<?php
namespace App\Models\Ajax;

use \PDO; 

class Vote_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  
  public function check_if_user_voted($id,$type_for,$ip) {
    $type_for = sql_escape($type_for); //type news/comments/greyfish
    $ip_sql=$this->db->prepare("select ip_add from ".$this->argos_db_prefix."voting_ip_".$type_for." where mes_id_fk=? and ip_add='$ip'");
    $ip_sql->bindParam(1, $id, PDO::PARAM_INT);      
    $ip_sql->execute(); 
    return $ip_sql->rowCount();
  } 
  
  public function up($id,$type_for) {
    $type_for = sql_escape($type_for); //type news/comments/greyfish
    $sql = $this->db->prepare("update  ".$this->argos_db_prefix."".$type_for." set vote=vote+1 where id=?");
    $sql->bindParam(1, $id, PDO::PARAM_INT);      
    $sql->execute(); 
  }
  
  public function down($id,$type_for) {
    $type_for = sql_escape($type_for); //type news/comments/greyfish
    $sql = $this->db->prepare("update  ".$this->argos_db_prefix."".$type_for." set vote=vote-1 where id=?");
    $sql->bindParam(1, $id, PDO::PARAM_INT);      
    $sql->execute();   
  }
  
  public function insert_user_vote($type_for,$id,$ip) {
    $type_for = sql_escape($type_for); //type news/comments/greyfish
    $sql = $this->db->prepare("insert into ".$this->argos_db_prefix."voting_ip_".$type_for." (mes_id_fk,ip_add) values (?,'$ip')");
    $sql->bindParam(1, $id, PDO::PARAM_INT);      
    $sql->execute(); 
  }
  
  public function get_votes($id,$type_for) {
    $type_for = sql_escape($type_for); //type news/comments/greyfish
    $result=$this->db->prepare("select vote from ".$this->argos_db_prefix."".$type_for." where id=?");
    $result->bindParam(1, $id, PDO::PARAM_INT);      
    $result->execute();
    return $result->fetch(PDO::FETCH_ASSOC);
  }
  
};