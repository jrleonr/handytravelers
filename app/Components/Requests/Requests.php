<?php

namespace Handytravelers\Components\Requests;

use Carbon\Carbon;
use Handytravelers\Components\Requests\Exceptions\HomeRequestInactiveException;
use Handytravelers\Components\Requests\Exceptions\HostsCannotAnswerRequestException;
use Handytravelers\Components\Requests\Exceptions\RequestHasRequestForUserException;
use Handytravelers\Components\Requests\Exceptions\UserCityisNotRequestedCityException;
use Handytravelers\Components\Requests\Exceptions\UsersCantInviteThemselves;
use Handytravelers\Components\Homes\Models\Home;
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




    /**
     * Response an request recieved
     * @param  \Components\Homes\Models\Request $request
     * @param  array    $formData  
     */
    public function responseRequest(Request $request, array $formData)
    {
 

    }




}
