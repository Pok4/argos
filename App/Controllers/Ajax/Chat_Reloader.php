<?php
namespace App\Controllers\Ajax;

use \PDO; 
use App\Entity\Emoji;

class Chat_Reloader extends \App\Controllers\BaseController {
  
  public function __construct() {
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\ChatReloader_Model; 
  }
    
  public function Chat_Reloader() {
    if(is_ajax())
    { 

      $limit_chat = 40; //we have 20 messages by default in chat * 2 = 40
  
      $chat_auto_delete_check = $this->model->get_from_config();
      $get_info = $chat_auto_delete_check->fetch(PDO::FETCH_ASSOC);
      if($get_info['chat_auto_delete'] == 1) {
      
        $limit_chat = $get_info['chat_auto_delete_after'] * 2; //new calculations for the limit, if this option is enabled.
        
        //if chat messages is more than X, we delete last.
        $get = $this->model->roller();
        $row = $get->fetch(PDO::FETCH_ASSOC);
        if($row['roller']>$get_info['chat_auto_delete_after']) {
          $deleter =($row['roller']-$get_info['chat_auto_delete_after']);
          $this->model->deleter($deleter);
        }
      }
  
  
      $catch = $this->model->get_chat($limit_chat);
      if($catch->rowCount() <1) {
        echo json_encode(['chat'=>$this->lang['lang_no_comments']]);
      } else {
      $data_chat = [];
      
      function makeClickableLinks($s) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
      }
      
      while($row = $catch->fetch(PDO::FETCH_ASSOC)) {
        $chat_id = $row['id'];
        $id = $row['user_id'];
        $color = $row['user_colour'];
        $userc=$row['name'];
        Emoji\Emojione::$imageType = 'png'; // or svg / png is default
        Emoji\Emojione::$imagePathPNG = 'https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.6/assets/png/'; // defaults to jsdelivr's free CDN
        $textc = Emoji\Emojione::toImage(makeClickableLinks($row['text']));
        $datec=$row['date'];
        $user_avatar = $row['avatar'];

        if($this->is_admin || check_custom_user_access()) {
          $admin_delete = "[<span class='remove_msg' data-my='$chat_id' title='".$this->lang['lang_acp_delete']."'><i style='color:red;cursor:pointer' class='fa fa-times'></i></span>]";
        }

        $data_chat[] = '<div class="post_chat" id="message-'.$chat_id.'">('.$datec.') <div class="chat_ava">'.$user_avatar.'</div> <a href="'.base_forum_url().'memberlist.php?mode=viewprofile&u='.$id.'" style="color:#'.$color.' !important" target="_blank">'.$userc.'</a> : <span style="color:orange">'.$textc.'</span> '.$admin_delete.'</div>';
      }

        echo json_encode(["chat"=>$data_chat,"chat_id"=>"$chat_id"]);
      }  

    }
  }

};