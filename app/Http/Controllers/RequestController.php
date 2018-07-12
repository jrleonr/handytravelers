<?php 

namespace Handytravelers\Http\Controllers;

use Carbon\Carbon;
use Handytravelers\Components\Homes\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Homes\Models\Home;
use Handytravelers\Components\Images\Images;
use Handytravelers\Components\Payments\Exceptions\UserDoesntHaveStripeTokenException;
use Handytravelers\Components\Requests\Exceptions\GuestsCannotAnswerRequestException;
use Handytravelers\Components\Requests\Exceptions\RequestHasInvitationForUserException;
use Handytravelers\Components\Requests\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Requests\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Requests\Models\Request as HomeRequest;
use Handytravelers\Components\Users\Exceptions\CityWhereUserLiveException;
use Handytravelers\Components\Users\Exceptions\ProfileNotCompletedException;
use Handytravelers\Components\Users\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use Stripe\Error\Card;

class RequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();

        try {
            $request = HomeRequest::byIdWithRequestAndParticipants($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', 'The request with ID: ' . $id . ' was not found.');

            return redirect()->route('inbox');
        }
       
        $request->userRole = $request->userRole($user);
        $type = $request->userRole;

        $request->markAsRead($user->id);

        return view('request.show', compact('request', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function showRequestForm($home)
    {
        $home = Home::where('id', $home)->with('users')->first();

        if (!Auth::user()->filled()) {
            return redirect()->route('edit.profile')->with('error', 'Complete your profile first');
        }

        return view('request.new', compact('home'));
    }


    /**
     * Create a new request
     *
     * @param Request $request
     * @return Response
     */
    public function postRequestForm(Request $request)
    {

        $this->validate($request, [
            'home_id' => 'required',
            'check_in' => 'required|date|date_format:Y-m-d|after:today',
            'check_out' => 'required|date|date_format:Y-m-d|after:check_in',
            'people' => 'required|integer|between:1,5',
            'body' => 'required|min:300',
        ]);
        
        $user = Auth::user();
         $data = $request->all();
        $home = Home::where('id', $data['home_id'])->first();

        if(!$user->filled()) {
            throw new ProfileNotCompletedException;
        }

        if($home->id === $user->home_id) {
            throw new UsersCantInviteThemselves;
        }

        

        try {

            //'accepted','declined','pending','cancelled'
            $request = HomeRequest::create([
                'uuid' => Uuid::uuid4(),
                'home_id' => $home->getId(),
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'people' => $data['people'],
                'body' => $data['body'],
                'place_id' => $home->getPlaceId(),
                'status' => 'pending',
                'waiting_action' => 'host',    
                'user_id' => $user->id,
            ]);
        
        //event(new HomeRequested($request));
        
        $request->addMessage($data['body'], $user->id);

        $participants = [
            ['user_id' => $user->id, 'role' => 'guest', 'last_read' => Carbon::now() ]
        ];

        foreach ($home->users as $user) {
            $participants[] = ['user_id' => $user->id, 'role' => 'host', 'last_read' => null ];
        }

        $request->addParticipants($participants);

        //Mail::to($request->user->email)->send(new NewRequest($request));

            return redirect()->route('request.show', ['id' => $request->uuid] );

            ///return redirect()->route('request.showCreateCustomer', ['requestId' => $homeRequest->uuid]);
        } catch (CityWhereUserLiveException $e) {
            return redirect()->route('dashboard')->with('error', 'You can\'t send a request where you live');
        } catch (ProfileNotCompletedException $e) {
            return redirect()->route('edit.profile')->with('error', 'Please complete your profile before send a request');
        } catch (GooglePlacesApiException $e) {
            return redirect()->back()->withInput($request->input())
            ->with('error', 'We couldn\'t find that place using the Google Maps. We\'re really sorry.');
        }
    }

    public function postNewMessage(Request $request)
    {
        
        $this->validate($request, [
            'body' => 'required',
            'requestId' => 'required'
        ]);

        $user = Auth::user();
        $homeRequest = HomeRequest::where('uuid', $request->input('requestId'))->firstOrFail();

        try {

            $data = request(['accept', 'decline', 'cancel', 'body']);

                   //check if the requests is decline or cancelled, and dont let do anything else
        if($homeRequest->isInactive()) {
            throw new \Exception("You are not allow to anwser this request because is close");
        }

        $homeRequest->isParticipant($user);

        $mail = NewMessage::class;

        if( isset($data['accept']) || isset($data['decline']) ) {

            if ( $homeRequest->isGuest($user)){
                throw new GuestsCannotAnswerRequestException("You can't do that");
            }

            if(isset($data['accept'])) {
                $homeRequest->accept($user);
                $mail = Accepted::class;
            } else {
                $homeRequest->decline();
                $mail = Declined::class;

            }
        } 

        if( isset($data['cancel']) ) {
            $homeRequest->cancel();
            $mail = Cancelled::class;
        }


        $homeRequest->addMessage($data['body'], $user->id);
        //Mail::to($homeRequest->getUsersWithoutMe($user))->send(new $mail($homeRequest, $user));



        } catch (UserDoesntHaveStripeTokenException $e) {
            return redirect()->route('request.showCreateCustomer', ['requestId' => $homeRequest->uuid])->with('error', "Add a credit card, please.");
        } catch (\Exception $e) {
            return redirect()->route('request.show', [$homeRequest->uuid])->with('error', $e->getMessage());
        }


        return Redirect::route('request.show', [$homeRequest->uuid]);
    }
}
