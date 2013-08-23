<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	//取得資料物件
	public function get_count()
	{
		$sql = "SELECT count(*) counts FROM report";
		$query = $this->db->query($sql);		
		$row = $query->row_array();
		return $row['counts'];
	}
	
	//取得資料列表
	public function get_list($page = 1,$limit = 50)
	{
		$start = ($page-1)*$limit;
		$sql = "SELECT report.*,authority.name as authority FROM report LEFT JOIN authority on report.authority=authority.aId order by report.reportDate desc LIMIT ? , ?";
		$query = $this->db->query($sql, array($start, $limit));		
		return $query->result();
	}
	
	//取得資料物件	
	public function get_report($id = FALSE)
	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('report');
			//return $query->result_array();
			return;
		}
		
		$sql = "SELECT report.*,authority.name as authority FROM report LEFT JOIN authority on report.authority=authority.aId where report.id=? ";		
		$query = $this->db->query($sql, array($id));
		$row = $query->row_array();
		
		
		$scId = $row['scId'];
		$pcId = $row['pcId'];
		$aCategory = $row['aCategory'];
		
		return $row;
	}
}