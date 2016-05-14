<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Football_menu extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('football_menu_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$input = array();
		$input['where'] = array('parent_id' => 0);
		$list = $this->football_menu_model->get_list($input);
		$this->data['list'] = $list;
		$this->data['temp'] = 'admin/football_menu/index';
		$this->load->view('admin/main', $this->data);
	}
	public function checkname($name)
	{
		$check = array('name' => $name);
		if ($this->football_menu_model->check_exists($check)) {
			$this->form_validation->set_message(__FUNCTION__,'Menu đã tồn tại !');
			return false;
		}
		return true;
	}
	public function checkparent($parent_id)
	{
		$check = array('id' => intval($parent_id));
		if (!$this->football_menu_model->check_exists($check)) {
			$this->form_validation->set_message(__FUNCTION__,'Chưa có menu cha !');
			return false;
		}
		return true;
	}
	public function checksort($sort)
	{
		if (0 > intval($sort) && intval($sort) > 10) {
			$this->form_validation->set_message(__FUNCTION__,'Vị trí không hợp lệ !');
			return false;
		}
		return true;
	}

	public function add()
	{
		$list = $this->football_menu_model->get_list();

		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_checkname');
			$this->form_validation->set_rules('parent', 'Parent Name', 'trim|numeric|required|callback_checkparent');
			$this->form_validation->set_rules('sort', 'Location', 'trim|required|numeric|callback_checkname');
			$this->form_validation->set_rules('site_title', 'Site title', 'trim|required|max_length[150]|min_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent');
				$sort_order = $this->input->post('sort');
				$site_title = $this->input->post('site_title');
				$meta_key = $this->input->post('meta_key');
				$meta_desc = $this->input->post('meta_desc');
				$data = array('name' => $name,
							  'site_title' => $site_title,
							  'meta_desc' => $meta_desc,
							  'meta_key' => $meta_key,
							  'parent_id' => $parent_id,
							  'sort_order' => $sort_order,
							  'create_date' => Util::convertStringDate2String(Util::getCurrentDBTime(), 'Y-m-d H:i:s', DBConfig::DATE));
				if ($this->football_menu_model->create($data)) 
				{
					$this->session->set_flashdata('message', 'Tạo menu thành công');
					redirect(admin_url('football_menu/index'));
				}else{
					$this->session->set_flashdata('message', 'Tạo menu không thành công');
					redirect(admin_url('football_menu/index'));
				}
			}
		}

		$sort_order = array();
		for ($i=0; $i < 10 ; $i++) { 
			$sort_order[$i] = $i;
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['sort_order'] = $sort_order;
		$this->data['list'] = $list;
		$this->data['temp'] = 'admin/football_menu/add';
		$this->load->view('admin/main', $this->data);
	}

	/*views info parent id*/
	public function views()
	{
		$parent_id = intval($this->uri->segment(4));
		$input = array();
		$input['where'] = array('parent_id' => $parent_id);
		$list = $this->football_menu_model->get_list($input);

		/*get list parent id*/
		$list_parent_id = $this->db->select('id, name')->where('parent_id', 0)->get('football_menu')->result();
		$sort_order = array();
		for ($i=1; $i < 10 ; $i++) { 
			$sort_order[$i] = $i;
		}
		//pre(count($list_parent_id));
		$this->data['parent_id'] = $list_parent_id;
		$this->data['sort_order'] = $sort_order;
		$this->data['list'] = $list;
		$this->data['temp'] = 'admin/football_menu/views';
		$this->load->view('admin/main', $this->data);
	}

	function action_menu()
	{
			//xử lý edit and delete
		if ($this->input->post('action') == 'edit') 
		{
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('parent','Name','required|numeric');
			$this->form_validation->set_rules('sort','Name','required|numeric');
			$this->form_validation->set_rules('site_title', 'Site title', 'trim|required|max_length[150]|min_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent');
				$sort_order = $this->input->post('sort');
				$site_title = $this->input->post('site_title');
				$id = intval($this->input->post('id'));
				$data = array( 'name' => $name,
							   'site_title' => $site_title,
							   'parent_id' => $parent_id,
							   'sort_order' => $sort_order,
							   'update_date' => date('Y-m-d'));
				if($this->football_menu_model->update($id, $data))
				{
					$this->session->set_flashdata('message','update success');
					$response = array( 'code' => 'success');
				} else 
				{
					$this->session->set_flashdata('message','update failed');
					$this->output->set_status_header('500');
					$response = array('code' => $this->session->flashdata('message'));
				}
			}
			else
			{
				$error = validation_errors();
				$this->output->set_status_header('500');
				$response = array('code' => $error);
			}
		}

		if ($this->input->post('action') == 'delete') 
		{
			$id = intval($this->input->post('id'));

			if($this->football_menu_model->delete($id))
			{
				$this->session->set_flashdata('message','Delete success');
				$response = array('code' => 'success');
			} else 
			{
				$this->session->set_flashdata('message','Delete fail');
				$this->output->set_status_header('500');
				$response = array('code' => 'fail');
			}
		}
		echo json_encode($response);
	}

}

/* End of file Football_menu.php */
/* Location: ./application/controllers/admin/Football_menu.php */