<?php
//prevent direct access
if(count(get_included_files()) == 1) {
  header('Location: index.php');
  exit; 
}

//Admin panel routes
$collection->attachRoute(new PHPRouter\Route('/admin/acp.php', [
    '_controller' => 'App\Controllers\Admin\Index::Index',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'acp'],
]));
 
$collection->attachRoute(new PHPRouter\Route('/admin/configure.php', [
    '_controller' => 'App\Controllers\Admin\Configure::Configure',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_configure'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/html_editor.php', [
    '_controller' => 'App\Controllers\Admin\HTML_Editor::HTML_Editor',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_htmleditor'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_aboutus.php', [
    '_controller' => 'App\Controllers\Admin\Add_AboutUS::Add_AboutUS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_aboutus'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_banners.php', [
    '_controller' => 'App\Controllers\Admin\Add_Banners::Add_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_banners'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_custom_css.php', [
    '_controller' => 'App\Controllers\Admin\Add_Custom_CSS::Add_Custom_CSS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_custom_css'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_custom_lang.php', [
    '_controller' => 'App\Controllers\Admin\Add_Custom_Lang::Add_Custom_Lang',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_custom_lang'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_jquery_js.php', [
    '_controller' => 'App\Controllers\Admin\Add_Jquery_JS::Add_Jquery_JS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_jquery_js'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_slider.php', [
    '_controller' => 'App\Controllers\Admin\Add_Slider::Add_Slider',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_slider'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_video_cat.php', [
    '_controller' => 'App\Controllers\Admin\Add_VideoCat::Add_VideoCat',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_video_cat'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_server.php', [
    '_controller' => 'App\Controllers\Admin\Add_Server::Add_Server',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_server'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_pages.php', [
    '_controller' => 'App\Controllers\Admin\Add_Pages::Add_Pages',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_pages'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_poll.php', [
    '_controller' => 'App\Controllers\Admin\Add_Poll::Add_Poll',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_poll'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_menu.php', [
    '_controller' => 'App\Controllers\Admin\Add_Menu::Add_Menu',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_menu'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_own_banners.php', [
    '_controller' => 'App\Controllers\Admin\Add_Own_Banners::Add_Own_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_own_banners'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_news.php', [
    '_controller' => 'App\Controllers\Admin\Add_News::Add_News',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_news'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_edit_emoticons.php', [
    '_controller' => 'App\Controllers\Admin\Add_Edit_Emoticons::Add_Edit_Emoticons',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_edit_emoticons'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_edit_ext.php', [
    '_controller' => 'App\Controllers\Admin\Add_Edit_Ext::Add_Edit_Ext',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_edit_ext'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/custom_pages_ext.php', [
    '_controller' => 'App\Controllers\Admin\Custom_Pages_Ext::Custom_Pages_Ext',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_custom_pages_ext'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_edit_user_access.php', [
    '_controller' => 'App\Controllers\Admin\Add_Edit_User_Access::Add_Edit_User_Access',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_edit_user_access'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/add_file.php', [
    '_controller' => 'App\Controllers\Admin\Add_File::Add_File',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_add_file'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/view_emails.php', [
    '_controller' => 'App\Controllers\Admin\View_Emails::View_Emails',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_view_emails'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_videos.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Videos::Edit_Videos',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_videos'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_video_cat.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Video_Cat::Edit_Video_Cat',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_video_cat'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_pages.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Pages::Edit_Pages',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_pages'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_polls.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Polls::Edit_Polls',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_polls'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_banners.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Banners::Edit_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_banners'],
]));


$collection->attachRoute(new PHPRouter\Route('/admin/edit_comments.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Comments::Edit_Comments',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_comments'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_files.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Files::Edit_Files',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_files'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_gallery.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Gallery::Edit_Gallery',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_gallery'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_jquery_js.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Jquery_JS::Edit_Jquery_JS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_jquery_js'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_menus.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Menus::Edit_Menus',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_menus'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_news.php', [
    '_controller' => 'App\Controllers\Admin\Edit_News::Edit_News',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_news'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_own_banners.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Own_Banners::Edit_Own_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_own_banners'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_servers.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Servers::Edit_Servers',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_servers'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/edit_sliders.php', [
    '_controller' => 'App\Controllers\Admin\Edit_Sliders::Edit_Sliders',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'admin_edit_sliders'],
]));


//Ajax Routes
$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_mail/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Mail::Remove_Mail',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_video/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Video::Remove_Video',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_video_cats/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Video_Cat::Remove_Video_Cat',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_slider/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Slider::Remove_Slider',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_server/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Server::Remove_Server',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_poll/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Poll::Remove_Poll',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_page/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Page::Remove_Page',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_own_banners/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Own_Banners::Remove_Own_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_news/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_News::Remove_News',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_menu/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Menu::Remove_Menu',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_js/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_JS::Remove_JS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_pic/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Pic::Remove_Pic',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_file/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_File::Remove_File',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_comments/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Comments::Remove_Comments',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_banners/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Banners::Remove_Banners',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/remove_access/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Remove_Access::Remove_Access',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/video_approved/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Video_Approved::Video_Approved',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/extension_updater/', [
    '_controller' => 'App\Controllers\Admin\Ajax\Extension_Updater::Extension_Updater',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/edit_pages_ajax', [
    '_controller' => 'App\Controllers\Admin\Ajax\Edit_Pages_Ajax::Edit_Pages_Ajax',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/html_editor_save', [
    '_controller' => 'App\Controllers\Admin\Ajax\HTML_Editor::HTML_Editor',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/custom_css', [
    '_controller' => 'App\Controllers\Admin\Ajax\Get_Custom_CSS::Get_Custom_CSS',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/admin/ajax/custom_lang', [
    '_controller' => 'App\Controllers\Admin\Ajax\Get_Custom_Lang::Get_Custom_Lang',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));