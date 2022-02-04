<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Polls extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Polls_Model; 
 
  }
    
  public function Edit_Polls() {
    $this->check_is_this_page();
      
    $mysql_check = $this->model->check_polls_exists();
    $mysql = $this->model->Get_Polls();
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $poll_id = $row['id'];
         $poll_question = $row['poll_question'];
         $poll_votes = $row['poll_votes'];
         $polls_info[]  = ['poll_id'=>$poll_id,'poll_question'=>$poll_question,'poll_votes'=>$poll_votes];
      }

      $this->mustache->assign('allpolls',new ArrayIterator( $polls_info)); 
      $this->mustache->assign('pagination_polls',$this->container['pagination_dpolls_acp']['output']);
    } else {
      $this->mustache->assign('no_have_polls',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_polls']."</div>");
    }
    
    $this->edit_polls_function();
  }
  
  public function edit_polls_function() {
  
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_polls_id',$id);
        
        
        $row= $this->model->fetch_poll_for_edit($id);
        $this->mustache->assign('acp_edit_polls_question',$row['poll_question']);
        $poll_answers = $row['poll_answer'];
         
        $pieces = explode(";", $poll_answers);
        $pollansw = ["votes"=>$pieces];

        foreach($pollansw['votes'] as $v ) {
        $counter++;
        $pollansw_redit= explode("##",$v);
        $poll_print2 .= $pollansw_redit[0].PHP_EOL;
        }
        $poll_print = rtrim($poll_print2, PHP_EOL);
        
        $this->mustache->assign('acp_edit_polls_poll_print',$poll_print);
        
        if(isset($_POST['acp_edit_polls_submit'])) {
        
          $poll_question = trim($_POST['poll_question']);
          $poll_answers = $_POST['poll_answer'];
          $poll_answers2= explode(PHP_EOL,$poll_answers);
          $poll_answers = ['answers'=>$poll_answers2];
          foreach($poll_answers['answers'] as $v) { 
            $format_poll .= "$v##0;"; 
          }
          $format_poll = rtrim($format_poll, ';');
          
          $this->model->edit_polls($id,$poll_question,$format_poll);
          $this->mustache->assign('acp_edit_polls_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }  
  
  }
  
  //check if user is on this page - edit_polls.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_polls.php') !== false) {
      $this->mustache->assign('is_poll_page',1);
    }
  }
  
  
};