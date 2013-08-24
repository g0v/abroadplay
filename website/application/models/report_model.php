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
		
		$sql = "SELECT report.*,a1.name as authority,a2.name as scId,a3.name as pcId,a4.name as aCategory FROM report
		LEFT JOIN authority a1 on report.authority=a1.aId
		LEFT JOIN authority a2 on report.scId=a2.aId
		LEFT JOIN authority a3 on report.pcId=a3.aId
		LEFT JOIN authority a4 on report.aCategory=a4.aId
		where report.id=? ";		
		$query = $this->db->query($sql, array($id));
		$row = $query->row_array();
		
		$sql = "SELECT a1.name FROM country
		LEFT JOIN authority a1 on country.aId=a1.aId
		where country.rId=?";
		$query = $this->db->query($sql, array($id));
		$row['country'] = $query->result();
		
		$sql = "SELECT abroad.*,a1.name as agencies,a2.name as units FROM abroad
		LEFT JOIN authority a1 on abroad.agencies=a1.aId
		LEFT JOIN authority a2 on abroad.units=a2.aId
		where abroad.rId=?";
		$query = $this->db->query($sql, array($id));
		$row['abroad'] = $query->result();		

		$sql = "SELECT * FROM file where rId=?";
		$query = $this->db->query($sql, array($id));
		$row['file'] = $query->result();
		
		return $row;
	}
}