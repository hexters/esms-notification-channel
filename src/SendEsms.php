<?php 

namespace Hexters\Esms;

class SendEsms {

  private $message;
  private $to;

  public function to($to) {
    $this->to = $to;
    return $this;
  }

  public function message($msg) {
    $this->message = $msg;
    return $this;
  }

  public function send() {
    if(empty($this->message)) {
      return "Message cannot empty!";
    }

    if(empty($this->to)) {
      return "Phone number cannot empty";  
    }

    $params = http_build_query([
      'user' => env('ESMS_USER', ''),
      'pass' => env('ESMS_PASSWORD', ''),
      'to' => $this->to,
      'msg' => trim($message->content)
    ]);
    $esms = 'https://api.esms.com.my/sms/send?' . $params;
    return file_get_contents($esms);
    
  }

}