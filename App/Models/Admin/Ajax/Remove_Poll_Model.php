<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Poll_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_poll($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."dpolls_votes WHERE poll_id='$id'");
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."dpolls WHERE id='$id'");
  }

  
};