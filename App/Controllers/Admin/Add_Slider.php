<?php
namespace App\Controllers\Admin;

class Add_Slider extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Slider_Model; 
 
  }
    
  public function Add_Slider() {
    if(isset($_POST['submit_slider'])) {
      $slider_img = trim($_POST['slider_link_img']);	
      $slider_link_enable = $_POST['slider_link_enable'];
      switch($slider_link_enable) {
        case 'on': {
          $slider_link_enable = 1;
          break;
        }
        case '': {
          $slider_link_enable = 0;
          break;
        }
      }
      $slider_link = trim($_POST['slider_link']);	
      $slider_text = trim($_POST['slider_text']);

      if($slider_link_enable == 1) {
        $is_link = 1;
        $this->model->slider_add($slider_img,$slider_link,$slider_text,$is_link);
      } else {
        $is_link = 0;
        $this->model->slider_add($slider_img,$slider_link,$slider_text,$is_link);
      }
      $this->mustache->assign('slider_add',$this->lang['lang_success']);
    }
  }
  
  
  
};