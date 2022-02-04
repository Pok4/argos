<?php
namespace App\Models;

use \PDO; 

class Gallery_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  public function Get_Gallery() {
    
      $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."gallery`")->fetchColumn();
      $pagination = pagination($results, [
          'get_vars'  => [
              'cat'   => (int)@$_GET['cat'],
              'view'  => @$_GET['view']
          ], 
          'per_page'  => get_from_db_config('pics_per_page'),
          'per_side'  => 3,
          'get_name'  => 'page'
      ]);
      
      $this->container['pagination_gallery'] = $pagination;
      return  $this->db->query("SELECT * FROM ".$this->argos_db_prefix."gallery order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_if_pics_exist() {
    return $this->db->query("SELECT id FROM ".$this->argos_db_prefix."gallery");
  }
  
};