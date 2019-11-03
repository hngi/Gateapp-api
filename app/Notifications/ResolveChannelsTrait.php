<?php


namespace App\Notifications;


trait ResolveChannelsTrait
{
  private function resolveChannels($target_user)
  {
      $settings = $target_user->settings;
      if (empty($settings)) {
          return ['database', 'fcm'];
      }

      $channels = [];
      if ($settings->app_notification) {
          $channels[] = 'database';
      }

      if ($settings->push_notification) {
          $channels[] = 'fcm';
      }
      return $channels;
  }
}
