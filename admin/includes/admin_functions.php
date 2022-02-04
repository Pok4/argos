<?php
//giving access to users
function giving_access_to_user() {
  global $dbh, $user;
  $username = $user->data['username'];
  $get=$dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."custom_user_access WHERE username='$username'");
  if($get->rowCount() > 0) {
    $row = $get->fetch(PDO::FETCH_ASSOC);
    $page_name = explode('?', basename($_SERVER['REQUEST_URI']), 2);
    $get_pages = explode(',',$row['pages']);
  if (strpos(json_encode($get_pages),$page_name[0]) !== false) {
    return true;
  } else {
    return false;
  }
  } else {
    return false;
  }
}

function is_custom_access_to_page($page) {
  global $dbh, $user;
  if($bb_admin) {
    return true;
  } else {
    $username = $user->data['username'];
    $get=$dbh->query("SELECT pages FROM ".getenv('DB_PREFIX')."custom_user_access WHERE username='$username'");
    if($get->rowCount() > 0) {
      $row = $get->fetch(PDO::FETCH_ASSOC);
      $get_pages = explode(',',$row['pages']);
    if(in_array($page,$get_pages)) {
      return true;
    }
  } else {
    return false;
  }
  }
}

//count pm
function get_pm_acp() {
  global $dbh;
  $mysql = $dbh->query("SELECT COUNT(id) as count_pms FROM ".getenv('DB_PREFIX')."contacts WHERE respond=0 order by id DESC LIMIT 5");
  $row = $mysql->fetch(PDO::FETCH_ASSOC);
  return $row['count_pms'];
}
 
//count reports
function get_reports_acp() {
  global $dbh, $bb_db, $bb_prefix, $cacher;

  $total_reports = $cacher->get("total_reports_from_forum");
  if(is_null($total_reports)) {
    $mysql = $dbh->query("SELECT COUNT(report_id) as reports FROM `$bb_db`.".$bb_prefix."_reports WHERE report_closed=0");
    $row = $mysql->fetch(PDO::FETCH_ASSOC);
    $cacher->set("total_reports_from_forum",$row['reports'], 60);
  }
  return $total_reports;
}


//unassign some vars to prevent bugs (overwrite)
$mustache->unassign('forum_path');
$mustache->unassign('user_logout');

$mustache->assign([ 
    'forum_path' => '../'.removeLastSlash(getenv("FORUM_PATH")),
    'user_logout' => '../'.removeLastSlash(getenv("FORUM_PATH")).'/ucp.php?mode=logout&sid='.$bb_session_id.'',
    'total_new_pm'=>get_pm_acp(),
    'total_new_reports'=>get_reports_acp(),
    'reports_link'=>'../'.removeLastSlash(getenv("FORUM_PATH")).'/mcp.php?i=mcp_reports&amp;mode=reports',
    'current_time'=>date('d.m.y h:i:s A', time()),
]);
 

//pms
function get_emails_from_users() {
  global $dbh;
  $mysql = $dbh->query("SELECT * FROM ".getenv('DB_PREFIX')."contacts WHERE respond=0 order by id DESC LIMIT 5");
  if($mysql->rowCount() > 0) {
    while($row = $mysql->fetch(PDO::FETCH_ASSOC)){
      $contact_date = date("d.m.y h:i:s", $row['date']);
      $contact_quest = truncate_chars($row['question'],15,'...');
      $contact_text = truncate_chars($row['text'],15,'...');
      $contact_info[]  = ['contact_date'=>$contact_date,'contact_quest'=>$contact_quest,'contact_text'=>$contact_text];
    }
  return new ArrayIterator( $contact_info ); 
  }
}
$mustache->assign('contact_pms',get_emails_from_users());
 

//gravatar fetch
function get_gravatar( $email, $s = 150, $d = 'mm', $r = 'pg', $img = false, $atts = [] ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}