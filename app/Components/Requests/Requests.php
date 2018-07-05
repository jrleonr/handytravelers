<?php

namespace Handytravelers\Components\Homes;

use Carbon\Carbon;
use Handytravelers\Components\Requests\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Requests\Exceptions\HostsCannotAnswerInvitationException;
use Handytravelers\Components\Requests\Exceptions\RequestHasInvitationForUserException;
use Handytravelers\Components\Requests\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Requests\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Offers\Models\Home;
use Handytravelers\Components\Requests\Models\{Request,Invitation,Message,Participant};
use Handytravelers\Components\Places\Models\Place;
use Handytravelers\Components\Places\Places;
use Handytravelers\Components\Users\Exceptions\CityWhereUserLiveException;
use Handytravelers\Components\Users\Exceptions\ProfileNotCompletedException;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Events\HomeRequested;
use Handytravelers\Jobs\NewMessageNotification;
use Handytravelers\Mail\Invitations\{NewInvitation,Accepted,Cancelled,Declined,NewMessage};
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;

class Requests
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create a new request
     * 
     * @param  array $formData
     * 
     */
    public function create(array $formData)
    {
        if(!$this->user->filled()) {
            throw new ProfileNotCompletedException;
        }

        $places = Places::setPlace($formData['place']);

        if(!$places) {
            throw new GooglePlacesApiException;
        }

        $place_id = Home::where('id', '=', $this->user->home_id)->first()->place_id;

        //user live here
        if($place_id == $places['city'] ) {
            throw new CityWhereUserLiveException('You live here!');
        }
          
        $request = Request::create([
            'uuid' => Uuid::uuid4(),
            'check_in' => $formData['check_in'],
            'check_out' => $formData['check_out'],
            'people' => $formData['people'],
            'body' => $formData['body'],
            'place_id' => $places['city'],
            'user_id' => $this->user->id,
            'active' => 0
        ]);
        
        $this->activate($request);

        return $request;
    }

    public function activate(Request $request, $token = '')
    {
        //it's going to be free, no need for customer
        // if(! $this->user->stripe_id) {
        //     $this->user->createCustomer($token);
        // }

        if(! $request->isActive()) {
            $request->activate();

            event(new HomeRequested($request));

        }

        return $request;
    }

    public function createInvitation(Request $request, string $body)
    {
        if($request->active == 0) {
            throw new HomeRequestInactiveException;
        }

        if($request->user_id === $this->user->id) {
            throw new UsersCantInviteThemselves;
        }

        if(! in_array($request->place_id, Place::getPlacesAroundIdsArray($this->user->home->place_id) ) ) {
            throw new UserCityisNotRequestedCityException;
        }

        if( $request->isAPreviousInvitation($this->user->id) ){
            throw new RequestHasInvitationForUserException;
        }

        $invitation = Invitation::create([
            'uuid' => Uuid::uuid4(),
            'status' => 'pending',
            'sent_by' => $this->user->id,
            'request_id' => $request->id
        ]);

        $invitation->addMessage($body, $this->user->id);

        $participants = [
            ['user_id' => $this->user->id, 'last_read' => Carbon::now() ],
            ['user_id' => $request->user->id, 'last_read' => null ]
        ];

        $invitation->addParticipants($participants);

        Mail::to($request->user->email)->send(new NewInvitation($invitation));

        return $invitation;
    }

    /**
     * Response an invitation recieved
     * @param  \Components\Homes\Models\Invitation $invitation
     * @param  array    $formData  
     */
    public function responseInvitation(Invitation $invitation, array $formData)
    {
        //check if the invitations is decline or cancelled, and dont let do anything else
        if($invitation->isInactive()) {
            throw new \Exception("You are not allow to anwser this invitation because is close");
        }

        $invitation->isParticipant($this->user);

        $mail = NewMessage::class;

        if( isset($formData['accept']) || isset($formData['decline']) ) {

            if ( $invitation->isHost($this->user)){
                throw new HostsCannotAnswerInvitationException;
            }

            if(isset($formData['accept'])) {
                $invitation->accept($this->user);
                $mail = Accepted::class;
            } else {
                $invitation->decline();
                $mail = Declined::class;

            }
        } 

        if( isset($formData['cancel']) ) {
            $invitation->cancel();
            $mail = Cancelled::class;
        }

        //TODO review this
        if($invitation->isPending()) {
            return false;
        }

        $invitation->addMessage($formData['body'], $this->user->id);
        Mail::to($invitation->getUsersWithoutMe($this->user))->send(new $mail($invitation, $this->user));

    }

    public function getRequest($uuid)
    {
        return Request::where([
            ['uuid', '=', $uuid]
        ])->firstOrFail();
    }


}
