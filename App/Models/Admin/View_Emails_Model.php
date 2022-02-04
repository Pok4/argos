<?php
namespace App\Models\Admin;

use \PDO; 

class View_Emails_Model extends \App\Controllers\BaseController {
  
 
  public function __construct() {

    parent::__construct(); 
  
  }
  
 
  public function Get_Emails() {
    $results    = $this->db->query("SELECT COUNT(`id`) FROM `".$this->argos_db_prefix."contacts`")->fetchColumn();
    $pagination = pagination($results, [
        'get_vars'  => [
            'cat'   => (int)@$_GET['cat'],
            'view'  => @$_GET['view']
        ], 
        'per_page'  => 15,
        'per_side'  => 3, 
        'get_name'  => 'page'
    ]);
    
    $this->container['pagination_emails_acp'] = $pagination;
      
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."contacts order by id DESC LIMIT {$pagination['limit']['first']}, {$pagination['limit']['second']}");
  }
  
  public function check_emails_exists() {
    return $this->db->query("SELECT * FROM ".$this->argos_db_prefix."contacts")->rowCount();
  }
  
  public function get_admin_email() {
    $get_origin = $this->db->query("SELECT admin_email,site_name FROM ".$this->argos_db_prefix."config");
    return $get_origin->fetch(PDO::FETCH_ASSOC);
  }
  
  public function fetch_email($id) {
    $get_data = $this->db->query("SELECT * FROM ".$this->argos_db_prefix."contacts WHERE id='$id'");
    return $get_data->fetch(PDO::FETCH_ASSOC);
  }
  
  public function send_mail($id,$our_text,$our_name,$his_mail,$site_name,$admin_email) {
    $this->db->query("UPDATE ".$this->argos_db_prefix."contacts SET respond=1 WHERE id='$id'");

    $headers = ""; 
    $headers .= "From: $admin_email"."\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $our_text = "$our_text <br/><br/><hr/>Поздрави, $our_name.";
    mail($his_mail, 'Suobshtenie ot ekipa na '.$site_name.'', $our_text, $headers);
  }
  
};