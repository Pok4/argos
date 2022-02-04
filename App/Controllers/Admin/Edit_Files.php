<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Files extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Files_Model; 
 
  }
    
  public function Edit_Files() {
    $this->check_is_this_page();
        
    $mysql_check = $this->model->check_files_exists();
    $mysql = $this->model->Get_Files();
    if($mysql_check > 0) {
    while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
       $file_id = $row['id'];
       $file_author = $row['author'];
       $file_game = $row['game'];
       $file_type = $row['type'];
       switch($file_type) {
        case 'Плъгин': {
          $file_type = $this->lang['lang_plugin'];
          break;
        }
        case 'Карта': {
          $file_type = $this->lang['lang_map'];
          break;
        }
        case 'Скин': { 
          $file_type = $this->lang['lang_skin'];
          break;
        }
        case 'Програма': {
          $file_type = $this->lang['lang_program'];
          break;
        }
       }
       $file_name = $row['name'];
       $files_info[]  = ['file_name'=>$file_name,'file_id'=>$file_id,'file_author'=>$file_author,'file_game'=>$file_game,'file_type'=>$file_type];
       
    }
    $this->mustache->assign('allfiles',new ArrayIterator( $files_info)); 
    $this->mustache->assign('pagination_files',$this->container['pagination_files_acp']['output']);
    } else {
      $this->mustache->assign('no_have_files',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_files']."</div>");
    }
    
    $this->edit_files_function();
  }
  
  public function edit_files_function() {
     $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_files_id',$id);
        
        $row = $this->model->fetch_file_for_edit($id);
        
        $this->mustache->assign('acp_edit_files_name',$row['name']);
        $this->mustache->assign('acp_edit_files_author',$row['author']);
        $this->mustache->assign('acp_edit_files_size',$row['size']);
        $this->mustache->assign('acp_edit_files_opisanie',$row['opisanie']);
        $this->mustache->assign('acp_edit_files_link',$row['link']);
        $img = $row['picture'];
        if(filter_var($img, FILTER_VALIDATE_URL)) {
          $this->mustache->assign('acp_edit_files_img',$img);
        } else {
          $this->mustache->assign('acp_edit_files_img',"../assets/img/no_image.jpg");
        }
        
        if(isset($_POST['acp_edit_files_submit'])) {
          $opisanie = trim($_POST['opisanie']);
          $file_name = trim($_POST['file_name']);
          $file_author = trim($_POST['file_author']);
          $file_img = trim($_POST['img']);
          if(filter_var($file_img, FILTER_VALIDATE_URL)) {
            $file_img = $file_img;
          } else {
            $file_img = url()."/assets/img/no_image.jpg";	
          }
          $file_size = trim($_POST['file_size']);
          $file_link = trim($_POST['file_link']);
          
          $this->model->edit_files($id,$file_link,$file_size,$file_name,$file_img,$file_author,$opisanie);
          $this->mustache->assign('acp_edit_files_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
          
        }
      }  
  }
  
  //check if user is on this page - edit_files.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_files.php') !== false) {
      $this->mustache->assign('is_files_page_acp',1);
    }
  }
  
  
};