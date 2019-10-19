<?php

namespace App\Notifications;

use App\User;
use App\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class GatemanAdmitsVisitor extends Notification
{
    use Queueable;

    protected $visitor;
    protected $gateman;
    private $title;
    private $body;

    /**
     * Create a new notification instance.
     * @param Visitor $visitor
     * @param User $gateman
     */
    public function __construct(User $gateman, Visitor $visitor)
    {
        $this->visitor = $visitor;
        $this->gateman = $gateman;

        $this->title = $this->visitor->name .  "has arrived to see you";
        $this->body = null;
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
            'title' => $this->title,
            'body' => $this->body,
            ])
            ->data([
                'visitor_id' => $this->visitor->id
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
       return $this->gateman->fcm_token;
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
            'title' => $this->title,
            'body' => $this->body,
            'visitor_id' => $this->visitor->id
        ];
    }
}
