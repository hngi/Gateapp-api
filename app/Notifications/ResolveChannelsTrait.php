<?php


namespace App\Notifications;


trait ResolveChannelsTrait
{
  private function resolveChannels($target_user)
  {
      if (empty($target_user->settings)) {
          return ['database', 'fcm'];
      }

      $channels = [];
      if ($target_user->settings->app_notification) {
          $channels[] = 'database';
      }

      if ($target_user->settings->push_notification) {
          $channels[] = 'fcm';
      }
      return $channels;
  }
}
