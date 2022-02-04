<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Poll extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Poll_Model;
 
  }
    
  public function Remove_Poll() {
  
    $id = (int)$_GET['id']; 
    $this->model->remove_poll($id);
    echo json_encode(['info' => $this->lang['lang_ajax_poll_delete_success'], 'id' => $id]);
  
  }
  
 
  
};