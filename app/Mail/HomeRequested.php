<?php

namespace Handytravelers\Mail;

use Handytravelers\Components\Homes\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HomeRequested extends Mailable implements ShouldQueue
{
    public $request;
    public $name;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request, $name)
    {
        $this->request = $request;
        $this->name = $name;
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
