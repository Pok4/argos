<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Index extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Index_Model; 
    
  }
    
  public function Index() {
    $this->check_is_this_page();
    
    //daily stats
    $mysql = $this->model->daily_stats();
    while($rows=$mysql->fetch(PDO::FETCH_ASSOC)){
      $stats_date = $rows['dat'];
      $stats_visitors = $rows['visitors'];
      $daily_stats[] = ['stats_date'=>$stats_date,'stats_visitors'=>$stats_visitors];
    }
    $this->mustache->assign('daily_stats',new ArrayIterator($daily_stats)); 
    
    
    //get last members
    $mysql = $this->model->get_last_members();
    while($row = $mysql->fetch(PDO::FETCH_ASSOC)) {
      $id = $row['user_id'];
      $regdate = date('d.m.y',$row['user_regdate']);	
      $new_username = $row['username'];
      $user_avatar_type = $row['user_avatar_type'];
      $user_avatar_real = $row['user_avatar'];

      switch($user_avatar_type) {
        case '': {
          $user_avatar = "../assets/img/no_avatar.png";
          break;
        }
        case 'avatar.driver.upload': {
          $user_avatar = base_forum_url()."download/file.php?avatar=".$user_avatar_real."";
          break;
        }
        case 'avatar.driver.remote': {
          $user_avatar = $user_avatar_real;
          break;
        }
        case 'avatar.driver.local': {
          $user_avatar = base_forum_url()."images/avatars/gallery/$user_avatar_real";
          break;
        }
        case 'avatar.driver.gravatar': {
          $user_avatar = get_gravatar($row['user_avatar']);
          break;
        }	
      }

      $newest_members[]  = ['new_userid'=>$id,'new_user_ava'=>$user_avatar,'new_username'=>$new_username,'new_user_regdate'=>$regdate];
      
    }
    $this->mustache->assign('newest_members',new ArrayIterator($newest_members)); 
  }
  
  //check if user is on admin/index.php page
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], 'acp.php') !== false) {
     $this->mustache->assign('is_index_page_acp',1);
    }
  }
  
  
};