<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Football_menu_model extends MY_Model {
	var $table = 'football_menu';
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	function getparent()
	{
		$input = array( 'select' => array('name', 'id'),
						'where' => array('parent_id' => 2));
		$option = $this->football_menu_model->get_list($input);
		$options = array();
		foreach ($option as $row) 
		{
			$options[$row->id] = $row->name;
		}
		return $options;
	}
}

/* End of file Football_spain_model.php */
/* Location: ./application/models/Football_spain_model.php */