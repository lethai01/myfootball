<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Spain extends MY_Controller {

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
		$input = array( 'select' => array('spain.id','title', 'image_link', 'views', 'football_menu.name as name', 'tags',
			 			'spain.create_user', 'spain.create_date'),
						'join' => array(array('football_menu', 'football_menu.id = spain.parent_id', 'left')));
		$list = $this->football_spain_model->get_list($input);
		$this->data['list'] = $list;
		
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

	public function edit()
	{
		$id = $this->uri->rsegment(3);
		$info = $this->football_spain_model->get_info($id);
		if (!$info) 
		{
			$this->session->set_flashdata('message', 'Không có thông tin phù hợp');
			redirect(admin_url('spain/index'));
			exit;
		}
		$this->data['info'] = $info;				
		$this->data['options'] = $this->football_menu_model->getparent();
		$this->data['tags'] = $this->football_tags_model->gettags();

		$this->data['temp'] = 'admin/spain/edit';
		$this->load->view('admin/main', $this->data);
	}
	/*add content spain*/
	public function add()
	{
		$this->load->helper('form');
		$input = array( 'select' => array('name', 'id'),
						'where' => array('parent_id' => 2));
		$option = $this->football_menu_model->get_list($input);
		$options = array();
		foreach ($option as $key => $row) 
		{
			$options[$row->id] = $row->name;
		}
		$this->data['options'] = $options;

		$tags_query = $this->db->select('id, name')->get('tags')->result();
		$tags = array();
		foreach ($tags_query as $key => $tag) 
		{
			$tags[$tag->id] = $tag->name;
		}
		$this->data['tags'] = $tags;
		
		/*kiểm tra thêm mới*/
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[150]');
			$this->form_validation->set_rules('intro', 'Intro', 'required|max_length[300]');
			$this->form_validation->set_rules('parent_id', 'Parent ', 'required');
			$this->form_validation->set_rules('tags[]', 'Tags', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');
			if ($this->form_validation->run() == TRUE) 
			{
				$title = $this->input->post('name');
				$intro = $this->input->post('intro');
				$meta_key = $this->input->post('meta_key');
				$meta_desc = $this->input->post('meta_desc');
				$image_link = $this->input->post('image_link');
				$parent_id = $this->input->post('parent_id');
				$tags = implode(',', $this->input->post('tags[]'));
				$content = $this->input->post('content');

				/*xử lý ảnh gửi lên*/
				/*$path = 'public/uploads/spain';
				$path_thumb = $path. '/' .'thumb';
				$prefix = 'myfootball_spain';
				$image_link_temp = $this->upload_football->uploadThubm('image_link', $path, $prefix, $path_thumb);
				if ($image_link_temp) 
				{
					$image_link = $image_link_temp;
				}
				$image_list_temp = $this->upload_football->uploadmutiimage($_FILES['image_list'], $path, $prefix);
				if ($image_list_temp) 
				{
					$image_list = implode(',', $image_list_temp);
				}*/
				$create_date = date(DBConfig::DATE);

				/*Tiến hành insert vào database*/
				$data = array(	'title' => $title,
								'content' => $content,
								'meta_desc' => $meta_desc,
								'meta_key' => $meta_key,
								'image_link' => $image_link,
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


		
		$this->data['option'] = $option;
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

}

/* End of file spain.php */
/* Location: ./application/controllers/admin/spain.php */