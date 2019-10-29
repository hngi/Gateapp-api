<?php

namespace App\Providers\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        // Log Errors, if any, from FirebaseNotifications
        $this->logFcmError($event);

    }

    private function logFcmError(NotificationSent $event)
    {
        if ($event->channel === 'fcm' && ($event->response[0]['failure'] != 0)) {
            Log::error("==========FCM NOTIFICATION ERROR==========\n" . print_r($event->response[0]['results'], true));
        }
    }
}
