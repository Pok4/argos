<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Own_Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Own_Banners() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."banners`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_own_banners_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."banners order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_own_banners_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."banners")->rowCount();
  }
  
  public function fetch_banner_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."banners WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_banners($id,$banner,$author,$title,$type) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."banners SET banner_img=?,link_title=?,avtor=?,type=? WHERE id='$id'");
    $go->bindParam(1, $banner, PDO::PARAM_STR);
    $go->bindParam(2, $title, PDO::PARAM_STR);
    $go->bindParam(3, $author, PDO::PARAM_STR);
    $go->bindParam(4, $type, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};