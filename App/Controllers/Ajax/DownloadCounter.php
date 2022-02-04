<?php
namespace App\Controllers\Ajax;

class DownloadCounter extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\DownloadCounter_Model; 
 
  }
    
  public function DownloadCounter() {
    if(is_ajax()) {
      $id = (int)$_GET['file_id'];
      $this->model->count_downloads($id);
    }
  }
 
 
  
};