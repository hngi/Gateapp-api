<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GatemanAdmitsVisitor extends Notification
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
        return ['fcm'];
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
                'visitor_id' => $this->message['visitor_id']
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
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
            'visitor_id' => $this->message['visitor_id']
        ];
    }
}
