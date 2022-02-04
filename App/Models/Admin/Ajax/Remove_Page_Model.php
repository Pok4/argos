<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Page_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function get_page_name($id) {
    $go = $this->db->query("SELECT page_name FROM ".$this->argos_db_prefix."pages WHERE id='$id'");
    $row = $go->fetch(PDO::FETCH_ASSOC);
    return $row['page_name'];
  }
  
  public function remove_page($id) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."pages WHERE id='$id'");
  }

  
};