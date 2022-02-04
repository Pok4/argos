<?php
namespace App\Controllers\Admin;

class Add_AboutUS extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_AboutUS_Model; 
 
  }
    
  public function Add_AboutUS() {
    $aboutus = $this->model->get_aboutus();
    $this->mustache->assign('aboutus_text_acp',$aboutus);
    
    if(isset($_POST['submit_aboutus'])) {
      $aboutus_post = trim($_POST['aboutus']);
      $this->model->update_aboutus($aboutus_post);
      $this->mustache->assign('submit_aboutus',$this->lang['lang_success']);
    }
  }
  
  
  
};