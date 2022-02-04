<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Video_Approved extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Video_Approved_Model;
 
  }
    
  public function Video_Approved() {
    $id = (int)$_GET['id']; 
    $approved = (int)$_GET['approved'];

    if($approved == "1") {
      $this->model->set_video_status($id,1);
      $message = $this->lang['lang_ajax_video_approved'];	
    } else {
      $this->model->set_video_status($id,0);
      $message = $this->lang['lang_ajax_video_disapproved'];
    }

    echo json_encode(['info' => $message, 'id' => $id]);
  }
  
 
  
};