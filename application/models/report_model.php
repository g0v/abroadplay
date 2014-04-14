<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	public $count;
	
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');	
	}

	//取得資料物件
	public function get_count()
	{
		return $this->count;
	}
	
	//取得資料列表
	public function get_list($page = 1,$limit = 50)
	{
		$this->db->from('report');
		$this->count = $this->db->count_all_results();
		
		$start = ($page-1)*$limit;
		$this->db->select('report.*,authority.name as authority');
		$this->db->from('report');
		$this->db->join('authority', 'report.authority=authority.aId');
		$this->db->order_by('report.reportDate','desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		
		return $query->result();
	}

	//取得搜索資料列表
	public function get_search($key = null,$Dfrom = null,$Dto = null,$page = 1,$limit = 50)
	{
		
		$this->db->select('report.*,authority.name as authority');
		$this->db->from('report');
		$this->db->join('authority', 'report.authority=authority.aId');
		if($Dfrom)
		$this->db->where('report.periodStart >=',$Dfrom);
		if($Dto)
		$this->db->where('report.periodEnd <=',$Dto);
		if($key):
		$where = "(report.name like '%$key%' or report.keyword like '%$key%' OR report.report like '%$key%' OR authority.name like '%$key%')";
		$this->db->where($where);
		endif;
		$this->count = $this->db->count_all_results();

		//$query = $this->db->query($sql,array($key));		
		//$row = $query->row_array();
		//$this->count = $row['counts'];
		
		$start = ($page-1)*$limit;
		$this->db->select('report.*,authority.name as authority');
		$this->db->from('report');
		$this->db->join('authority', 'report.authority=authority.aId');
		if($Dfrom)
		$this->db->where('report.periodStart >=',$Dfrom);
		if($Dto)
		$this->db->where('report.periodEnd <=',$Dto);
		if($key):
		$where = "(report.name like '%$key%' or report.keyword like '%$key%' OR report.report like '%$key%' OR authority.name like '%$key%')";
		$this->db->where($where);
		endif;
		$this->db->order_by('report.reportDate','desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		
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
	
	//取得搜索資料列表
	public function get_datelimit($Dfrom = null,$Dto = null,$page = 1,$limit = 50)
	{

		$this->db->select('report.*,authority.name as authority');
		$this->db->from('report');
		$this->db->join('authority', 'report.authority=authority.aId');
		$this->db->where('report.periodStart >=',$Dfrom);
		$this->db->where('report.periodEnd <=',$Dto);
		$this->count = $this->db->count_all_results();

		//$query = $this->db->query($sql,array($key));		
		//$row = $query->row_array();
		//$this->count = $row['counts'];
		
		$start = ($page-1)*$limit;
		$this->db->select('report.*,authority.name as authority');
		$this->db->from('report');
		$this->db->join('authority', 'report.authority=authority.aId');
		$this->db->where('report.periodStart >=',$Dfrom);
		$this->db->where('report.periodEnd <=',$Dto);
		$this->db->order_by('report.reportDate','desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		
		return $query->result();
	}

	//取得國家筆數
	public function get_country($Dfrom = null,$Dto = null)
	{
		$this->db->select("count(*) as cnt,authority.name as cName");
		$this->db->from('report');
		$this->db->join('country', 'country.rId=report.id');
		$this->db->join('authority', 'country.aId=authority.aId');
		$this->db->where('report.periodStart >=',$Dfrom);
		$this->db->where('report.periodEnd <=',$Dto);
		$this->db->group_by("authority.name"); 
		$this->db->order_by('cnt','desc');
		$query = $this->db->get();
		//$arr = $query->result();
		//print_r($arr);
		return $query->result();
	}	

	public function searchterm_handler($searchterm,$key='searchterm')
	{
	    if($searchterm)
	    {
			$this->session->set_userdata($key, $searchterm);
			return $searchterm;
	    }
	    elseif($this->session->userdata($key))
	    {
			$searchterm = $this->session->userdata($key);
			return $searchterm;
	    }
	    else
	    {
			$searchterm ="";
			return $searchterm;
	    }
	}	
}