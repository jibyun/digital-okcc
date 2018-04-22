<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Get the notification's delivery channels.
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $name = $notifiable->name;
        return (new MailMessage)
            ->from(env('MAIL_USERNAME', 'it.help@okcc.ca'), 'OCO Admin')
            ->subject("Complete OKCC Cloud Office registration")
            ->greeting(sprintf('Hello %s', $name))
            ->line('You have successfully registered to OKCC Cloud Office system. Your current initial password is "password". Please change your password immediately.')
            ->line('Thank you for using OKCC Cloud Office system!');
    }

    /**
     * Get the array representation of the notification.
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
