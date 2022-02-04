<?php
session_start();
//Base
//Composer Autoload
require_once __DIR__.'/vendor/autoload.php';

//ENV
$dotenv = new Dotenv\Dotenv(__DIR__, 'config.env');
$dotenv->load();

//DB Connect
try {
  $dbh = new PDO("mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME').";charset=utf8", getenv('DB_USER'), getenv('DB_PASS'));
} catch(PDOException $e) {
  if(file_exists('install') && strpos($_SERVER['REQUEST_URI'], 'install') === false) {
    header('location: install/');
    exit;
  } else if(strpos($_SERVER['REQUEST_URI'], 'install') === false) {
    echo "DB connection failed. You can visit the installator - <a href='install'>Install Panel</a> and try again.";
    exit;
  }
}

//Container for our basics
use Pimple\Container;
$container = new Container();

//phpBB integration
require_once __DIR__.'/includes/phpbb_bridge.php';

//Our Autoloader class
$loader = new \Aura\Autoload\Loader;
$loader->register();

//Our autoloaders
$loader->addPrefix('App\Models', 'App/Models');
$loader->addPrefix('App\Controllers', 'App/Controllers');
$loader->addPrefix('Ext\\', 'ext/');
$loader->addPrefix('App\Entity', 'App/Entity');

//PHP Fast Cache
$cache_config = [
  "path"      =>  __DIR__."/cache",
  "storage" => getenv('CACHE_TYPE'),
];

use phpFastCache\CacheManager;
CacheManager::setup($cache_config);
$cacher = phpFastCache();

//Event Dispatcher
use walmsles\EventDispatch\Dispatcher;
$dispatcher = new Dispatcher();
 
//GameQ (UDP Gaming Queries)
$GameQ = new \GameQ\GameQ();

//The Routes
use PHPRouter\RouteCollection;
use PHPRouter\Config;
use PHPRouter\Router;
use PHPRouter\Route;
$collection = new RouteCollection();

//Get style (we pass this in mustache loader below)
function get_style() {
    global $dbh;
  
    if(isset($_COOKIE['argos_style'])) {
      if(file_exists(__DIR__.'/template/'.$_COOKIE['argos_style'])) {
        return $_COOKIE['argos_style'];
      } else {
        return 'default';
      }
    } else {
      $get_style = $dbh->query("SELECT style FROM ".getenv('DB_PREFIX')."config");
      $row_style = $get_style->fetch(PDO::FETCH_ASSOC);
      return $row_style['style'];
    }
}

//Mustache Template Engine
Mustache_Autoloader::register();

$admin_url = (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false); //if /admin/ string is in url we change mustache loader

$mustache = new Mustache_Engine([
  'template_class_prefix' => $admin_url ? '__argos_acp_' : '__argos_', //prefix for cache files
  'cache' => dirname(__FILE__).'/cache', //cache folder
	'loader' => $admin_url ? new Mustache_Loader_FilesystemLoader('admin/template',['extension' => '.html']) : new Mustache_Loader_FilesystemLoader(__DIR__."/template/".get_style()."", ['extension' => '.html']),
]);

//Our global functions
require_once __DIR__.'/includes/functions.php';

//All Events
require_once(__DIR__."/includes/events.php");

//////////////////ROUTES/////////////////////
$collection->attachRoute(new PHPRouter\Route('/', [
    '_controller' => 'App\Controllers\News::News',
    'methods' => ['GET','POST'],
    'parameters'=> ['template_file'=>'index'],
]));

$collection->attachRoute(new PHPRouter\Route('/:id', [
    '_controller' => 'App\Controllers\News::News',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'index'],
]));

$collection->attachRoute(new PHPRouter\Route('/core.php', [
    '_controller' => 'App\Controllers\News::News',
    'methods' => ['GET','POST'],
    'parameters'=> ['template_file'=>'index'],
]));

$collection->attachRoute(new PHPRouter\Route('/banners.php', [
    '_controller' => 'App\Controllers\Banners::Banners',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'banners'],
]));

$collection->attachRoute(new PHPRouter\Route('/contact.php', [
    '_controller' => 'App\Controllers\Contact::Contact',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'contact'],
]));

$collection->attachRoute(new PHPRouter\Route('/captcha.php', [
    '_controller' => 'App\Controllers\Captcha::Captcha',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/aboutus.php', [
    '_controller' => 'App\Controllers\AboutUS::AboutUS',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'aboutus'],
]));

