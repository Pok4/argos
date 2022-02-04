<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Slider_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function slider_add($slider_img,$slider_link,$slider_text,$is_link) {
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."sliders (`slider_img`,`is_link`,`slider_link`,`text`) VALUES(?,'".$is_link."',?,?)");	
    $go->bindParam(1, $slider_img, PDO::PARAM_STR);
    $go->bindParam(2, $slider_link, PDO::PARAM_STR);
    $go->bindParam(3, $slider_text, PDO::PARAM_STR);
    $go->execute(); 
  }
 
 
  
};