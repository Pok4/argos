<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Banners extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Banners_Model; 
 
  }
    
  public function Edit_Banners() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_banners_exists();
    $mysql = $this->model->Get_Banners();
    if($mysql_check > 0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $banner_id = $row['id'];
         $banner_expire = secondsToTime($row['expire']);
         if (strpos($banner_expire, '-') !== false) {
           $banner_expire = $this->lang['lang_banner_sys'];
         }
         $banner_link = $row['site_link'];
         $banner_img = $row['banner_img'];
         $banner_title = $row['link_title'];
         $banners_info_acp[]  = ['banner_id'=>$banner_id,'banner_expire'=>$banner_expire,'banner_img'=>$banner_img,'banner_link'=>$banner_link,'banner_title'=>$banner_title];
      }
      $this->mustache->assign('allbanners',new ArrayIterator( $banners_info_acp)); 
      $this->mustache->assign('pagination_banners',$this->container['pagination_advertise_acp']['output']);
    } else {
      $this->mustache->assign('no_have_banners',"<div class='alert alert-danger'>".$this->lang['lang_no_banners']."</div>");
    }
    
    $this->edit_function();
  }
  
  public function edit_function() {
    $id = (int)$_GET['id'];
    if(isset($id)) {
      $this->mustache->assign('acp_edit_banners_id',$id);
      
      $row = $this->model->fetch_banner_for_edit($id);
      $this->mustache->assign('acp_edit_banners_banner_img', $row['banner_img']);
      $this->mustache->assign('acp_edit_banners_site_link',$row['site_link']);
      $this->mustache->assign('acp_edit_banners_link_title',$row['link_title']);

      if(isset($_POST['edit_banners_submit'])) {
        $banner = trim($_POST['banner_img']);
        $b_link = trim($_POST['banner_link']);
        $title = trim($_POST['banner_title']);
        
        $this->model->edit_banners($id,$banner,$b_link,$title);
        $this->mustache->assign('acp_edit_banners_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');    
      }
    }
  }
  
  //check if user is on this page - edit_banners.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_banners.php') !== false) {
      $this->mustache->assign('is_banners_page',1);
    }
  }
  
  
};