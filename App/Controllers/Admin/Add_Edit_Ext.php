<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Add_Edit_Ext extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Edit_Ext_Model; 
 
  }
    
  public function Add_Edit_Ext() {
    $this->check_is_this_page();
    
    //get all dirs function
    function directories($directory)
    {
        $glob = glob($directory . '/*');

        if($glob === false)
        {
          return array();
        }

        return array_filter($glob, function($dir) {
          return is_dir($dir);
        });
    }

    //extensions root path
    $alldirs = directories('ext');

    //check empty dirs and remove them
    function dir_is_empty($dir) {
      $dirItems = count(scandir($dir));
      if($dirItems > 2) return false;
      else return true;
    }

    if(!empty($alldirs)) {
      $alldirs2 = [];
      foreach($alldirs as $v) {
        if(!dir_is_empty($v)) {
         $alldirs2[] = $v;
        }
      }
    }

    //check and get subfolders
    function myScandir(&$parentDir,$actual_dir){
      if(file_exists($actual_dir)) {
            $scanDir = scandir($actual_dir);
            for ($i=0;$i<count($scanDir);$i++){
                if ( $scanDir[$i] == '.' || $scanDir[$i] == '..' ) {
                  continue;
                }
                if (is_dir($actual_dir.'/'.$scanDir[$i]) && !dir_is_empty($actual_dir.'/'.$scanDir[$i])){
                  $dir =  $actual_dir.'/'.$scanDir[$i];
                  myScandir( $parentDir[$dir] , "$actual_dir/$dir" );
                }
            }
          return true;
      }     
    }

    if(!empty($alldirs2)) {
      foreach($alldirs2 as $v) {
        $alldirs3 = myScandir($parentDir,$v);
      }
    }

    if(!empty($parentDir)) {
      
      $all_extensions = array_keys($parentDir);

      foreach($all_extensions as $v) {
        //ext names $v
        $ext_name = explode('ext/',$v);

        $mysql = $this->model->fetch_exts($ext_name[1]);
        $row=$mysql->fetch(PDO::FETCH_ASSOC);
        
        $ext_status = $row['ext_active'] ? $row['ext_active'] : '0';
        switch($ext_status) {
          case '1': {
            $color = 'red';
            $icon = 'fa fa-times';
            $url_type = 'off';
            $status = $this->lang['lang_acp_ext_status_enable'];
            break;
          }
          case '0': {
            $color = 'green';
            $icon = 'fa fa-check';
            $url_type = 'on';
            $status = $this->lang['lang_acp_ext_status_disable'];
            break;
          }
        }
        $ext_info[] = ['ext_name'=>$row['ext_name'] ? $row['ext_name'] : $ext_name[1],'ext_ver'=>$row['ext_version'] ? $row['ext_version'] : 'N/A', 'ext_status'=>$row['ext_active'] ? '<span class="badge bg-green">'.$status.'</span>' : '<span class="badge bg-red">'.$status.'</span>','ext_status_color'=>$color,'ext_status_icon'=>$icon,'ext_url_type'=>$url_type];
     
      }
      $this->mustache->assign('allext',new ArrayIterator($ext_info)); 
     
    } else {
      //no have extensions
      $this->mustache->assign('no_have_ext',"<div class='alert alert-danger'>".$this->lang['lang_acp_no_ext']."</div>");
    }    
  }
  
  //check if user is on this page - add_edit_ext.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/add_edit_ext.php') !== false) {
      $this->mustache->assign('is_ext_page_acp',1);
    }
  }
  
};