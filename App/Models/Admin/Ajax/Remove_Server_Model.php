<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Server_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_server($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."greyfish_servers WHERE id='$id'");
  }

  
};