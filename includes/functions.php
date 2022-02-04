<?php
//Delete old Advertises
$dbh->query("DELETE FROM ".getenv('DB_PREFIX')."advertise WHERE `dobaven_na`+`expire`<UNIX_TIMESTAMP()");

//Load extensions
function load_extensions() {
  global $dbh,$container,$dispatcher;
  $checker = $dbh->query('SELECT ext_name FROM '.getenv("DB_PREFIX").'ext WHERE ext_active=1');    
  if($checker->rowCount() > 0) {
    while($row=$checker->fetch(PDO::FETCH_ASSOC)){
      $ext_name = $row['ext_name'];
      if(file_exists(__DIR__.'/../ext/'.$ext_name.'/ext.php')) {
        require_once(__DIR__.'/../ext/'.$ext_name.'/ext.php');
      }
    }
  }
}

//Language setter
if(isset($_COOKIE['argos_lang'])){
  if(file_exists(dirname(__DIR__).'/lang/'.$_COOKIE['argos_lang'])) {
    require dirname(__DIR__)."/lang/".$_COOKIE['argos_lang']."/".$_COOKIE['argos_lang'].".php"; 
    require dirname(__DIR__)."/lang/".$_COOKIE['argos_lang']."/custom_".$_COOKIE['argos_lang'].".php"; 
  } else {
    require dirname(__DIR__)."/lang/en/en.php"; 
    require dirname(__DIR__)."/lang/en/custom_en.php"; 
  }
} else {
  $get = $dbh->query("SELECT default_language FROM ".getenv('DB_PREFIX')."config");
  $row = $get->fetch(PDO::FETCH_ASSOC);
  $default_lang = $row['default_language'];
  require dirname(__DIR__)."/lang/$default_lang/$default_lang.php"; //default lang
  require dirname(__DIR__)."/lang/$default_lang/custom_$default_lang.php";
}

//get current language
function get_current_language() {
  if(!isset($_COOKIE['argos_lang'])) {
    global $dbh;
    $get = $dbh->query("SELECT default_language FROM ".getenv('DB_PREFIX')."config");
    $row = $get->fetch(PDO::FETCH_ASSOC);
    $default_lang = $row['default_language'];
    return $default_lang;
  } else {
    if(file_exists(dirname(__DIR__).'/lang/'.$_COOKIE['argos_lang'])) {
      return $_COOKIE['argos_lang'];
    } else {
      return 'en';
    }
  }
}

//get user avatar
function get_user_ava() {
  global $user;
  $arg['avatar'] = $user->data['user_avatar'];
  $arg['avatar_type'] = $user->data['user_avatar_type'];
  $arg['avatar_height'] = $user->data['user_avatar_height'];
  $arg['avatar_width'] = $user->data['user_avatar_width'];
  
  if(empty($arg['avatar'])) {
    $urlParts = explode('/', str_ireplace(['http://', 'https://'], '', url()));
    return '<img class="avatar" src="//'.$_SERVER['SERVER_NAME'].'/'.$urlParts[1].'/assets/img/no_avatar.png" width="150" height="120" alt="User avatar" />';
  } else {
    $avatar =  phpbb_get_user_avatar($arg, $user->lang['USER_AVATAR'], false);	
   
    if($user->data['user_avatar_type'] == 'avatar.driver.upload') {
      $get_specific = explode('download/',$avatar);
      return '<img style="max-width:100%;max-height:100%" src="'.base_forum_url().'download/'.preg_replace( '/(width|height)="\d*"\s/', "",$get_specific[1]);
    } else if($user->data['user_avatar_type'] == 'avatar.driver.local') {
      $get_specific = explode('images/',$avatar);
      return '<img style="max-width:100%;max-height:100%" src="'.base_forum_url().'images/'.preg_replace( '/(width|height)="\d*"\s/', "",$get_specific[1]);
    } else {
      return $avatar;
    }
  }
}

