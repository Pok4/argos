<?php
namespace App\Controllers\Admin;

class Add_File extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Add_File_Model; 
 
  }
    
  public function Add_File() {
  
    $this->check_is_this_page();
  
    $file_type = $_POST['dropdown_type'];
    switch($file_type) {
      case '1': {
        $file_type_real = $this->lang['lang_acp_files_add_page_plugin'];
        break;
      }
      case '2': {
        $file_type_real = $this->lang['lang_acp_files_add_page_map'];
        break;
      }
      case '3': {
        $file_type_real = $this->lang['lang_acp_files_add_page_skin'];
        break;
      }
      case '4': {
        $file_type_real = $this->lang['lang_acp_files_add_page_program'];
        break;
      }
    }
    $file_game = $_POST['dropdown_game'];
    switch($file_game) {
      case '1': {
        $file_game_real = "CS 1.6";
        break;
      }
      case '2': {
        $file_game_real = "CS:GO";
        break;
      }
      case '3': {
        $file_game_real = "SAMP";
        break;
      }
      case '4': {
        $file_game_real = "Minecraft";
        break;
      }
    }
    if($file_type != 0 && $file_game != 0) {

     

    if(($file_game == 1 || $file_game ==2 || $file_game ==3 || $file_game ==4) && $file_type == 1) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="" selected="selected"> '.$this->lang['lang_acp_files_add_page_choose'].' </option>
        <option value="Админ команди">'.$this->lang['lang_file_sys_admin_comm'].'</option>
        <option value="Общо предназначение">'.$this->lang['lang_file_sys_multipurpose'].'</option>
        <option value="Статистически">'.$this->lang['lang_file_sys_statistic'].'</option>
        <option value="Геймплей">'.$this->lang['lang_file_sys_gameplay'].'</option>
        <option value="Събития">'.$this->lang['lang_file_sys_events'].'</option>
        <option value="Управление на сървър">'.$this->lang['lang_file_sys_server_control'].'</option>
        <option value="Забавни">'.$this->lang['lang_file_sys_fun'].'</option>
        <option value="Технически">'.$this->lang['lang_file_sys_technical'].'</option>
        <option value="Всякакви">'.$this->lang['lang_file_sys_all_others'].'</option>
        </select><br/><br/>
        ';
    }

    if(($file_game == 1 || $file_game ==2) && $file_type == 2) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="" selected="selected"> '.$this->lang['lang_acp_files_add_page_choose'].' </option>
        <option value="aim">aim</option>
        <option value="awp">awp</option>
        <option value="bb">bb</option>
        <option value="cs">cs</option>
        <option value="de">de</option>
        <option value="deathrun">deathrun</option>
        <option value="fy">fy</option>
        <option value="gg">gg</option>
        <option value="hns">hns</option>
        <option value="jb">jb</option>
        <option value="jump">jump</option>
        <option value="zm">zm</option>
        </select><br/><br/>';
    }
      
    if($file_game == 1 && $file_type == 3) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="" selected="selected"> '.$this->lang['lang_acp_files_add_page_choose'].' </option>
        <option value="ak47">ak47</option>
        <option value="awp">awp</option>
        <option value="deagle">deagle</option>
        <option value="g3sg1">g3sg-1</option>
        <option value="glock18">glock18</option>
        <option value="knives">knives</option>
        <option value="m3">m3</option>
        <option value="mac10">mac10</option>
        <option value="mp5">mp5</option>
        <option value="p9">p9</option>
        <option value="sg550">sg550</option>
        <option value="tmp">tmp</option>
        <option value="usp">usp</option>
        <option value="shield">shield</option>
        <option value="aug">aug</option>
        <option value="c4">c4</option>
        <option value="dualbarettas">dual barettas</option>
        <option value="fiveseven">fiveseven</option>
        <option value="galil">galil</option>
        <option value="grenades">grenades</option>
        <option value="m249">m249</option>
        <option value="m4a1">m4a1</option>
        <option value="xm1014">xm1014</option>
        <option value="p228">p228</option>
        <option value="scout">scout</option>
        <option value="sg552">sg552</option>
        <option value="ump">ump</option>
        <option value="arctic">arctic (T)</option>
        <option value="guerilla">guerilla (T)</option>
        <option value="l33t">l33t (T)</option>
        <option value="terror">terror (T)</option>
        <option value="gign">gign (CT)</option>
        <option value="gsg9">gsg9 (CT)</option>
        <option value="sas">sas (CT)</option>
        <option value="urban">urban (CT)</option>
        </select><br/><br/>';
    }	

    if(($file_game == 1 || $file_game ==2) && $file_type == 4) {
        $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="" selected="selected"> '.$this->lang['lang_acp_files_add_page_choose'].' </option>
        <option value="skin">'.$this->lang['lang_file_sys_forskins'].'</option>
        <option value="maps">'.$this->lang['lang_file_sys_formaps'].'</option>
        <option value="bots">'.$this->lang['lang_file_sys_bots'].'</option>
        <option value="videos">'.$this->lang['lang_file_sys_forvideos'].'</option>
        <option value="backgrounds">'.$this->lang['lang_file_sys_forbackgrounds'].'</option>
        <option value="rcon">'.$this->lang['lang_file_sys_forrcon'].'</option>
        <option value="exploits">exploit defenders</option>
        <option value="models">'.$this->lang['lang_file_sys_formodels'].'</option>
        </select><br/><br/>';
    }

    if($file_game == 2 && $file_type == 3) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="" selected="selected"> - Избери - </option>
        <option value="cz75">cz75</option>
        <option value="deagle">deagle</option>
        <option value="dualbarettas">dual barretas</option>
        <option value="fiveseven">five seven</option>
        <option value="glock18">glock18</option>
        <option value="p2000">p2000</option>
        <option value="p250">p250</option>
        <option value="tec9">tec9</option>
        <option value="usp-s">usp-s</option>
        <option value="ak47">ak47</option>
        <option value="aug">aug</option>
        <option value="awp">awp</option>
        <option value="famas">famas</option>
        <option value="g3sg1">g3sg-1</option>
        <option value="galil">galil</option>
        <option value="m4a4">m4a4</option>
        <option value="m4a1-s">m4a1-s</option>
        <option value="scar20">scar20</option>
        <option value="sg553">sg553</option>
        <option value="ssg08">ssg08</option>
        <option value="mac10">mac10</option>
        <option value="mp7">mp7</option>
        <option value="mp9">mp9</option>
        <option value="cz75">cz75</option>
        <option value="ppbizon">pp-bizon</option>
        <option value="p90">cz75</option>
        <option value="ump45">ump-45</option>
        <option value="mag7">mag7</option>
        <option value="nova">nova</option>
        <option value="sawedoff">sawedoff</option>
        <option value="xm1014">xm1014</option>
        <option value="m249">m249</option>
        <option value="negev">negev</option>
        <option value="knives">knives</option>
        
        </select><br/><br/>';
    }	

    if($file_game == 3 && $file_type == 2) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="multiplayer">multiplayer</option>
        <option value="others">others</option>
        <option value="racetrack">racetrack</option>
        <option value="stunt">stunt</option>
        </select><br/><br/>';
        
        
    }

    if($file_game == 3 && $file_type == 3) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="cellphones">'.$this->lang['lang_file_sys_telephones'].'</option>
        <option value="clothing">'.$this->lang['lang_file_sys_clothing'].'</option>
        <option value="glasses">'.$this->lang['lang_file_sys_glasses'].'</option>
        <option value="jackets">'.$this->lang['lang_file_sys_jackets'].'</option>
        <option value="others">'.$this->lang['lang_file_sys_others'].'</option>
        </select><br/><br/>';
    }
     
    if($file_game == 3 && $file_type == 4) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="всякакви">'.$this->lang['lang_file_sys_all_others'].'</option>
        </select><br/><br/>';	
    }


    if($file_game == 4 && $file_type == 2) {
      $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="adventure">adventure</option>
        <option value="parkour">parkour</option>
        <option value="horror">horror</option>
        <option value="survival">survival</option>
        <option value="creation">creation</option>
        <option value="pvp">pvp</option>
        <option value="puzzle">puzzle</option>
        <option value="game">game</option>
        <option value="others">'.$this->lang['lang_file_sys_others'].'</option>
        </select><br/><br/>';	
    }
     
    if($file_game == 4 && $file_type == 3) {
        $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="всякакви">'.$this->lang['lang_file_sys_all_others'].'</option>
        </select><br/><br/>';	
    }

    if($file_game == 4 && $file_type == 4) {
        $ready_template = '
        '.$this->lang['lang_cat'].':<br/>
        <select name="category">
        <option value="editors">editors</option>
        <option value="mapping">mapping</option>
        <option value="viewers">viewers</option>
        <option value="mods">mods</option>
        <option value="3d-exporters">3d exporters</option>
        <option value="others">'.$this->lang['lang_file_sys_others'].'</option>
        </select><br/><br/>';	
    }
      
      $this->mustache->assign(['file_type_not_real'=>$file_type, 'file_game_not_real'=>$file_game,'file_type'=>$file_type_real,'file_game'=>$file_game_real,'ready_template'=>$ready_template]);

    } else {
      $this->mustache->assign('form_cant_submit',$this->lang['lang_please_fill_all_fields']);
    }
    
    $this->file_submit();
  }
  
  
  public function file_submit() {
    if(isset($_POST['submit_file'])){
      if($_POST['file_game'] != 0 && $_POST['file_type'] != 0 && !empty($_POST['file_name']) &&  !empty($_POST['file_link']) && !empty($_POST['file_author'])) {
      
      $file_type_not_real = $_POST['file_type'];
      $file_type = $_POST['file_type'];
      switch($file_type) {
      case '1': {
        $file_type = "Плъгин";
        break;
      }
      case '2': {
        $file_type = "Карта";
        break;
      }
      case '3': {
        $file_type = "Скин";
        break;
      }
      case '4': {
        $file_type = "Програма";
        break;
      }
      }
       
      $file_game_not_real= $_POST['file_game'];
      $file_game= $_POST['file_game'];
      switch($file_game) {
      case '1': {
        $file_game = "CS 1.6";
        break;
      }
      case '2': {
        $file_game = "CS:GO";
        break;
      }
      case '3': {
        $file_game = "SAMP";
        break;
      }
      case '4': {
        $file_game = "Minecraft";
        break;
      }
      }
      
      $file_name = $_POST['file_name'];
      
     
      
      if($this->model->check_file_exists($file_name) < 1) {
        $file_link = trim($_POST['file_link']);
        $file_author = trim($_POST['file_author']);
        $file_img = trim($_POST['file_img']);
        if(empty($file_img) || !filter_var($fle_img, FILTER_VALIDATE_URL)) {
          $file_img = "assets/img/no_image.jpg";
        }
        $file_description = trim($_POST['opisanie']);
        $file_size = $_POST['file_size'];
        $file_upload_date = time();
        $file_cat = $_POST['category'];
        $down_counts = 0; 
        
        $this->model->add_file($file_img,$file_author,$down_counts,$file_upload_date,$file_size,$file_type,$file_game,$file_type_not_real,$file_game_not_real,$file_cat,$file_description,$file_link,$file_name);
        
        $this->mustache->assign('file_add','<div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
      } else {
        $this->mustache->assign('file_add','<div class="alert alert-danger"><i class="fa fa-remove"></i> '.$this->lang['lang_already_have_file'].'</div>');
      }
      } else {
        $this->mustache->assign('file_add','<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_acp_missing_input'].'</div>');
      }
    }  
  }
  
  //check if user is on this page - add_file.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/add_file.php') !== false) {
      $this->mustache->assign('is_filesadd_page',1);
    }
  }
  
  
};