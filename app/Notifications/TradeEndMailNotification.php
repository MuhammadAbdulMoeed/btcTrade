<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
class TradeEndMailNotification extends Notification
{
    use Queueable;
    public $user;
    public $position;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user,$position)
    {
        $this->user = $user;
        $this->position = $position;
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
        $mailData = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'position' => $this->position
        ];

        return (new MailMessage)->subject('IV-Capital Close Trade Position')->markdown(
            'email.trade-close', ['mailData' => $mailData]
        );

//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
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
