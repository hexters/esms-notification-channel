# ESMS Notification Channel for Laravel
How to use the Esms channel? firs you need to create  account from the https://esms.com.my 


Install the package with composer
```
composer require hexters/esms-notification-channel
```

open the .env configuratin, and add the code below
```
ESMS_USER=
ESMS_PASSWORD=
```

Set route notification in User class or our custom User class
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
    return ['mail', EsmsChannel::class];
}

. . .

/**
* Get the voice representation of the notification.
*
* @param  mixed  $notifiable
* @return EsmsResponse
*/
public function toEsms($notifiable) {
    return (new EsmsMessage)->content('Your SMS message content');
}

```
## SMS Manualy

If you will send SMS manualy, you can try
```
. . . 
use Hexters\Esms\SendEsms;

. . . 

$sms = new sendEsms;
$sms->to(608123481234)->message("RM0.00 Your OTP number is " . rand(1111,9999))->send();

```

Happy codding... ☕☕☕