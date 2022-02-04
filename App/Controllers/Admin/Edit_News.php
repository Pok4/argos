<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_News extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_News_Model; 
 
  }
    
  public function Edit_News() {
    $this->check_is_this_page();
    
    $mysql_check = $this->model->check_news_exists();
    $mysql = $this->model->Get_News();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $sender_id = $row['id'];
         $sender_username = $row['author'];
         $sender_date = date('d.m.y h:i:s',$row['date']);
         $sender_title = truncate_chars($row['title'],30,'...');
         $senders_info[]  = ['sender_username'=>$sender_username,'sender_title'=>$sender_title,'sender_date'=>$sender_date,'sender_id'=>$sender_id];
         
      }
      $this->mustache->assign('allnews',new ArrayIterator( $senders_info)); 
      $this->mustache->assign('pagination_news',$this->container['pagination_news_acp']['output']);
    } else {
      $this->mustache->assign('no_have_news',"<div class='alert alert-danger'>".$this->lang['lang_no_news']."</div>");
    }
    
     $this->edit_news_function();

  }
  
  public function edit_news_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_news_id',$id);
        
        $row = $this->model->fetch_news_for_edit($id);
        $this->mustache->assign('acp_edit_news_author', $row['author']);
        $this->mustache->assign('acp_edit_news_title',$row['title']);
        $this->mustache->assign('acp_edit_news_text',$row['text']);
        
        $img = $row['img'];
        if(filter_var($img, FILTER_VALIDATE_URL)) {
          $this->mustache->assign('acp_edit_news_img',$img);
        } else {
          $this->mustache->assign('acp_edit_news_img',"../assets/img/news_img.png");	
        }
          
        $comments_enable = $row['comments_enabled'];
        switch($comments_enable){
          case '1': {
            $this->mustache->assign('acp_edit_news_comments_enable', "checked");
            break;
          }
          case '0': {
            $this->mustache->assign('acp_edit_news_comments_enable','');
            break;
          }
        }
        
        if(isset($_POST['acp_edit_news_submit'])) {
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
            
            $text = trim($_POST['text']);
            $author = trim($_POST['author']);
            $novina= trim($_POST['novina']);
            $seourl =  parse_cyr_en_url($novina.'_'.date('d_m_Y',time()));
            $img = trim($_POST['img']);
            if(filter_var($img, FILTER_VALIDATE_URL)) {
              $img = $img;
            } else {
              $img = url()."/assets/img/news_img.png";	
            }
           
            
            $this->model->edit_news($id,$author,$novina,$seourl,$text,$img,$comments_enable);

            $this->mustache->assign('acp_edit_news_submit', '<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  }
  
  
  //check if user is on this page - edit_news.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_news.php') !== false) {
      $this->mustache->assign('is_news_page',1);
    }
  }
  
  
};