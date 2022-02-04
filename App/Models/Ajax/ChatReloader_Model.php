<?php
namespace App\Models\Ajax;

use \PDO; 

class ChatReloader_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Get from db config chat_auto_delete | chat_auto_delete_after
  public function get_from_config() {
   return $this->db->query("SELECT chat_auto_delete,chat_auto_delete_after FROM ".$this->argos_db_prefix."config");
  }
  
  public function roller() {
    return $this->db->query("SELECT count(id) as roller from ".$this->argos_db_prefix."chat");
  }
  
  public function deleter($count) {
    return $this->db->query("DELETE FROM ".$this->argos_db_prefix."chat ORDER BY id ASC LIMIT $count");
  }
  
  public function get_chat($limit_chat) {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."chat INNER JOIN `".$this->forum_db."`.".$this->forum_db_prefix."_users ON name=username ORDER by id ASC LIMIT $limit_chat");
  }
  
};