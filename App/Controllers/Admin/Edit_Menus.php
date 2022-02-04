<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Menus extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Menus_Model; 
 
  }
    
  public function Edit_Menus() {
    $this->check_is_this_page();
      
    $mysql = $this->model->Get_Menus();
    if($mysql->rowCount()>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $menu_title = $row['title'];
         $menu_id = $row['id'];
         $menus_info[]  = ['menu_title'=>$menu_title,'menu_id'=>$menu_id];
      }
      $this->mustache->assign('allmenus',new ArrayIterator( $menus_info)); 
    } else {
      $this->mustache->assign('no_have_menus',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_menus']."</div>");
    }
    
    $this->edit_menus_function();
  }
  
  public function edit_menus_function() {
    $id = (int)$_GET['id'];	
    
    if(isset($id)) {
      $this->mustache->assign('acp_edit_menus_id',$id);
       
      $row = $this->model->fetch_menu_for_edit($id);
      $this->mustache->assign('acp_edit_menus_title', $row['title']);
      $this->mustache->assign('acp_edit_menus_the_content', $row['the_content']);
      
      
      if(isset($_POST['acp_edit_menus_submit'])) {
  
        $menu_content = trim($_POST['menu_content']);
        $menu_title = trim($_POST['menu_title']);
        
        $this->model->edit_menus($id,$menu_title,$menu_content);

        $this->mustache->assign('acp_edit_menus_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');	
        
      }
    }
  }
  
  //check if user is on this page - edit_menus.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_menus.php') !== false) {
      $this->mustache->assign('is_menus_page',1);
    }
  }
  
  
};