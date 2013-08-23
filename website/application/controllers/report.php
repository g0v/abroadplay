<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('report_model');
	}

	public function index()
	{
		$this->page(1);
	}
	
	public function page($page=1)
	{
		$data['title'] = '公務員出國考察追蹤網';
		$data['list'] = $this->report_model->get_list($page);
		//print_r($data['list']);exit();
		$this->load->library('pagination');
		$config['total_rows'] = $this->report_model->get_count();
		$this->pagination->initialize($config);
		$data['pageList'] = $this->pagination->create_links();		

		$this->load->view('templates/header', $data);
		$this->load->view('report/list', $data);
		$this->load->view('templates/footer');
	}	

	public function view($id)
	{
		$data['item'] = $this->report_model->get_report($id);
	
		if (empty($data['item']))
		{
			show_404();
		}
	
		$data['title'] = $data['item']['sysid'].'-'.$data['item']['reportName'];
	
		$this->load->view('templates/header', $data);
		$this->load->view('report/view', $data);
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */