<?php
namespace App\Models;

use \PDO; 

class Files_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }

  public function check_for_cats($type,$game) {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."files WHERE type_not_real='$type' AND game_not_real='$game' GROUP by category");
  }
  
  public function get_files($file_type,$file_game,$file_cat) {
      
      $results = $this->db->prepare("SELECT COUNT(id) FROM ".$this->argos_db_prefix."files WHERE type_not_real='$file_type' AND game_not_real='$file_game' AND category=?");
      $results->bindParam(1, $file_cat, PDO::PARAM_STR); 
      $results->execute();
      
    $pagination = pagination($results->fetchColumn(), [
        'get_vars'  => [
            'view'  => @$_GET['view'],
            'cat' => $file_cat,
            'type'=> $file_type,
            'game'=> $file_game,
        ], 
        'per_page'  => get_from_db_config('files_per_page'),
        'per_side'  => 3,
        'get_name'  => 'page'
      
      ]);
      
      $this->container['pagination_files'] = $pagination;
      
      $get = $this->db->prepare("SELECT * FROM ".$this->argos_db_prefix."files WHERE type_not_real='$file_type' AND game_not_real='$file_game' AND category=? order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
      $get->bindParam(1, $file_cat, PDO::PARAM_STR); 
      $get->execute();
       
      return $get;
      
  }
  
  public function check_for_files($file_type,$file_game,$file_cat) {
    return $this->db->query("SELECT id FROM ".$this->argos_db_prefix."files WHERE type_not_real='$file_type' AND game_not_real='$file_game' AND category='$file_cat' order by id DESC");
  }
  
};