<?php
namespace App\Controllers\Admin;

class Add_Own_Banners extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Own_Banners_Model; 
 
  }
    
  public function Add_Own_Banners() {
    if(isset($_POST['submit_banner'])) {
      $banner_type = $_POST['banner_type'];
       
      $banner_img = trim($_POST['banner_img']);
      
      
      if($this->model->check_if_banner_exists($banner_img) < 1) {
        $banner_link = secure_url().$_SERVER['SERVER_NAME'] ;
        $banner_link_title = trim($_POST['banner_link_title']);
        $banner_author= trim($_POST['banner_author']);
      
        $this->model->add_banner($banner_type,$banner_link,$banner_img,$banner_link_title,$banner_author);
        
        $this->mustache->assign('banner_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('banner_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_banners'].'</div>');
      }
      
    }   
  }
  
  
  
};