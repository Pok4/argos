<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Extension_Updater_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function extension_status_set($id,$status) {
    $id = sql_escape($id);
    
    $this->db->query("UPDATE ".$this->argos_db_prefix."ext SET ext_active='".$status."' WHERE ext_name='".$id."'");
    
    if(file_exists('ext/'.$id.'/migrate.php')) {
      require ('ext/'.$id.'/migrate.php');
    }
  }

  
};