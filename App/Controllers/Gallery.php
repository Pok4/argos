<?php
namespace App\Controllers;

use \PDO;
use \ArrayIterator;

class Gallery extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_gallery']);
    
    //The Model for this Controller
    $this->model = new \App\Models\Gallery_Model; 
  
  }
    
  public function Gallery() {

      $mysql_check = $this->model->check_if_pics_exist();
      $mysql = $this->model->Get_Gallery();
      if($mysql_check->rowCount() > 0) {
        while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
           $pic_date = date('d.m.y :: h:i',$row['date']);
           $pic_uploader = $row['uploader'];
           $pic_link = $row['pic_link'];
           $gallery_info[]  = ['pic_date'=>$pic_date,'pic_uploader'=>$pic_uploader,'pic_link'=>$pic_link];
        }

        $this->mustache->assign('allpictures',new ArrayIterator( $gallery_info)); 
        $this->mustache->assign('pagination_gallery',$this->container['pagination_gallery']['output']);
        
      } else {
        $this->mustache->assign('no_have_pics',"<br/><div class='alert alert-info'><i class='fa fa-exclamation-triangle'></i> ".$this->lang['lang_no_pics']."</div>");
      }
    
      //check is user on gallery page
      $this->check_is_this_page();
  }
  
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/gallery.php') !== false) {
      $this->mustache->assign('is_gallery_page',1);
    }
  }
 
 
  
};