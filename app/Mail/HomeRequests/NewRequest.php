<?php

namespace Handytravelers\Mail\HomeRequests;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRequest extends Mailable implements ShouldQueue
{
    public $request;
    public $user;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $user)
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
        return $this->subject($this->request->user->first_name . ' is looking for a host in ' . $this->request->place->name)->markdown('emails.requests.new');
    }
}
