<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Get_Custom_Lang extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function Get_Custom_Lang() {
     echo file_get_contents_utf8('lang/'.$_POST['choosen_lang'].'/custom_'.$_POST['choosen_lang'].'.php'); 
  }
  

  
};