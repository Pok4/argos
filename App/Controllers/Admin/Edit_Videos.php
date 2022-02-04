<?php
namespace App\Controllers\Admin;

use \PDO; 
use \ArrayIterator;

class Edit_Videos extends \App\Controllers\BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->is_user_admin(); //check if user is admin, if not - redirect to forum login...
    
    //The Model for this Controller
    $this->model = new \App\Models\Admin\Edit_Videos_Model; 
 
  }
    
  public function Edit_Videos() {
     $this->check_is_this_page();
      
    $mysql_check = $this->model->check_videos_exists();
    $mysql = $this->model->Get_Videos();
    if($mysql_check>0) {
    while ($row=$mysql->fetch(PDO::FETCH_ASSOC)) { 
       $video_id = $row['id'];
       $video_link = $row['videolink'];
       $video_approved = $row['approved'];
       if($video_approved == "0") {
         $video_approved = "<a href='ajax/video_approved/?id=$video_id&approved=1' class='approved_video' style='color:green'><i class='fa fa-check'></i></a>";
       } else {
         $video_approved = "<a href='ajax/video_approved/?id=$video_id&approved=0' class='approved_video' style='color:red'><i class='fa fa-times'></i></a>";
       }
       $video_title = $row['original_title'];
       $videos_info[]  = ['video_id'=>$video_id,'video_link'=>$video_link,'video_approved'=>$video_approved,'video_title'=>$video_title];
       
    }
    $this->mustache->assign('allvideos',new ArrayIterator( $videos_info)); 
    $this->mustache->assign('pagination_videos', $this->container['pagination_videos_acp']['output']);
    } else {
      $this->mustache->assign('no_have_videos',"<div class='alert alert-danger'>".$this->lang['lang_no_videos']."</div>");
    }
    
    $this->edit_videos_function();
  }
  
  public function edit_videos_function() {
      $id = (int)$_GET['id'];	
    
      if(isset($id)) {
        $this->mustache->assign('acp_edit_videos_id',$id);
        
        $row = $this->model->fetch_video_for_edit($id);
        $vlink = $row['videolink'];
        $vsite = $row['site'];
        if($vsite == "vbox") {
          $pieces1 = explode("play:", $vlink);
          $vid = $pieces1[1];
          $this->mustache->assign('acp_edit_videos_vlink',secure_url()."vbox7.com/emb/external.php?vid=$vid");
        } else if($vsite=="vimeo") {
          $pieces1 = explode("vimeo.com/", $vlink);
          $vid = $pieces1[1];
          $this->mustache->assign('acp_edit_videos_vlink',secure_url()."player.vimeo.com/video/$vid");
        } else {
          $pieces2 = explode("watch?v=", $vlink);
          $vid = $pieces2[1];
          $this->mustache->assign('acp_edit_videos_vlink',secure_url()."www.youtube.com/embed/$vid");
        }
        $this->mustache->assign('acp_edit_videos_uploader',$row['uploader']);
        $this->mustache->assign('acp_edit_videos_curcat',$row['cat']);
        
        $getallcats = ""; //globalize
        $get_all_vcats =  $this->model->get_all_from_vcats();
        while($row2=$get_all_vcats->fetch(PDO::FETCH_ASSOC)) {
          $getallcats .= '<option value="'.$row2['category'].'">'.$row2['category'].'</option>';
        }
        $this->mustache->assign('acp_edit_videos_all_cats',$getallcats);
        
        if(isset($_POST['acp_edit_videos_submit'])) {
          $cat = $_POST['cat'];
          $uploader = $_POST['uploader'];
          
          $this->model->edit_videos($id,$cat,$uploader);
          $this->mustache->assign('acp_edit_videos_submit','<br/><div class="alert alert-success"><i class="fa fa-check"></i> '.$this->lang['lang_success'].'</div>');
        }
      }
  }  
  
  //check if user is on this page - edit_videos.php
  public function check_is_this_page() {
    if (strpos($_SERVER["REQUEST_URI"], '/edit_videos.php') !== false) {
      $this->mustache->assign('is_video_page_acp',1);
    }
  }
  
  
};