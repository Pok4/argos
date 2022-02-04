<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Remove_Page extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Remove_Page_Model;
 
  }
    
  public function Remove_Page() {
  
    $id = (int)$_GET['id']; 

    $pagename = $this->model->get_page_name($id);

    @unlink("custom_page_content/$pagename.php");


    $this->model->remove_page($id);

    echo json_encode(['info' => $this->lang['lang_ajax_page_delete_success'], 'id' => $id]);
  
  }
  
 
  
};