<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Add_Edit_User_Access extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_Edit_User_Access_Model; 
 
  }
    
  public function Add_Edit_User_Access() {
     $this->check_is_this_page();
    
    //needed function
    function array2string($data){
      $log_a = "";
      foreach ($data as $key => $value) {
        if(is_array($value))    $log_a .= " (". array2string($value). ") \n";
            else                $log_a .= " ".$value."\n";
        }
      return $log_a;
    }
    
    if($this->model->check_access()>0) {
      
     $table_start='
      <br/>
      <table class="table table-striped">
        <tr>
          <th><i class="fa fa-user"></i></th>
          <th><i class="fa fa-key"></i></th>
          <th>'.$this->lang['lang_acp_delete'].'</th>
        </tr>
      ';
      $table_end = '</table>';
       
      $get = $this->model->fetch_access(); 
      while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $access_id = $row['id'];
      $username = $row['username'];
      $pages=explode(',',$row['pages']);
      foreach($pages as $v) {
        $pages2[] .= ' :: '.$v;
      }
      
      
      $access_acp[] = ['all_pages'=>'
        <tr class="user_access-'.$access_id.'">
          <td>'.$username.'</td>
          <td><b data-toggle="tooltip" title="'.array2string($pages2).'"><i class="fa fa-question-circle"></i></b></td>
          <td><a href="ajax/remove_access/?id='.$access_id.'" class="delete_access" style="color:red"><i class="fa fa-times"></i></a></td>
        </tr>
      '];
      $pages2 = []; //clear array masive
      }
      
      $this->mustache->assign('all_access',new ArrayIterator($access_acp)); 
      $this->mustache->assign(['table_start_custom_access'=>$table_start,'table_end_custom_access'=>$table_end]);

    } else {
      $this->mustache->assign('access_acp','<hr/><div class="alert alert-info"><i class="fa fa-warning"></i> '.$this->lang['lang_acp_no_access'].'</div>');
    }

    $files = [];
    foreach (glob("admin/template/*.html") as $file) {
      $removed = ["admin/template/acp.html", "admin/template/admin_htmleditor.html","admin/template/ajax.html","admin/template/admin_add_jquery_js.html","admin/template/admin_add_edit_user_access.html","admin/template/admin_add_edit_emoticons.html",
      "admin/template/content-wrap.html","admin/template/footer.html","admin/template/header.html","admin/template/js_libs.html","admin/template/meta.html","admin/template/sidebar.html","admin/template/meta.html","admin/template/admin_add_edit_ext.html","admin/template/admin_custom_pages_ext.html",
      "admin/template/admin_home.html","admin/template/admin_add_edit_user_access.html","admin/template/admin_configure.html","admin/template/admin_add_custom_lang.html","admin/template/admin_add_custom_css.html","admin/template/admin_add_pages.html","admin/template/admin_edit_pages.html"];
      $file = str_replace($removed, '', $file); //remove pages before (in $removed)
      $file = str_replace('admin/template/admin_', '', $file); //remove admin/template/admin_ from names
      $file = str_replace('.html', '.php', $file); //change .html to .php
      $files[] = "<option value='$file'>$file</option>";
      $files = array_diff($files,["<option value=''></option>"]); //glamorouse, isn't it ? This will wrap page names with option tag
    }
     
    $this->mustache->assign('get_all_pages_acp_access',array2string($files));
    
    $this->submit_access();
   
  }
  
  public function submit_access() {
    if(isset($_POST['submit_access'])) {
      
      $username = trim($_POST['username']);
 
      if($this->model->check_if_username_exist($username)>0) {
      
        $access_pages = 'acp.php,'.implode(',',$_POST['Pages']);
        $this->model->add_access($username, $access_pages);
        $this->mustache->assign('submit_access','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
     
      } else {
        $this->mustache->assign('submit_access','<br/><div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_no_such_member'].'</div>');
      }
       
    }    
  }
  
  //check if user is on this page - add_edit_user_access.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/add_edit_user_access.php') !== false) {
      $this->mustache->assign('is_access_page_acp',1);
    }
  }
  
  
};