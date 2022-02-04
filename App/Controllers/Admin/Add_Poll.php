<?php
namespace App\Controllers\Admin;

class Add_Poll extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Poll_Model; 
 
  }
    
  public function Add_Poll() {
    if(isset($_POST['submit_poll'])) {
      
      $poll_question = trim($_POST['poll_question']);
 
      if($this->model->check_if_poll_exists($poll_question) < 1) {
        $poll_answers = $_POST['poll_answers'];
        $poll_answers2= explode(PHP_EOL,$poll_answers);
        $poll_answers = ['answers'=>$poll_answers2];
        
        foreach($poll_answers['answers'] as $v) { 
          $format_poll .= "$v##0;"; 
        }
        $format_poll = rtrim($format_poll, ';');
        $format_poll = str_replace(array("\r", "\n"), '', $format_poll);

        $this->model->add_poll($poll_question,$format_poll);
        
        $this->mustache->assign('poll_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('poll_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_poll'].'</div>');
      }
      
    }    
  }
  
  
  
};