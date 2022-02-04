<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class Edit_Pages_Ajax extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Ajax\Edit_Pages_Ajax_Model; 
  }
    
  public function Edit_Pages_Ajax() {
 
    $page_content = $_POST['page_content'];
    $page_title = $_POST['page_title'];
    $page_name = $_POST['page_name'];
    $page_name_old=$_POST['page_name_old'];
    /*if($page_name == $page_name_old) {*/
    $id = (int)$_POST['page_id'];


    $this->model->edit_page($id,$page_name,$page_title,$page_content,$page_name_old);
     
    echo json_encode(['message' => '<br/><div style="max-width:700px;" class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>','content' => $page_content,'page_title'=>$page_title,'page_name'=>$page_name]);
    /*} else {
    echo json_encode(['message' => '<br/><div style="max-width:700px;" class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_acp_already_page'].'</div>','content' => $page_content,'page_title'=>$page_title,'page_name'=>$page_name]);  
    }*/
  }
  
 
  
};