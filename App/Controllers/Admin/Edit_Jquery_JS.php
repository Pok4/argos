<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Jquery_JS extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Jquery_JS_Model; 
 
  }
    
  public function Edit_Jquery_JS() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_jquery_js_exists();
    $mysql = $this->model->Get_Jquery_JS();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $js_id = $row['id'];
         $jquery_js = $row['jquery_js'];
         $jquery_js_name = $row['jquery_js_name'];
         $jquery_js_info[]  = ['jquery_js'=>$jquery_js,'jquery_js_name'=>$jquery_js_name,'js_id'=>$js_id];
      }
      $this->mustache->assign('alljs',new ArrayIterator($jquery_js_info)); 
      $this->mustache->assign('pagination_js_jquery',$this->container['pagination_jquery_js_acp']['output']);
    } else {
      $this->mustache->assign('no_have_js_jquery',"<div class='alert alert-danger'>".$this->lang['lang_acp_jquery_js_no_have']."</div>");
    }
    
    $this->edit_jquery_js_function();
  }
  
  public function edit_jquery_js_function() {
  
     $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_jquery_js_id',$id);
        
        $row = $this->model->fetch_file_for_edit($id);
        $this->mustache->assign('acp_edit_jquery_js_name', $row['jquery_js_name']);
        $this->mustache->assign('acp_edit_jquery_js_content', $row['jquery_js']);
        
        if(isset($_POST['acp_edit_files_submit'])) {
          $jquery_js = $_POST['jquery_js'];
          $jquery_js_name = $_POST['js_name'];
          if(!empty($jquery_js_name)) {
            $this->model->edit_files($id,$jquery_js_name,$jquery_js);
            $this->mustache->assign('acp_edit_files_submit', '<br/><div class="alert alert-success">'.$this->lang['lang_success'].'</div>');
          }
        }
      }
  }
  
  //check if user is on this page - edit_jquery_js.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_jquery_js.php') !== false) {
      $this->mustache->assign('is_jquery_js_page_acp',1);
    }
  }
  
  
};