<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Banners() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."advertise`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_advertise_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."advertise order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_banners_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."advertise")->rowCount();
  }
  
  public function edit_banners($id,$banner,$b_link,$title) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."advertise SET banner_img=?,site_link=?,link_title=? WHERE id='$id'");
    $go->bindParam(1, $banner, PDO::PARAM_STR);
    $go->bindParam(2, $b_link, PDO::PARAM_STR);
    $go->bindParam(3, $title, PDO::PARAM_STR);
    $go->execute(); 
  }
  
  public function fetch_banner_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."advertise WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
};