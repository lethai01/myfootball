<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload_football');
	}
	public function index()
	{
		$this->load->helper('form');
		$arrData['error'] = '';
		$arrData['content'] = 'multi_image_upload';
		$this->load->view('admin/spain/test',$arrData);
	}
	public function do_image_upload()
	{
		if ($this->input->post('submit_form'))
		{
			$path = 'public/uploads/spain';
			$prefix = 'Spain';
			$data = $this->upload_football->uploadmutiimage($_FILES['profile_pic'], $path, $prefix);
			if ($data) {
				pre($data);
			}else{
				pre($data);
			}
		}else{
			echo "sai";	
		}
		
	}
	public function tags()
	{
		if ($this->input->post()) {
			pre($this->input->post('tags'));
		}
		$this->data['temp'] = 'admin/spain/tag';
		$this->load->view('admin/main', $this->data);
	}

}

/* End of file test.php */
/* Location: ./application/controllers/admin/test.php */