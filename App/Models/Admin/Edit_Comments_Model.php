<?php
namespace App\Models\Admin;

use \PDO; 

class Edit_Comments_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Comments() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."comments`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_comments_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."comments order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_comments_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."comments")->rowCount();
  }
  
  public function get_news_information($news_id) {
    $get = $this->db->query("SELECT title,seourl FROM ".$this->argos_db_prefix."news WHERE id='$news_id'");
    return $get->fetch(PDO::FETCH_ASSOC); 
  }
  
  public function edit_comments($id,$text) {
    $text = htmlspecialchars_decode($text);
    $go = $this->db->prepare("UPDATE ".$this->argos_db_prefix."comments SET text=? WHERE id='$id'");
    $go->bindParam(1, $text, PDO::PARAM_STR);
    $go->execute();
  }
  
  public function fetch_comment_for_edit($id) {
    $get = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."comments WHERE id='$id'");
    $row = $get->fetch(PDO::FETCH_ASSOC);
    return htmlspecialchars($row['text']);
  }
  
  
};