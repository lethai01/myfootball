<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Spain extends MY_Controller {
	const PAGING_NUMBER_PER_PAGE = 10;
	const PAGING_NUM_LINKS = 2; 

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('football_spain_model');
		$this->load->library('form_validation');
		$this->load->model('football_menu_model');
		$this->load->model('football_tags_model');

	}

	public function index()
	{
		$this->load->helper('form');
		$input = array( 'select' => array('spain.id','title', 'image_link','image_thumb', 'views', 'football_menu.name as name', 			 'tags','spain.create_user', 'spain.create_date', 'spain.update_user', 'spain.update_date'),
						'join' => array(array('football_menu', 'football_menu.id = spain.parent_id', 'left')));
		$title = $this->input->post('title');
		if ($title) {
			$input['like'] = array('title' => $title);
		}
		/*lấy số dòng trên một trang*/
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
		$total = $this->football_spain_model->get_total($input);
        $config['base_url']   = admin_url('spain/index'); //link hien thi ra danh sach san pham
        $config['next_link']  = '>>';
        $config['prev_link']  = '<<';
        $config['total_rows'] = $total;//tong tat ca cac san pham tren website
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        /*dropdown so dong cua 1 trang*/
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

		$list = $this->football_spain_model->get_list($input);
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total;
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'admin/spain/index';
		$this->load->view('admin/main', $this->data);
	}
	public function views()
	{
		$id = intval($this->uri->segment(4));
		if ($id) 
		{
			$list = $this->football_spain_model->get_list($id);
			$this->data['list'] = $list;
			pre($list);
			$this->data['temp'] = 'admin/spain/views';
			$this->load->view('admin/main', $this->data);
		}
	}

	/*kiểm tra sự hợp lệ của parent id*/
	function checkParent($pid)
	{
		$listParent = $this->football_menu_model->getChilParent(2);
		if (!array_key_exists($pid, $listParent)) 
		{
			$this->form_validation->set_message(__FUNCTION__,'Menu cha không hợp lệ !');
			return false;
		}
		return true;
	}
	public function edit()
	{
		$this->load->helper('form');
		$id = $this->uri->rsegment(3);
		$info = $this->football_spain_model->get_info($id);
		if (!$info)
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('spain/index'));
			exit;
		}

		/*editing*/
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[150]');
			$this->form_validation->set_rules('intro', 'Intro', 'required|max_length[300]');
			$this->form_validation->set_rules('image_link', 'Image Link', 'required|max_length[300]');
			$this->form_validation->set_rules('parent_id', 'Parent ', 'required|callback_checkParent');
			$this->form_validation->set_rules('tags[]', 'Tags', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');
			if ($this->form_validation->run() == TRUE) 
			{
				$title = $this->input->post('name');
				$intro = $this->input->post('intro');
				$meta_key = $this->input->post('meta_key');
				$meta_desc = $this->input->post('meta_desc');
				$image_link = $this->input->post('image_link');
				$image_thumb_arr_r = explode('/', $image_link);

				/*get link thumbs image*/
				$count = count($image_thumb_arr_r);
				$image_thumb_arr = array_replace($image_thumb_arr_r, array(($count -2) => '_thumbs'));
				$image_thumb_arr = array_replace($image_thumb_arr, array(($count - 1) => $image_thumb_arr_r[$count - 2]));
				$image_thumb_arr = array_replace($image_thumb_arr, array(($count) => $image_thumb_arr_r[$count - 1]));
				$image_thumb = implode('/', $image_thumb_arr);

				$parent_id = $this->input->post('parent_id');
				$tags = implode(',', $this->input->post('tags[]'));
				$content = $this->input->post('content');

				$update_date = date(DBConfig::DATE);
				/*Tiến hành edit vào database*/
				$data = array(	'title' => $title,
								'content' => $content,
								'meta_desc' => $meta_desc,
								'meta_key' => $meta_key,
								'image_link' => $image_link,
								'image_thumb' => $image_thumb,
								'intro' => $intro,
								'parent_id' => $parent_id,
								'tags' => $tags,
								'update_date' => $update_date);
				if ($this->football_spain_model->update($id, $data)) 
				{
					$this->session->set_flashdata('message', 'Sửa thành công');
					redirect(admin_url('spain/index'));
					exit;
				}else{
					$this->session->set_flashdata('message', 'Sửa thất bại');
					redirect(admin_url('spain/index'));
					exit;
				}
			}else{
				$info->tags = $tags = implode(',', $this->input->post('tags[]'));
				$info->title = $this->input->post('name');
				$info->intro = $this->input->post('intro');
				$info->meta_key = $this->input->post('meta_key');
				$info->meta_desc = $this->input->post('meta_desc');
				$info->image_link = $this->input->post('image_link');
				$info->parent_id = $this->input->post('parent_id');
				$info->content =  $this->input->post('content');
			}
		}
		/*send data to views*/
		$this->data['info'] = $info;				
		$this->data['options'] = $this->football_menu_model->getChilParent(null, $info->parent_id);
		$this->data['list_tags'] = $this->football_tags_model->gettags();
		$this->data['temp'] = 'admin/spain/edit';
		$this->load->view('admin/main', $this->data);
	}
	/*add content spain*/
	public function add()
	{
		$this->load->helper('form');
		$this->data['options'] = $this->football_menu_model->getChilParent(2);

		$this->data['list_tags'] = $this->football_tags_model->gettags();
		
		/*kiểm tra thêm mới*/
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[150]');
			$this->form_validation->set_rules('intro', 'Intro', 'required|max_length[300]');
			$this->form_validation->set_rules('image_link', 'Image Link', 'required|max_length[300]');
			$this->form_validation->set_rules('parent_id', 'Parent ', 'required|callback_checkParent');
			$this->form_validation->set_rules('tags[]', 'Tags', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');
			if ($this->form_validation->run() == TRUE) 
			{
				$title = $this->input->post('name');
				$intro = $this->input->post('intro');
				$meta_key = $this->input->post('meta_key');
				$meta_desc = $this->input->post('meta_desc');
				$image_link = $this->input->post('image_link');
				$image_thumb_arr_r = explode('/', $image_link);

				/*get link thumbs image*/
				$count = count($image_thumb_arr_r);
				$image_thumb_arr = array_replace($image_thumb_arr_r, array(($count -2) => '_thumbs'));
				$image_thumb_arr = array_replace($image_thumb_arr, array(($count - 1) => $image_thumb_arr_r[$count - 2]));
				$image_thumb_arr = array_replace($image_thumb_arr, array(($count) => $image_thumb_arr_r[$count - 1]));
				$image_thumb = implode('/', $image_thumb_arr);

				$parent_id = $this->input->post('parent_id');
				$tags = implode(',', $this->input->post('tags[]'));
				$content = $this->input->post('content');

				$create_date = date(DBConfig::DATE);

				/*Tiến hành insert vào database*/
				$data = array(	'title' => $title,
								'content' => $content,
								'meta_desc' => $meta_desc,
								'meta_key' => $meta_key,
								'image_link' => $image_link,
								'image_thumb' => $image_thumb,
								'intro' => $intro,
								'views' => 0,
								'parent_id' => $parent_id,
								'tags' => $tags,
								'create_date' => $create_date);
				if($this->football_spain_model->create($data))
				{
					$this->session->set_flashdata('message', 'Thêm mới thành công');
					redirect(admin_url('spain/index'));
					exit;
				}else{
					$this->session->set_flashdata('message', 'Thêm mới thất bại');
					redirect(admin_url('spain/index'));
					exit;
				}
			} 
		}

		$this->data['temp'] = 'admin/spain/add';
		$this->load->view('admin/main', $this->data);
	}

	/*function delete with id*/
	function delete()
	{
		$id = $this->uri->rsegment(3);
		$info = $this->football_spain_model->get_info($id);
		if (!$info) 
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('spain/index'));
			exit;
		}elseif($this->football_spain_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công bài viết : ' . $info->title);
			redirect(admin_url('spain/index'));
			exit;
		}else{
			$this->session->set_flashdata('message', 'Xóa không thành công bài viết : ' . $info->title);
			redirect(admin_url('spain/index'));
			exit;
		}

	}
	/*delete all*/
	public function delete_all()
	{
		if ($this->input->post('delall') == 'delete_all' && $this->input->post('ids') != null) {
			$id_arr = $this->input->post('ids');
			if ($this->db->where_in('id', $id_arr)->delete('spain')) 
			{
				$this->session->set_flashdata('message', 'Xóa thành công : ');
				redirect(admin_url('spain/index'));
				exit;
			}else{
				$this->session->set_flashdata('message', 'Xóa không thành công : ');
				redirect(admin_url('spain/index'));
				exit;
			}
		}else{
			redirect(admin_url('spain/index'));
			exit;
		}

	}

}

/* End of file spain.php */
/* Location: ./application/controllers/admin/spain.php */