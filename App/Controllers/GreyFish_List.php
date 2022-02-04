<?php
namespace App\Controllers;

use \PDO;
use \ArrayIterator;

class GreyFish_List extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_upload_img']);
    
    //The Model for this Controller
    $this->model = new \App\Models\GreyFish_Model; 
  
  }
    
  public function GreyFish_List() {
  
    if($this->model->check_if_have_servers() > 0) {
      $this->mustache->assign('greyfish_servers',1);
      greyfish_cache();
    
      $getzone = $this->model->get_servers();
        while($row = $getzone->fetch(PDO::FETCH_ASSOC)) {
        
          $ip = $row['ip'];
          $port = $row['port'];
          $type = $row['type'];
          $map = $row['map'];
          $hostname = $row['hostname'];
          $hostname_min = truncate_chars($hostname,32,'...');
          $players = $row['players'];
          $maxplayers=  $row['maxplayers'];
          $status = $row['status'];
          $servid = $row['id'];
          
          if (file_exists('greyfish/maps/'.$type.'/'.$map.'.jpg') && $status == 1) {
            $mapimg = ''.url().'/greyfish/maps/'.$type.'/'.$map.'.jpg';
          } else if(!file_exists('greyfish/maps/'.$type.'/'.$map.'.jpg') && $status == 1) {
            $mapimg = ''.url().'/greyfish/maps/map_no_image.jpg';
          } else if($status == 0) {
            $mapimg = ''.url().'/greyfish/maps/map_no_response.jpg';
          }
            
          $vote = $row['vote'];
          if($type == "cs" || $type=="csgo" || $type=="css" || $type == "tf2") {
          $steam = "<a href='steam://connect/$ip:$port' title='steam'><img src='".url()."/greyfish/icons/steam/steam.gif' alt='steam'/></a>";
          } 
          
          $gametracker ="<a href='https://www.gametracker.com/server_info/$ip:$port/' target='_blank' title='gametracker'><img src='".url()."/greyfish/icons/gt/gt.gif' alt='gt'/></a>";
          
          switch($status) {
            case '1': {
              $statusimg ='<img src="'.url().'/greyfish/icons/status/online.png" title="This server is online" alt="online"/>';
              break;
            }
            case '0': {
              $statusimg ='<img src="'.url().'/greyfish/icons/status/offline.png" title="This server is offline" alt="offline"/>';
              break;
            }
          }

          $game = '<img src="'.url().'/greyfish/icons/'.$type.'/'.$type.'.png" alt="'.$type.'"/>';
          
          $greyfish_array[]  = ['greyfish_list_servid'=>$servid,'greyfish_list_ip'=>$ip,'greyfish_list_port'=>$port,'greyfish_list_type'=>$type,'greyfish_list_hostname'=>$hostname,'greyfish_list_hostname_min'=>$hostname_min,'greyfish_list_players'=>$players,'greyfish_list_maxplayers'=>$maxplayers,'greyfish_list_vote'=>$vote,'greyfish_list_game'=>$game,'greyfish_list_status'=>$statusimg,'greyfish_list_gametracker'=>$gametracker,'greyfish_list_steam'=>$steam,'greyfish_list_mapimg'=>$mapimg,'greyfish_list_map'=>$map];
          
        }
        $this->mustache->assign('greyfish_list',new ArrayIterator($greyfish_array)); 
    } else {
      $this->mustache->assign('greyfish_servers',0);
    }
    
    
    $this->show_progressbar();
  }
  
  public function show_progressbar() {
    $row = $this->model->sum_server_info();
    @$per_cent = floor(($row['numplayers']/$row['slots'])*100);

    if($per_cent < 0 || $per_cent > 35) {
      $bg = "#ac0";
    } 
    if($per_cent > 50) {
      $bg = "#fb5";
    } 
    if($per_cent > 80) {
      $bg = "#f67";
    }
    $this->mustache->assign('greyfish_list_total_players',$row['numplayers']);
    $this->mustache->assign('greyfish_list_total_servers',$row['numservers']);
    $this->mustache->assign('greyfish_list_total_maxplayers',$row['slots']);
    $this->mustache->assign('greyfish_list_percent',$per_cent);
    $this->mustache->assign('greyfish_list_progressbar_bg',$bg);
  } 

};