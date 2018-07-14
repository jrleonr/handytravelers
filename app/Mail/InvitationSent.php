<?php

namespace Handytravelers\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationSent extends Mailable implements ShouldQueue
{
    public $invitation;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->invitation->sentBy->first_name . ' sent you an invitation for your Request in ' . $this->invitation->request->place->name)
            ->markdown('emails.invitations.new');
    }
}
