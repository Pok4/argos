<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Sliders extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Sliders_Model; 
 
  }
    
  public function Edit_Sliders() {
    $this->check_is_this_page();
    
    $mysql_check = $this->model->check_sliders_exists();
    $mysql = $this->model->Get_Sliders();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $slider_id = $row['id'];
         $slider_text= $row['text'];
         $slider_img= $row['slider_img'];
         if(filter_var($slider_img, FILTER_VALIDATE_URL)) { 
            $slider_img= $row['slider_img'];
         } else {
            $slider_img= '../'.$row['slider_img'];
         }
         $sliders_info_acp[]  = ['slider_id'=>$slider_id,'slider_text'=>$slider_text,'slider_img'=>$slider_img];  
      }
      $this->mustache->assign('allsliders',new ArrayIterator($sliders_info_acp)); 
      $this->mustache->assign('pagination_sliders',$this->container['pagination_sliders_acp']['output']);
    } else {
      $this->mustache->assign('no_have_sliders',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_sliders']."</div>");
    }    
  
     $this->edit_sliders_function();
  }
  
  public function edit_sliders_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_sliders_id',$id);
        
        
        $row = $this->model->fetch_slider_for_edit($id);
        $this->mustache->assign('acp_edit_sliders_is_link',$row['is_link']);
        $slider_img = $row['slider_img'];
        if(filter_var($slider_img, FILTER_VALIDATE_URL)) { 
          $this->mustache->assign('acp_edit_sliders_slider_img',$row['slider_img']);
        } else {
          $this->mustache->assign('acp_edit_sliders_slider_img','../'.$row['slider_img']);
        }
        $this->mustache->assign('acp_edit_sliders_slider_text',$row['text']);
        $this->mustache->assign('acp_edit_sliders_slider_link',$row['slider_link']);
        
        if(isset($_POST['acp_edit_sliders_submit'])) {

          $slider_link = trim($_POST['slider_link']);
          $slider_img = trim($_POST['slider_img']);
          $slider_text = trim($_POST['slider_text']);
          
          $enable_link = $_POST['enable_link'];
          switch($enable_link) {
            case 'on': {
              $enable_link = 1;
              break;
            }
            case '': {
              $enable_link = 0;
              break;
            }
          }
          
          $this->model->edit_sliders($id,$enable_link,$slider_link,$slider_img,$slider_text);          
          $this->mustache->assign('acp_edit_sliders_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  }
  
  //check if user is on this page - edit_sliders.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_sliders.php') !== false) {
      $this->mustache->assign('is_sliders_page',1);
    }
  }
  
  
};