<?php
namespace App\Controllers\Admin;

class HTML_Editor extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function HTML_Editor() {
    $this->check_is_this_page();
 
    //select files for html area
    if ($handle = opendir('template/'.get_from_db_config('style').'')) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && strtolower(substr($entry, strrpos($entry, '.') + 1)) == 'html')
        { 
          $htmlfiles .="<option data-html='$entry' value='../template/".get_from_db_config('style')."/$entry'>$entry</option>\n";
          $this->mustache->assign('thelist',$htmlfiles); 
        }  
      }
      closedir($handle);
    }
    
  }
  
  //check if user is on admin/index.php page
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], 'admin/html_editor.php') !== false) {
     $this->mustache->assign('is_html_page',1);
    }
  }
  
  
};