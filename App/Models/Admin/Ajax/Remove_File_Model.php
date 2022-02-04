<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_File_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_file($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."files WHERE id='$id'");
  }
  
};