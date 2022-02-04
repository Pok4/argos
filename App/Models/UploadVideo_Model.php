<?php
namespace App\Models;

use \PDO; 

class UploadVideo_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  public function get_video_cats() {
    //get all video cats
    $getcats = $this->db->query("SELECT category FROM ".$this->argos_db_prefix."videocat");
    $getvcats[]="";
    if($getcats->rowCount() > 0) {
      while($row=$getcats->fetch(PDO::FETCH_ASSOC)) {
        $cats .= '<option value="'.$row['category'].'">'.$row['category'].'</option>';
        $this->mustache->assign('allvcats',$cats);
      }
    }
  }
  
  public function check_video_exist($video_url) {
    $video_url = htmlspecialchars($video_url);
    $check = $this->db->prepare("SELECT videolink FROM `".$this->argos_db_prefix."uploadvideos` WHERE `videolink`=?");
    $check->bindParam(1, $video_url, PDO::PARAM_STR); 
    $check->execute(); 
    return $check->rowCount();
  }
  
  public function video_insert($video_url,$video_cat,$video_site,$video_title) {
    $video_url = htmlspecialchars($video_url);
    $video_cat = htmlspecialchars($video_cat);
    $video_site = htmlspecialchars($video_site);
    $video_title = htmlspecialchars($video_title);
    $date_video = time();
    
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."uploadvideos (`uploader`,`videolink`,`date`,`cat`,`site`, `approved`,`original_title`) VALUES(?,?,'$date_video',?,?,'0',?)");
    $go->bindParam(1, $this->username, PDO::PARAM_STR); 
    $go->bindParam(2, $video_url, PDO::PARAM_STR); 
    $go->bindParam(3, $video_cat, PDO::PARAM_STR);
    $go->bindParam(4, $video_site, PDO::PARAM_STR);
    $go->bindParam(5, $video_title, PDO::PARAM_STR);
    $go->execute();
  }
  
};