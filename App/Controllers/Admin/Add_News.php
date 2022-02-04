<?php
namespace App\Controllers\Admin;

class Add_News extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_News_Model; 
 
  }
    
  public function Add_News() {
    if(isset($_POST['submit_news'])) {
      
      $comments_enable = $_POST['news_comment_enable'];
      switch($comments_enable) {
        case '':{
          $comments_enable = 0;
          break;
        }
        case 'on': {
          $comments_enable = 1;
          break;
        }
      }
      
      $news_title = $_POST['news_name'];
 
      
      if($this->model->check_if_news_exists($news_title) < 1) {
        $news_poster = $_POST['admin_poster'];
        $seourl =  parse_cyr_en_url($news_title.'_'.date('d_m_Y',time()));
        $news_date = time();
        $news_text = trim($_POST['text']);
        $img = trim($_POST['img_link']);

        if(filter_var($img, FILTER_VALIDATE_URL)) {
          $img = $img;
        } else {
          $img = "assets/img/news_img.png";	
        }
        
        $this->model->add_news($news_poster,$news_title,$seourl,$news_text,$news_date,$comments_enable,$img);
        
        $this->mustache->assign('news_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('news_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_news'].'</div>');
      }
      
    }    
  }
  
  
  
};