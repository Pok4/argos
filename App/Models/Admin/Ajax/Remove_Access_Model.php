<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Access_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_access($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."custom_user_access WHERE id='$id'");
  }

  
};