//check custom user access
function check_custom_user_access() {
  global $dbh, $user;
  $username = $user->data['username'];
  $get=$dbh->query("SELECT id FROM ".getenv('DB_PREFIX')."custom_user_access WHERE username='$username'");
  if($get->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

//remove last trailing slash
function removeLastSlash($string)
{
  if($string{strlen($string) - 1} == '/') {
    return substr($string, 0, strlen($string) - 1);
  } else{
    return $string;
  }
}
	
//base url
function url() 
{
  $currentPath = $_SERVER['PHP_SELF']; 
  $pathInfo = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $hostName = $_SERVER['HTTP_HOST']; 
  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
  if (isset($_SERVER['HTTP_CF_VISITOR']) && json_decode($_SERVER['HTTP_CF_VISITOR'])->scheme == 'https') {
    $protocol = "https://";
  }
  return $protocol.$hostName.$pathInfo."";
}

//return seconds to time
function secondsToTime($seconds) {
  global $lang_sys;
  $dtF = new DateTime("@0");
  $dtT = new DateTime("@$seconds");
  return $dtF->diff($dtT)->format('%a '.$lang_sys['lang_days'].'');
}

//create utf8 file
function write_utf8_file($file,$content) {
  $file_handle = fopen($file, "wb") or die("can't open file");
  fwrite($file_handle, iconv('UTF-8', 'UTF-8', $content));
  fclose($file_handle);
} 

//get total users 
function get_total_users() {
  global $dbh, $bb_prefix, $bb_db, $cacher;

  $total_users = $cacher->get("total_users_from_forum");
    if(is_null($total_users)) {
      $mysql = $dbh->query("SELECT count(user_id) as total_users FROM `$bb_db`.".$bb_prefix."_users WHERE group_id!=6 AND group_id!=1 AND user_type!=1");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_users_from_forum",$fetchrow['total_users'], 60);
    }
  return $total_users;
}

//get total sessions
function get_total_sessions() {
  global $dbh, $bb_prefix, $bb_db, $cacher;

  $total_sessions= $cacher->get("total_sessions_from_forum");
    if(is_null($total_sessions)) {
      $mysql=$dbh->query("select session_user_id,COUNT(session_user_id) as count_sess from `$bb_db`.".$bb_prefix."_sessions s INNER JOIN `$bb_db`.".$bb_prefix."_users u ON u.user_id = s.session_user_id WHERE session_user_id <> 1 AND (session_time + 300) > UNIX_TIMESTAMP(NOW())");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_sessions_from_forum",$fetchrow['count_sess'], 60);
    }
  return $total_sessions;
}

//get total anonymous
function get_total_anonymous() {
  global $dbh, $bb_prefix, $bb_db, $cacher;

  $total_guests= $cacher->get("total_guests_from_forum");
    if(is_null($total_guests)) {
      $mysql=$dbh->query("select session_user_id,COUNT(session_user_id) as count_sess_anony from `$bb_db`.".$bb_prefix."_sessions s INNER JOIN `$bb_db`.".$bb_prefix."_users u ON u.user_id = s.session_user_id WHERE session_user_id = 1 AND (session_time + 300) > UNIX_TIMESTAMP(NOW())");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_guests_from_forum",$fetchrow['count_sess_anony'], 60);
    }
  return $total_guests;
}

//get total topics
function get_total_topics() {
  global $dbh, $bb_prefix, $bb_db, $cacher;

  $total_topics= $cacher->get("total_topics_from_forum");
    if(is_null($total_topics)) {
      $mysql = $dbh->query("SELECT count(topic_id) as total_topics FROM `$bb_db`.".$bb_prefix."_topics WHERE topic_posts_approved >= '1'");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_topics_from_forum",$fetchrow['total_topics'], 60);
    }
  return $total_topics;
}

//get total forums
function get_total_forums() {
  global $dbh, $bb_prefix, $bb_db, $cacher;
  
  $total_forums= $cacher->get("total_forums_from_forum");
    if(is_null($total_forums)) {
      $mysql = $dbh->query("SELECT count(forum_id) as total_forums FROM `$bb_db`.".$bb_prefix."_forums WHERE forum_type=1");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_forums_from_forum",$fetchrow['total_forums'], 60);
    }
  return $total_forums;
}

//get total posts
function get_total_posts() {
  global $dbh, $bb_prefix, $bb_db, $cacher;
  
  $total_posts= $cacher->get("total_posts_from_forum");
    if(is_null($total_posts)) {
      $mysql = $dbh->query("SELECT count(post_id) as total_posts FROM `$bb_db`.".$bb_prefix."_posts WHERE post_visibility=1");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_posts_from_forum",$fetchrow['total_posts'], 60);
    }
  return $total_posts;
}

//get total topic views 
function get_total_topic_views() {
  global $dbh, $bb_prefix, $bb_db, $cacher;

  $total_views= $cacher->get("total_views_from_forum");
    if(is_null($total_views)) {
      $mysql = $dbh->query("SELECT SUM(topic_views) as total_topic_views  FROM `$bb_db`.".$bb_prefix."_topics WHERE topic_posts_approved = '1'");
      $fetchrow = $mysql->fetch(PDO::FETCH_ASSOC);
      $cacher->set("total_views_from_forum",$fetchrow['total_topic_views'], 60);
    }
  return $total_views;
}

//stats function
function unique_statistic() {
  global $dbh;
  
  $mysql=$dbh->query("select * from ".getenv('DB_PREFIX')."stats where date IN (CURDATE()) AND ip='".$_SERVER['REMOTE_ADDR']."'");
  $n=$mysql->rowCount();
  if($n==0)
  {
    $go = $dbh->query("insert into ".getenv('DB_PREFIX')."stats (date,ip) values(CURDATE(),'".$_SERVER['REMOTE_ADDR']."')");
  }
  $go = $dbh->query("DELETE FROM `".getenv('DB_PREFIX')."stats` where date(date) < DATE_SUB(CurDate(), INTERVAL 6 DAY);");
}

//all global variables from mysql table 'config'
function get_from_db_config($val) {
  global $dbh;
  $get = $dbh->query("SELECT ".$val." FROM ".getenv('DB_PREFIX')."config");
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row[$val];
}

//get jquery/js for insert in templates
function get_from_jquery_js() {
  global $dbh;
  $get = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."jquery_js");
  while($row = $get->fetch(PDO::FETCH_ASSOC)) {
    $jquery_js .= $row['jquery_js'];
  } 
  return $jquery_js;
}

//get all custom pages
function get_all_custom_pages() {
  global $dbh;
  $get = $dbh->query("SELECT page_name,page_title FROM ".getenv('DB_PREFIX')."pages");
  if($get->rowCount()>0) {
    while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $c_page_name = $row['page_name'];
      $c_page_title = $row['page_title'];
      $c_pages .= "<li><a href='".url()."/pages/$c_page_name'>$c_page_title</a></li>";
    }
    return $c_pages;
  } else {
    return 0;
  }
}

