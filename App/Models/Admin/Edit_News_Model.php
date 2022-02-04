<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_News_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_News() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."news`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_news_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."news order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_news_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."news")->rowCount();
  }
  
  public function fetch_news_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."news WHERE id='$id'");
    return $get->fetch(PDO::FETCH_ASSOC);
  }
  
  public function edit_news($id,$author,$novina,$seourl,$text,$img,$comments_enable) {
    $author = htmlspecialchars(trim($author));
    $img = htmlspecialchars(trim($img));
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."news SET author=?,title=?,seourl=?,text=?,comments_enabled='$comments_enable',img=? WHERE id='$id'");
    $go->bindParam(1, $author, PDO::PARAM_STR);
    $go->bindParam(2, $novina, PDO::PARAM_STR);
    $go->bindParam(3, $seourl, PDO::PARAM_STR);
    $go->bindParam(4, $text, PDO::PARAM_STR);
    $go->bindParam(5, $img, PDO::PARAM_STR);
    $go->execute(); 
  }
  
};