<?php
namespace App\Controllers\Admin\Ajax;

use \PDO; 

class HTML_Editor extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
 
  }
    
  public function HTML_Editor() {
 
    $content_html = stripcslashes($_POST['content']);
    $file_name = $_POST['html_file'];	
    file_put_contents(str_replace('../','',$file_name), $content_html);
    echo '<br/><div class="alert alert-success">'.$this->lang['lang_success'].'</div>';
    
  }
  
 
  
};