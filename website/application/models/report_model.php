<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_list($page = 1,$limit = 50)
	{
		$start = ($page-1)*$limit;
		$sql = "SELECT * FROM report LIMIT ? , ?";
		$query = $this->db->query($sql, array($start, $limit));		
		return $query->result();
	}	
		
	public function get_report($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('report');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('report', array('id' => $id));
		return $query->row_array();
	}
}