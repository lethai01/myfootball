<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadimage extends CI_Controller {

 function __construct(){
  parent::__construct();
 }

 public function index()
 {
 	$this->load->helper('form');
	$arrData['error'] = '';
	$arrData['content'] = 'multi_image_upload';
	$this->load->view('admin/spain/test',$arrData);
 }

 public function do_multi_upload(){
  if($this->input->post('submit_form')){
   if($_FILES["profile_pic"]["tmp_name"]) {
    $this->do_miltiupload_files('public/upload/', 'Myfootball', $_FILES['profile_pic']); // call the function with params
   }
  }
 }

 function do_miltiupload_files($path, $title, $files)
    {   
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['multi_images[]']['name']= $files['name'][$key];
            $_FILES['multi_images[]']['type']= $files['type'][$key];
            $_FILES['multi_images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['multi_images[]']['error']= $files['error'][$key];
            $_FILES['multi_images[]']['size']= $files['size'][$key];
            // here we change file name on run time
            $fileName = $title .'_'. $image;
            $images[] = $fileName;
            $config['file_name'] = $fileName; //new file name

            $this->upload->initialize($config); // load new config setting 

            if ($this->upload->do_upload('multi_images[]')) { // upload file here
            	$this->load->library('image_lib');
            	$config['image_library']='gd2';
                $config['source_image']='public/upload/'.$fileName;

                //tạo thumb image mà giữ nguyên ảnh gốc
                $config['new_image']='public/upload/thumb/';
                $config['create_thumb']=TRUE;    
                $config['maintain_ratio']=TRUE;
                $config['width'] =150;
                $config['height']=100;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            } else {
                return false;
            }
        }
        return $images;
    }
    /*public function selectnumber()
    {
    	if ($this->input->post('selectnumber')) 
    	{
    		$number = intval($this->input->post('selectnumber'));
    		//echo form_open_multipart('admin/uploadimage/do_multi_upload');
    		echo "<form action='admin_url('uploadimage/do_multi_upload')' method='post' enctype='multipart/form-data'>";
    		for ($i=0; $i < $number; $i++) 
    		{ 
    			echo "<input type='file' name='profile_pic[]'' size='20' multiple/>";
    		}
    		echo "<input type='submit' value='upload' name='submit_form'/>";	
    		//echo form_close();
    		echo "</form>";
    	}
    }*/
}