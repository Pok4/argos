<?php
namespace App\Controllers;

use \PDO; 

class Banners extends BaseController {
  
  
  public function __construct() {
  
    parent::__construct(); 
    
    $this->mustache->assign('page_title', $this->lang['lang_banners']);
    
    //The Model for this Controller
    $this->model = new \App\Models\Banners_Model; 
    
  }
    
  public function Banners() {
  
      ////////////////////////468x60//////////////////////
      $own_banners .= "<div class='alert alert-warning'>468x60</div>";
      $get = $this->model->get_from_banners('468x60');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='468' height='60' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      ////////////////////////88x31//////////////////////
      $own_banners .= "<div class='alert alert-warning'>88x31</div>";
      $get = $this->model->get_from_banners('88x31');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='88' height='31' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      ////////////////////////200x200//////////////////////
      $own_banners .= "<div class='alert alert-warning'>200x200</div>";
      $get = $this->model->get_from_banners('200x200');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='200' height='200' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      ////////////////////////userbars//////////////////////
      $own_banners .= "<div class='alert alert-warning'>userbars</div>";
      $get = $this->model->get_from_banners('userbar');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='350' height='20' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      ////////////////////////728x90//////////////////////
      $own_banners .= "<div class='alert alert-warning'>728x90</div>";
      $get = $this->model->get_from_banners('728x90');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='728' height='90' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      ////////////////////////120x240//////////////////////
      $own_banners .= "<div class='alert alert-warning'>120x240</div>";
      $get = $this->model->get_from_banners('120x240');
      while($row = $get->fetch(PDO::FETCH_ASSOC)) { 

        $id = $row['id'];
        $banner_link = $row['site_link'];
        $banner_img = $row['banner_img'];
        $banner_title = $row['link_title'];
        $banner_author = $row['avtor'];

        $own_banners .="
        <div style='text-align:center'>
        <img src='$banner_img' class='img-responsive center-block' width='120' height='240' alt=''/><br/>
        <textarea style='width:90%;' onclick='hl_text(this)' readonly='readonly'>&lt;a href='$banner_link' target='_blank' title='$banner_title'&gt;&lt;img src='$banner_img' alt='' style='border:0' /&gt;&lt;/a&gt;</textarea>
        <br/>".$this->lang['lang_author'].": <b>$banner_author</b>
        </div>
        ";
        
      }

      $get = $this->model->check_for_banners();
      if($get->rowCount() < 1) {
        $this->mustache->assign('all_own_banners',"<br/><div class='alert alert-info'><i class='fa fa-info-circle'></i> ".$this->lang['lang_no_banners']."</div>");
      } else {
        $this->mustache->assign('all_own_banners',$own_banners);
      }
 

  }
  
};