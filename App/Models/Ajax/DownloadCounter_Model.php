<?php
namespace App\Models\Ajax;

use \PDO; 

class DownloadCounter_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
   
  public function count_downloads($id) {
     $this->db->query("UPDATE ".$this->argos_db_prefix."files SET down_counts=down_counts+1 WHERE id='$id'");  
  }
  
  
};