//global template variables
$mustache->assign([
  'username'=>$bb_username,
  'is_logged'=>$bb_is_anonymous ? false : true,
  'baseurl'=>url(),
	'forum_path' => removeLastSlash(getenv("FORUM_PATH")),
	'user_id' => $bb_user_id,
	'session_id' => $bb_session_id,
	'login_proceed' => append_sid("".removeLastSlash(getenv("FORUM_PATH"))."/ucp.php", 'mode=login', true,$bb_session_id ),
	'unread_pm' => $bb_unread_pm,
	'user_avatar' => get_user_ava(),
	'user_ip' => $bb_user_ip,
	'user_posts' => $bb_user_posts,
	'user_last_visit' => $user->format_date($bb_user_last_visit),
	'user_logout' => removeLastSlash(getenv("FORUM_PATH")).'/ucp.php?mode=logout&sid='.$bb_session_id.'',
	'user_color' => $bb_user_color,
	'is_admin' => ($bb_is_admin || check_custom_user_access()) ? true : false,
	'online_users' => get_total_sessions(),
	'online_users_anonymous' => get_total_anonymous(),
	'total_users'=>get_total_users(),
	'total_topics'=>get_total_topics(),
	'total_forums'=>get_total_forums(),
	'total_posts'=>get_total_posts(),
	'total_topics_views'=>get_total_topic_views(),
	'chat_enable'=>get_from_db_config('chat_enable'),
	'poll_enable'=>get_from_db_config('poll_enable'),
	'img_upload_enable'=>get_from_db_config('img_upload_enable'),
	'file_upload_enable'=>get_from_db_config('file_upload_enable'),
	'footer_stats_enable'=>get_from_db_config('footer_stats_enable'),
	'socials_enable'=>get_from_db_config('socials_enable'),
	'servers_enable'=>get_from_db_config('servers_enable'),
	'cookie_policy_enable'=>get_from_db_config('cookie_policy'),
	'video_upload_enable'=>get_from_db_config('video_enable'),
	'gallery_enable'=>get_from_db_config('gallery_enable'),
	'rating_enable'=>get_from_db_config('rating_enable'),
	'tw_link'=>get_from_db_config('tw_link'),
	'fb_link'=>get_from_db_config('fb_link'),
	'goo_link'=>get_from_db_config('goo_link'),
	'favicon'=>get_from_db_config('favicon'),
	'small_text_logo'=>get_from_db_config('logo_text_small'),
	'big_text_logo'=>get_from_db_config('logo_text_big'),
	'site_name'=>get_from_db_config('site_name'),
	'last_news_name'=>get_from_db_config('last_news_name'),
	'last_news_link'=>get_from_db_config('last_news_link'),
	'head_box_text'=>get_from_db_config('head_box_text'),
	'google_site_verify'=> get_from_db_config('google_site_verify'),
	'google_analytics'=> get_from_db_config('google_analytics'),
	'current_year'=>date("Y"),
	'jquery_js' => get_from_jquery_js(),
	'all_custom_pages' => get_all_custom_pages(),
	'current_style'=> (strpos($_SERVER['REQUEST_URI'],'admin') !== false) ? '' : get_style(),
  'get_active_lang'=>get_active_langs(),
  'banlist_url'=>get_from_db_config('banlist_url'),
  'current_language'=>get_current_language(),
  'hide_test_menus'=>get_from_db_config('hide_test_menus'),
]);

//continue stats
function group_users() {
  global $dbh, $bb_db, $bb_prefix, $cacher;

  $group_users= $cacher->get("group_users_from_forum");
  if(is_null($group_users)) {
  $mysql=$dbh->query("select group_name,group_colour FROM `$bb_db`.".$bb_prefix."_groups WHERE group_legend != 0 ORDER by group_name ASC");
    while($fetchrow = $mysql->fetch(PDO::FETCH_ASSOC)) {
      $group_colors = $fetchrow['group_colour'];
      $group_names = $fetchrow['group_name'];
      switch($group_names) {
        case 'GLOBAL_MODERATORS':{
          $group_names= 'Глобални модератори';
          break;
        }
        case 'ADMINISTRATORS':{
          $group_names= 'Администратори';
          break;
        }
      }
    $group_users[] = ['group_names'=>$group_names, 'group_colors'=>$group_colors];
    $cacher->set("group_users_from_forum",$group_users, 200);
    }
  }
  return new ArrayIterator($group_users); 
}
$mustache->assign('group_users',group_users());

//start advertise
//get 88x31
function banners88x31() {
  global $dbh;
  
  $get = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."advertise WHERE type='88x31'");
  if($get->rowCount() > 0) {
    while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $banner_link = $row['site_link'];
      $banner_img = $row['banner_img'];
      $banner_title = $row['link_title'];
      $banners_info[]=['banner_link_88x31'=>$banner_link,'banner_img_88x31'=>$banner_img,'banner_title_88x31'=>$banner_title];
    }
	return new ArrayIterator($banners_info); 
  }
}
$mustache->assign('get_88x31', banners88x31());
if(empty(banners88x31())) {
  $mustache->assign('no_banners_88x31',1);
}

