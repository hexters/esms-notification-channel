<?php

namespace Hexters\Esms;

use Illuminate\Notifications\Notification;

use Hexters\Esms\EsmsMessage as SendMessage;
use Hexters\Esms\SendEsms as BaseEsms;

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

        $message = $notification->toEsms($notifiable);

        if(is_string($message)) {
          $message = new SendMessage($message);
        }

        $send = (new BaseEsms)->to($to)->message($message->content)->send();
    }
}
