<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Pages_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_page_exists($page_name) {
  
    $page_check = $this->db->prepare("SELECT page_name FROM ".$this->argos_db_prefix."pages WHERE page_name=?");
    $page_check->bindParam(1, $page_name, PDO::PARAM_STR);
    $page_check->execute(); 
    return $page_check->rowCount();
  }
  
  public function add_page($page_name,$page_title,$page_type) {
  
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."pages (page_name,page_title,menu_type) VALUES(?,?,?)");
    $go->bindParam(1, $page_name, PDO::PARAM_STR);
    $go->bindParam(2, $page_title, PDO::PARAM_STR);
    $go->bindParam(3, $page_type, PDO::PARAM_STR);
    $go->execute(); 
  
  }
  
};