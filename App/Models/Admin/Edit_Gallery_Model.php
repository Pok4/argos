<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Gallery_Model extends \App\Controllers\BaseController {
  
 
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
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_gallery_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."gallery order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_gallery_exists() {
  return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."gallery")->rowCount();
  }
  
};