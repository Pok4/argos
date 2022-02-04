<?php
namespace App\Controllers;
use \PDO;
use \ArrayIterator; //for mustache
use App\Entity\Captcha;

class Captcha extends BaseController  {
  
  public function __construct() {
    parent::__construct();
  }
    
  public function Captcha() {
 
    $captchaConfig = array(
     'img_width' => '200',
     'img_height' => '50',
     'font_size' => '30',
     'font_path' => 'assets/fonts/Monofont.ttf',
     );
    $captcha = new Captcha($captchaConfig);
    $captcha->createCaptcha();
 
  }
 
  
};