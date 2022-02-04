<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Video_Cat extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Video_Cat_Model; 
 
  }
    
  public function Edit_Video_Cat() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_video_cat_exists();
    $mysql = $this->model->Get_Video_Cat();
    
    $mysql_check = $this->model->check_video_cat_exists();
    $mysql = $this->model->Get_Video_Cat();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $videocat_id= $row['id'];
         $videocat_title = $row['category'];
         $vcats_info[]  = ['vcat_id'=>$videocat_id,'vcat_title'=>$videocat_title];
         
      }
      $this->mustache->assign('allcats',new ArrayIterator($vcats_info)); 
      $this->mustache->assign('pagination_cats',$this->container['pagination_video_cat_acp']['output']);
    } else {
      $this->mustache->assign('no_have_cats',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_vcats']."</div>");
    }
    
    $this->edit_vcat_function();
  }
  
  public function edit_vcat_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_vcat_id',$id);
        
        
        $row = $this->model->fetch_vcat_for_edit($id);
        $this->mustache->assign('acp_edit_vcats_category',$row['category']);
        
        if(isset($_POST['acp_edit_vcats_submit'])) {
          $vcat = trim($_POST['vcat']);
          
          $this->model->edit_vcats($id,$vcat);
          $this->mustache->assign('acp_edit_vcats_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  }
  
  
  //check if user is on this page - edit_video_cat.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_video_cat.php') !== false) {
      $this->mustache->assign('is_vcat_page',1);
    }
  }
  
  
};