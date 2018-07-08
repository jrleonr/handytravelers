<?php 

namespace Handytravelers\Http\Controllers;

use Carbon\Carbon;
use Handytravelers\Components\Homes\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Requests\Exceptions\RequestHasInvitationForUserException;
use Handytravelers\Components\Requests\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Requests\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Requests\Models\Request as RequestModel;
use Handytravelers\Components\Offers\Models\Home;
use Handytravelers\Components\Requests\Requests as HomeRequest;
use Handytravelers\Components\Images\Images;
use Handytravelers\Components\Payments\Exceptions\UserDoesntHaveStripeTokenException;
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
            $request = RequestModel::byIdWithRequestAndParticipants($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', 'The request with ID: ' . $id . ' was not found.');

            return redirect()->route('inbox');
        }
       
        //$request = $request->request;

        $request->userRole = $request->userRole($user);
        $type = $request->userRole;
        if ($request->userRole == 'guest' && ! $user->stripe_id) {
            return redirect()->route('request.showCreateCustomer', [$request->uuid])->with('error', 'Please set up to a payment to be able to anwser an request');
        }

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
        $user = Auth::user();

        $this->validate($request, [
            'offer_id' => 'required',
            'check_in' => 'required|date|date_format:Y-m-d|after:today',
            'check_out' => 'required|date|date_format:Y-m-d|after:check_in',
            'people' => 'required|integer|between:1,5',
            'body' => 'required|min:300',
        ]);



        try {
            $data = $request->all();

            $home = Home::where('id', $data['offer_id'])->first();

            //'accepted','declined','pending','cancelled'
            $homeRequest = new HomeRequest($user, $home);
            $homeRequest = $homeRequest->create([
                'offer_id' => $data['offer_id'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'people' => $data['people'],
                'body' => $data['body']
            ]);

            return redirect()->route('request.sent');

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

    public function postDeleteRequest(Request $request)
    {
        // $request = r::where('hash', $request->input('hash'))->firstOrFail();

        // if ($request->user_id != $user->id) {
        //     return 'This requests is from another user';
        // }

        // $request->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    // public function getShowRequest($id)
    // {
    //     $user = Auth::user();
    
    //     try {
            
    //         $request = RequestModel::where('uuid', $id)->with('user','messages')->firstOrFail();

    //         //$host = User::where('username', $host)->with('home')->firstOrFail();

    //         // if (!$user->home->filled() && $host->id != $user->id) {
    //         //     return redirect()->route('edit.home')->with('error', 'To send a request you have to provide info about your home.');
    //         // }
    //     } catch (ModelNotFoundException $e) {
    //         return redirect()->route('dashboard')->with('error', 'That Request is not longer available.');
    //     }

    //     $type = 'host';
        

    //     return view('request.show', compact('request', 'type'));
    // }

    public function sendInvite(Request $request)
    {
        $this->validate($request, [
            'requestId' => 'required',
            'body' => 'required'
        ]);

        try {
            $homeRequest = new HomeRequest(Auth::user());

            $request = $homeRequest->createInvitation(
                $homeRequest->getRequest($request->input('requestId')),
                $request->input('body')
            );
        } catch (UserCityisNotRequestedCityException $e) {
            return redirect()->back()->with('error', 'You don\'t live there!');
        } catch (HomeRequestInactiveException $e) {
            return redirect()->route('dashboard')->with('error', 'This request is not longer available. The user cancelled or has accepted another request. Thank you for sending a request, try with a different traveler!');
        } catch (UsersCantInviteThemselves $e) {
            return redirect()->route('dashboard')->with('error', 'You can\'t invite yourself.');
        } catch (RequestHasInvitationForUserException $e) {
            return redirect()->route('dashboard')->with('error', 'You already sent an request for this request.');
        }

        return redirect()->route('request.show', ['message' => $request->uuid ]);
    }



    public function postNewMessage(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'requestId' => 'required'
        ]);

        $request = RequestModel::where('uuid', $request->input('requestId'))->firstOrFail();

        try {
            $homeRequest = new HomeRequest(Auth::user());

            $homeRequest->responseRequest(
                $request,
                request(['accept', 'decline', 'cancel', 'body'])
            );
        } catch (UserDoesntHaveStripeTokenException $e) {
            return redirect()->route('request.showCreateCustomer', ['requestId' => $request->uuid])->with('error', "Add a credit card, please.");
        } catch (\Exception $e) {
            return redirect()->route('request.show', [$request->uuid])->with('error', $e->getMessage());
        }


        return Redirect::route('request.show', [$request->uuid]);
    }
}
