<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class GatemanInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable, ResolveChannelsTrait;

    protected $resident;
    protected $gateman;
    private $title;
    private $body;

    /**
     * Create a new notification instance.
     * @param User $resident
     * @param User $gateman
     */
    public function __construct(User $resident,  User $gateman)
    {
        $this->resident = $resident;
        $this->gateman = $gateman;

        $this->title = "Invite";
        $this->body = "{$this->resident->name}  has invited you as a gateman to his home";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->resolveChannels($this->gateman);
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
                'resident' => $this->resident,
                'click_action' => 'FLUTTER_NOTIFICATION_ACTION',
                'type' => 'gateman_invitation_notification'
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
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'resident_id' => $this->resident->id,
        ];
    }
}
