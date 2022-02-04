<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Comments extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Comments_Model; 
 
  }
    
  public function Remove_Comments() {
  
    $id = (int)$_GET['id']; 

    $news_id = $this->model->get_newsid($id);

    $this->model->remove_comment($id,$news_id);
    
    echo json_encode(['info' => $this->lang['lang_ajax_comment_delete_success'], 'id' => $id]);    
  
  }
  
 
  
};