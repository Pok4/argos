<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Files_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Files() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."files`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_files_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."files order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_files_exists() {
  return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."files")->rowCount();
  }
  
  public function fetch_file_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."files WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_files($id,$file_link,$file_size,$file_name,$file_img,$file_author,$opisanie) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."files SET link=?,size=?,name=?,picture=?,author=?,opisanie=? WHERE id='$id'");
    $go->bindParam(1, $file_link, PDO::PARAM_STR);
    $go->bindParam(2, $file_size, PDO::PARAM_STR);
    $go->bindParam(3, $file_name, PDO::PARAM_STR);
    $go->bindParam(4, $file_img, PDO::PARAM_STR);
    $go->bindParam(5, $file_author, PDO::PARAM_STR);
    $go->bindParam(6, $opisanie, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};