<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Edit_Ext_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function fetch_exts($ext_name) {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."ext WHERE ext_name='".$ext_name."' order by ext_active DESC");
  }
  
};