<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_News_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function remove_news($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."comments WHERE newsid='$id'");
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."news WHERE id='$id'");
  }
  
};