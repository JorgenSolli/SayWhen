<?php

namespace App\Notifications;

use Illuminate\Support\Arr;
use App\Models\VerifiedEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerification extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var VerifiedEmail */
    public $verifiedEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(VerifiedEmail $verifiedEmail)
    {
        $this->verifiedEmail = $verifiedEmail;
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
        return (new MailMessage)
                    ->subject("Verify your " . config('app.name') . " watchlist")
                    ->greeting("Welcome to " . config('app.name'))
                    ->line("In order to receive notifications when the products you watch are in stock, you need to verify your email")
                    ->action(
                        'Verify',
                        url('/email/verify?') . 
                        Arr::query(['token' => $this->verifiedEmail->token, 'email' => $this->verifiedEmail->email])
                    )
                    ->line('Thank you for using SayWhen');
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
