<?php
namespace App\Models;

use \PDO; 

class CustomPage_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
   
  //Get Title for Custom Page
  public function Get_Title() {
  
    $url =  $_SERVER['REQUEST_URI'];
    $pieces = explode("pages/", $url);  
    $page_name = htmlspecialchars($pieces[1]);
    if (strpos($page_name, '?') !== false) {
      $page_name = get_string_between($url, 'pages/','?');
    }
 
    $page_name_get = $this->db->prepare("SELECT page_title FROM ".$this->argos_db_prefix."pages WHERE page_name=?");
    $page_name_get->bindParam(1, $page_name, PDO::PARAM_STR); 
    $page_name_get->execute(); 
    
    $row = $page_name_get->fetch(PDO::FETCH_ASSOC);
    return $row['page_title'];

  }
  
  public function check_if_page_is_by_ext($page_name) {
     $go = $this->db->prepare("SELECT id FROM ".$this->argos_db_prefix."pages WHERE page_name=? AND type='ext' LIMIT 1");
     $go->bindParam(1, $page_name, PDO::PARAM_STR); 
     $go->execute();
     return $go->rowCount();
  }
  
};