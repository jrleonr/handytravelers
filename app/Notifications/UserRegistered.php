<?php

namespace Handytravelers\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (str_contains($notifiable->locale, 'en')) {
            return (new MailMessage)
            ->from('joseleon@handytravelers.com', 'Jose at Handytravelers')
            ->subject('Does this sound like you?')
            ->markdown('emails.users.en.welcome', ['user' => $notifiable]);
        } else {
            return (new MailMessage)
            ->from('joseleon@handytravelers.com', 'Jose de Handytravelers')
            ->subject('¿Te recuerda a ti?')
            ->markdown('emails.users.es.welcome', ['user' => $notifiable]);
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
