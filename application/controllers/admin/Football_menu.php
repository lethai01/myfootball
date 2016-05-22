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
		$menu_name = $this->input->post('menu_name');
		if ($menu_name) {
			$input['like'] = array('name' => $menu_name);
		}
		
		$input['where'] = array('parent_id' => 0);
		$list = $this->football_menu_model->get_list($input);
		$this->data['list'] = $list;
		$this->data['message'] = $this->session->flashdata('message');
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
		if (!$this->football_menu_model->check_exists($check) && $parent_id != 0) {
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
		$this->load->helper('form');
		$this->data['listParent'] = $this->football_menu_model->getListParent();

		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_checkname');
			$this->form_validation->set_rules('parent_id', 'Parent Name', 'trim|numeric|required|callback_checkparent');
			$this->form_validation->set_rules('sort', 'Location', 'trim|required|numeric|callback_checksort');
			$this->form_validation->set_rules('site_title', 'Site title', 'trim|required|max_length[150]|min_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort');
				$site_title = $this->input->post('site_title');
				$data = array('name' => $name,
							  'site_title' => $site_title,
							  'parent_id' => $parent_id,
							  'sort_order' => $sort_order,
							  'create_date' => date('Y-m-d', now()));
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

		$listSort = array();
		for ($i=0; $i < 10 ; $i++) { 
			$listSort[$i] = "Location ".$i;
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['listSort'] = $listSort;
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
		
		$this->data['message'] = $this->session->flashdata('message');
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
			$id = intval($this->input->post('id'));
			$this->form_validation->set_rules('name','Name','required|callback_checkEditName[$id]');
			$this->form_validation->set_rules('parent_id','Parent','required|numeric');
			$this->form_validation->set_rules('sort','Sort','required|numeric');
			$this->form_validation->set_rules('site_title', 'Site title', 'trim|required|max_length[150]|min_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort');
				$site_title = $this->input->post('site_title');
				$data = array( 'name' => $name,
							   'site_title' => $site_title,
							   'parent_id' => $parent_id,
							   'sort_order' => $sort_order,
							   'update_date' => date('Y-m-d', now()));
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

	/*ckeck điều kiện edit*/
	function checkEditName($name,$id)
	{
		$check = $this->db->select('name')->where_not_in('id', $id)->get('football_menu')->result();
		$name_check = array();
		foreach ($check as $value) {
			array_push($name_check, $value->name);
		}
		if (in_array($name, $name_check)) 
		{
			$this->form_validation->set_message(__FUNCTION__,'Tên menu đã tồn tại !');
			return false;
		}
		return true;
	}

	/*edit menu parent*/
	public function edit()
	{
		$this->load->helper('form');
		$id = $this->uri->rsegment(3);
		$info = $this->football_menu_model->get_info($id);
		if (!$info) 
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('football_menu/index'));
			exit;
		}

		/*Xử lý edit*/
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', "trim|required|callback_checkEditName[$info->id]");
			$this->form_validation->set_rules('parent_id', 'Parent Name', 'trim|numeric|required|callback_checkparent');
			$this->form_validation->set_rules('sort', 'Location', 'trim|required|numeric|callback_checksort');
			$this->form_validation->set_rules('site_title', 'Site title', 'trim|required|max_length[150]|min_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name');
				$parent_id = $this->input->post('parent_id');
				$sort_order = $this->input->post('sort');
				$site_title = $this->input->post('site_title');
				$data = array('name' => $name,
							  'site_title' => $site_title,
							  'parent_id' => $parent_id,
							  'sort_order' => $sort_order,
							  'update_date' => Util::convertStringDate2String(Util::getCurrentDBTime(), 'Y-m-d', DBConfig::DATE));
				if ($this->football_menu_model->update($id, $data)) 
				{
					$this->session->set_flashdata('message', 'Sửa menu thành công');
					redirect(admin_url('football_menu/index'));
				}else{
					$this->session->set_flashdata('message', 'Sửa menu không thành công');
					redirect(admin_url('football_menu/index'));
				}
			}else{
				$info->name = $this->input->post('name');
				$info->site_title =  $this->input->post('site_title');
				$info->parent_id = $this->input->post('parent_id');
				$info->sort_order = $this->input->post('sort');
			}
		}


		$listSort = array();
		for ($i=0; $i < 10 ; $i++) { 
			$listSort[$i] = "Location ".$i;
		}

		$this->data['info'] = $info;
		$this->data['listParent'] = $this->football_menu_model->getListParent();
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['listSort'] = $listSort;
		$this->data['temp'] = 'admin/football_menu/edit';
		$this->load->view('admin/main', $this->data);
	}

	function delete()
	{
		$id = $this->uri->rsegment(3);
		$info = $this->football_menu_model->get_info($id);
		if (!$info) 
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('football_menu/index'));
			exit;
		}elseif($this->football_menu_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công : ' . $info->name);
			redirect(admin_url('football_menu/index'));
			exit;
		}else{
			$this->session->set_flashdata('message', 'Xóa không thành công : ' . $info->name);
			redirect(admin_url('football_menu/index'));
			exit;
		}

	}

	/*delete all*/
	public function delete_all()
	{
		if ($this->input->post('delall') == 'delete_all' && $this->input->post('ids') != null) {
			$id_arr = $this->input->post('ids');
			if ($this->db->where_in('id', $id_arr)->delete('football_menu')) 
			{
				$this->session->set_flashdata('message', 'Xóa thành công : ');
				redirect(admin_url('football_menu/index'));
				exit;
			}else{
				$this->session->set_flashdata('message', 'Xóa không thành công : ');
				redirect(admin_url('football_menu/index'));
				exit;
			}
		}else{
			redirect(admin_url('football_menu/index'));
			exit;
		}

	}
}

/* End of file Football_menu.php */
/* Location: ./application/controllers/admin/Football_menu.php */