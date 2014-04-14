<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('report_model');

	}
	public function lists($page=1)
	{

		$data = $this->report_model->get_list($page);
		foreach ($data as $value) {
			$this->getContentview($value->id);
		}
		echo "OK-$page";
		if($page<700)
		redirect(base_url().'tool/lists/'.($page+1), 'refresh');

	}

	public function getContentview($id=null)
	{
		$data = $this->report_model->get_report($id);
		//print_r($data);
		$html = $this->gethtml($data['source']);	
		/*
		$set = "/<table.*?>.*?<\/[\s]*table>/si";
		*/
		$set = "/<td.*?>(.*?)<\/[\s]*td>/si";
		preg_match_all($set, $html, $matches);
		//計畫名稱
		$name = trim(strip_tags($matches[1][1]));
		//報告名稱
		$reportName = trim($matches[1][2]);				
		preg_match_all("/<p.*?>(.*?)<\/[\s]*p>/si", $html, $matches);
		//print_r($matches);exit;
		$data = array('report' => $matches[1][0],'name'=>$name,'reportName'=> $reportName);
		$this->upreport($id,$data);
	}
	public function upreport($id=null,$data)
	{
     	if($id!='14041'&&$id!='15042'):
			//$data = array($vname => $value);
			$this->db->update('report',$data,"id ='$id'");
		endif;
	}	
	public function gethtml($url){
		// 初始化一個 cURL 對象
		$ch = @curl_init();
		$options = array(
						CURLOPT_URL => $url,// 設置你需要抓取的URL
						//CURLOPT_REFERER => $referer,
						CURLOPT_HEADER => false,// 設置header
						CURLOPT_RETURNTRANSFER => true,// 設置cURL 參數，要求結果保存到字符串中還是輸出到屏幕上。
						CURLOPT_USERAGENT => "Google Bot",
						CURLOPT_FOLLOWLOCATION => true,	
						//CURLOPT_CONNECTTIMEOUT  => $timeout,	
						//CURLOPT_COOKIE => $cookie
				   );
		curl_setopt_array($ch, $options);
		return $Contents = curl_exec($ch);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */