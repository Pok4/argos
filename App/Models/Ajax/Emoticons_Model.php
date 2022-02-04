<?php
namespace App\Models\Ajax;

use \PDO; 

class Emoticons_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Get Emoticons
  public function get_smilies() {
   return $this->db->query("select * from ".$this->argos_db_prefix."smilies");
  }
  
};