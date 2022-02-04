<?php
namespace App\Controllers;

class GreyFish_ShowPlayers extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_upload_img']);

  }
    
  public function GreyFish_ShowPlayers() {
  
    $ip = htmlspecialchars($_GET['ip']);
    $port = (int)$_GET['port'];
    $type = htmlspecialchars($_GET['game']);
    
    if($type == 'teamspeak3') {
      $this->gameq->addServer([
      'type' => "$type",
      'host' => "$ip:$port",
      'options' => [
      'query_port' => 10011,
      ],
      ]); 
      } else {
      $this->gameq->addServer([
      'type' => "$type",
      'host' => "$ip:$port",
      ]);   
    }
    $q_data = $this->gameq->process()["$ip:$port"];
    
    switch ($type) {
      
      case 'cs16': { 
        
        if( $q_data['hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['name'])."<br>";
              echo "<b>Score:</b> ".$player['score']."<br>";
              echo "<b>Time connected:</b> ". gmdate("H:i:s",(int)$player['time'])."</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'csgo': { 
        
        if( $q_data['hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['name'])."<br>";
              echo "<b>Score:</b> ".$player['score']."<br>";
              echo "<b>Time connected:</b> ". gmdate("H:i:s",(int)$player['time'])."</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'css': { 
        
        if( $q_data['hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['name'])."<br>";
              echo "<b>Score:</b> ".$player['score']."<br>";
              echo "<b>Time connected:</b> ". gmdate("H:i:s",(int)$player['time'])."</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'tf2': { 
        
        if( $q_data['hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['name'])."<br>";
              echo "<b>Score:</b> ".$player['score']."<br>";
              echo "<b>Time connected:</b> ". gmdate("H:i:s",(int)$player['time'])."</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'minecraft': {
        if( $q_data['hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['player'])."<br>";
              echo "</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'samp': {
        if( $q_data['servername'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['name'])."<br>";
              echo "<b>Score:</b> ".$player['score']."<br>";
              echo "<b>Ping:</b> ".$player['ping']."</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'teamspeak3': {
        if( $q_data['gq_hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['gq_name'])."<br>";
              echo "</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
      case 'ventrilo': {
        if( $q_data['gq_hostname'] != null) {
          if( !empty( $q_data['players'] ) ) {
            foreach($q_data['players'] as $player) {
              echo "<div style='outline:1px solid black;width:300px;'>";
              echo "<b>Name:</b> ".iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE',$player['gq_name'])."<br>";
              echo "</div><br/>";
            }
            } else {
            echo $this->lang['lang_greyfish_no_players'];
          }
          } else {
          echo $this->lang['lang_greyfish_server_offline'];  
        }
        break;
      }
      
    }    
  }
  


};