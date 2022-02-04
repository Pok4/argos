<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Mail_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_mail($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."contacts WHERE id='$id'");
  }
  
};