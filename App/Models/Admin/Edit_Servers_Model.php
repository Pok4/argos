<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Servers_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Servers() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."greyfish_servers`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_servers_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."greyfish_servers order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_servers_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."greyfish_servers")->rowCount();
  }
  
  public function fetch_server_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."greyfish_servers WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_servers($id,$hostname,$ip,$port,$map,$type,$vote) {
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."greyfish_servers SET hostname=?,ip=?,port='$port',map=?,type=?,vote='$vote' WHERE id='$id'");
    $go->bindParam(1, $hostname, PDO::PARAM_STR);
    $go->bindParam(2, $ip, PDO::PARAM_STR);
    $go->bindParam(3, $map, PDO::PARAM_STR);
    $go->bindParam(4, $type, PDO::PARAM_STR);
    $go->execute();     
  }
  
};