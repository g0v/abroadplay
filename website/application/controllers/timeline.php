<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('timeline_model');
		$this->load->model('report_model');

	}	
	public function index()
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');

		$data['title'] = '公務員出國考察追蹤網TimeLine';
		$data['Dfrom'] = "";
		$data['Dto'] = "";
		$data['list'] = array();
		$data['pageList']   = $this->pagination->create_links();	
		$this->load->view('templates/header', $data);
		$this->load->view('timeline', $data);
		$this->load->view('templates/footer', $data);
		
	}	
	public function datelimit($page=1)
	{
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
		try
		{
			// This is the last name from the form
			$Dfrom = $this->report_model->searchterm_handler($this->input->get_post('Dfrom', TRUE));
			$Dto = $this->report_model->searchterm_handler($this->input->get_post('Dto', TRUE));
			$data['title'] = '公務員出國考察追蹤網';
			
			$data['Dfrom'] = "{$Dfrom}";
			$data['Dto'] = "{$Dto}";
			$data['list'] = $this->report_model->get_datelimit($Dfrom,$Dto,$page);
			$this->paginationlib->initPagination("timeline/datelimit",$this->report_model->get_count());
			$data['pageList']   = $this->pagination->create_links();		
	
			$this->load->view('templates/header', $data);
			$this->load->view('timeline', $data);
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