<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Sliders_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Sliders() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."sliders`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_sliders_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."sliders order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_sliders_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."sliders")->rowCount();
  }
  
  public function fetch_slider_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."sliders WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_sliders($id,$enable_link,$slider_link,$slider_img,$slider_text) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."sliders SET is_link='$enable_link',slider_link=?,slider_img=?,text=? WHERE id='$id'");
    $go->bindParam(1, $slider_link, PDO::PARAM_STR);
    $go->bindParam(2, $slider_img, PDO::PARAM_STR);
    $go->bindParam(3, $slider_text, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};