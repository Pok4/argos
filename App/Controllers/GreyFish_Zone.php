<?php
namespace App\Controllers;

use \PDO;
use \ArrayIterator;

class GreyFish_Zone extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_upload_img']);
    
    //The Model for this Controller
    $this->model = new \App\Models\GreyFish_Model; 
  
  }
    
  public function GreyFish_Zone() {
  
    if($this->model->check_if_have_servers() > 0) {
      $this->mustache->assign('greyfish_servers',1);
      greyfish_cache();
    
      $getzone = $this->model->get_servers();
        while($row = $getzone->fetch(PDO::FETCH_ASSOC)) {
        
          $type = $row['type'];
          $map = $row['map'];
          $map_min =  truncate_chars($row['map'],9,'...');
          $players = $row['players'];
          $maxplayers = $row['maxplayers'];
          $hostname = $row['hostname'];
          $hostname_min = truncate_chars($row['hostname'],25,'...');
          $ip = $row['ip'];
          $port = $row['port'];
          @$progressbar=floor(($players / $maxplayers) * 100); //progress bar
          
          $status = $row['status'];
          switch($status) {
            case 1: {
              $statuscolor = "green";
              break;
            }
            case 0: {
              $statuscolor = "red";
              break;
            }
          }
          
          if (file_exists('greyfish/maps/'.$type.'/'.$map.'.jpg') && $status == 1) {
            $mapimg = ''.url().'/greyfish/maps/'.$type.'/'.$map.'.jpg';
          } else if(!file_exists('greyfish/maps/'.$type.'/'.$map.'.jpg') && $status == 1) {
            $mapimg = ''.url().'/greyfish/maps/map_no_image.jpg';
          } else if($status == 0) {
            $mapimg = ''.url().'/greyfish/maps/map_no_response.jpg';
          }

       
          $mapimg = "<img style='width:100%;height:160px;' src='$mapimg' alt='$map'/>";
          
          $greyfish_array[]  = ['greyfish_zone_type'=>$type,'greyfish_zone_map'=>$map,'greyfish_zone_map_min'=>$map_min,'greyfish_zone_players'=>$players,'greyfish_zone_maxplayers'=>$maxplayers,'greyfish_zone_hostname'=>$hostname,'greyfish_zone_hostname_min'=>$hostname_min,'greyfish_zone_ip'=>$ip,'greyfish_zone_port'=>$port,'greyfish_zone_progressbar'=>$progressbar,'greyfish_zone_statuscolor'=>$statuscolor,'greyfish_zone_mapimg'=>$mapimg];
          
        }
        $this->mustache->assign('greyfish_zone',new ArrayIterator($greyfish_array)); 
    } else {
      $this->mustache->assign('greyfish_servers',0);
    }
 
  }

};