<?php 

namespace Handytravelers\Http\Controllers;

use Carbon\Carbon;
use Handytravelers\Components\Homes\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Homes\Exceptions\RequestHasInvitationForUserException;
use Handytravelers\Components\Homes\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Homes\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Homes\Models\Request;
use Handytravelers\Components\Homes\Models\Request as RequestModel;
use Handytravelers\Components\Homes\Requests as HomeRequest;
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
            $request = Request::byIdWithRequestAndParticipants($id);
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
    public function showRequestForm()
    {
        if (!Auth::user()->filled()) {
            return redirect()->route('edit.profile')->with('error', 'Complete your profile first');
        }

        return view('request.new');
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
            'place' => 'required',
            'check_in' => 'required|date|date_format:Y-m-d|after:today',
            'check_out' => 'required|date|date_format:Y-m-d|after:check_in',
            'people' => 'required|integer|between:1,5',
            'body' => 'required|min:300',
        ]);

        try {
            $data = $request->all();

            $homeRequest = new HomeRequest($user);
            $homeRequest = $homeRequest->create([
                'place' => $data['place'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'people' => $data['people'],
                'body' => $data['body']
            ]);

            if ($homeRequest->active) {
                return redirect()->route('request.sent');
            }

            return redirect()->route('request.showCreateCustomer', ['requestId' => $homeRequest->uuid]);
        } catch (CityWhereUserLiveException $e) {
            return redirect()->route('dashboard')->with('error', 'You can\'t send a request where you live');
        } catch (ProfileNotCompletedException $e) {
            return redirect()->route('edit.profile')->with('error', 'Please complete your profile before send a request');
        } catch (GooglePlacesApiException $e) {
            return redirect()->back()->withInput($request->input())
            ->with('error', 'We couldn\'t find that place using the Google Maps. We\'re really sorry.');
        }
    }

    public function getRequestSent()
    {
        return view('request.sent');
    }

    public function showCreateCustomer($requestId)
    {
        return view('request.pay', compact('requestId'));
    }


    public function postCreateCustomer(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'stripeToken' => 'required',
            'requestId' => 'required'
        ]);

        $homeRequest = new HomeRequest($user);

        try {
            $homeRequest->activate(
                $homeRequest->getRequest($request->input('requestId')),
                $request->input('stripeToken')
            );
        } catch (Card $e) {
            return redirect()->route('request.showCreateCustomer', [$request->input('requestId')])->with('error', $e->getMessage());
        }

        return redirect()->route('request.sent');
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
    public function getShowRequest($id)
    {
        $user = Auth::user();
        
        try {
            $request = RequestModel::where('uuid', $id)->with('user')->firstOrFail();

            if (!$user->home->filled() && $request->user_id != $user->id) {
                return redirect()->route('edit.home')->with('error', 'To send a request you have to provide info about your home.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'That Request is not longer available.');
        }
       

        $homeInvitation = $request->user->home_id;

        $type = 'host';
        
        $request = [];

        return view('request.show', compact('request', 'request', 'type'));
    }

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


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function inbox()
    {
        $user = Auth::user();

        $requests = $user->requests()->has('invitations')->with('invitations.participants.user')->latest('updated_at')->get();

        $requests = $user->invitations()->latest('updated_at')->get();


        return view('request.inbox', compact('requests', 'invitations'));
    }

    public function postNewMessage(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request = Request::where('uuid', $request->input('invitationId'))->with('request')->firstOrFail();

        try {
            $homeRequest = new HomeRequest(Auth::user());

            $homeRequest->responseInvitation(
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
