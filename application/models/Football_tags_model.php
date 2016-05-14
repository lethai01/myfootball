<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Football_tags_model extends MY_Model {

	var $table = 'tags';
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function gettags()
	{
		$tags_query = $this->db->select('id, name')->get('tags')->result();
		$tags = array();
		foreach ($tags_query as $key => $tag) 
		{
			$tags[$tag->id] = $tag->name;
		}
		return $tags;
	}
	public function get_tags_name($tags_id)
	{
		$this->db->select('name');
		$this->db->where_in('id', $tags_id);
		$tags_query = $this->db->get('tags')->result();
		if ($tags_query) {
			return $tags_query;
		}
		return false;
	}
}

/* End of file Football_spain_model.php */
/* Location: ./application/models/Football_spain_model.php */