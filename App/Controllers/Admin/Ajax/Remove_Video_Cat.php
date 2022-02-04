<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Video_Cat extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Video_Cat_Model;
 
  }
    
  public function Remove_Video_Cat() {
 
    $id = (int)$_GET['id']; 
    
    $video_cat = $this->model->get_video_cat($id);

    $this->model->remove_vcat($id,$video_cat);

    echo json_encode(['info' => $this->lang['lang_ajax_vcat_delete_success'], 'id' => $id]);
    
  }
  
 
  
};