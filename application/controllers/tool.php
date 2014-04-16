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
	public function lists()
	{
		exit;
		$url="http://report.nat.gov.tw/ReportFront/report_category.jspx?cateType=2&categoryId=1";
		$html = $this->gethtml($url);
		preg_match_all("/<ul.*?>(.*?)<\/[\s]*ul>/si", $html, $ul);
		preg_match_all("/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/si", $ul[0][5], $temp);
		$list = $temp[1];
		foreach ($list as $key => $value) {
			$url = "http://report.nat.gov.tw/ReportFront/{$value}";

			$catearr = array(
				'cateType'=>'2',
				'cateName'=>html_entity_decode(trim($temp[2][$key])),
				'cateLevel'=>'1',
				'cateBid'=>'0',
			);
			$this->db->insert('category', $catearr);
			$bid = $this->db->insert_id();

			$list1 = $this->gethtml2($url);

			foreach ($list1 as $key1 => $value1) 
			{
				$catearr = array(
					'cateType'=>'2',
					'cateName'=>html_entity_decode(trim($value1['title'])),
					'cateLevel'=>'2',
					'cateBid'=>$bid,
				);
				$this->db->insert('category', $catearr);
				$bid2 = $this->db->insert_id();	

				foreach ($value1['list'] as $value2) 
				{
					$catearr = array(
						'cateType'=>'2',
						'cateName'=>html_entity_decode(trim($value2)),
						'cateLevel'=>'3',
						'cateBid'=>$bid2,
					);
					$this->db->insert('category', $catearr);								
				}


			}
			//$arr[] = $this->gethtml2($url);
		}
		//print_r($arr);

	}
	public function gethtml2($url)
	{
		
		$html = $this->gethtml($url);
		preg_match_all("/<h3.*?><a.*?>(.*?)<\/a><\/[\s]*h3>/si", $html, $h3_matches);
		$title=$h3_matches[1];
		preg_match_all("/<\/[\s]*h3>.*?<ul.*?>(.*?)<\/[\s]*ul>/si", $html, $ul_matches);
		//print_r($ul_matches[1]);
		$category;
		foreach ($ul_matches[1] as $key=>$value) {
			$temp = array();
			preg_match_all("/<a.*?>(.*?)<\/a>/si", $value, $temp);
			$category[]=array('title' => $title[$key],'list'=> $temp[1]);
		}
		return $category;
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