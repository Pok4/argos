<?php
namespace App\Controllers;

use \PDO;
use \ArrayIterator;

class Files extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_files']);
    
    //The Model for this Controller
    $this->model = new \App\Models\Files_Model; 
  
  }
    
  public function Files() {
    
    $this->check_is_this_page();
    
    //if ?game isset
    if(isset($_GET['game'])) {
      $this->mustache->assign(['game_set'=>1,'game_type'=>$_GET['game']]);
    }   
    
    if(isset($_GET['type']) && isset($_GET['game'])) {
    $type = (int)$_GET['type'];
    $game = (int)$_GET['game'];

    $get = $this->model->check_for_cats($type,$game);

    if($get->rowCount() > 0) {
		
      $get_files .= "
      <form method='post'>
      <select name='choose_cat' class='form-control' style='max-width:300px;display:inline-block'>
      <option value=''>".$this->lang['lang_choose']."</option>";
      while($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $category_get = $row['category'];
        if($_COOKIE['argos_lang'] != 'bg') {
            switch($category_get) {
              case 'Админ команди': {
                $category_get2 = "Admin commands";
                break;
              }
              case 'Общо предназначение': {
                $category_get2 = "General Purpose";
                break;
              }
              case 'Статистически': {
                $category_get2 = "Statistical";
                break;
              }
              case 'Геймплей': {
                $category_get2 = "Gameplay";
                break;
              }
              case 'Събития': {
                $category_get2 = "Events";
                break;
              }
              case 'Управление на сървър': {
                $category_get2 = "Server Manage";
                break;
              }
              case 'Забавни': {
                $category_get2 = "Funny";
                break;
              }
              case 'Технически': {
                $category_get2 = "Technical";
                break;
              }
              case 'Всякакви': {
                $category_get2 = "Any";
                break;
              }
            }
            $get_files .= "<option value='$category_get'>$category_get2</option>";
          } else {
            $get_files .= "<option value='$category_get'>$category_get</option>";
          }
        }
      $get_files .= "
      </select>
      <input type='submit' value='".$this->lang['lang_send']."' name='submit_cat' class='btn btn-md btn-success'/>
      </form>
      ";
      if(isset($_POST['submit_cat'])) {
        $choosed_cat = sql_escape($_POST['choose_cat']);
        $get_current_url = secure_url().$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: '.$get_current_url.'&cat='.$choosed_cat.'');
        exit();
      }
		
    } else {
      $get_files = '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_no_files'].'</div>';
    }
      
      //unassign some vars to prevent bugs (double content)
      $this->mustache->unassign('game_set');
      $this->mustache->unassign('game_type');
      
      $this->mustache->assign(['game_set'=>1,'game_type'=>$_GET['game'],'choose_cat'=>1,'get_files'=>$get_files]);
    }
    
      $this->game_isset();
  }
  
  public function game_isset() {
  
    if(isset($_GET['type']) && isset($_GET['game']) && isset($_GET['cat'])) {
 
      $file_type = (int)$_GET['type'];
      $file_game = (int)$_GET['game'];
      $file_cat = htmlspecialchars($_GET['cat']);

      $pagination_check = $this->model->check_for_files($file_type,$file_game,$file_cat);
      $get = $this->model->get_files($file_type,$file_game,$file_cat);
 
      if($pagination_check->rowCount() > 0) {
        while($row = $get->fetch(PDO::FETCH_ASSOC)) {
          $file_id = $row['id'];
          $file_link = $row['link'];
          $opisanie = $row['opisanie'];
          $file_author = $row['author'];
          $file_date = date('d.m.Y :: h:i',$row['date']);
          $down_counts = $row['down_counts'];
          $file_size = $row['size'];
          $file_img = $row['picture'];
          $file_name = $row['name'];
          
          $get_all_in_cat[] = ['file_id'=>$file_id,'file_name'=>$file_name,'file_img'=>$file_img,'file_size'=>$file_size,'file_author'=>$file_author,'file_date'=>$file_date,'file_opisanie'=>$opisanie,'file_link'=>$file_link,'file_down_counts'=>$down_counts];
        }
        $this->mustache->assign('file_pagination',$this->container['pagination_files']['output']);
        $this->mustache->assign('all_spec_files',new ArrayIterator($get_all_in_cat)); 
      } else {
        $this->mustache->assign('no_files_here','<br/><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang['lang_no_files'].'</div>');
      }
      
        //unassign some vars to prevent bugs (double content)
        $this->mustache->unassign('game_set');
        $this->mustache->unassign('game_type');
        
        $this->mustache->assign(['game_set'=>1,'game_type'=>$_GET['game'],'choose_cat'=>1,'get_files'=>$get_files,'files_is_ready'=>1]);
      
    }
 
  }
  
  //check if users is on this files page
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/files.php') !== false) {
      $this->mustache->assign('is_files_page',1);
    }
  }

};