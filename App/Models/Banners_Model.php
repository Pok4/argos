<?php
namespace App\Models;

use \PDO; 

class Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function get_from_banners($type) {
    return $this->db->query("SELECT * FROM `".$this->argos_db_prefix."banners` WHERE type='".$type."' ORDER by id");
  }
  
  public function check_for_banners() {
    return $this->db->query("SELECT id FROM `".$this->argos_db_prefix."banners`");
  }
  
};