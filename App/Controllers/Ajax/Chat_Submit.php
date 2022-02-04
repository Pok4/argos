<?php
namespace App\Controllers\Ajax;

class Chat_Submit extends \App\Controllers\BaseController {
  
  public function __construct() {
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\ChatSubmit_Model; 
  }
    
  public function Chat_Submit() {
    if(is_ajax())
    { 
          $date = time();
          $convertd = date('d.m.y / H:i', $date);
          $chattext=$_POST["text1"];
          $user_ava=get_user_ava();

          if ((!strlen(trim($chattext)) || strlen($chattext) > 300) || $this->is_bot || $this->is_anonymous) {
            return;
          }

          $username=$_POST["usernamec"];
          
          $this->model->chat_submit($convertd,$user_ava,$username,$chattext);
          
 
    }
  }

};