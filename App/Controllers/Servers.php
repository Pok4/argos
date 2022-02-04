<?php
namespace App\Controllers;

class Servers extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_servers']);
  
  }
    
  public function Servers() {
    //It's your choice :)
  }
 
 
  
};