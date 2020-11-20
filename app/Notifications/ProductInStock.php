<?php

namespace App\Notifications;

use App\Models\Watcher;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductInStock extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var $watcher */
    public $watcher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Watcher $watcher)
    {
        $this->watcher = $watcher;
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
                    ->subject($this->watcher->product_name . " now in stock!")
                    ->greeting("It's time!")
                    ->line($this->watcher->product_name . " appears to be in stock over at " . $this->watcher->store. "!")
                    ->line("The current stock is: " . $this->watcher->stock_status)
                    ->action('Go get it now', $this->watcher->product_url)
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
