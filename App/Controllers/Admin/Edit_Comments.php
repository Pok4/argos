<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;
use App\Entity\Emoji;

class Edit_Comments extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Comments_Model; 
 
  }
    
  public function Edit_Comments() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_comments_exists();
    $mysql = $this->model->Get_Comments();
    if($mysql_check > 0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $sender_id = $row['id'];
         $sender_username = $row['author'];
         $news_id = $row['newsid'];
         
         //news info
         $row2 = $this->model->get_news_information($news_id);
         $news_title = $row2['title'];
         $seourl =$row2['seourl'];
         
         $sender_date = date('d.m.y h:i:s',$row['date']);
         
         Emoji\Emojione::$imageType = 'png'; // or svg / png is default
         Emoji\Emojione::$imagePathPNG = 'https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.6/assets/png/'; // defaults to jsdelivr's free CDN
         $sender_text=Emoji\Emojione::toImage($row['text']);
      
         $sender_color = $row['nick_colour'];
         $senders_info[]  = ['news_title'=>$news_title,'seourl'=>'topic_'.$seourl,'sender_color'=>$sender_color,'sender_username'=>$sender_username,'sender_text'=>$sender_text,'sender_date'=>$sender_date,'sender_id'=>$sender_id];
      }
      $this->mustache->assign('allcomments',new ArrayIterator( $senders_info)); 
      $this->mustache->assign('pagination_comments',$this->container['pagination_comments_acp']['output']);
    } else {
      $this->mustache->assign('no_have_comments',"<div class='alert alert-danger'>".$this->lang['lang_no_comments']."</div>");
    }
    
    $this->edit_comments_function();
  }
  
  public function edit_comments_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_comments_id',$id);
        
        
        $text = $this->model->fetch_comment_for_edit($id);
        $this->mustache->assign('acp_edit_comments_text',$text);
        
        if(isset($_POST['acp_edit_comments_submit'])) {
          $text = trim($_POST['text']);
          
          $this->model->edit_comments($id,$text);
          $this->mustache->assign('acp_edit_comments_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }
  }
  
  //check if user is on this page - edit_comments.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_comments.php') !== false) {
      $this->mustache->assign('is_comments_page',1);
    }
  }
  
  
};