//get 468x60
function banners468x60() {
  global $dbh;

  $get = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."advertise WHERE type='468x60' order by RAND() LIMIT 1");
  if($get->rowCount() > 0) {
    while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $banner_link = $row['site_link'];
      $banner_img = $row['banner_img'];
      $banner_title = $row['link_title'];
      $banners_info2[]=['banner_link_468x60'=>$banner_link,'banner_img_468x60'=>$banner_img,'banner_title_468x60'=>$banner_title];
    }
	return new ArrayIterator($banners_info2); 
  }
}
$mustache->assign('get_468x60', banners468x60());
if(empty(banners468x60())) {
  $mustache->assign('no_banners_468x60',1);
}

//get sliders
function sliders() {
  global $dbh;
  $get= $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."sliders order by id DESC");
  if($get->rowCount() > 0) {
    while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $slider_link = $row['slider_link'];
      $slider_img = $row['slider_img'];
      $slider_text = $row['text'];
      $slider_is_link = $row['is_link'];
      $sliders_info[] = ['slider_is_link'=>$slider_is_link,'slider_img'=>$slider_img,'slider_link'=>$slider_link,'slider_text'=>$slider_text];
    }
  return new ArrayIterator($sliders_info); 
  }
}
$mustache->assign('get_sliders', sliders());
if(empty(sliders())) {
  $mustache->assign('no_sliders',1);
}

//last topics from forum
function last_topics() {
  global $dbh, $bb_db, $bb_prefix, $user, $cacher;

  $last_topics = $cacher->get("last_topics_from_forum");
    if(is_null($last_topics)) {
      $mysql = $dbh->query("SELECT topic_first_poster_name,topic_title,topic_id,a.forum_id,topic_views,topic_time,topic_first_poster_colour FROM `$bb_db`.".$bb_prefix."_topics a INNER JOIN `$bb_db`.".$bb_prefix."_forums g ON g.forum_id=a.forum_id WHERE topic_posts_approved >= '1' AND enable_indexing=1 ORDER BY topic_time DESC LIMIT 0,5");
    if($mysql->rowCount() > 0) {
      while($row = $mysql->fetch(PDO::FETCH_ASSOC)) {
        $usernames = $row['topic_first_poster_name'];
        $topic_titles = htmlspecialchars_decode(truncate_chars($row['topic_title'],35,'...'));
        $topic_id = $row['topic_id'];
        $forum_id = $row['forum_id'];
        $topic_views = $row['topic_views'];
        $topic_times =  $user->format_date($row['topic_time']);
        $user_post_color = $row['topic_first_poster_colour'];
        $last_topics[]  = ['usernames'=>$usernames,'topic_time'=>$topic_times,'topic_titles'=>$topic_titles,'topic_link'=>''.base_forum_url().'viewtopic.php?f='.$forum_id.'&t='.$topic_id.'','topic_views'=>$topic_views,'topic_user_color'=>$user_post_color];
        $cacher->set("last_topics_from_forum",$last_topics, 60);
      } 
    }
  }
  return new ArrayIterator($last_topics); 
}
$mustache->assign('last_topics', last_topics());

//get right menus
function get_right_menus() {
  global $dbh;
  $get= $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."menus WHERE position='right' order by id ASC");
  if($get->rowCount() > 0) {
    while($row= $get->fetch(PDO::FETCH_ASSOC)){
      $menu_title = $row['title'];
      $menu_content = htmlspecialchars_decode($row['the_content']);
      $menus_info[] = ['menu_title'=>$menu_title,'menu_content'=>$menu_content];
    }
    return new ArrayIterator($menus_info); 
  }
}
  
$mustache->assign('get_menus', get_right_menus());
if(empty(get_right_menus())) {
  $mustache->assign('no_menuz',1);
}

//get left menus
function get_left_menus() {
  global $dbh;
  $get2= $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."menus WHERE position='left' order by id ASC");
  if($get2->rowCount() > 0) {
    while($row = $get2->fetch(PDO::FETCH_ASSOC)){
      $menu_title = $row['title'];
      $menu_content = htmlspecialchars_decode($row['the_content']);
      $menus_info2[] = ['menu_title2'=>$menu_title,'menu_content2'=>$menu_content];
    }
  return new ArrayIterator($menus_info2); 
  }
}
$mustache->assign('get_menus2',get_left_menus());
if(empty(get_left_menus())) {
  $mustache->assign(['no_menuz2'=>1]);
}


