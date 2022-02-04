<?php
namespace App\Models\Admin;

use \PDO; 

class Index_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  
  public function daily_stats() {
    return $this->db->query("SELECT *,COUNT(id) as visitors, DATE_FORMAT( date, '%b-%d' ) as dat from ".$this->argos_db_prefix."stats GROUP by dat order by `date` DESC LIMIT 5"); 
  }
  
  public function get_last_members() {
    return $this->db->query("SELECT username,user_id,user_regdate,user_avatar,user_avatar_type FROM `".$this->forum_db."`.".$this->forum_db_prefix."_users WHERE  group_id!=6 AND group_id!=1 AND user_type!=1 Order by user_id DESC LIMIT 8");
  }

  
};