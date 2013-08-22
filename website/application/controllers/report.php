<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('report_model');
	}

	public function index()
	{
		$this->showlist(1);
	}
	
	public function showlist($page)
	{
		$data['list'] = $this->report_model->get_list($page);
		
		//print_r($data['list']);exit();
		$data['title'] = '公務員出國考察追蹤網';
	
		$this->load->view('templates/header', $data);
		$this->load->view('report/list', $data);
		$this->load->view('templates/footer');
	}	

	public function view($id)
	{
		$data['report_item'] = $this->report_model->get_report($id);
	
		if (empty($data['report_item']))
		{
			show_404();
		}
	
		$data['title'] = $data['report_item']['title'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('report/view', $data);
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */