<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Servers extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Servers_Model; 
 
  }
    
  public function Edit_Servers() {
    $this->check_is_this_page();
    
    $mysql_check = $this->model->check_servers_exists();
    $mysql = $this->model->Get_Servers();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $server_id = $row['id'];
         $server_name = truncate_chars($row['hostname'],30,'...');
         $server_port = $row['port'];
         $server_ip = $row['ip'];
         $real_server_ip = $server_ip.':'.$server_port;
         $server_map = truncate_chars($row['map'],30,'...');
         $server_type = $row['type'];
         $servers_info[]  = ['server_id'=>$server_id,'server_name'=>$server_name,'server_ip'=>$real_server_ip,'server_map'=>$server_map,'server_type'=>$server_type];
         
      }

      $this->mustache->assign('allservers',new ArrayIterator( $servers_info)); 
      $this->mustache->assign('pagination_servers',$this->container['pagination_servers_acp']['output']);
    } else {
      $this->mustache->assign('no_have_servers',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_servers']."</div>");
    }   

    $this->edit_servers_function();
  }
  
  public function edit_servers_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_servers_id',$id);
        
        
        $row = $this->model->fetch_server_for_edit($id);
        $this->mustache->assign('acp_edit_servers_hostname',$row['hostname']);
        $this->mustache->assign('acp_edit_servers_ip',$row['ip']);
        $this->mustache->assign('acp_edit_servers_port',$row['port']);
        $this->mustache->assign('acp_edit_servers_map',$row['map']);
        $this->mustache->assign('acp_edit_servers_type',$row['type']);
        $this->mustache->assign('acp_edit_servers_vote',$row['vote']); 
        
        if(isset($_POST['acp_edit_servers_submit'])) {
          $hostname = trim($_POST['hostname']);
          $ip = trim($_POST['ip']);
          $port = (int)$_POST['port'];
          $map = trim($_POST['map']);
          $type = trim($_POST['game']);
          $vote = (int)$_POST['vote'];
          
          $this->model->edit_servers($id,$hostname,$ip,$port,$map,$type,$vote);
         
          $this->mustache->assign('acp_edit_servers_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  }
  
  //check if user is on this page - edit_servers.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_servers.php') !== false) {
      $this->mustache->assign('is_servers_page',1);
    }
  }
  
  
};