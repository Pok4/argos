<?php
if(isset($_COOKIE['argos_lang'])) {
  require "lang/".$_COOKIE['argos_lang']."/".$_COOKIE['argos_lang'].".php"; 
} else {
  require "lang/en/en.php"; 
}
?>
<!DOCTYPE html>
<!-- created by dedihost.org -->
<html lang="en">
<head>
<meta charset="utf-8">    
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
  <title>Argos <?php echo $lang_sys['lang_installator']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>

<body style="background:#34495E">
  
<br/>
<div class="container" style="background:#dedede;max-width:500px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px">
<br/>
<div style="text-align:center">
  <a href="#" class="change_lang" data-language="bg"><img height="16" width="20" src='../assets/img/flags/bg.gif' alt="Bulgarian"/></a> &nbsp;
  <a href="#" class="change_lang" data-language="en"><img height="16" width="20" src='../assets/img/flags/en.gif' alt="English"/></a> &nbsp;
  <a href="#" class="change_lang" data-language="ru"><img height="16" width="20" src='../assets/img/flags/ru.gif' alt="English"/></a>
</div>
<br/>
<div class="alert alert-info" style="max-width:500px"><i class="fa fa-info"></i> <?php echo $lang_sys['lang_welcome']; ?> Argos <?php echo $lang_sys['lang_installator']; ?></div>
<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> <?php echo $lang_sys['lang_please_create_db']; ?></div>

<form method="post" style="max-width:500px">
  <input type="text" name="host" placeholder="host <?php echo $lang_sys['lang_example_host']; ?>" class="form-control" /><br/>
  <input type="text" name="user" placeholder="root user" class="form-control" /><br/>
  <input type="password" name="pass" placeholder="root pass" class="form-control" /><br/>
  <input type="text" name="db" placeholder="database" class="form-control" /><br/>
  <br/>
  <input type="text" name="forum_path" placeholder="<?php echo $lang_sys['lang_phpbb_folder_example']; ?>" class="form-control" /><br/>
  DB Table's prefix:<br/>
  <input type="text" name="table_prefix" placeholder="<?php echo $lang_sys['lang_table_prefix']; ?>" value="argos_" class="form-control" /><br/>
  <hr/>
  Greyfish data:<br/>
  <input type="text" name="greyfish_upd" placeholder="<?php echo $lang_sys['lang_greyfish_updater']; ?>" class="form-control" /><br/>
  <hr/>
  <input type="submit" name="submit" class="btn btn-md btn-success" value="<?php echo $lang_sys['lang_install']; ?> Argos"/>
</form>
<br/>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $lang_sys['lang_please_after']; ?></div>

<?php
error_reporting(0);
if(isset($_POST['submit'])) {
	$host = $_POST['host'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$db = $_POST['db'];
	$phpbb_ver = $_POST['phpbb_vers'];
	$forum_path = $_POST['forum_path'];
  $table_prefix = $_POST['table_prefix'];
	$greyfish_upd = (int)$_POST['greyfish_upd'] == '' ? 300 : $_POST['greyfish_upd'];
	//////////////////////////
	
  if(!empty($host) && !empty($user) && !empty($pass) && !empty($db) &&  !empty($forum_path) && !empty($greyfish_upd)){

  try {
    $dbh = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pass);
  } catch(PDOException $e) {
     echo "<br/><div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i> ".$lang_sys['lang_db_conn_failed']."</div>";
     die();
  }
  require_once 'sql.php'; //our sql
  $dbh->query($sql);


  $filename = "../config.env";

/////////
//GENERATE config.env
/////////
$output = '//DB connect
DB_HOST = "'.$host.'";
DB_USER = "'.$user.'";
DB_PASS = "'.$pass.'";
DB_NAME = "'.$db.'";

//DB Table\'s prefix
DB_PREFIX = "'.$table_prefix.'";

//PHPBB Folder
FORUM_PATH = "'.$forum_path.'";

//Fast Cache type
CACHE_TYPE = "files";

//Greyfish
GREFISH_UPDATE = "'.$greyfish_upd.'"; //default: 300, on 300 seconds greyfish will update collected data to db.';
/////////
///END///
/////////

  $filehandle = fopen($filename, 'w');
  fwrite($filehandle, $output);
  fclose($filehandle);

  echo "<br/><div class='alert alert-success'><i class='fa fa-check'></i> ".$lang_sys['lang_success']."</div>";
 
} else {
  echo "<br/><div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i> ".$lang_sys['lang_missing_input']."</div>";
}
}
?>
<hr/>
Made by val4o0o0 @ <a href="http://dedihost.org">dedihost.org</a><br/><br/>
</div>

<script>
$( document ).ready(function() {
$('.change_lang').click(function(){
var choosed_lang = $(this).attr("data-language");
document.cookie ='argos_lang='+choosed_lang+';expires=Wed, 31 Oct 3099 08:50:17 GMT;path=/'
location.reload();
return false;
})
});
</script>
</body>
</html>