<?php
namespace App\Models\Admin;

use \PDO; 

class Add_Jquery_JS_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function insert_js_jquery($jquery_js_post,$jquery_js_name) {
    $jquery_js_post = stripcslashes($jquery_js_post);
    $jquery_js_name = htmlspecialchars($jquery_js_name);
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."jquery_js (jquery_js,jquery_js_name) VALUES(?,?)");
    $go->bindParam(1, $jquery_js_post, PDO::PARAM_STR);
    $go->bindParam(2, $jquery_js_name, PDO::PARAM_STR);
    $go->execute(); 
  }
   
 
  
};