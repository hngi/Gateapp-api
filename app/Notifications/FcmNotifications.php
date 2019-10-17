<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class FcmNotifications extends Notification
{
    use Queueable;
    protected $notify_message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notify_message)
    {
        $this->notify_message = $notify_message;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toFcm($notifiable)
    {



        $message = new FcmMessage();
        $message->content([
            'title' => $this->notify_message['title'],
            'body' => $this->notify_message['body'],
        ])->priority(FcmMessage::PRIORITY_HIGH);

        // Notification::create([
        //     'resident_id' => 1,
        //     'gateman_id' => 2,
        //     'visitor_id' => 3,
        //     'home_id' => 4,
        //     'type' => 'gateman_invite',
        //     'title' => $this->notify_message['title'],
        //     'body' => $this->notify_message['body']
        // ]);

        return $message;
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
