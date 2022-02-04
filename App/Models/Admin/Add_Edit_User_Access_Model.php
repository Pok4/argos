<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Edit_User_Access_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function check_access() {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."custom_user_access");
    return $get->rowCount();
  }
  
  public function fetch_access() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."custom_user_access");
  }
  
  public function check_if_username_exist($username) {
    $check = $this->db->prepare("SELECT username from `".$this->forum_db."`.".$this->forum_db_prefix."_users WHERE username=?");
    $check->bindParam(1, $username, PDO::PARAM_STR);
    $check->execute(); 
    return $check->rowCount();
  }
  
  public function add_access($username, $access_pages) {
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."custom_user_access  (username,pages) VALUES(?,'$access_pages')");
    $go->bindParam(1, $username, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};