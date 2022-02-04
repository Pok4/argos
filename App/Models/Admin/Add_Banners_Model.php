<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Banners_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_banner_exists($img_banner) {
    $banner_check = $this->db->prepare("SELECT banner_img FROM ".$this->argos_db_prefix."advertise WHERE banner_img=?");
    $banner_check->bindParam(1, $img_banner, PDO::PARAM_STR);
    $banner_check->execute(); 
    return $banner_check->rowCount();
  }
  
  public function insert_banner($img_link,$img_banner,$title_b,$date_add,$type,$expire) {
  
        $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."advertise (type,site_link,banner_img,expire,link_title,dobaven_na) VALUES('$type',?,?,'$expire',?,'$date_add')");
        $go->bindParam(1, $img_link, PDO::PARAM_STR);
        $go->bindParam(2, $img_banner, PDO::PARAM_STR);
        $go->bindParam(3, $title_b, PDO::PARAM_STR);
        $go->execute(); 
  
  }
 

  
};