<?php
namespace App\Models;

use \PDO; 

class Contact_Model extends \App\Controllers\BaseController {
  
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function Insert_Contact($name,$text,$question,$mail) {
        $time = time();
        
        $name = htmlspecialchars($name);
        $text = htmlspecialchars($text);
        $question = htmlspecialchars($question);
        $mail = htmlspecialchars($mail);
        
        $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."contacts (`date`, `ip`,`username`, `text`, `question`, `email`) VALUES('$time','".$this->user_ip."',?,?,?,?)");
        $go->bindParam(1, $name, PDO::PARAM_STR);
        $go->bindParam(2, $text, PDO::PARAM_STR); 
        $go->bindParam(3, $question, PDO::PARAM_STR); 
        $go->bindParam(4, $mail, PDO::PARAM_STR); 
        $go->execute(); 
  }
  

  
};