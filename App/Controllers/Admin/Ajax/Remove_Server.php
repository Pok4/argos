<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Server extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Server_Model;
 
  }
    
  public function Remove_Server() {
  
    $id = (int)$_GET['id']; 
    $this->model->remove_server($id);
    echo json_encode(['info' => $this->lang['lang_ajax_server_delete_success'], 'id' => $id]);
    
  }
  
 
  
};