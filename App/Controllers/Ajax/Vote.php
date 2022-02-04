<?php
namespace App\Controllers\Ajax;

class Vote extends \App\Controllers\BaseController {
  
  public function __construct() {
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\Vote_Model; 
  }
    
  public function Vote() {
    if(is_ajax())
    { 

      $id = $_POST['id'];
      $ip = $_SERVER['REMOTE_ADDR'];
      
      $type_for = $_GET['for']; //type news/comments/greyfish
      $type_vote = sql_escape($_GET['vote']); //vote type (up or down)

      switch($type_vote) {
        case 'up': {
          $id = str_replace('sdown', '', $id);
          break;
        }
        case 'down': {
          $id = str_replace('sup', '', $id);
          break;
        }
      } 

      $count = $this->model->check_if_user_voted($id,$type_for,$ip);
       
      if($count==0)
      {
        switch($type_vote) {
        case 'up': {
          $this->model->up($id,$type_for);
          break;
        }
        case 'down': {
          $this->model->down($id,$type_for);
          break;
        }
        }


        $this->model->insert_user_vote($type_for,$id,$ip);
        echo "<script>alert('".$this->lang['lang_vote_success']."');</script>";

      }
      else
      {
        echo "<script>alert('".$this->lang['lang_already_voted']."');</script>";
      }

      $row = $this->model->get_votes($id,$type_for);
      echo $row['vote']; 

    }
  }

};