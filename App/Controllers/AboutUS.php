<?php
namespace App\Controllers;

class AboutUS extends BaseController {
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_aboutus']);
    
    //The Model for this Controller
    $this->model = new \App\Models\AboutUS_Model; 
  
  }
    
  public function AboutUS() {
     $this->mustache->assign('aboutus',$this->model->Fetch_AboutUS());
  }

};