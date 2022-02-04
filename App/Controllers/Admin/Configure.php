<?php
namespace App\Controllers\Admin;

class Configure extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Configure_Model; 
    
  }
    
  public function Configure() {
  
    $this->check_is_this_page();
    
    $row = $this->model->get_info_from_config();
    
    $chat_enable = $row['chat_enable'];
    if($chat_enable == 0 || empty($chat_enable)){ 
      $chat_enable = "";
    } else {
      $chat_enable = "checked";
    }

    $gallery_enable = $row['gallery_enable'];
    if($gallery_enable == 0 || empty($gallery_enable)){ 
      $gallery_enable = "";
    } else {
      $gallery_enable = "checked";
    }

    $img_upload_enable = $row['img_upload_enable'];
    if($img_upload_enable == 0 || empty($img_upload_enable)){ 
      $img_upload_enable = "";
    } else {
      $img_upload_enable = "checked";
    }

    $file_upload_enable = $row['file_upload_enable'];
    if($file_upload_enable == 0 || empty($file_upload_enable)){ 
      $file_upload_enable = "";
    } else {
      $file_upload_enable = "checked";
    }

    $poll_enable = $row['poll_enable'];
    if($poll_enable == 0 || empty($poll_enable)){ 
      $poll_enable = "";
    } else {
      $poll_enable = "checked";
    }

    $stats_enable = $row['footer_stats_enable'];
    if($stats_enable == 0 || empty($stats_enable)){ 
      $stats_enable = "";
    } else {
      $stats_enable = "checked";
    }

    $socials_enable = $row['socials_enable'];
    if($socials_enable == 0 || empty($socials_enable)){ 
      $socials_enable = "";
    } else {
      $socials_enable = "checked";
    }

    $servers_enable = $row['servers_enable'];
    if($servers_enable == 0 || empty($servers_enable)){ 
      $servers_enable = "";
    } else {
      $servers_enable = "checked";
    }

    $cookie_policy_enable = $row['cookie_policy'];
    if($cookie_policy_enable == 0 || empty($cookie_policy_enable)){ 
      $cookie_policy_enable = "";
    } else {
      $cookie_policy_enable = "checked";
    }

    $video_enable = $row['video_enable'];
    if($video_enable == 0 || empty($video_enable)){ 
      $video_enable = "";
    } else {
      $video_enable = "checked";
    }

    $rating_enable = $row['rating_enable'];
    if($rating_enable == 0 || empty($rating_enable)){ 
      $rating_enable = "";
    } else {
      $rating_enable = "checked";
    }

    $hide_test_menus = $row['hide_test_menus'];
    if($hide_test_menus == 0 || empty($hide_test_menus)){ 
      $hide_test_menus = "";
    } else {
      $hide_test_menus = "checked";
    }
    
    $auto_chat_delete_enable = $row['chat_auto_delete'];
    if($auto_chat_delete_enable == 0 || empty($auto_chat_delete_enable)){ 
      $auto_chat_delete_enable = "";
    } else {
      $auto_chat_delete_enable = "checked";
    }

    $phpbb_news_enable = $row['phpbb_news'];
    if($phpbb_news_enable == 0 || empty($phpbb_news_enable)){ 
      $phpbb_news_enable = "";
    } else {
      $phpbb_news_enable = "checked";
    }

    $site_name = $row['site_name'];
    $logo_text_small = $row['logo_text_small'];
    $logo_text_big = $row['logo_text_big'];
    $favicon = $row['favicon'];
    $admin_email = $row['admin_email'];
    $fb_link = $row['fb_link'];
    $tw_link = $row['tw_link'];
    $goo_link = $row['goo_link'];
    $language = $row['default_language'];
    $head_box_text = $row['head_box_text'];
    $last_news_link = $row['last_news_link'];
    $last_news_name = $row['last_news_name'];
    $google_analytics = $row['google_analytics'];
    $google_site_verify = $row['google_site_verify'];
    $chat_auto_delete_after = $row['chat_auto_delete_after'];
    $phpbb_news_forum_id = $row['phpbb_news_forum_id'];;
    $current_style = $row['style'];
    $files_per_page = $row['files_per_page'];
    $news_per_page = $row['news_per_page'];
    $pics_per_page = $row['pics_per_page'];
    $videos_per_page = $row['videos_per_page'];
    $banlist_url = $row['banlist_url'];

    if($language == "bg") { $language_bg = "selected"; }
    if($language == "en") { $language_en = "selected"; }
    if($language == "ru") { $language_ru = "selected"; }

    //styles changer
    foreach(glob('template/*', GLOB_ONLYDIR) as $dir) {
        $style_name = str_replace('template/', '', $dir);
      if($current_style == $style_name) {
        $all_styles .= '<option value="'.$style_name.'" selected>'.$style_name.'</option>'; 
      } else {
        $all_styles .= '<option value="'.$style_name.'">'.$style_name.'</option>'; 
      }
    }
     
    $this->mustache->assign(['chat_enable_acp'=>$chat_enable,'gallery_enable_acp'=>$gallery_enable,'video_enable_acp'=>$video_enable,'img_upload_enable_acp'=>$img_upload_enable,'file_upload_enable_acp'=>$file_upload_enable,'poll_enable_acp'=>$poll_enable,'stats_enable_acp'=>$stats_enable,'socials_enable_acp'=>$socials_enable,'servers_enable_acp'=>$servers_enable,'rating_enable_acp'=>$rating_enable,'hide_test_menus_enable_acp'=>$hide_test_menus,'auto_chat_delete_enable_acp'=>$auto_chat_delete_enable,'phpbb_news_enable_acp'=>$phpbb_news_enable
    ,'site_name_acp'=>$site_name, 'logo_text_small_acp'=>$logo_text_small,'logo_text_big_acp'=>$logo_text_big
    ,'favicon_acp'=>$favicon, 'admin_email_acp'=>$admin_email,'fb_link_acp'=>$fb_link,'tw_link_acp'=>$tw_link,'goo_link_acp'=>$goo_link,'cookie_policy_enable_acp'=>$cookie_policy_enable,'default_lang_bg'=>$language_bg,'default_lang_en'=>$language_en,'default_lang_ru'=>$language_ru,
    'head_box_text_acp'=>$head_box_text,'last_news_name_acp'=>$last_news_name,'last_news_link_acp'=>$last_news_link, 'google_analytics_acp'=>$google_analytics, 'google_site_verify_acp'=>$google_site_verify,'styles_name'=>$all_styles,'chat_auto_delete_after'=>$chat_auto_delete_after,'phpbb_news_forum_id'=>$phpbb_news_forum_id,
    'files_per_page'=>$files_per_page,'videos_per_page'=>$videos_per_page,'news_per_page'=>$news_per_page,'pics_per_page'=>$pics_per_page,'banlist_url_acp'=>$banlist_url]);
  
    $this->submit_changes(); //submit admin changes
    $this->delete_cache(); //delete site cache
    $this->delete_chat(); //delete all chat msgs
  }
  
  public function submit_changes() {
  
    if(isset($_POST['submit_changes'])) {
	
      switch($_POST['chat_enable']) {
        case '':{
          $this->model->update_config_db('chat_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('chat_enable',1);
          break;
        }
      }
        
      switch($_POST['gallery_enable']) {
        case '':{
          $this->model->update_config_db('gallery_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('gallery_enable',1);
          break;
        }
      }

      switch($_POST['img_upload_enable']) {
        case '':{
          $this->model->update_config_db('img_upload_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('img_upload_enable',1);
          break;
        }
      }

      switch($_POST['upload_enable']) {
        case '':{
          $this->model->update_config_db('file_upload_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('file_upload_enable',1);
          break;
        }
      }	

      switch($_POST['poll_enable']) {
        case '':{
          $this->model->update_config_db('poll_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('poll_enable',1);
          break;
        }
      }	

      switch($_POST['stats_enable']) {
        case '':{
          $this->model->update_config_db('footer_stats_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('footer_stats_enable',1);
          break;
        }
      }	

      switch($_POST['socials_enable']) {
        case '':{
          $this->model->update_config_db('socials_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('socials_enable',1);
          break;
        }
      }	

      switch($_POST['servers_enable']) {
        case '':{
          $this->model->update_config_db('servers_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('servers_enable',1);
          break;
        }
      }	

      switch($_POST['cookie_policy_enable']) {
        case '':{
          $this->model->update_config_db('cookie_policy',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('cookie_policy',1);
          break;
        }
      }	

      switch($_POST['video_enable']) {
        case '':{
          $this->model->update_config_db('video_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('video_enable',1);
          break;
        }
      }	

      switch($_POST['rating_enable']) {
        case '':{
          $this->model->update_config_db('rating_enable',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('rating_enable',1);
          break;
        }
      }	
      
      switch($_POST['hide_test_menus']) {
        case '':{
          $this->model->update_config_db('hide_test_menus',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('hide_test_menus',1);
          break;
        }
      }	

      switch($_POST['auto_chat_delete_enable']) {
        case '':{
          $this->model->update_config_db('chat_auto_delete',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('chat_auto_delete',1);
          break;
        }
      }

      switch($_POST['phpbb_news_enable']) {
        case '':{
          $this->model->update_config_db('phpbb_news',0);
          break;
        }
        case 'on':{ 
          $this->model->update_config_db('phpbb_news',1);
          $this->model->update_config_db('rating_enable',0); //disable rating system, if phpbb news enable.
          break;
          }
      }	

      $site_name = $_POST['site_name'];
      $this->model->update_config_db('site_name',$site_name);

      $small_text_header = $_POST['small_text_header'];
      $this->model->update_config_db('logo_text_small',$small_text_header);

      $big_text_header = $_POST['big_text_header'];
      $this->model->update_config_db('logo_text_big',$big_text_header);

      $favicon = $_POST['favicon'];
      $this->model->update_config_db('favicon',$favicon);

      $admin_email = $_POST['admin_mail'];
      $this->model->update_config_db('admin_email',$admin_email);

      $fb_link = $_POST['fb_link'];
      $this->model->update_config_db('fb_link',$fb_link);

      $tw_link = $_POST['tw_link'];
      $this->model->update_config_db('tw_link',$fb_link);

      $goo_link = $_POST['goo_link'];
      $this->model->update_config_db('goo_link',$goo_link);

      $default_lang = $_POST['language_now'];
      $this->model->update_config_db('default_language',$default_lang);

      $last_news_link = $_POST['last_news_link'];
      $this->model->update_config_db('last_news_link',$last_news_link);

      $last_news_name = $_POST['last_news_name'];
      $this->model->update_config_db('last_news_name',$last_news_name);

      $head_box_text = $_POST['head_box_text'];
      $this->model->update_config_db('head_box_text',$head_box_text);

      $google_analytics = $_POST['google_analytics'];
      $this->model->update_config_db('google_analytics',$google_analytics);

      $google_site_verify = $_POST['google_site_verify'];
      $this->model->update_config_db('google_site_verify',$google_site_verify);

      $default_style = $_POST['style_now'];
      $this->model->update_config_db('style',$default_style);

      $auto_chat_delete_after = $_POST['chat_auto_delete_after'] ? $_POST['chat_auto_delete_after'] : 20;
      $this->model->update_config_db('chat_auto_delete_after',$auto_chat_delete_after);

      $phpbb_news_forum_id = $_POST['phpbb_news_forum_id'] ? $_POST['phpbb_news_forum_id'] : 0;
      $this->model->update_config_db('phpbb_news_forum_id',$phpbb_news_forum_id);

      $pics_per_page = $_POST['pictures_per_page'];
      $this->model->update_config_db('pics_per_page',$pics_per_page);

      $news_per_page = $_POST['news_per_page'];
      $this->model->update_config_db('news_per_page',$news_per_page);

      $files_per_page = $_POST['files_per_page'];
      $this->model->update_config_db('files_per_page',$files_per_page);

      $videos_per_page = $_POST['videos_per_page'];
      $this->model->update_config_db('videos_per_page',$videos_per_page);

      $banlist_url = $_POST['banlist_url'];
      $this->model->update_config_db('banlist_url',$banlist_url);
      
      $this->mustache->assign('site_changes',$this->lang['lang_success']);
  
    }
  }
  
  public function delete_cache() {
    if(isset($_POST['submit_cache'])) {
      //delete mustache cache
      unlink_recursive('cache','php');
    
      //delete cache from simple cache
      rmdir_recursive('cache/localhost/');
    
      $this->mustache->assign('cache_delete',$this->lang['lang_success']);
    }
  }
  
  public function delete_chat() {
    if(isset($_POST['submit_chat_del'])) {
    	$this->db->query("TRUNCATE TABLE ".$this->argos_db_prefix."chat");
      $this->mustache->assign('chat_delete',$this->lang['lang_success']);
    }
  }
 
  
  //check if user is on admin/configure.php page
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], 'admin/configure.php') !== false) {
     $this->mustache->assign('is_configure_page',1);
    }
  }
  
  
};