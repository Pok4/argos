<?php
namespace App\Models\Admin;

use \PDO; 

class Add_File_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_file_exists($file_name){
    $file_check = $this->db->prepare("SELECT name FROM ".$this->argos_db_prefix."files WHERE name=?");
    $file_check->bindParam(1, $file_name, PDO::PARAM_STR);
    $file_check->execute(); 
    return $file_check->rowCount();
  }
  
  public function add_file($file_img,$file_author,$down_counts,$file_upload_date,$file_size,$file_type,$file_game,$file_type_not_real,$file_game_not_real,$file_cat,$file_description,$file_link,$file_name) {
      $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."files (picture,author,down_counts,date,size,type,game,type_not_real,game_not_real,category,opisanie,link,name) VALUES(?,?,'$down_counts','$file_upload_date',?,'$file_type','$file_game','$file_type_not_real','$file_game_not_real',?,?,?,?)");
      $go->bindParam(1, $file_img, PDO::PARAM_STR);
      $go->bindParam(2, $file_author, PDO::PARAM_STR);
      $go->bindParam(3, $file_size, PDO::PARAM_STR);
      $go->bindParam(4, $file_cat, PDO::PARAM_STR);
      $go->bindParam(5, $file_description, PDO::PARAM_STR);
      $go->bindParam(6, $file_link, PDO::PARAM_STR);
      $go->bindParam(7, $file_name, PDO::PARAM_STR);
      $go->execute();   
  }
  
};