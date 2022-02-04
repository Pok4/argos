<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Video_Cat_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function get_video_cat($id) {
    $go = $this->db->query("SELECT category FROM ".$this->argos_db_prefix."videocat WHERE id='$id'");
    $row = $go->fetch(PDO::FETCH_ASSOC);
    return $row['category'];
  }
  
  public function remove_vcat($id,$video_cat) {
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."uploadvideos WHERE cat='$video_cat'");
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."videocat WHERE id='$id'");
  }

  
};