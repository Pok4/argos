<?php
namespace App\Controllers\Admin;

class Add_Pages extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Pages_Model; 
 
  }
    
  public function Add_Pages() {
    if(isset($_POST['submit_page'])) {

      $page_title = trim($_POST['page_title']);
      $page_name = trim($_POST['page_name']);
      
      if($this->model->check_if_page_exists($page_name) < 1) {
      
        $page_content = stripcslashes($_POST['page_content']);
        $page_type = $_POST['page_type'];
      
        write_utf8_file("custom_page_content/$page_name.php",$page_content);

        $this->model->add_page($page_name,$page_title,$page_type);
       
        $this->mustache->assign('pages_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('pages_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_acp_already_page'].'</div>');	
      }
      
    }    
  }
  
  
  
};