<?php
namespace App\Controllers;

use \PDO;
use \ArrayIterator;

class Videos extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_videos']);
    
    //The Model for this Controller
    $this->model = new \App\Models\Videos_Model; 
  
  }
    
  public function Videos() {
    
    $this->model->get_all_cats();
    $this->check_is_this_page();
      
    if(isset($_POST['submit_cat_ch'])) {
      setcookie("lifted_cat", sql_escape($_POST['cat_choose']),time()+3600);
      echo "<meta http-equiv='refresh' content='0;url=".url()."/videos.php'>";
    }
    
    $mysql = $this->model->get_videos();
    $mysql_check = $this->model->check_if_videos_exists();
    
    if($mysql_check->rowCount() > 0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $video_date = date('d.m.y :: h:i',$row['date']);
         $video_uploader = $row['uploader'];
         $video_link = $row['videolink'];
         $video_site = $row['site'];
         $video_title = $row['original_title'];
         if($video_site =="vbox") {
            $pieces1 = explode("play:", $video_link);
            $vid = $pieces1[1];
            $vbox_api = file_get_contents(secure_url()."vbox7.com/etc/ext.do?key=$vid");
            $vbox_api = get_string_between($vbox_api, '&jpg_addr=', '&subs');
            $video_pic = secure_url().$vbox_api;
            $video_link = secure_url()."vbox7.com/emb/external.php?vid=$vid";
         } else if($video_site =="vimeo") {
            $pieces1 = explode("vimeo.com/", $video_link);
            $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".$pieces1[1].".php"));
            $video_pic = $hash[0]['thumbnail_medium'];  
         } else {
           $pieces2 = explode("watch?v=", $video_link);
           $video_pic = secure_url()."img.youtube.com/vi/".$pieces2[1]."/default.jpg";
         }
         $video_info[]  = ['video_date'=>$video_date,'video_uploader'=>$video_uploader,'video_link'=>$video_link,'video_pic'=>$video_pic,'video_title'=>$video_title,'video_site'=>$video_site];
      }

      $this->mustache->assign('allvideos',new ArrayIterator($video_info)); 
      $this->mustache->assign('pagination_videos',$this->container['pagination_videos']['output']);
      
    } else {
      $this->mustache->assign('no_have_videos',"<br/><div class='alert alert-info'><i class='fa fa-exclamation-triangle'></i> ".$this->lang['lang_no_videos']."</div>");
    }
    
     
  }
  
  //check if users is on this videos page
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/videos.php') !== false) {
      $this->mustache->assign('is_video_page',1);
    }
  }
  

};