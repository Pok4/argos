<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Pages_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Pages() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."pages`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_pages_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."pages order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_pages_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."pages")->rowCount();
  }
  
  public function fetch_page_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."pages WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
};