<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_football{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	
	function config($path = '')
	{
		$config = array();
		$config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['max_width']  = '10240';
        $config['max_height']  = '7680';
        $config['overwrite']  = 1;
        return $config;
	}

	public function uploadimage($image, $path, $prefix = '')
	{
		$config = $this->config($path);
		$config['file_name'] = $prefix . '_' . $_FILES[$image]['name']; // new file name
		$this->ci->load->library("upload", $config);
		if ($this->ci->upload->do_upload($image)) 
		{
			return $this->ci->upload->data();
		}else{
			return	$this->ci->upload->display_errors();
		}

	}

	function uploadThubm($image, $path, $prefix, $path_thumb)
	{
		$data = $this->uploadimage($image, $path, $prefix);
		if ($data) 
		{
			$this->ci->load->library('image_lib');
			$config = array();
			$config['image_library'] = 'gd2';
            $config['source_image'] = $path. '/' .$data['file_name'];

            //tạo thumb image mà giữ nguyên ảnh gốc
            $config['new_image'] = $path_thumb;
            $config['create_thumb'] = TRUE;    
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] =''; 
            $config['width'] = 150;
            $config['height'] = 100;
            //pre($config);
            $this->ci->image_lib->initialize($config);
            $this->ci->image_lib->resize();
            return $data['file_name'];
       	} else {
           	return $data;
        }
	}

	function uploadmutiimage($files, $path, $prefix = '')
	{
		$config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );
		$this->ci->load->library("upload", $config);
		$images = array();
		foreach ($files['name'] as $key => $image) 
		{
			$_FILES['multi_images[]']['name']= $files['name'][$key];
            $_FILES['multi_images[]']['type']= $files['type'][$key];
            $_FILES['multi_images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['multi_images[]']['error']= $files['error'][$key];
            $_FILES['multi_images[]']['size']= $files['size'][$key];
            // here we change file name on run time
            $fileName = $prefix .'_'. $image;
            $images[] = $fileName;
            $config['file_name'] = $fileName; //new file name
            $this->ci->upload->initialize($config); // load new config setting 
            $this->ci->upload->do_upload('multi_images[]');
		}
		return $images;
	}
}

/* End of file Upload.php */
/* Location: ./application/libraries/Upload.php */