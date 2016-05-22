<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Football_menu_model extends MY_Model {
	var $table = 'football_menu';
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	function getChilParent($parent_id, $chil_id = null)
	{	if (!isset($parent_id) || $parent_id == null && isset($chil_id) && $chil_id != null) 
		{
			$parent_id = $this->getRootParent($chil_id);
		}
		$query = $this->db->select('name, id')->where('parent_id', $parent_id)->get('football_menu')->result();
		$options = array();
		foreach ($query as $row) 
		{
			$options[$row->id] = $row->name;
		}
		return $options;
	}
	function getRootParent($chil_id)
	{
		$input = array( 'select' => array('parent_id'),
						'where' => array('id' => $chil_id));
		$query = $this->db->select('parent_id')->where('id', $chil_id)->get('football_menu')->result();
		return $query[0]->parent_id;
	}
	function getListParent()
	{
		$query = $this->db->select('id, name')->get('football_menu')->result();
		$listParent = array();
		$listParent[0] = 'Parent';
		foreach ($query as $value) {
			$listParent[$value->id] = $value->name;
		}
		return $listParent;
	}
}

/* End of file Football_spain_model.php */
/* Location: ./application/models/Football_spain_model.php */