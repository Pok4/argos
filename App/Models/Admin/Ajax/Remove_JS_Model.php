<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_JS_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_js($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."jquery_js WHERE id='$id'");
  }
  
};