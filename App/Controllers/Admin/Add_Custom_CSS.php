<?php
namespace App\Controllers\Admin;

class Add_Custom_CSS extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function Add_Custom_CSS() {
     $this->check_is_this_page();
     
      //get css custom files
      $style_name = ""; //globalize
      foreach(glob('template/*', GLOB_ONLYDIR) as $dir) {
        $style_name .= '<option value="'.str_replace('template/', '', $dir).'">'.str_replace('template/', '', $dir).'</option>';
      }
      $this->mustache->assign('template_options',$style_name);

     
      //update css files
      if(isset($_POST['submit_css'])) {
        $template = $_POST['template'];
        $custom_css = stripcslashes($_POST['custom_css_content']);
        write_utf8_file('template/'.$template.'/css/custom.css',$custom_css);
        $this->mustache->assign('submit_css',$this->lang['lang_success']);
      }
  }
  
  //check if user is on this page - add_custom_css.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/add_custom_css.php') !== false) {
        $this->mustache->assign('is_css_page',1);
    }
  }
  
  
};