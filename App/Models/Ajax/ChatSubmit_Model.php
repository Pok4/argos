<?php
namespace App\Models\Ajax;

use \PDO; 

class ChatSubmit_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Pic Insert
  public function chat_submit($convertd,$user_ava,$username,$chattext) {
      $chattext = htmlspecialchars($chattext);
      $go = $this->db->prepare("INSERT INTO `".$this->argos_db_prefix."chat` (name, text, date,avatar) VALUES(?, ?, '$convertd','$user_ava')");
      $go->bindParam(1, $username, PDO::PARAM_STR); 
      $go->bindParam(2, $chattext, PDO::PARAM_STR);
      $go->execute();  
  } 
  
};