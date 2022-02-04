<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class View_Emails extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\View_Emails_Model; 
 
  }
    
  public function View_Emails() {
     $this->check_is_this_page();
     
      
    $mysql_check = $this->model->check_emails_exists();
    $mysql = $this->model->Get_Emails();
    
    if($mysql_check>0) {
      while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
         $sender_id = $row['id'];
         $sender_username = $row['username'];
         $sender_date = date('d.m.y h:i:s A',$row['date']);
         $sender_question = truncate_chars($row['question'],30,'...');
         $sender_respond = $row['respond'] ? $this->lang['lang_yes'] : $this->lang['lang_no'];
         $sender_respond2 = $row['respond'];
         $sender_badge = $sender_respond2 ? 'green':'red';
         $senders_info[]  = ['sender_username'=>$sender_username,'sender_question'=>$sender_question,'sender_date'=>$sender_date,'sender_respond'=>$sender_respond,'sender_badge'=>$sender_badge,'sender_id'=>$sender_id];
         
      }
      $this->mustache->assign('allpms',new ArrayIterator($senders_info)); 
      $this->mustache->assign('pagination_pm',$this->container['pagination_emails_acp']['output']);
    } else {
      $this->mustache->assign('no_have_pms',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_messages']."</div>");
    }
    
    $this->view_mails_function();
  }
  
  public function view_mails_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_view_emails_id',$id);
        
        //get admin mail to send
        $row = $this->model->get_admin_email();
        $admin_email = $row['admin_email'];
        $site_name = $row['site_name'];
        
        $row = $this->model->fetch_email($id);
        $this->mustache->assign('acp_view_mails_question',$row['question']);
        $this->mustache->assign('acp_view_mails_username',$row['username']);
        $this->mustache->assign('acp_view_mails_email',$row['email']);
        $this->mustache->assign('acp_view_mails_histext',$row['text']);
        
        if(isset($_POST['acp_view_mails_submit'])) {
          $our_text = trim($_POST['our_text']);
          $our_name = trim($_POST['our_name']);
          $his_mail =trim($_POST['his_mail']);
          
          $this->model->send_mail($id,$our_text,$our_name,$his_mail,$site_name,$admin_email);
          $this->mustache->assign('acp_view_mails_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_email_sended_success'].'</div>');
        }
      }  
  
  }
  
  //check if user is on this page - view_emails.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/view_emails.php') !== false) {
        $this->mustache->assign('is_mails_page',1);
    }
  }
  
  
};