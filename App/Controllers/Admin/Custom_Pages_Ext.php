<?php
namespace App\Controllers\Admin;

class Custom_Pages_Ext extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function Custom_Pages_Ext() {
     
  }
  

  
  
};