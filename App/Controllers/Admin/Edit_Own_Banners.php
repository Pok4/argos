<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Own_Banners extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Own_Banners_Model; 
 
  }
    
  public function Edit_Own_Banners() {
    $this->check_is_this_page();
    
    $mysql_check = $this->model->check_own_banners_exists();
    $mysql = $this->model->Get_Own_Banners();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $banner_id = $row['id'];
         $banner_author = $row['avtor'];
         $banner_img = $row['banner_img'];
         $banner_type = $row['type'];
         $banners_info_acp[]  = ['banner_id'=>$banner_id,'banner_author'=>$banner_author,'banner_img'=>$banner_img,'banner_type'=>$banner_type];
         
      }
      $this->mustache->assign('allbanners',new ArrayIterator($banners_info_acp)); 
      $this->mustache->assign('pagination_banners',$this->container['pagination_own_banners_acp']['output']);
    } else {
      $this->mustache->assign('no_have_banners',"<div class='alert alert-danger'>".$this->lang['lang_no_banners']."</div>");
    }      
    
    
    $this->edit_own_banners_function();

  }
  
  public function edit_own_banners_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_own_banners_id',$id);
        
        
        $row = $this->model->fetch_banner_for_edit($id);
        $this->mustache->assign('acp_edit_own_banners_banner_img', $row['banner_img']);
        $this->mustache->assign('acp_edit_own_banners_link_title', $row['link_title']);
        $this->mustache->assign('acp_edit_own_banners_author',$row['avtor']);
        $this->mustache->assign('acp_edit_own_banners_banner_type',$row['type']);
        
        if(isset($_POST['acp_edit_own_banners_submit'])) {
            $banner = trim($_POST['banner_img']);
            $author = trim($_POST['banner_author']);
            $title = trim($_POST['banner_title']);
            $type = $_POST['type'];
            if($type != 0) {
              $type = $type;
            } else {
              $type = $row['type'];
            }
          
          $this->model->edit_banners($id,$banner,$author,$title,$type);
          $this->mustache->assign('acp_edit_own_banners_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  }
  
  //check if user is on this page - edit_own_banners.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_own_banners.php') !== false) {
      $this->mustache->assign('is_ownbanners_page',1);
    }
  }
  
  
};