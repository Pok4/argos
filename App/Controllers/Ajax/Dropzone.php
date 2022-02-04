<?php
namespace App\Controllers\Ajax;

class Dropzone extends \App\Controllers\BaseController {
  
  public function __construct() {
    parent::__construct(); 
    
    //The Model for this Controller
    $this->model = new \App\Models\Ajax\Dropzone_Model; 
  }
    
  public function Dropzone() {
    if(is_ajax())
    { 

        $ds = DIRECTORY_SEPARATOR;
        $storeFolder = '../../../uploads/images';

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name']; 
            $file_data = getimagesize($tempFile);         
            if(is_array($file_data) && strpos($file_data['mime'],'image') !== false) {
              $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
             
              $targetFile = $targetPath. time().'_'.$_FILES['file']['name'];
              $file_to_down =  time().'_'.$_FILES['file']['name'];
              move_uploaded_file($tempFile,$targetFile); 
           
              echo url().'/uploads/images/'.$file_to_down; 
              $date = time();
              $this->model->pic_insert($date,$file_to_down); 
               
            }
        }

    }
  }

};