<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Menu_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_menu($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."menus WHERE id='$id'");
  }
  
};