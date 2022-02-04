<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Gallery extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Gallery_Model; 
 
  }
    
  public function Edit_Gallery() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_gallery_exists();
    $mysql = $this->model->Get_Gallery();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $pic_id = $row['id'];
         $pic_link = $row['pic_link'];
         $pic_uploader = $row['uploader'];
         $pics_info[]  = ['pic_uploader'=>$pic_uploader,'pic_link'=>$pic_link,'pic_id'=>$pic_id];
         
      }
      $this->mustache->assign('allpics',new ArrayIterator($pics_info)); 
      $this->mustache->assign('pagination_pics',$this->container['pagination_gallery_acp']['output']);
    } else {
      $this->mustache->assign('no_have_pics',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_images']."</div>");
    }
  }
  
  //check if user is on this page - edit_gallery.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_gallery.php') !== false) {
      $this->mustache->assign('is_gallery_page_acp',1);
    }
  }
  
  
};