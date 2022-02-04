<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Menu_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_menu_exists($menu_name) {
    $menu_check = $this->db->prepare("SELECT title FROM ".$this->argos_db_prefix."menus WHERE title=?");
    $menu_check->bindParam(1, $menu_name, PDO::PARAM_STR);
    $menu_check->execute(); 
    return $menu_check->rowCount();
  }
  
  public function add_menu($menu_name,$menu_text,$menu_pos) {
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."menus (`title`,`the_content`,`position`) VALUES(?,?,?)");
    $go->bindParam(1, $menu_name, PDO::PARAM_STR);
    $go->bindParam(2, $menu_text, PDO::PARAM_STR);
    $go->bindParam(3, $menu_pos, PDO::PARAM_STR);
    $go->execute(); 
  }
  
  
};