<?php
namespace App\Models;

use \PDO; 

class AboutUS_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Get AboutUS text 
  public function Fetch_AboutUS() {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."aboutus");
    $row = $get->fetch(PDO::FETCH_ASSOC);
    return htmlspecialchars_decode($row['aboutus']);
  }
  
};