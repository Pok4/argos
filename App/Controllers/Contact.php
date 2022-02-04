<?php
namespace App\Controllers;

class Contact extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_contacts']);
    
    //The Model for this Controller
    $this->model = new \App\Models\Contact_Model; 
    
  }
    
  public function Contact() {
  
      if(isset($_POST['submit_contact'])) {
        $your_name = trim($_POST['your-name']);
        $your_question = trim($_POST['your-question']);
        $your_email = trim($_POST['your-email']);
        $your_text = trim($_POST['your-text']);
        $captchaCode = $_SESSION['captchaCode'];
        $enteredcaptchaCode = trim($_POST['captcha_code']);
      
         
        if(empty($your_name)) {
          $this->mustache->assign([ 
            'submit_contact' => $this->lang['lang_no_name_found'],
            'submit_contact_alert' => "danger",
            'submit_contact_ico' => "exclamation-circle",
          ]);	
        } else if(empty($your_question)) {
          $this->mustache->assign([
            'submit_contact' => $this->lang['lang_no_question_found'],
            'submit_contact_alert' => "danger",
            'submit_contact_ico' => "exclamation-circle",
          ]);
          
        } else if(empty($your_text)) {
          $this->mustache->assign([
            'submit_contact' => $this->lang['lang_no_text_found'],
            'submit_contact_alert' => "danger",
            'submit_contact_ico' => "exclamation-circle",	
          ]);
        } else if($enteredcaptchaCode == $captchaCode){

          $this->mustache->assign([
            'submit_contact' => $this->lang['lang_success_contact'],
            'submit_contact_alert' => "success",
            'submit_contact_ico' => "check",	
          ]);
        
          $this->model->Insert_Contact($your_name,$your_text,$your_question,$your_email);
         
        } else {
          $this->mustache->assign([
            'submit_contact' => $this->lang['lang_wrong_captcha'],
            'submit_contact_alert' => "danger",
            'submit_contact_ico' => "exclamation-circle",	
          ]);	
        }
      }
 

  }
 
 
  
};