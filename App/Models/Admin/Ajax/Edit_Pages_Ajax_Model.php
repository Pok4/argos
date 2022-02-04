<?php
namespace App\Models\Admin\Ajax;

use \PDO; 

class Edit_Pages_Ajax_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 

  }
  
  public function edit_page($id,$page_name,$page_title,$page_content,$page_name_old) {
    $page_content = stripcslashes($page_content);
    $page_title = htmlspecialchars(trim($page_title));
    $page_name = htmlspecialchars(trim($page_name));
    
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."pages SET page_name=?,page_title=? WHERE id='$id'");
    $go->bindParam(1, $page_name, PDO::PARAM_STR);
    $go->bindParam(2, $page_title, PDO::PARAM_STR);	
    $go->execute();

    rename("custom_page_content/$page_name_old.php", "custom_page_content/$page_name.php");
    write_utf8_file("custom_page_content/$page_name.php",$page_content); 
  }

  
};