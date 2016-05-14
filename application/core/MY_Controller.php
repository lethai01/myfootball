<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

	public function __construct()
	{
		//để sử dụng function của CI_Contrller
		parent::__construct();
		//Do your magic here
		$this->load->library('Util');
		$this->load->library('upload_football');
		/*$this->load->helper('admin');
		$action = $this->uri->rsegment(2);
		$controller = $this->uri->rsegment(1);
		$this->data['action'] = $action;
		$this->data['controller'] = $controller;

		// check login
		if ($action != 'login' && !$this->tank_auth->is_logged_in()) {
			redirect(admin_url('auth/login'));
		}*/
	}
	
	protected function get_login_userid() {
		return $this->session->userdata['user_id'];
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */