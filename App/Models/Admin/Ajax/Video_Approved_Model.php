<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Video_Approved_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function set_video_status($id,$status) {
    $this->db->query("UPDATE ".$this->argos_db_prefix."uploadvideos SET approved='".$status."' WHERE id='$id'");
  }

  
};