<?php
namespace App\Models;

use \PDO; 

class Videos_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  public function get_all_cats() {
    //catch all cats
    $getcats = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."videocat");
    $getallcats[]="";
    $allvcats ="";
    while($row = $getcats->fetch(PDO::FETCH_ASSOC)) {
      $allvcats.='<option value="'.$row['category'].'">'.$row['category'].'</option>'; 
    }
    $this->mustache->assign('allvcats',$allvcats);
  
  }
  
  public function get_videos() {
 
    $choosed_cat = sql_escape($_COOKIE["lifted_cat"]);
    if(isset($_COOKIE["lifted_cat"])) {
      $results    = $this->db->query("SELECT COUNT(`id`) FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1 AND cat='$choosed_cat'")->fetchColumn();
    } else {
      $results    = $this->db->query("SELECT COUNT(`id`) FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1")->fetchColumn();
    }
    
    $pagination = pagination($results, [
    'get_vars'  => [
        'cat'   => (int)@$_GET['cat'],
        'view'  => @$_GET['view'],
		'cat_choose' =>  sql_escape($_GET['cat_choose']),
    ], 
    'per_page'  => get_from_db_config('videos_per_page'),
    'per_side'  => 3,
    'get_name'  => 'page'
    ]);
      
    $this->container['pagination_videos'] = $pagination;
    
    
    if(isset($_COOKIE["lifted_cat"])) {
      return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1 AND cat='$choosed_cat' order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
    } else {
      return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1 order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
    }
  
  }
  
  public function check_if_videos_exists() {
  
    $choosed_cat = sql_escape($_COOKIE["lifted_cat"]);
    if(isset($_COOKIE["lifted_cat"])) {
      return $this->db->query("SELECT id FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1 AND cat='$choosed_cat'");
    } else {
      return $this->db->query("SELECT id FROM ".$this->argos_db_prefix."uploadvideos WHERE approved=1");
    }
  
  }
  
};