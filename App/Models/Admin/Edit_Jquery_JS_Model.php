<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Jquery_JS_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Jquery_JS() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."jquery_js`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_jquery_js_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."jquery_js order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_jquery_js_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."jquery_js")->rowCount();
  }
  
  public function fetch_file_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."jquery_js WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_files($id,$jquery_js_name,$jquery_js) {
    $jquery_js = stripcslashes($jquery_js);
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."jquery_js SET jquery_js_name=?, jquery_js=? WHERE id='$id'");
    $go->bindParam(1, $jquery_js_name, PDO::PARAM_STR);
    $go->bindParam(2, $jquery_js, PDO::PARAM_STR);
    $go->execute();
  }
  
};