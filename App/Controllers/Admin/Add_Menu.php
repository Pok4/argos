<?php
namespace App\Controllers\Admin;

class Add_Menu extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Menu_Model; 
 
  }
    
  public function Add_Menu() {
    if(isset($_POST['submit_menu'])) {
      $menu_name = $_POST['menu_name'];

      if($this->model->check_if_menu_exists($menu_name) < 1) {
        $menu_text = stripcslashes($_POST['menu_text']);
        $menu_pos = $_POST['position_menu'];
        
        $this->model->add_menu($menu_name,$menu_text,$menu_pos);
        $this->mustache->assign('menu_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('menu_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_menu'].'</div>');
      }
    }      
  }
  
  
  
};