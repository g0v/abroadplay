<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$data['title'] = '公務員出國考察追蹤網';
		$this->load->view('templates/header',$data);
		$this->load->view('index');
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */