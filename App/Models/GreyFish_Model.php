<?php
namespace App\Models;

use \PDO; 

class GreyFish_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_have_servers() {
    $getzone =  $this->db->query("SELECT * FROM ".$this->argos_db_prefix."greyfish_servers ORDER by type DESC");
    return $getzone->rowCount();
  } 
  
  public function get_servers() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."greyfish_servers ORDER by type DESC");
  }
  
  public function sum_server_info() {
    $gettotal = $this->db->query("SELECT COUNT(*) as numservers, SUM(players) as numplayers, SUM(maxplayers) as slots FROM ".$this->argos_db_prefix."greyfish_servers");
    return $gettotal->fetch(PDO::FETCH_ASSOC);
  }
};