//Poll
function get_poll() {
  global $dbh, $lang_sys, $bb_user_ip;
  $get_polls = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."dpolls ORDER by id DESC LIMIT 1");
  
  if($get_polls->rowCount() > 0) {
    $row = $get_polls->fetch(PDO::FETCH_ASSOC);
    $poll_id = $row['id'];
    $pollansw1 = $row['poll_answer']; //column which holds votes and counts
    $poll_votes = $row['poll_votes']; //total votes
 
    $pieces = explode(";", $pollansw1); //explode votes
    $pollansw = ["votes"=>$pieces]; //make array with votes
    $quest = $row['poll_question']; //the question

    $get_poll_votes = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."dpolls_votes WHERE ip='$bb_user_ip' AND poll_id='$poll_id' ORDER by id DESC LIMIT 1");
    if($get_poll_votes->rowCount() < 1) {
      $poll_print .= '
      <i class="fa fa-question-circle"></i> '.$quest.'
      <form  method="post">';
      
      $counter = 0;
      foreach($pollansw['votes'] as $v ) {
        $counter++;
        $pollansw_redit= explode("##",$v);
        $poll_print .= '<input type="radio" name="answ" class="css-checkbox" id="radio'.$counter.'" value="'.$v.'"/> '.$pollansw_redit[0].' <label for="radio'.$counter.'" class="css-label radGroup1">&nbsp;</label><div class="clearfix"></div>';
      }
      
      $poll_print .= '
      <input type="submit" class="btn btn-md btn-primary" name="submit_vote" value="'.$lang_sys['lang_vote'].'"/>
      </form>
      <div class="clear clearfix"></div>
      ';
      return $poll_print;
    } else {
      $poll_print = "<i class='fa fa-question-circle'></i> $quest<br />";

      foreach($pollansw['votes'] as $v ) {
        $pollansw_redit= explode("##",$v);
        $poll_bar_width = floor(($pollansw_redit[1] / $poll_votes) * 100);
        $poll_print .= "".$pollansw_redit[0]." <span style='display:inline-block;width:".$poll_bar_width."%;max-width:73%;background:#3093c7;height:4px'></span> ($pollansw_redit[1])<br />";	
      }
      $poll_print .= "".$lang_sys['lang_total_votes']." <b>$poll_votes</b>";
      return $poll_print;
    }
  } else {
    return $lang_sys['lang_no_poll'];
  }
}
$mustache->assign(['poll_print'=> get_poll()]);

//vote submit
$poll_send_vote[] ="";
  if(isset($_POST['submit_vote'])) {
  if(!empty($_POST['answ'])) {
  
    //get poll id
    $get_polls = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."dpolls ORDER by id DESC LIMIT 1");
    $row_poll = $get_polls->fetch(PDO::FETCH_ASSOC);
    $poll_id = $row_poll['id'];

    //catch answer
    $answ1z = trim(htmlspecialchars($_POST['answ']));
    $answer = explode("##",$answ1z);
    $answer2 = $answer[1] +1;
    $updated_answer = $answer[0].'##'.$answer2;


    //to get poll answer column
    $get_poll_answer = $dbh->query("SELECT poll_answer from ".getenv('DB_PREFIX')."dpolls order by id DESC LIMIT 1");
    $row_poll = $get_poll_answer->fetch(PDO::FETCH_ASSOC);
    $poll_answer=$row_poll['poll_answer'];;

    $go = $dbh->prepare("UPDATE ".getenv('DB_PREFIX')."dpolls SET poll_answer = REPLACE('$poll_answer', ?, '$updated_answer') WHERE poll_answer LIKE ? AND id='$poll_id'");
    $go->bindParam(1, $answ1z, PDO::PARAM_STR);     
    $reference_answ1z = "%$answ1z%"; //to pass below, else error...
    $go->bindParam(2, $reference_answ1z, PDO::PARAM_STR); 
    $go->execute(); 
    $dbh->query("INSERT INTO ".getenv('DB_PREFIX')."dpolls_votes (poll_id,ip) VALUES('$poll_id','$bb_user_ip')"); //we count vote on voter
    $dbh->query("UPDATE ".getenv('DB_PREFIX')."dpolls SET poll_votes=poll_votes+1");
    header('Location: '.secure_url().$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
    exit;
  } else {
    $mustache->assign(['poll_choose'=>$lang_sys['lang_choose_one_option']]);
  }
}


//truncate
function truncate_chars($str, $limit = 15, $bekind = false, $maxkind = NULL, $end = NULL){
    if ( empty($str) || gettype($str) != 'string' ){
        return false;
    }
    $end = empty($end) || gettype($end) != 'string' ? '...' : $end;
    $limit = intval($limit) <= 0 ? 15 : intval($limit);
    if ( mb_strlen($str, 'UTF-8') > $limit ){
        if ( $bekind == true ){
            $maxkind = $maxkind == NULL || intval($maxkind) <= 0 ? 5 : intval($maxkind);
            $chars = preg_split('/(?<!^)(?!$)/u', $str);
            $cut = mb_substr($str, 0, $limit, 'UTF-8');
            $buffer = '';
            $total = $limit;
            for ( $i = $limit ; $i < count($chars) ; $i++ ){
                if ( !( $chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i]) ) ){
                    if ( $maxkind > 0 ){
                        $maxkind--;
                        $buffer = $buffer . $chars[$i];
                    }else{
                        $buffer = !( $chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i]) ) ? '' : $buffer;
                        $total = !( $chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i]) ) ? 0 : ( $total + 1 );
                        break;
                    }
                    $total++;
                }else{
                    break;
                }
            }
            return $total == mb_strlen($str, 'UTF-8') ? $str : ( $cut . $buffer . $end );
        }
        return mb_substr($str, 0, $limit, 'UTF-8') . $end;
    }else{
        return $str;
    }
}


//unlink recursive
function unlink_recursive($dir_name, $ext) {
    if (!file_exists($dir_name)) {
        return false;
    }

    $dir_handle = dir($dir_name);

    while (false !== ($entry = $dir_handle->read())) {

        if ($entry == '.' || $entry == '..') {
            continue;
        }

        $abs_name = "$dir_name/$entry";

        if (is_file($abs_name) && preg_match("/^.+\.$ext$/", $entry)) {
            if (unlink($abs_name)) {
                continue;
            }
            return false;
        }

        if (is_dir($abs_name) || is_link($abs_name)) {
            unlink_recursive($abs_name, $ext);
        }
    }

    $dir_handle->close();
    return true;
}

