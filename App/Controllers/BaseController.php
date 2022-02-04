<?php
namespace App\Controllers;

class BaseController {

  public function __construct() {
    global $mustache;
    global $dbh;
    global $bb_prefix;
    global $bb_db;
    global $lang_sys;
    global $user;
    global $bb_ava_type;
    global $auth;
    global $container;
    global $cacher;
    global $GameQ;
    global $dispatcher;
    
    //Argos Features
    $this->mustache = $mustache;
    $this->db = $dbh;
    $this->argos_db_prefix = getenv('DB_PREFIX');
    $this->lang = $lang_sys;
    $this->container = $container;
    $this->fastcache = $cacher;
    $this->gameq = $GameQ;
    $this->dispatcher = $dispatcher;
    
    //phpBB Integration
    $this->forum_db_prefix = $bb_prefix;
    $this->forum_db = $bb_db;
    $this->forum_path = getenv('FORUM_PATH');
    $this->is_anonymous = ($user->data['user_id']==ANONYMOUS);
    $this->session_id = $user->session_id;
    $this->user_id = $user->data['user_id'];
    $this->is_bot = $user->data['is_bot'];
    $this->user_email = $user->data['user_email'];
    $this->username = $user->data['username'];
    $this->is_admin = $auth->acl_get('a_user');
    $this->user_ip = $user->ip;
    $this->user_signature = $user->data['user_sig'];
    $this->bbcode_uid = $user->data['user_sig_bbcode_uid'];
    $this->bbcode_bitfield = $user->data['user_sig_bbcode_bitfield'];
    $this->last_visit = $user->data['user_lastvisit'];
    $this->user_color = $user->data['user_colour'];
    $this->current_page = $user->page['page'];
    $this->new_privmsg = $user->data['user_new_privmsg'];
    $this->unread_privmsg = $user->data['user_unread_privmsg'];
    $this->user_posts = $user->data['user_posts'];
    $this->user_ava = $user->data['user_avatar'];
    $this->group_id = $user->data['group_id'];
    $this->ava_type = $bb_ava_type;
    $this->user_warns = $user->data['user_warnings'];
    
    //Unique Stats counter
    unique_statistic();
   
    //Load All Enabled Extensions
    load_extensions();
  }
  
  
 
  public function is_user_admin() {
  
    //admin check
    if(!$this->is_admin && !giving_access_to_user()) {
      header("Location: ../".removeLastSlash($this->forum_path)."/ucp.php?mode=login");
    }
  
  }
    
 
  
};