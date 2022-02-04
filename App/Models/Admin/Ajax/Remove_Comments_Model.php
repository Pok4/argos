<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Remove_Comments_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function get_newsid($id) {
    $get = $this->db->query("SELECT newsid FROM ".$this->argos_db_prefix."comments WHERE id='$id'");
    $row = $get->fetch(PDO::FETCH_ASSOC);
    return $row['newsid'];
  }
  
  public function remove_comment($id,$news_id) {
    $this->db->query("UPDATE ".$this->argos_db_prefix."news SET comments=comments-1 WHERE id='$news_id'");
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."comments WHERE id='$id'");
  }
  
};