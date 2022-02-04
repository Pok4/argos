<?php
namespace App\Controllers\Admin;

class Add_VideoCat extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_VideoCat_Model; 
 
  }
    
  public function Add_VideoCat() {
     if(isset($_POST['submit_vcat'])) {
      $catname = trim($_POST['video_cat_add']);
      $go = $this->model->check_cat_exists($catname);
      
      if($go > 0) {
         $this->mustache->assign('video_cat_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_acp_already_cat'].'</div>');
      } else {
        $this->model->add_video_cat($catname);
        $this->mustache->assign('video_cat_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      }
       
    }

  }
  
  
  
};