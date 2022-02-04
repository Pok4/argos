<?php
namespace App\Models\Admin;

use \PDO; 

class Add_AboutUS_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
   public function get_aboutus() {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."aboutus");
    $row = $get->fetch(PDO::FETCH_ASSOC);
    return $row['aboutus'];
   }
   
   public function update_aboutus($aboutus_post) {
      $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."aboutus SET aboutus=?");
      $go->bindParam(1, $aboutus_post, PDO::PARAM_STR);
      $go->execute(); 
   }

  
};