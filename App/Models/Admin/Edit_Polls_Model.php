<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Polls_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Polls() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."dpolls`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_dpolls_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."dpolls order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_polls_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."dpolls")->rowCount();
  }
  
  public function fetch_poll_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."dpolls WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_polls($id,$poll_question,$format_poll) {
  
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."dpolls SET poll_question=?,poll_answer=?,poll_votes=0 WHERE id='$id'");
    $go->bindParam(1, $poll_question, PDO::PARAM_STR);
    $go->bindParam(2, $format_poll, PDO::PARAM_STR);
    $go->execute(); 
    
    //reset votes
    $this->db->query("DELETE FROM ".$this->argos_db_prefix."dpolls_votes WHERE poll_id='$id'");
  
  }
};