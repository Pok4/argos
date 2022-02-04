<?php
namespace App\Controllers\Admin;

class Add_Server extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Server_Model; 
 
  }
    
  public function Add_Server() {

    if(isset($_POST['submit_server'])) {
  
      $type = $_POST['type'];
			$ip = trim($_POST['server_ip']);
			$port = trim($_POST['server_port']);
			if($port!= "PORT" || $ip != "IP") {
      
			if($type == 'minecraft') {
   
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $mc_data = $this->gameq->process()["$ip:$port"];
      
		   if($mc_data['hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$mc_data['hostname']);
		 
        $version = $mc_data['version'];
        $map = $mc_data['map'];
        $players = $mc_data['gq_numplayers'];
        $maxplayers = $mc_data['gq_maxplayers'];
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
      } else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>');  
		  }
    
			} else if($type == 'samp') {
			 
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $samp_data = $this->gameq->process()["$ip:$port"];
      
      if($samp_data['servername'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$samp_data['servername']);
        $map = $samp_data['gq_mapname'];
        $version = $samp_data['gametype'];
        $players = $samp_data['gq_numplayers'];
        $maxplayers = $samp_data['gq_maxplayers'];
			
       $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
      } else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
      }
				
			} else if($type == 'cs16') {
				
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $cs_data = $this->gameq->process()["$ip:$port"];
        
			if($cs_data['hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$cs_data['hostname']);
        $map = $cs_data['map'];
        $players = $cs_data['gq_numplayers'];
        $maxplayers = $cs_data['gq_maxplayers'];
        $version = 'CS 1.6';
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
			}
			
			} else if($type == 'csgo') {
				
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $cs_data = $this->gameq->process()["$ip:$port"];
        
			if($cs_data['hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$cs_data['hostname']);
        $map = $cs_data['map'];
        $players = $cs_data['gq_numplayers'];
        $maxplayers = $cs_data['gq_maxplayers'];
        $version = 'CS:GO';
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
			}
				
			} else if($type == 'teamspeak3') {
      
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
          'options' => [
            'query_port' => 10011,
          ],
        ]); 
        
        $ts_data = $this->gameq->process()["$ip:$port"];

        if($ts_data['gq_hostname'] != null) {

          $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $ts_data['gq_hostname']);
          $players = $ts_data['gq_numplayers']; 
          $maxplayers = $ts_data['gq_maxplayers']; 
          $map = "Teamspeak"; 
          $version = '3';
			
          $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
          $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
        } else {
          $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 	
        }
			
			} else if($type == 'css') {
				
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $cs_data = $this->gameq->process()["$ip:$port"];
        
			if($cs_data['hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$cs_data['hostname']);
        $map = $cs_data['map'];
        $players = $cs_data['gq_numplayers'];
        $maxplayers = $cs_data['gq_maxplayers'];
        $version = 'CS:Source';
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
			}
				
			} else if($type == 'tf2') {
				
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $tf_data = $this->gameq->process()["$ip:$port"];
        
			if($tf_data['hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$tf_data['hostname']);
        $map = $tf_data['map'];
        $players = $tf_data['gq_numplayers'];
        $maxplayers = $tf_data['gq_maxplayers'];
        $version = 'TF2';
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
			}
				
			} else if($type == 'ventrilo') {
				
        $this->gameq->addServer([
          'type' => "$type",
          'host' => "$ip:$port",
        ]); 
        $vent_data = $this->gameq->process()["$ip:$port"];
        
			if($vent_data['gq_hostname'] != null) {
        $hostname = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$vent_data['gq_hostname']);
        $map = 'ventrilo';
        $players = $vent_data['gq_numplayers'];
        $maxplayers = $vent_data['gq_maxplayers'];
        $version = 'Ventrilo';
        $this->model->add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,0,1);
        $this->mustache->assign('server_add','<div class="alert alert-success">'.$this->lang['lang_acp_success_server_add'].'</div>'); 
				
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_server_offline'].'</div>'); 
			}
				
			}
			
			} else {
        $this->mustache->assign('server_add','<div class="alert alert-danger">'.$this->lang['lang_acp_missing_ip_port'].'</div>'); 
			}
    }	  
      
  }
  
  
};