# ESMS Notification Channel for Laravel
How to use the Esms chanel? firs you need to create  account from the https://esms.com.my 


Install the package with composer
```
composer require hexters/esms-notification-channel
```

open the .env configuratin, and add the code below
```
ESMS_USER=
ESMS_PASSWORD=
```

set route notification in User class or our custome User class
```
. . .

Class User extends Authenticatable  {

. . .

public function routeNotificationForEsms($notification) {
  return $this->phone;
}

. . .
```

How to use? in the notification class please add.
```
<?php 

namespace App\Notifications;
. . .

use Hexters\Esms\EsmsChannel;
use Hexters\Esms\EsmsMessage;

. . .

class InvoicePaid extends Notification {

. . . 

/**
* Get the notification channels.
*
* @param  mixed  $notifiable
* @return array|string
*/
public function via($notifiable) {
    return [EsmsChannel::class];
}

. . .

/**
* Get the voice representation of the notification.
*
* @param  mixed  $notifiable
* @return VoiceMessage
*/
public function toEsms($notifiable) {
    return (new EsmsMessage)->content('Your SMS message content');
}

```

Happy codding... ☕☕☕