<?php
namespace App\Controllers;

use \ArrayIterator;
use \PDO; 
use App\Entity\Emoji;

class News extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_home']);
    
    //The Model for this Controller
    $this->model = new \App\Models\News_Model; 
    
  }
    
  public function News() {
 

    if(!isset($_GET['id'])) {

      switch(get_from_db_config('phpbb_news')) {
        
        case '1': {
          $argos_news_check = $this->model->Check_For_News_phpbb();
          $argos_fetch_news = $this->model->Get_News_phpbb();
          break;
        }
        
        case '0': {
          $argos_news_check = $this->model->Check_For_News_Argos();
          $argos_fetch_news = $this->model->Get_News_Argos();
          break;
        }
      }
 
      if($argos_news_check>0) {
        
      while ($row=$argos_fetch_news->fetch(PDO::FETCH_ASSOC)) { 
        
        switch(get_from_db_config('phpbb_news')) { 
         
           case '1': {
              $news_id = $row['topic_id'];
              $forum_id_news = $row['forum_id'];
              $news_username = $row['username'];
              $news_date = date('F j, Y, g:i a', $row['post_time']);
              $news_title = truncate_chars($row['topic_title'],30,'...');
              $news_comments = $row['topic_posts_approved'];
              $news_text = generate_text_for_display($row['post_text'],$row['bbcode_uid'],$row['bbcode_bitfield'],7,true,true,true); 
              $news_text = preg_replace('#<img (.+)>#isU', '<img $1  style="max-width:630px" />', $news_text);
              $news_img = 'assets/img/news_img.png';
              $phpbb_topic_url = 'viewtopic.php?f='.$forum_id_news.'&t='.$news_id.'';
              $news_info[]  = array('news_username'=>$news_username,'news_title'=>$news_title,'news_date'=>$news_date,'news_id'=>$news_id,'news_comments'=>$news_comments,'news_text'=>$news_text,'news_img'=>$news_img,'news_seourl'=> base_forum_url().$phpbb_topic_url);
              break;
           }
           
           case '0': {
              $news_id = $row['id'];
              $news_username = $row['author'];
              $news_date = date('d.m.y в h:i',$row['date']);
              $news_title = truncate_chars($row['title'],30,'...');
              $news_comments = $row['comments'];
              $news_text = $row['text'];
              $news_votes = $row['vote'];
              if(is_html($news_text)) {
                $news_text = htmlspecialchars_decode($row['text']);
              } else {
                $news_text = truncate_chars(htmlspecialchars_decode(strip_word_html($row['text'])),400,'...');  
              }
              $news_img = $row['img'];
              $news_seourl = $row['seourl'];
              $news_info[]  = ['news_username'=>$news_username,'news_title'=>$news_title,'news_date'=>$news_date,'news_votes'=>$news_votes,'news_id'=>$news_id,'news_comments'=>$news_comments,'news_text'=>$news_text,'news_img'=>$news_img,'news_seourl'=>'topic_'.$news_seourl];
              break; 
           }
        }
      }
        $this->mustache->assign('allnews',new ArrayIterator($news_info)); 
        $this->mustache->assign('pagination_news',$this->container['pagination_news']['output']);
        
      } else {
        $this->mustache->assign('no_have_news',"<div class='box'><div class='boxhead_L'><span class='boxhead_titles'><i class='fa fa-comment'></i> ".$this->lang['lang_no_news']."</span></div><br/><div class='alert alert-info'><i class='fa fa-exclamation-triangle'></i> ".$this->lang['lang_no_news']."</div></div>");
      }

    }
    
    //Call Comments
    $this->Comments();

  }
  
  
  public function Comments() {
    if(isset($_GET['id'])) {
    
        $get = $this->model->get_titles();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        
        
        //check for unauthorized urls
        if($get->rowCount() < 1) {
          header('Location: index.php');
          exit();
        }
      
      	$news_id = $row['id'];
        $news_username = $row['author'];
        $news_date = date('d.m.y в h:i',$row['date']);
        $news_title = $row['title'];
        $news_comments = $row['comments'];
        $news_text = htmlspecialchars_decode($row['text']);
        $news_img = $row['img'];
        $comments_enable = $row['comments_enabled'];
        $news_votes = $row['vote'];

        $get_comm = $this->model->get_comments($news_id);
        
        if($get_comm->rowCount() >0) {
        while($row = $get_comm->fetch(PDO::FETCH_ASSOC)) {
          $comment_id = $row['id'];
          $comment_votes = $row['vote'];
          $comment_author = $row['author'];
          Emoji\Emojione::$imageType = 'png'; // or svg / png is default
          Emoji\Emojione::$imagePathPNG = 'https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.6/assets/png/'; // defaults to jsdelivr's free CDN
          $comment_text=Emoji\Emojione::toImage($row['text']);
          $comment_date = date('d.m.y в h:i',$row['date']);
          $comment_ava = $row['avatar'];
          $comment_nick_color = $row['nick_colour'];
          $comment_userid = $row['user_id'];
          
          $newsinfo[]=['comment_id'=>$comment_id,'comment_votes'=>$comment_votes,'comment_author'=>$comment_author,'comment_text'=>$comment_text,'comment_date'=>$comment_date,'comment_ava'=>$comment_ava,'comment_nick_color'=>$comment_nick_color,'comment_userid'=>$comment_userid];
        }
          $this->mustache->assign('allcomments',new ArrayIterator($newsinfo)); 
        } else {
          $this->mustache->assign('no_comments_here','<div class="alert alert-warning"><i class="fa fa-volume-up"></i> '.$this->lang['lang_no_comments'].'</div>');
        }
        
        $this->mustache->assign(['news_votes'=>$news_votes,'news_id'=>$news_id,'news_exists'=>1,'comments_enable'=>$comments_enable,'news_author'=>$news_username,'news_title'=>$news_title,'news_date'=>$news_date,'news_comments'=>$news_comments,'news_text'=>$news_text,'news_img'=>$news_img]);
        
        //submit comments
        if(isset($_POST['submit_comm'])) {
          $com_ava = get_user_ava();
          $com_text = trim($_POST['com_text']);
          if(!empty($com_text)) {
            $com_text = preg_replace('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@','URL is disabled!',$com_text);
            $com_date = time();
            
            $this->model->insert_comment($com_ava,$com_text,$news_id,$com_date);
            $this->mustache->assign(['submit_com_suc'=>''.$this->lang['lang_success'].'! <meta http-equiv="refresh" content="1">']);
          }
        }
          
          
    }
    
  }
 
 
  
};