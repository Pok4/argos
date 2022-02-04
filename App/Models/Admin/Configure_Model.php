<?php
namespace App\Models\Admin;

use \PDO; 

class Configure_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function get_info_from_config() {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."config");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function update_config_db($col,$val) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."config SET ".$col."=?");
    $go->bindParam(1, $val, PDO::PARAM_STR);
    $go->execute(); 
  }
  
 
  
};