<?php
namespace App\Models\Admin;

use \PDO; 

class Add_News_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
  public function check_if_news_exists($news_title) {
    $news_check = $this->db->prepare("SELECT title FROM ".$this->argos_db_prefix."news WHERE title=?");
    $news_check->bindParam(1, $news_title, PDO::PARAM_STR);
    $news_check->execute(); 
    return $news_check->rowCount();
  }
  
  public function add_news($news_poster,$news_title,$seourl,$news_text,$news_date,$comments_enable,$img) {
  
    $go = $this->db->prepare("INSERT INTO ".$this->argos_db_prefix."news (author,title,seourl,text,date,comments_enabled,comments,img) VALUES('$news_poster',?,'$seourl',?,'$news_date','$comments_enable','0',?)");
    $go->bindParam(1, $news_title, PDO::PARAM_STR);
    $go->bindParam(2, $news_text, PDO::PARAM_STR);
    $go->bindParam(3, $img, PDO::PARAM_STR);
    $go->execute(); 
  
  }
 

  
};