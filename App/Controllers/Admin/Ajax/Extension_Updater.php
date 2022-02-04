<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Extension_Updater extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Extension_Updater_Model; 
  }
    
  public function Extension_Updater() {
    $id = $_GET['id']; 
    $status = $_GET['status']; 
    
    switch($status) {
      case 'on': {
        $this->model->extension_status_set($id,1);
        break;
      }
      case 'off': {
        $this->model->extension_status_set($id,0);
        break;
      }
    }
  
  }
  
 
  
};