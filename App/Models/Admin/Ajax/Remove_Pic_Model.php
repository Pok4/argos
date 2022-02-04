<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Pic_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function get_pic_link($id) {
    $go = $this->db->query("SELECT pic_link FROM ".$this->argos_db_prefix."gallery WHERE id='$id'");
    $row = $go->fetch(PDO::FETCH_ASSOC);
    return $row['pic_link'];
  }
  
  public function remove_pic($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."gallery WHERE id='$id'");
  }

  
};