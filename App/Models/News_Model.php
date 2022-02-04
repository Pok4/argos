<?php
namespace App\Models;

use \PDO; 

class News_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
   
  //Get Argos News
  public function Get_News_Argos() {
  
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."news`")->fetchColumn();
    
    $pagination = pagination($results, [
    'get_vars'  => [
        'cat'   => (int)@$_GET['cat'],
        'view'  => @$_GET['view']
    ], 
    'per_page'  => get_from_db_config('news_per_page'),
    'per_side'  => 3,
    'get_name'  => 'page'
    ]);
    
    $this->container['pagination_news'] = $pagination;

    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."news order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function Check_For_News_Argos() {
    return $this->db->query("SELECT id FROM ".$this->argos_db_prefix."news")->rowCount();
  }
  
  //Get phpBB News
  public function Get_News_phpbb() {
  
    $results    = $this->db->query("SELECT COUNT(`topic_id`) FROM `".$this->forum_db."`.".$this->forum_db_prefix."_topics WHERE forum_id=".get_from_db_config('phpbb_news_forum_id')."")->fetchColumn();
    
    $pagination = pagination($results, [
    'get_vars'  => [
    'cat'   => (int)@$_GET['cat'],
        'view'  => @$_GET['view']
    ], 
    'per_page'  => get_from_db_config('news_per_page'),
    'per_side'  => 3,
    'get_name'  => 'page'
    ]);
    
    $this->container['pagination_news'] = $pagination;
          
    return $this->db->query("SELECT t.topic_id, t.topic_posts_approved, t.topic_title, t.topic_last_post_id, t.forum_id, p.enable_smilies, p.enable_magic_url, p.bbcode_bitfield, p.bbcode_uid, p.enable_bbcode, p.post_id, p.post_text, p.poster_id, p.post_time, u.user_colour, u.user_id, u.username
          FROM `".$this->forum_db."`.".$this->forum_db_prefix."_topics t, `".$this->forum_db."`.".$this->forum_db_prefix."_forums f, `".$this->forum_db."`.".$this->forum_db_prefix."_posts p, `".$this->forum_db."`.".$this->forum_db_prefix."_users u
          WHERE 
          t.forum_id = ".get_from_db_config('phpbb_news_forum_id')." AND
          f.forum_id = t.forum_id AND
          t.topic_id  = p.topic_id AND
          p.post_id = t.topic_first_post_id AND
          p.poster_id = u.user_id
          ORDER BY p.topic_id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function Check_For_News_phpbb() {
    return $this->db->query("SELECT topic_id FROM `".$this->forum_db."`.".$this->forum_db_prefix."_topics WHERE forum_id=". get_from_db_config('phpbb_news_forum_id')."")->fetchColumn();
  }
  
  public function get_titles() {
        $url =  $_SERVER['REQUEST_URI'];
        $pieces = explode("topic_", $url);
        $newsearch = sql_escape(htmlspecialchars($pieces[1]));
        $get = $this->db->prepare("SELECT * FROM ".$this->argos_db_prefix."news WHERE seourl=?");
        $get->bindParam(1, $newsearch, PDO::PARAM_STR); 
        $get->execute(); 
        
        return $get;
  }
  
  public function get_comments($news_id) {
   return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."comments WHERE newsid='$news_id' order by id ASC");
  }
  
  public function insert_comment($com_ava,$com_text,$news_id,$com_date) {
  
    $com_text = htmlspecialchars($_POST['com_text']);
  
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."comments (author,text,date,avatar,nick_colour,user_id,newsid) VALUES(?,?,'$com_date','$com_ava','".$this->user_color."','".$this->user_id."', '$news_id')");    
    $go->bindParam(1, $this->username, PDO::PARAM_STR); 
    $go->bindParam(2, $com_text, PDO::PARAM_STR); 
    $go->execute(); 
    $go = $this->db->query("UPDATE ".$this->argos_db_prefix."news SET comments=comments+1 WHERE id='$news_id'");
  
  }
  
};