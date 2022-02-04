<?php
namespace App\Controllers\Admin;

class Add_Custom_Lang extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
 
  }
    
  public function Add_Custom_Lang() {
    
    $this->check_is_this_page();
     
    //get custom lang file
    foreach(glob('lang/*', GLOB_ONLYDIR) as $dir) {
      $get_lang .= '<option value="'.str_replace('lang/', '', $dir).'">'.str_replace('lang/', '', $dir).'</option>';
    }
    $this->mustache->assign('lang_options',$get_lang);
    
    //update custom lang file
    if(isset($_POST['submit_css'])) {
      $lang = $_POST['choosen_lang'];
      $custom_lang = stripcslashes($_POST['custom_lang_content']);
      write_utf8_file('lang/'.$lang.'/custom_'.$lang.'.php',$custom_lang);
      $this->mustache->assign('submit_lang',$this->lang['lang_success']);
    }

  }
  
  //check is user on this page - add_custom_lang.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/add_custom_lang.php') !== false) {
      $this->mustache->assign('is_lang_page',1);
    }
  }
  
  
  
};