<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page = 'home')
	{
		if ( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			//哇勒!我們沒有這個頁面!
			show_404();
		}
		
		$data['title'] = ucfirst($page); //第一個字母大寫
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
	public function index()
	{
		$data['title'] = 'news'; //第一個字母大寫	
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer', $data);
	}	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */