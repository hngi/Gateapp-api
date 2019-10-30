<?php


namespace App\Notifications;


trait ResolveChannelsTrait
{
  private function resolveChannels($target_user)
  {
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