$collection->attachRoute(new PHPRouter\Route('/servers.php', [
    '_controller' => 'App\Controllers\Servers::Servers',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'servers'],
]));

$collection->attachRoute(new PHPRouter\Route('/upload_img.php', [
    '_controller' => 'App\Controllers\UploadIMG::UploadIMG',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'upload_img'],
]));

$collection->attachRoute(new PHPRouter\Route('/gallery.php', [
    '_controller' => 'App\Controllers\Gallery::Gallery',
    'methods' => 'GET',
    'parameters'=> ['template_file'=>'gallery'],
]));

$collection->attachRoute(new PHPRouter\Route('/upload_video.php', [
    '_controller' => 'App\Controllers\UploadVideo::UploadVideo',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'upload_video'],
]));

$collection->attachRoute(new PHPRouter\Route('/videos.php', [
    '_controller' => 'App\Controllers\Videos::Videos',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'videos'],
]));

$collection->attachRoute(new PHPRouter\Route('/files.php', [
    '_controller' => 'App\Controllers\Files::Files',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'files'],
]));

$collection->attachRoute(new PHPRouter\Route('/greyfish/list.php', [
    '_controller' => 'App\Controllers\GreyFish_List::GreyFish_List',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'greyfish_list'],
]));

$collection->attachRoute(new PHPRouter\Route('/greyfish/zone.php', [
    '_controller' => 'App\Controllers\GreyFish_Zone::GreyFish_Zone',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'greyfish_zone'],
]));

$collection->attachRoute(new PHPRouter\Route('/greyfish/showplayers.php', [
    '_controller' => 'App\Controllers\GreyFish_ShowPlayers::GreyFish_ShowPlayers',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

//Custom Pages Route
$url =  $_SERVER['REQUEST_URI'];
$pieces = explode("pages/", $url);  
$page_name = htmlspecialchars($pieces[1]);
if (strpos($page_name, '?') !== false) {
  $page_name = get_string_between($url, 'pages/','?');
}

$page_name_get = $dbh->prepare("SELECT menu_type FROM ".getenv('DB_PREFIX')."pages WHERE page_name=?");
$page_name_get->bindParam(1, $page_name, PDO::PARAM_STR); 
$page_name_get->execute(); 
if($page_name_get->rowCount() > 0) {
$row = $page_name_get->fetch(PDO::FETCH_ASSOC);
$menu_type = $row['menu_type'];
switch($menu_type) {
  case 'wmenu': {
    $template_file = 'custom_page_w_menu';
    break;
  }
  case 'menu': {
    $template_file = 'custom_page_menu';
    break;
  } 
}
$collection->attachRoute(new PHPRouter\Route('/pages/'.$page_name.'', [
    '_controller' => 'App\Controllers\CustomPage::CustomPage',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>$template_file],
]));

}

//Ajax Routes
$collection->attachRoute(new PHPRouter\Route('/ajax/ajax_chat_data_reloader', [
    '_controller' => 'App\Controllers\Ajax\Chat_Reloader::Chat_Reloader',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/ajax/chat_remove_message/', [
    '_controller' => 'App\Controllers\Ajax\Chat_Remove_Message::Chat_Remove_Message',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/ajax/chat_submit_post', [
    '_controller' => 'App\Controllers\Ajax\Chat_Submit::Chat_Submit',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/ajax/dropzone', [
    '_controller' => 'App\Controllers\Ajax\Dropzone::Dropzone',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/ajax/file_download_counter', [
    '_controller' => 'App\Controllers\Ajax\DownloadCounter::DownloadCounter',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

$collection->attachRoute(new PHPRouter\Route('/ajax/vote_up_down/', [
    '_controller' => 'App\Controllers\Ajax\Vote::Vote',
    'methods' => ['POST','GET'],
    'parameters'=> ['template_file'=>'ajax'],
]));

//if admin is touching admin/, we redirect. ($admin_url is in common.php)
if ($admin_url) {
  require_once(__DIR__.'/admin/routes.php');
  require_once(__DIR__.'/admin/includes/admin_functions.php');
}

$router = new PHPRouter\Router($collection);
$route = $router->matchCurrentRequest();

//if we no found page -> print 404
if(!$route) {
  header('Location: '.url().'/404/');
  exit;
} 

$tpl = $mustache->loadTemplate($route->getParameters()['template_file']);
echo $tpl->render($lang_sys + $event_dispatcher);