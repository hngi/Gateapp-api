<?php

namespace App\Notifications;

use App\User;
use App\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class VisitorArrivalNotification extends Notification implements ShouldQueue
{
    use Queueable, ResolveChannelsTrait;

    private $resident;
    private $visitor;
    private $gateman;
    private $title;
    private $body;
    private $checkingOut;

    /**
     * Create a new notification instance.
     * @param User $resident
     * @param User $gateman
     * @param Visitor $visitor
     * @param bool $checkingOut
     */
    public function __construct(User $resident, User $gateman, Visitor $visitor, bool $checkingOut)
    {
        $this->resident = $resident;
        $this->visitor = $visitor;
        $this->gateman = $gateman;
        $this->checkingOut = $checkingOut;
        if($checkingOut)
        {
        $this->title = 'Visitor Checked Out';
        $this->body = $this->visitor->name .  "has left,They are being checked out by {$this->gateman->name}";
        } else{
             $this->title = 'Visitor Arrival';
        $this->body = $this->visitor->name .  "has arrived to see you \n They are being checked in by {$this->gateman->name}";
        }

       
        
        
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->resolveChannels($this->resident);
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
                'visitor_details' => $this->visitor->toArray(),
                'gateman_details' => $this->gateman->toArray(),
                'click_action' => 'FLUTTER_NOTIFICATION_ACTION',
                'type' => 'visitor_arrival_notification'
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
       return $this->resident->fcm_token;
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
            'visitor_details' => $this->visitor->toArray(),
            'gateman_details' => $this->gateman->toArray(),
        ];
    }
}
