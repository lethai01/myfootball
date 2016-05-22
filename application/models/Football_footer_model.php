<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Football_footer_model extends MY_Model {

	var $table = 'footer';
	function getFooter($type)
	{
		return	$this->db->select()->where('type', $type)->order_by('id', 'DESC')->limit(1,0)->get('footer')->result()[0];
	}	

}

/* End of file Football_footer_model.php */
/* Location: ./application/models/Football_footer_model.php */