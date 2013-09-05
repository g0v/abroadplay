<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}	
	public function index()
	{
		$data['title'] = '公務員出國考察追蹤網TimeLine';
		
		$this->load->view('templates/header', $data);
		$this->load->view('timeline', $data);
		$this->load->view('templates/footer', $data);
	}	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */