<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Own_Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_banner_exists($banner_img) {
    $banner_check = $this->db->prepare("SELECT banner_img FROM ".$this->argos_db_prefix."banners WHERE banner_img=?");
    $banner_check->bindParam(1, $banner_img, PDO::PARAM_STR);
    $banner_check->execute(); 
    return $banner_check->rowCount();
  }
  
  public function add_banner($banner_type,$banner_link,$banner_img,$banner_link_title,$banner_author) {
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."banners (type,site_link,banner_img,link_title,avtor) VALUES('$banner_type','$banner_link',?,?,?)");
    $go->bindParam(1, $banner_img, PDO::PARAM_STR);
    $go->bindParam(2, $banner_link_title, PDO::PARAM_STR);
    $go->bindParam(3, $banner_author, PDO::PARAM_STR);
    $go->execute(); 
  }
  
  
  
  
};