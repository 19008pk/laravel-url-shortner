<?php

namespace App\Notifications;

use App\Models\ShortUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShortUrlCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $shortUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Short URL is Ready')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your short URL has been successfully created.')
            ->action('Visit Short URL', route('short-urls.redirect', $this->shortUrl->short_code))
            ->line('Thanks for using our service!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
