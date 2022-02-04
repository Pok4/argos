<?php
namespace App\Models\Ajax;

use \PDO; 

class Chat_Remove_Message_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Get from db config chat_auto_delete | chat_auto_delete_after
  public function remove_message($id) {
   $this->db->query("DELETE FROM ".$this->argos_db_prefix."chat WHERE id='$id' LIMIT 1");
  }

  
};