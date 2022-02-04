<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Pic extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Pic_Model;
 
  }
    
  public function Remove_Pic() {
    $id = (int)$_GET['id']; 

    $image = $this->model->get_pic_link($id);
    @unlink('uploads/images/'.$image.'');

    $this->model->remove_pic($id);

    echo json_encode(['info' => $this->lang['lang_ajax_pic_delete_success'], 'id' => $id]);
  }
  
 
  
};