//seo url
function parse_cyr_en_url($str, $replace=[], $delimiter='-') {
   
   $cyr=[
     "Щ", "Ш", "Ч","Ц", "Ю", "Я", "Ж","А","Б","В",
     "Г","Д","Е","Ё","З","И","Й","К","Л","М","Н",
     "О","П","Р","С","Т","У","Ф","Х","Ь","Ы","Ъ",
     "Э","Є", "Ї","І",
     "щ", "ш", "ч","ц", "ю", "я", "ж","а","б","в",
     "г","д","е","ё","з","и","й","к","л","м","н",
     "о","п","р","с","т","у","ф","х","ь","ы","ъ",
     "э","є", "ї","і"
  ];
  $lat=[
     "sch","sh","ch","c","yu","ya","j","a","b","v",
     "g","d","e","e","z","i","y","k","l","m","n",
     "o","p","r","s","t","u","f","h","", 
     "y","" ,"e","e","yi","i",
     "sch","sh","ch","c","yu","ya","j","a","b","v",
     "g","d","e","e","z","i","y","k","l","m","n",
     "o","p","r","s","t","u","f","h",
     "", "y","" ,"e","e","yi","i"
  ];

  for($i=0; $i<count($cyr); $i++)  {
     $c_cyr = $cyr[$i];
     $c_lat = $lat[$i];
     $str = str_replace($c_cyr, $c_lat, $str);
  }
  
   $str= preg_replace("/([qwrtpsdfghklzxcvbnmQWRTPSDFGHKLZXCVBNM]+)[jJ]e/", "\${1}e", $str);
   $str = preg_replace("/([qwrtpsdfghklzxcvbnmQWRTPSDFGHKLZXCVBNM]+)[jJ]/", "\${1}'", $str);
   $str = preg_replace("/([eyuioaEYUIOA]+)[Kk]h/", "\${1}h", $str);
   $str = preg_replace("/^kh/", "h", $str);
   $str = preg_replace("/^Kh/", "H", $str);
  
   $str2 =$str;
    
   if( !empty($replace) ) {
      $str2 = str_replace((array)$replace, ' ', $str2);
   }
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str2);
   $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
   $clean = strtolower(trim($clean, '-'));
   $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

   return $clean;
}

//strip tags
function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>') 
{ 
  mb_regex_encoding('UTF-8'); 
  $search = ['/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u']; 
  $replace = ['\'', '\'', '"', '"', '-']; 
  $text = preg_replace($search, $replace, $text); 
  $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8'); 
  if(mb_stripos($text, '/*') !== FALSE){ 
    $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm'); 
  } 
  $text = preg_replace(['/<([0-9]+)/'], ['< $1'], $text); 
  $text = strip_tags($text, $allowed_tags); 
  $text = preg_replace(['/^\s\s+/', '/\s\s+$/', '/\s\s+/u'], ['', '', ' '], $text); 
  $search = ['#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu']; 
  $replace = ['<b>$2</b>', '<i>$2</i>', '<u>$1</u>']; 
  $text = preg_replace($search, $replace, $text); 
  $num_matches = preg_match_all("/\<!--/u", $text, $matches); 
  if($num_matches){ 
    $text = preg_replace('/\<!--(.)*--\>/isu', '', $text); 
  } 
  return $text; 
} 
	
//for vbox api (in videos)
function get_string_between($string, $start, $end, $inclusive = false){
  $fragments = explode($start, $string, 2);
  if (isset($fragments[1])) {
    $fragments = explode($end, $fragments[1], 2);
    if ($inclusive) {
       return $start.$fragments[0].$end;
    } else {
       return $fragments[0];
    }
  }
  return false;
}

//define is html string or not
function is_html($string)
{
  return preg_match("/<[^<]+>/",$string,$m) != 0;
}

function file_get_contents_utf8($url){
  $raw = file_get_contents($url);
  if($raw === FALSE){
     return false;
  } else {
    return mb_convert_encoding($raw, 'UTF-8',
    mb_detect_encoding($raw, 'UTF-8, ISO-8859-1', true));
  }
}

