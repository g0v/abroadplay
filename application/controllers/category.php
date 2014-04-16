<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('report_model');

	}

	public function index()
	{
		try
		{
			$arr = array();
			$temp = $this->getlist(0,1);
			foreach ($temp as $key=>$value) {
				$list = $this->getlist($value->id,1);
				$temp ='';
				foreach ($list as $value1) {
					$temp[] = $value1->cateName;
				}
				$arr[] = array('name'=>$value->cateName,'list'=>$temp );
			}
			//print_r($arr);
			$data['title'] = '公務員出國考察追蹤網';
			$data['list'] = $arr;	
	
			$this->load->view('templates/header', $data);
			$this->load->view('category/catetype1', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
	}
	public function catetype()
	{
		try
		{
			$arr = array();
			$temp = $this->getlist(0,2);
			foreach ($temp as $key=>$value) {
				$list = $this->getlist($value->id,2);
				if(count($list)>0):
					$temp =null;
					foreach ($list as $value1) 
					{
						$list1 = $this->getlist($value1->id,2);
						$temp1 = null;
						if(count($list1)>0):							
							foreach ($list1 as $value2)
								$temp1[] = $value2->cateName;							
						endif;
						$temp[] = array('name'=>$value1->cateName,'list'=>$temp1);
					}
					$arr[] = array('id'=>$value->id,'name'=>$value->cateName,'list'=>$temp );
				endif;
			}
			//print_r($arr);
			$data['title'] = '公務員出國考察追蹤網';
			$data['list'] = $arr;	
	
			$this->load->view('templates/header', $data);
			$this->load->view('category/catetype2', $data);
			$this->load->view('templates/footer');	    
		}
		catch (Exception $err)
		{
		    log_message("error", $err->getMessage());
		    return show_error($err->getMessage());
		}
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

	public function getlist($id,$cateType){
		$this->db->from('category');
		$this->db->where('cateType =',$cateType);
		$this->db->where('cateBid =',$id);
		$this->db->order_by('id','asc');
		$query = $this->db->get();	
		return $query->result();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */