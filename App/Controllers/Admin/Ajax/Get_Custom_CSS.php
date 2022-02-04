<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Get_Custom_CSS extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function Get_Custom_CSS() {
    $template = $_POST['choosen_template'];
    if($template != $lang_sys['lang_choose']) {
      echo file_get_contents_utf8('template/'.$template.'/css/custom.css'); 
    } else {
      echo '';
    }
  }
  

  
};