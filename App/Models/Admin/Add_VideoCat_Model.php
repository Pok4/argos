<?php
namespace App\Models\Admin;

use \PDO; 

class Add_VideoCat_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function check_cat_exists($catname) {
    $go = $this->db->prepare("SELECT * FROM ".$this->argos_db_prefix."videocat WHERE category=?");
    $go->bindParam(1, $catname, PDO::PARAM_STR);
    $go->execute(); 
    return $go->rowCount();
  }
  
  public function add_video_cat($catname) {
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."videocat (`category`) VALUES(?)");
    $go->bindParam(1, $catname, PDO::PARAM_STR);
    $go->execute(); 
  }
 
 
  
};