<?php
namespace App\Controllers;

class UploadIMG extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_upload_img']);
  
  }
    
  public function UploadIMG() {
    if (strpos($_SERVER["REQUEST_URI"], '/upload_img.php') !== false) {
      $this->mustache->assign('is_uploadimg_page',1);
    }
  }
 
 
  
};