<?php

namespace Hexters\Esms;

use Illuminate\Notifications\Notification;

use Hexters\Esms\EsmsMessage;

class EsmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification) {

      if(! $to = $notifiable->routeNotificationFor('Esms')) {
        return;
      }

        $message = $notification->toVoice($notifiable);

        if(is_string($message)) {
          $message = new EsmsMessage($message);
        }

        $params = http_build_query([
          'user' => env('ESMS_USER', ''),
          'pass' => env('ESMS_PASSWORD', ''),
          'to' => $to,
          'msg' => trim($message->content)
        ]);
        $esms = 'https://api.esms.com.my/sms/send?' . $params;
        $send = file_get_contents($esms);
        
    }
}