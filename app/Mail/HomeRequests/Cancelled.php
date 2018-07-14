<?php

namespace Handytravelers\Mail\HomeRequests;

use Handytravelers\Components\Requests\Models\Request;
use Handytravelers\Components\Users\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Cancelled extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $request;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $place = $this->request->placeName();

        return $this->subject($this->user->first_name . ' has cancelled the request to ' . $place)->markdown('emails.requests.cancelled');
    }
}
