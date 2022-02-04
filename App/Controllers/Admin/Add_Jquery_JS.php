<?php
namespace App\Controllers\Admin;

class Add_Jquery_JS extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Jquery_JS_Model; 
 
  }
    
  public function Add_Jquery_JS() {
    if(isset($_POST['submit_jquery_js'])) {
    
      $jquery_js_post = $_POST['jquery_js'];
      $jquery_js_name = $_POST['js_name'];
      
      if(!empty($jquery_js_post)) {
      $this->model->insert_js_jquery($jquery_js_post,$jquery_js_name);
      $this->mustache->assign('submit_jquery_js',$this->lang['lang_success']);
      }
      
    }
  }
  
  
  
};