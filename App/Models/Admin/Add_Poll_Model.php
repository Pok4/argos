<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Poll_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_poll_exists($poll_question) {
    $poll_check = $this->db->prepare("SELECT poll_question FROM ".$this->argos_db_prefix."dpolls WHERE poll_question=?");
    $poll_check->bindParam(1, $poll_question, PDO::PARAM_STR);
    $poll_check->execute(); 
    return $poll_check->rowCount();
  }
  
  public function add_poll($poll_question,$format_poll) {
  
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."dpolls (poll_question,poll_answer,poll_votes) VALUES(?,?,'0')");
    $go->bindParam(1, $poll_question, PDO::PARAM_STR);
    $go->bindParam(2, $format_poll, PDO::PARAM_STR);
    $go->execute(); 
  
  }
  
};