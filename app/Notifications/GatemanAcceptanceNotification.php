<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class GatemanAcceptanceNotification extends Notification
{
    use Queueable;
    protected $message;

    /**
     * Create a new notification instance.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['fcm', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return FcmMessage
     */

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message
            ->content([
            'title' => $this->message['title'],
            'body' => $this->message['body'],
            ])
            ->data([
                'resident_id' => $this->message['resident_id'],
                'gateman_id' => $this->message['gateman_id'],
                'home_id' => $this->message['home_id'] ?? null,
            ])
            ->priority(FcmMessage::PRIORITY_HIGH);

        return $message;
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
//        return $this->device_token;
    }


        public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     * This will be JSON encoded into the data column
     * of the notifications table
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->message['title'],
            'body' => $this->message['body'],
            'resident_id' => $this->message['resident_id'],
            'gateman_id' => $this->message['gateman_id'],
            'home_id' => $this->message['home_id'] ?? null,
        ];
    }
}
