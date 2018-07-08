<?php

namespace Handytravelers\Components\Requests;

use Carbon\Carbon;
use Handytravelers\Components\Requests\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Requests\Exceptions\HostsCannotAnswerRequestException;
use Handytravelers\Components\Requests\Exceptions\RequestHasRequestForUserException;
use Handytravelers\Components\Requests\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Requests\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Offers\Models\Home;
use Handytravelers\Components\Requests\Models\{Request,Message,Participant};
use Handytravelers\Components\Places\Models\Place;
use Handytravelers\Components\Places\Places;
use Handytravelers\Components\Users\Exceptions\CityWhereUserLiveException;
use Handytravelers\Components\Users\Exceptions\ProfileNotCompletedException;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Events\HomeRequested;
use Handytravelers\Jobs\NewMessageNotification;
use Handytravelers\Mail\Requests\{NewRequest,Accepted,Cancelled,Declined,NewMessage};
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
    public function create(array $formData, $home)
    {
        if(!$this->user->filled()) {
            throw new ProfileNotCompletedException;
        }

        if($home->id === $this->user->home_id) {
            throw new UsersCantInviteThemselves;
        }

        //$places = Places::setPlace($formData['place']);

        // if(!$places) {
        //     throw new GooglePlacesApiException;
        // }

        $place_id = $home->getPlaceId();
          
        $request = Request::create([
            'uuid' => Uuid::uuid4(),
            'offer_id' => $home->getId(),
            'offer_type' => 'home',
            'check_in' => $formData['check_in'],
            'check_out' => $formData['check_out'],
            'people' => $formData['people'],
            'body' => $formData['body'],
            'place_id' => $home->place_id,
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
        
        //event(new HomeRequested($request));
        
        $request->addMessage($formData['body'], $this->user->id);

        $participants = [
            ['user_id' => $this->user->id, 'last_read' => Carbon::now() ]
        ];

        foreach ($home->users as $user) {
            $participants[] = ['user_id' => $user->id, 'last_read' => null ];
        }

        $request->addParticipants($participants);

        //Mail::to($request->user->email)->send(new NewRequest($request));

        return $request;
    }


    /**
     * Response an request recieved
     * @param  \Components\Homes\Models\Request $request
     * @param  array    $formData  
     */
    public function responseRequest(Request $request, array $formData)
    {
        //check if the requests is decline or cancelled, and dont let do anything else
        if($request->isInactive()) {
            throw new \Exception("You are not allow to anwser this request because is close");
        }

        $request->isParticipant($this->user);

        $mail = NewMessage::class;

        if( isset($formData['accept']) || isset($formData['decline']) ) {

            if ( $request->isHost($this->user)){
                throw new HostsCannotAnswerRequestException;
            }

            if(isset($formData['accept'])) {
                $request->accept($this->user);
                $mail = Accepted::class;
            } else {
                $request->decline();
                $mail = Declined::class;

            }
        } 

        if( isset($formData['cancel']) ) {
            $request->cancel();
            $mail = Cancelled::class;
        }


        $request->addMessage($formData['body'], $this->user->id);
        //Mail::to($request->getUsersWithoutMe($this->user))->send(new $mail($request, $this->user));

    }

    public function getRequest($uuid)
    {
        return Request::where([
            ['uuid', '=', $uuid]
        ])->firstOrFail();
    }


}
