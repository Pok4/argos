<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Server_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function add_server($ip,$port,$players,$maxplayers,$version,$type,$map,$hostname,$vote,$status) {
     $this->db->query("INSERT INTO ".$this->argos_db_prefix."greyfish_servers (ip,port,players,maxplayers,version,type,map,hostname,vote,status) VALUES('$ip','$port','$players','$maxplayers','$version','$type','$map','$hostname','$vote','$status')");
  }
  
 
 
  
};