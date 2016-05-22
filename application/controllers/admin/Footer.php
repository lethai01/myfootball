<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends MY_Controller {
	const PAGING_NUMBER_PER_PAGE = 10;
	const PAGING_NUM_LINKS = 2;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('football_footer_model');
	}
	public function index()
	{
		$this->load->helper('text');
		$input = array();

		$type = $this->input->post('type');
		if ($type && $type != 0) {
			$input['where'] = array('type' => $type);
		}
		/*phân trang*/		
		$this->load->library('pagination');
		/*set gia tri so row cua 1 trang*/
		$num_per_page = $this->input->post('num_per_page');
		if (!$num_per_page) {
			$num_per_page = self::PAGING_NUMBER_PER_PAGE;
		}
		$this->data['num_per_page'] = $num_per_page;
		/*config gia tri ban dau cua paging*/
		$config = array();
		$config['per_page']   = $num_per_page;//so luong san pham hien thi tren 1 trang
        $config['num_links']  = self::PAGING_NUM_LINKS;
        $start = $this->uri->segment(4);
        $start = intval($start);
        $input['limit'] = array($config['per_page'], $start);
		$total = $this->football_footer_model->get_total($input);
        $config['base_url']   = admin_url('bad_number/index'); //link hien thi ra danh sach san pham
        $config['next_link']  = '>>';
        $config['prev_link']  = '<<';
        $config['total_rows'] = $total;//tong tat ca cac san pham tren website
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
		/*lấy số dòng trên 1 trang*/
		$row_of_page = array(
			'5' => '5',
			'10' => '10',
			'15' => '15',
			'20' => '20'
		);
        $this->data['row_of_page'] = $row_of_page;
        /*Set gia tri dau va cuoi cua paging*/
		$this->data['start'] = $start + 1;
		if($start + $num_per_page < $total)
			$this->data['end'] = $start + $num_per_page;
		else
			$this->data['end'] = $total;
		$options = array( '0' => 'All',
						  TypeConfig::ADMIN => 'Admin',
						  TypeConfig::PAGE => 'Page');
		$list = $this->football_footer_model->get_list($input);
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['total_rows'] = $total;
		$this->data['options'] = $options;
		$this->data['list'] = $list;
		$this->load->model('football_footer_model');
		$this->data['temp'] = 'admin/footer/index';
		$this->load->view('admin/main', $this->data);
	}

	/*kiểm tra tính hợp lệ của dữ liệu*/
	function checkVersion($version)
	{
		$check = array('version' => $version);
		if ($this->football_footer_model->check_exists($check)) {
			$this->form_validation->set_message(__FUNCTION__,'Version này đã dược tạo !');
			return false;
		}
		return true;
	}
	function checkType($type)
	{
		if (intval($type) == TypeConfig::ADMIN || intval($type) == TypeConfig::PAGE) 
		{
			return true;
		}else{
			$this->form_validation->set_message(__FUNCTION__,'Vị trí hiển thị không hợp lệ !');
			return false;
		}
		
	}
	public function add()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('version', 'Version', 'trim|required|min_length[5]|max_length[20]|callback_checkVersion');
			$this->form_validation->set_rules('type', 'Display', 'trim|required|numeric|callback_checkType');
			$this->form_validation->set_rules('intro', 'Version', 'trim|required|min_length[5]|max_length[250]');
			if ($this->form_validation->run() == TRUE) 
			{
				$version = $this->input->post('version');
				$intro = $this->input->post('intro');
				$type = $this->input->post('type');
				$content_left = $this->input->post('content_left');
				$content_right = $this->input->post('content_right');
				$create_date = date(DBConfig::DATE);
				$data = array('version' => $version,
							  'intro' => $intro,
							  'type' => $type,
							  'content_left' => $content_left,
							  'content_right' => $content_right,
							  'create_user' => 1,
							  'create_date' => $create_date);
				if ($this->football_footer_model->create($data)) {					
					$this->session->set_flashdata('message', 'Thêm mới thành công');
					redirect(admin_url('footer/index'));
					exit;
				}else{
					$this->session->set_flashdata('message', 'Thêm mới thất bại');
					redirect(admin_url('footer/index'));
					exit;
				}
			}
		}
		$options = array(TypeConfig::ADMIN => 'Admin',
						TypeConfig::PAGE => 'Page');
		$this->data['options'] = $options;
		$this->data['temp'] = 'admin/footer/add';
		$this->load->view('admin/main', $this->data);
	}

	function checkEditVersion($version, $id)
	{
		$check = $this->db->select('version')->where_not_in('id', $id)->get('footer')->result();
		$version_check = array();
		foreach ($check as $value) {
			array_push($version_check, $value->version);
		}
		if (in_array($version, $version_check)) {
			$this->form_validation->set_message(__FUNCTION__,'Version đã tồn tại !');
			return false;
		}
		return true;
	}
	/*chỉnh sửa*/
	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$info = $this->football_footer_model->get_info($id);
		if (!$info) {
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('footer/index'));
			exit;
		}

		/*edit*/
		if ($this->input->post()) {
			$this->form_validation->set_rules('version', 'Version', "trim|required|min_length[5]|max_length[20]|callback_checkEditVersion[$info->id]");
			$this->form_validation->set_rules('type', 'Display', 'trim|required|numeric|callback_checkType');
			$this->form_validation->set_rules('intro', 'Version', 'trim|required|min_length[5]|max_length[250]');

			if ($this->form_validation->run() == TRUE) {
				$version = $this->input->post('version');
				$intro = $this->input->post('intro');
				$type = $this->input->post('type');
				$content_left = $this->input->post('content_left');
				$content_right = $this->input->post('content_right');
				$update_date = date(DBConfig::DATE);
				$data = array('version' => $version,
							  'intro' => $intro,
							  'type' => $type,
							  'content_left' => $content_left,
							  'content_right' => $content_right,
							  'update_user' => 1,
							  'update_date' => $update_date);
				if ($this->football_footer_model->update($id, $data)) {					
					$this->session->set_flashdata('message', 'Sửa thành công');
					redirect(admin_url('footer/index'));
					exit;
				}else{
					$this->session->set_flashdata('message', 'Sửa thất bại');
					redirect(admin_url('footer/index'));
					exit;
				}
			} else {
				$info->version = $this->input->post('version');
				$info->intro = $this->input->post('intro');
				$info->type = $this->input->post('type');
				$info->content_left = $this->input->post('content_left');
				$info->content_right = $this->input->post('content_right');
			}
		}
		$options = array(TypeConfig::ADMIN => 'Admin',
						TypeConfig::PAGE => 'Page');
		$this->data['info'] = $info;
		$this->data['options'] = $options;
		$this->data['temp'] = 'admin/footer/edit';
		$this->load->view('admin/main', $this->data);
	}

	/*function delete with id*/
	function delete()
	{
		$id = $this->uri->rsegment(3);
		$info = $this->football_footer_model->get_info($id);
		if (!$info) 
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('footer/index'));
			exit;
		}elseif($this->football_footer_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công  : ' . $info->version);
			redirect(admin_url('footer/index'));
			exit;
		}else{
			$this->session->set_flashdata('message', 'Xóa không thành công : ' . $info->version);
			redirect(admin_url('footer/index'));
			exit;
		}

	}
	/*delete all*/
	public function delete_all()
	{
		if ($this->input->post('delall') == 'delete_all' && $this->input->post('ids') != null) {
			$id_arr = $this->input->post('ids');
			if ($this->db->where_in('id', $id_arr)->delete('footer')) 
			{
				$this->session->set_flashdata('message', 'Xóa thành công : ');
				redirect(admin_url('footer/index'));
				exit;
			}else{
				$this->session->set_flashdata('message', 'Xóa không thành công : ');
				redirect(admin_url('footer/index'));
				exit;
			}
		}else{
			redirect(admin_url('footer/index'));
			exit;
		}

	}

}

/* End of file Footer.php */
/* Location: ./application/controllers/admin/Footer.php */