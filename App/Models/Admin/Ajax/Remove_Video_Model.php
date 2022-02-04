<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Video_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_video($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."uploadvideos WHERE id='$id'");
  }

  
};