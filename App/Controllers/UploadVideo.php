<?php
namespace App\Controllers;

class UploadVideo extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_upload_video']);
    
    //The Model for this Controller
    $this->model = new \App\Models\UploadVideo_Model; 
  
  }
    
  public function UploadVideo() {
    
    $this->model->get_video_cats();
    
    if(isset($_POST['submit_video'])) {
   
      $video_site = $_POST['video_site'];
      $video_url = $_POST['videoid'];
      $video_title = $_POST['video_title'];
      $video_cat = $_POST['video_category'];
      $date_video = time();
     
      if($video_cat == "0") {
        $this->mustache->assign('submit_video','<br/><div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_not_choosed_cat'].'</div>');
      } else if($video_site == "0") {
        $this->mustache->assign('submit_video','<br/><div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_not_choosed_site'].'</div>');
      } else {
      
 
        if($this->model->check_video_exist($video_url) > 0){
          $this->mustache->assign('submit_video','<br/><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_already_has_video'].'</div>');
        } else {
          $this->mustache->assign('submit_video','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success_submit_video'].'</div>');
          $this->model->video_insert($video_url,$video_cat,$video_site,$video_title);
        }
      }
    }
     
  }
  
 
 
 
  
};