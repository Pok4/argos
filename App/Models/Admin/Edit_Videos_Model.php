<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Videos_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Videos() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."uploadvideos`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_videos_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."uploadvideos order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_videos_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."uploadvideos")->rowCount();
  }
  
  public function fetch_video_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."uploadvideos WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function get_all_from_vcats() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."videocat");
  }
  
  public function edit_videos($id,$cat,$uploader) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."uploadvideos SET cat=?, uploader=? WHERE id='$id'");
    $go->bindParam(1, $cat, PDO::PARAM_STR);
    $go->bindParam(2, $uploader, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};