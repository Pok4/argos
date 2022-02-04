<?php
namespace App\Controllers\Ajax;

use \PDO; 

class Chat_Remove_Message extends \App\Controllers\BaseController {
  
  public function __construct() {
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\Chat_Remove_Message_Model; 
  }
    
  public function Chat_Remove_Message() {
    if(is_ajax())
    { 
        $id = (int)$_GET['id'];	
        $this->model->remove_message($id);
        echo $this->lang['lang_success_delete']." #$id";
    }
  }

};