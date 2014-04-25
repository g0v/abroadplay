<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abroad extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('report_model');
	}

	public function index()
	{
		$this->lists(1);
	}


	public function search($key='',$page=1)
	{

		if($key==''):
		$key =	$this->input->get_post('key', TRUE);
		redirect(base_url()."abroad/search/".urlencode($key), 'refresh');
		endif;

		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
		try
		{


			$limit = 50;

			$this->db->select('count(*) acoutns');	
			$this->db->from('abroad');		
			$this->db->where('name',urldecode($key));
			$this->db->group_by('name','agencies');
					
			$query = $this->db->get();
			$count = count($query->result());


			$start = ($page-1)*$limit;

			$this->db->select('abroad.*,a1.name as agencies,a2.name as units,count(abroad.rId) acounts');
			$this->db->from('abroad');	
			$this->db->join('authority a1', 'abroad.agencies=a1.aId');
			$this->db->join('authority a2', 'abroad.units=a2.aId');
			$this->db->where('abroad.name',urldecode($key));
			$this->db->group_by('abroad.agencies');
			$this->db->group_by('abroad.name');
			$this->db->order_by('acounts','desc');
			$this->db->order_by('abroad.agencies','asc');
			//$this->db->order_by('abroad.name','asc');
			$this->db->order_by('abroad.units','asc');
			$this->db->order_by('abroad.title','asc');
			$this->db->limit($limit,$start);
			$query = $this->db->get();

			$data['list'] = $query->result();
			//print_r($data['list']);exit;
			$this->paginationlib->initPagination("abroad/lists/",$count,$page);
			$data['pageList']   = $this->pagination->create_links();			
			$data['key'] = urldecode($key);
			$data['page'] = $page;
			$data['title'] = '出國考察統計－公務員出國考察追蹤網';
			$this->load->view('templates/header', $data);
			$this->load->view('abroad/index', $data);
			$this->load->view('templates/footer');		    
		}		
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}	

	}

	public function lists($page=1)
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
		try
		{
			$limit = 50;

			$this->db->select('count(*) acoutns');	
			$this->db->from('abroad');				
			$this->db->where('name !=','');
			$this->db->group_by('name','agencies');
			$query = $this->db->get();
			$count = count($query->result());


			$start = ($page-1)*$limit;



			$this->db->select('abroad.*,a1.name as agencies,a2.name as units,count(abroad.name) acounts');
			$this->db->from('abroad');	
			$this->db->join('authority a1', 'abroad.agencies=a1.aId');
			$this->db->join('authority a2', 'abroad.units=a2.aId');
			$this->db->group_by('abroad.agencies');
			$this->db->group_by('abroad.name');
			$this->db->order_by('acounts','desc');
			$this->db->order_by('abroad.agencies','asc');
			//$this->db->order_by('abroad.name','asc');
			$this->db->order_by('abroad.units','asc');
			$this->db->order_by('abroad.title','asc');
			$this->db->limit($limit,$start);
			$query = $this->db->get();

			$data['list'] = $query->result();
			//print_r($data['list']);exit;
			$this->paginationlib->initPagination("abroad/lists/",$count);
			$data['pageList']   = $this->pagination->create_links();			
			$data['key'] = "";
			$data['page'] = $page;
			$data['title'] = '出國考察統計－公務員出國考察追蹤網';
			$this->load->view('templates/header', $data);
			$this->load->view('abroad/index', $data);
			$this->load->view('templates/footer');		    
		}		
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}		
	}	

	public function view($key=null,$page=1)
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
		try
		{		
			$limit = 50;

			$this->db->from('abroad');
			$this->db->where('abroad.name', urldecode($key));			
			$count = $this->db->count_all_results();

			$start = ($page-1)*$limit;

			$this->db->select('abroad.*,report.*,a1.name as agencies,a2.name as units,authority.name as authority');
			$this->db->from('abroad');	
			$this->db->join('authority a1', 'abroad.agencies=a1.aId');
			$this->db->join('authority a2', 'abroad.units=a2.aId');
			$this->db->join('report', 'abroad.rId=report.id');
			$this->db->join('authority', 'report.authority=authority.aId');
			$this->db->where('abroad.name', urldecode($key));
			$this->db->order_by('report.periodStart','desc');
			$this->db->limit($limit,$start);
			$query = $this->db->get();
			$data['list'] = $query->result();

			$this->paginationlib->initPagination("abroad/view/$key",$count,$page);
			$data['pageList']   = $this->pagination->create_links();		
		
			$data['title'] = '公務員出國考察追蹤網';
			$this->load->view('templates/header', $data);
			$this->load->view('abroad/list', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */