<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */