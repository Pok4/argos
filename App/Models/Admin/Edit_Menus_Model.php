<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Menus_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Menus() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."menus order by id DESC");
  }
  
  public function fetch_menu_for_edit($id) {
  
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."menus WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_menus($id,$menu_title,$menu_content) {
    $menu_content = stripcslashes($menu_content);
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."menus SET title=?, the_content=? WHERE id='$id'");
    $go->bindParam(1, $menu_title, PDO::PARAM_STR);
    $go->bindParam(2, $menu_content, PDO::PARAM_STR);
    $go->execute();
  }
 
  
};