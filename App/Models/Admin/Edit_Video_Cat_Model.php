<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Video_Cat_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Video_Cat() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."videocat`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_video_cat_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."videocat order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_video_cat_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."videocat")->rowCount();
  }
  
  public function fetch_vcat_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."videocat WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_vcats($id,$vcat) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."uploadvideos SET cat=? WHERE cat='$cat'");
    $go->bindParam(1, $vcat, PDO::PARAM_STR);
    $go->execute(); 
    
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."videocat SET category=? WHERE id='$id'");
    $go->bindParam(1, $vcat, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};