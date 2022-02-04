<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_File extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_File_Model; 
 
  }
    
  public function Remove_File() {
      $id = (int)$_GET['id']; 
      $this->model->remove_file($id);
      echo json_encode(['info' => $this->lang['lang_ajax_file_delete_success'], 'id' => $id]);  
  }
  
 
  
};