//for simple cache deleting
function rmdir_recursive( $dirname ) {
    if ( class_exists( 'FilesystemIterator' ) && defined( 'FilesystemIterator::SKIP_DOTS' ) ) {

        if ( !is_dir( $dirname ) ) {
            return false;
        }

        foreach( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dirname, FilesystemIterator::SKIP_DOTS ), RecursiveIteratorIterator::CHILD_FIRST ) as $path ) {
            $path->isDir() ? rmdir( $path->getPathname() ) : unlink( $path->getRealPath() );
        }

        return rmdir( $dirname );

    }

    if ( class_exists( 'RecursiveDirectoryIterator' ) && defined( 'RecursiveDirectoryIterator::SKIP_DOTS' ) ) {

        if ( !is_dir( $dirname ) ) {
            return false;
        }

        foreach( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dirname, RecursiveDirectoryIterator::SKIP_DOTS ), RecursiveIteratorIterator::CHILD_FIRST ) as $path ) {
            $path->isDir() ? rmdir( $path->getPathname() ) : unlink( $path->getRealPath() );
        }

        return rmdir( $dirname );

    }
    
    if ( class_exists( 'RecursiveIteratorIterator' ) && class_exists( 'RecursiveDirectoryIterator' ) ) {

        if ( !is_dir( $dirname ) ) {
            return false;
        }

        foreach( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dirname ), RecursiveIteratorIterator::CHILD_FIRST ) as $path ) {
            if ( in_array( $path->getFilename(), [ '.', '..' ] ) ) {
                continue;
            }
            $path->isDir() ? rmdir( $path->getPathname() ) : unlink( $path->getRealPath() );
        }

        return rmdir( $dirname );

    }

    if ( !is_dir( $dirname ) ) {
        return false;
    }

    $objects = scandir( $dirname );

    foreach ( $objects as $object ) {
        if ( $object === '.' || $object === '..' ) {
            continue;
        }
        filetype( $dirname . DIRECTORY_SEPARATOR . $object ) === 'dir' ? rmdir_recursive( $dirname . DIRECTORY_SEPARATOR . $object ) : unlink( $dirname . DIRECTORY_SEPARATOR . $object );
    }

    reset( $objects );
    rmdir( $dirname );

    return !is_dir( $dirname );
}

//for specific purposes
function sql_escape($data) {
  if ( !isset($data) or empty($data) ) return '';
  if ( is_numeric($data) ) return $data;
  $non_displayables = [
      '/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
      '/%1[0-9a-f]/',             // url encoded 16-31
      '/[\x00-\x08]/',            // 00-08
      '/\x0b/',                   // 11
      '/\x0c/',                   // 12
      '/[\x0e-\x1f]/'             // 14-31
  ];
  foreach ( $non_displayables as $regex )
    $data = preg_replace( $regex, '', $data );
    $data = str_replace("'", "''", $data );
  return $data;
}

//greyfish cache updater
function greyfish_cache() {

global $dbh, $cacher, $GameQ;
$greyfish_servers = $cacher->get("greyfish_servers");
if(is_null($greyfish_servers)) {
  $get_servers = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."greyfish_servers");
    while($row = $get_servers->fetch(PDO::FETCH_ASSOC)){
      $server_ip = $row['ip'];
      $server_port = $row['port'];
      $server_type = $row['type'];
      $servid = $row['id'];
      

      if($server_type == 'teamspeak3') {  
        $GameQ->addServer([
          'type' => "$server_type",
          'host' => "$server_ip:$server_port",
          'options' => [
              'query_port' => 10011,
          ],
        ]);
      } else {
       $GameQ->addServer([
          'type' => "$server_type",
          'host' => "$server_ip:$server_port",
        ]); 
      }
      
      $server_query = $GameQ->process()["$server_ip:$server_port"];
   
      switch($server_type) {
      
        case  'cs16': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['hostname']);
          if ($host_cron == null) {
            //offline
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          } else {
            //online
            $map_cron = $server_query['map'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron',map='$map_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          }
          break;
        }
        
        case 'csgo': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['hostname']);
          if ($host_cron == null) {
            //offline
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          } else {
            //online
            $map_cron = $server_query['map'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron',map='$map_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          }
          break;
        }
        
        case 'css': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['hostname']);
          if ($host_cron == null) {
            //offline
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          } else {
            //online
            $map_cron = $server_query['map'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron',map='$map_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          }
          break;
        }
        
        case 'tf2': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['hostname']);
          if ($host_cron == null) {
            //offline
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          } else {
            //online
            $map_cron = $server_query['map'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron',map='$map_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          }
          break;
        }
        
        case 'samp': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['servername']);
          if ($host_cron != null) {
            //online
            $map_cron = $server_query['gq_mapname'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $query_q_samp = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron',map='$map_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          } else {
            //offline
            $query_q_samp = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          }
          break;
        }
        
        case 'teamspeak3': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['gq_hostname']);
          
          if ($host_cron == null) {
            //offline
            $query_q_ts3 = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          } else {
            //online
            $p_cron =  $server_query['gq_numplayers'];
            $maxp_cron =  $server_query['gq_maxplayers'];
            $query_q_cs = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',hostname='$host_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
          }
          break;
        }
        
        case 'minecraft': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['hostname']);
          if ($host_cron != null) {
            //online
            $map = $server_query['map'];
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $version_cron = $server_query['version'];
            $query_q_mc = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',version='$version_cron',hostname='$host_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
             
          } else {
            //ofline
            $query_q_mc = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          }
          break;
        }
        
        case 'ventrilo': {
          $host_cron = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$server_query['gq_hostname']);
          if ($host_cron != null) {
            //online
            $map = 'ventrilo';
            $p_cron = $server_query['gq_numplayers'];
            $maxp_cron = $server_query['gq_maxplayers'];
            $version_cron = $server_query['version'];
            $query_vent = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='1',version='$version_cron',hostname='$host_cron', players='$p_cron',maxplayers='$maxp_cron' WHERE id='$servid'");
             
          } else {
            //ofline
            $query_vent = $dbh->query("UPDATE ".getenv('DB_PREFIX')."greyfish_servers SET status='0', players='0',maxplayers='0' WHERE id='$servid'");
          }
          break;
        }
        
      }
    } 
