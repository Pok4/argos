<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Pages extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Pages_Model; 
 
  }
    
  public function Edit_Pages() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_pages_exists();
    $mysql = $this->model->Get_Pages();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $page_id = $row['id'];
         $page_title = $row['page_title'];
         $page_name= $row['page_name'];
         $page_info[]  = ['page_id'=>$page_id,'page_name'=>$page_name,'page_title'=>$page_title];
         
      }
      $this->mustache->assign('allpages',new ArrayIterator( $page_info)); 
      $this->mustache->assign('pagination_pages',$this->container['pagination_pages_acp']['output']);
    } else {
      $this->mustache->assign('no_have_pages',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_pages']."</div>");
    }
    
    $this->edit_pages_function();
  }
  
  public function edit_pages_function() {
      $id = (int)$_GET['id'];	
      
      if(isset($id)) {
        $this->mustache->assign('acp_edit_pages_id',$id);

        $row = $this->model->fetch_page_for_edit($id);
        $this->mustache->assign('acp_edit_pages_page_name',$row['page_name']);
        $this->mustache->assign('acp_edit_pages_page_title',$row['page_title']);
        if(file_exists('custom_page_content/'.$row['page_name'].'.php')) {
          $this->mustache->assign('acp_edit_pages_page_content', file_get_contents_utf8('custom_page_content/'.$row['page_name'].'.php'));
        } else {
          $this->mustache->assign('acp_edit_pages_page_content', 'Page Not Found');
        }
      }  
  }
  
  //check if user is on this page - edit_pages.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_pages.php') !== false) {
      $this->mustache->assign('is_page_page',1);
    }
  }
  
  
};