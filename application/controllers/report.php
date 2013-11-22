<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('report_model');
	}
	public function index()
	{
		redirect(base_url().'report/lists/', 'refresh');
	}
	
	public function search($page=1)
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
		try
		{
			// This is the last name from the form
			$Dfrom = $this->report_model->searchterm_handler($this->input->get_post('Dfrom', TRUE),'Dfrom');
			$Dto = $this->report_model->searchterm_handler($this->input->get_post('Dto', TRUE),'Dto');			
			$key =	$this->report_model->searchterm_handler($this->input->get_post('key', TRUE));
			
			$data['title'] = '公務員出國考察追蹤網';
			$data['Dfrom'] = "{$Dfrom}";
			$data['Dto'] = "{$Dto}";			
			$data['key'] = "{$key}";
			$data['list'] = $this->report_model->get_search($key,$Dfrom,$Dto,$page);
			$this->paginationlib->initPagination("report/search",$this->report_model->get_count());
			$data['pageList']   = $this->pagination->create_links();		
	
			$this->load->view('templates/header', $data);
			$this->load->view('report/list', $data);
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
			$data['title'] = '公務員出國考察追蹤網';
			$data['list'] = $this->report_model->get_list($page);
			$this->paginationlib->initPagination("report/lists",$this->report_model->get_count());
			$data['pageList']   = $this->pagination->create_links();			
			$data['Dfrom'] = "";
			$data['Dto'] = "";			
			$data['key'] = "";
			$data['page'] = $page;
			$this->load->view('templates/header', $data);
			$this->load->view('report/list', $data);
			$this->load->view('templates/footer');		    
		}		
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}		
	}	

	public function view($id=null)
	{
		if($id!='')
		{
			$data['item'] = $this->report_model->get_report($id);
	
			if (empty($data['item']))
			{
				log_message("error", $err->getMessage());
				return show_error($err->getMessage());
			}
	
			$data['title'] = $data['item']['sysid'].'-'.$data['item']['reportName'];
	
			$this->load->view('templates/header', $data);
			$this->load->view('report/view', $data);
			$this->load->view('templates/footer');
		}
		else
			redirect(base_url().'report/lists/', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */