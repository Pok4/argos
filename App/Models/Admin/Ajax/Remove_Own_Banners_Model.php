<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Own_Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_banner($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."banners WHERE id='$id'");
  }

  
};