$cacher->set("greyfish_servers",'greyfish_update', getnev('GREYFISH_UPDATE'));
}
}

//is SSL ?
function secure_url() {
  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    return 'https://';
  } else {
    return 'http://';
  }
}

//base forum url
function base_forum_url() {
  return  url()."/".preg_replace('/\.\.\/+/',"", getenv("FORUM_PATH"));
}

//get active languages
function get_active_langs() {
  $files2 = array_diff(scandir(dirname(__DIR__).'/lang'), ['.', '..']);
  foreach ($files2 as $v) {
     $files .= '<li><a href="#" data-langchange data-language="'.$v.'"><img src="'.url().'/assets/img/flags/'.$v.'.gif" height="14" width="20" alt="'.$v.' language"/></a></li>';
  }
  return str_replace('Array','',$files);
}


//pagination results
function pagination($results, $properties = []) {
  
  if (strpos(basename($_SERVER['REQUEST_URI']), '?') !== false && !strpos($_SERVER['REQUEST_URI'], '/pages/')) {
    $r_uri = explode('?',basename($_SERVER['REQUEST_URI']));
    $r_uri = $r_uri[0]; //page name without ?page=
  } else if(!strpos(basename($_SERVER['REQUEST_URI']), '.php') && !strpos($_SERVER['REQUEST_URI'], '/pages/')) {
    $r_uri = ''; //we are on index
  } else if(strpos($_SERVER['REQUEST_URI'], '/pages/') !== false) {
    //custom pages
    $r_uri = 'pages/'.get_string_between('/'.substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1),'/','?');
  } else {
    $r_uri = basename($_SERVER['REQUEST_URI']); //clear page name, like gallery.php
  }

	$defaultProperties = [
		'get_vars'	=> [],
		'per_page' 	=> 15,
		'per_side'	=> 4,
		'get_name'	=> 'page'
	];
	
	foreach($defaultProperties as $name => $default) { $properties[$name] = (isset($properties[$name])) ? $properties[$name] : $default; }
	
	foreach($properties['get_vars'] as $name => $value) {
		if (isset($_GET[$name]) && $name != $properties['get_name']) {
			$GETItems[] = $name.'='.$value;
		}
	}
	$l = (empty($GETItems)) ? '?'.$properties['get_name'].'=' : '?'.implode('&', $GETItems).'&'.$properties['get_name'].'=';
	
	$totalPages		= ceil($results / $properties['per_page']);
	$currentPage 	= (isset($_GET[$properties['get_name']]) && $_GET[$properties['get_name']] > 1) ? $_GET[$properties['get_name']] : 1;
	$currentPage 	= ($currentPage > $totalPages) ? $totalPages : $currentPage;
	
	$previousPage 	= $currentPage - 1;
	$nextPage 		= $currentPage + 1;
	
	// calculate which pages to show
	if ($totalPages <= ($properties['per_side'] * 2) + 1) {
		$loopStart = 1;
		$loopRange = $totalPages;
	} else {
		$loopStart = $currentPage - $properties['per_side'];
		$loopRange = $currentPage + $properties['per_side'];
		
		$loopStart = ($loopStart < 1) ? 1 : $loopStart;
		while ($loopRange - $loopStart < $properties['per_side'] * 2) { $loopRange++; }
		
		$loopRange = ($loopRange > $totalPages) ? $totalPages : $loopRange;
		while ($loopRange - $loopStart < $properties['per_side'] * 2) { $loopStart--; }
	}

	// start placing data to output
	$output = '';
	$output .= '
	<div class="text-center">
	<a class="btn btn-default btn-block toggle-pagination"><i class="glyphicon glyphicon-plus"></i> Toggle Pagination</a>
	<ul class="pagination pagination-responsive pagination-lg">
	 ';
	
	
	// first and previous page
	if ($currentPage != 1) {
		$output	.= '<li><a href=\''.$r_uri.''.$l.'1\'>&#171;</a></li>';
		$output .= '<li><a href=\''.$r_uri.''.$l.$previousPage.'\'>‹</a></li>';
	} else {
		$output .= '<li><span class=\'inactive\'>&#171;</span></li>';
		$output .= '<li><span class=\'inactive\'>‹</span></li>';
	}
	
	// add the pages
	for ($p = $loopStart; $p <= $loopRange; $p++) {
		if ($p != $currentPage) {
			$output .= '<li><a href=\''.$r_uri.''.$l.$p.'\'>'.$p.'</a></li>';
		} else {
			$output .= '<li class=\'active\'><span class=\'current\'><a href="#">'.$p.'</a></span></li>';
		}
	}

	// next and last page
	if ($currentPage != $totalPages) {
		$output .= '<li><a href=\''.$r_uri.''.$l.$nextPage.'\' class=\'active\'>›</a></li>';
		$output .= '<li><a href=\''.$r_uri.''.$l.$totalPages.'\' class=\'active\'>&#187;</a></li>';
	} else {
		$output .= '<li><span class=\'inactive\'>›</span></li>';
		$output .= '<li><span class=\'inactive\'>&#187;</span></li>';
	}
	
	$output .= '</ul>
   </div>';
	// end of output
	
	return [
		'limit' => [
			'first' 	=> $previousPage * $properties['per_page'],
			'second' 	=> $properties['per_page']
		],
		
		'output' => $output
	];
}

function is_ajax() {
  return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}