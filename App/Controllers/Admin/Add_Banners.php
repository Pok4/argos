<?php
namespace App\Controllers\Admin;

class Add_Banners extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Banners_Model; 
 
  }
    
  public function Add_Banners() {
    if(isset($_POST['submit_banner'])) {
      $type = $_POST['type'];
      $expire = $_POST['aktivnost'];
      switch($expire) {
        case '30': {
          $expire = '2629743';
          break;
        }
        case '7': {
          $expire = '604800';
          break;
        }
        case '0':{
          $expire = '1999999573';
          break;
        }
      }
      $img_link = trim($_POST['img_link']);
      $img_banner = trim($_POST['img_banner']);
      
      if($this->model->check_if_banner_exists($img_banner) < 1) {
        $title_b = $_POST['link_title'];
        $date_add = time();
        
        $this->model->insert_banner($img_link,$img_banner,$title_b,$date_add,$type,$expire);
        
        $this->mustache->assign('banner_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('banner_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_banners'].'</div>');
      }
    
    }
  }
  
  
  
};