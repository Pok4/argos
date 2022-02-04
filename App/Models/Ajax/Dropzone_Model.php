<?php
namespace App\Models\Ajax;

use \PDO; 

class Dropzone_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
   
  //Pic Insert
  public function pic_insert($date,$file_to_down) {
    $go= $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."gallery (date,pic_link,uploader) VALUES('$date','$file_to_down',?)");
    $go->bindParam(1, $this->username, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};