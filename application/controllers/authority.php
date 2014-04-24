<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authority extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('report_model');

	}

	public function index()
	{
		try
		{
			$arr = array();
			$temp = $this->getlist(0);
			//print_r($temp);
			foreach ($temp as $key=>$value) {
				$list = $this->getlist($value->group_id,2);
				$temp ='';
				foreach ($list as $value1) {
					$list2 = $this->getlist($value1->group_id,2);
					$temp2 = "";
					foreach ($list2 as $value2) {
						$temp2[] = array("name"=>$value2->org_name,"url"=>"" );
					}
					$temp[] = array("name"=>$value1->org_name,"url"=>"","list"=>$temp2);
				}
				$arr[] = array('name'=>$value->org_name,'list'=>$temp );
			}
			//print_r($arr);
			$data['title'] = '公務員出國考察追蹤網';
			$data['list'] = $arr;	
	
			$this->load->view('templates/header', $data);
			$this->load->view('authority/index', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
	}
	public function catetype($set=1)
	{
		try
		{
			$arr = array();
			$temp = $this->getlist($set,2);
			foreach ($temp as $key=>$value) {
				$list = $this->getlist($value->id,2);
				if(count($list)>0):
					$temp =null;
					foreach ($list as $value1) 
					{
						$cateId = $value1->id;
						$this->db->from('report');
						$this->db->where('pcId',$cateId);
						$count = $this->db->count_all_results();	
						$temp[] = array('name'=>$value1->cateName,"url"=>"/category/catelist/2_".$cateId."_1","count"=>$count);
					}

					$cateId = $value->id;
					$this->db->from('report');
					$this->db->where('pcId',$cateId);
					$count = $this->db->count_all_results();	

					$arr[] = array('id'=>$value->id,'name'=>$value->cateName,'count','list'=>$temp,'url'=>"/category/catelist/2_".$cateId."_1","count"=>$count );
					//print_r($arr);exit;
				endif;
			}
			$data['title'] = '公務員出國考察追蹤網';
			$data['cateList'] = $this->getlist(0,2);
			$data['list'] = $arr;	
	
			$this->load->view('templates/header', $data);
			$this->load->view('category/catetype2', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
	}

	public function catelist($set="1_1_1")
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');		
		try
		{
			$limit = 50;
			$temp = explode('_', $set);
			$cateType = $temp[0];
			$cateId = $temp[1];
			$page = ($temp[2])?$temp[2]:'1';

			$this->db->from('category');
			$this->db->where('id =',$cateId);
			$query = $this->db->get();	
			$cateName = $query->result();

			$this->db->from('category');
			$this->db->where('id =',$cateName[0]->cateBid);
			$query = $this->db->get();	
			$tcateName = $query->result();

			$this->db->from('report');
			if($cateType==1)
				$this->db->where('scId2',$cateId);
			else
				$this->db->where('pcId',$cateId);
			
			$count = $this->db->count_all_results();
			
			$start = ($page-1)*$limit;

			$this->db->select('report.*,authority.name as authority');
			$this->db->from('report');
			$this->db->join('authority', 'report.authority=authority.aId');			
			if($cateType==1)
				$this->db->where('report.scId2',$cateId);
			else
				$this->db->where('report.pcId',$cateId);

			$this->db->order_by('report.reportDate','desc');
			$this->db->limit($limit,$start);
			$query = $this->db->get();
			
			$data['list'] = $query->result();

			//print_r($data['list']);

			$data['title'] = '公務員出國考察追蹤網';
			
			$this->paginationlib->initPagination("category/catelist",$count);
			$data['pageList']   = $this->pagination->create_links();
			$data['cateName'] = $cateName;
			$data['tcateName'] = $tcateName;

	
			$this->load->view('templates/header', $data);
			$this->load->view('category/list', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
	}

	public function getlist($id=0,$level=1){
		$this->db->from('orginfo');
		$this->db->where('director_id',$id);
		$this->db->where('org_level',$level);
		$this->db->order_by('group_id','asc');
		$query = $this->db->get();	
		return $query->result();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */