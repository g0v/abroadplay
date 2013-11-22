<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('timeline_model');
		$this->load->model('report_model');

	}	
	public function index()
	{
		$Dfrom="2012-01-01";
		$Dto="2012-12-31";
		$data['title'] = '公務員出國考察追蹤網-國家統計';
		$data['Dfrom'] = "{$Dfrom}";
		$data['Dto'] = "{$Dto}";
		$data['list'] = $this->report_model->get_country($Dfrom,$Dto);
		$this->load->view('templates/header', $data);
		$this->load->view('country', $data);
		$this->load->view('templates/footer', $data);
	}	
	public function datelist()
	{
		// This is the last name from the form
		$Dfrom = $this->report_model->searchterm_handler($this->input->get_post('Dfrom', TRUE),'Dfrom');
		$Dto = $this->report_model->searchterm_handler($this->input->get_post('Dto', TRUE),'Dto');		
		
		try
		{
			$data['title'] = '公務員出國考察追蹤網-國家統計';
			$data['Dfrom'] = "{$Dfrom}";
			$data['Dto'] = "{$Dto}";
			$data['list'] = $this->report_model->get_country($Dfrom,$Dto);
	
			$this->load->view('templates/header', $data);
			$this->load->view('country', $data);
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