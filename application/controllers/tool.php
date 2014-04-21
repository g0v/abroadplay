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
	public function index()
	{
		$arr = $this->getlist(0,'category');
		foreach ($arr as $key => $value) {
			$cateName = $value->name;
			$this->db->select('id');
			$this->db->from('category');
			$this->db->where('cateType',1);
			$this->db->where('cateBid',0);
			$this->db->where('cateName',$cateName);
			$query = $this->db->get();
			$cateId = $query->result();
			$newid = $cateId[0]->id;
			$catearr = array(
				'scId'=>$newid,
			);
			$this->db->where('scId', $value->aId);
			//$this->db->update('report', $catearr); 			
		}
	}

	public function catetype($set='1.1_1')
	{
		$arr = array("1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","W","X","Y","Z");
		$temp = explode('_', $set);
		$cateId = $temp[0];
		$page = ($temp[1])?$temp[1]:'1';
		$url = "http://report.nat.gov.tw/ReportFront/report_result.jspx?cateType=1&categoryId={$cateId}";
		$html = $this->gethtml($url."&page={$page}");
		preg_match_all('/<label.*?for="pickPage">(.*?)頁<\/label>/si', $html, $pickPage);
		
		if(count($pickPage[1])==0)
		{		
			$temp = explode('.', $cateId);		
			$key = array_search($temp[1], $arr);
			$temp1 = $key+1;
				
			if(count($temp)<3)
				{
					if($temp1<count($arr))
					{
						redirect(base_url().'tool/catetype/'.$temp[0].'.'.$arr[$temp1].'_1', 'refresh');
					}
					else
					redirect(base_url().'tool/catetype/'.$temp[0].'.1.1_1', 'refresh');
				}
				else
				{
					$key = array_search($temp[0], $arr);
					$temp1 = $key+1;					
					$key2 = array_search($temp[2], $arr);		
					$temp2 = $key2+1;	
					$key3 = array_search($temp[1], $arr);
					$temp3 = $key3+1;							

					if($temp2<count($arr))
					{
						redirect(base_url().'tool/catetype/'.$temp[0].'.'.$temp[1].'.'.$arr[$temp2].'_1', 'refresh');
					}
					elseif($temp3<count($arr))
					{
						redirect(base_url()."tool/catetype/".$temp[0].'.'.$arr[$temp3].".1_1", 'refresh');
					}					
					elseif($temp1<count($arr))
					{
						redirect(base_url()."tool/catetype/".$arr[$temp1].".1_1", 'refresh');
					}

				}
			}
			
			preg_match_all('/<option.*?>(.*?)<\/option>/si', $pickPage[1][0], $option);
			$pages = count($option[1]);
			preg_match_all('/<div.*?class="browseCate">(.*?)<div.*?class="aRight">/si', $html, $browseCate);
			//echo  $browseCate[1][0];
			preg_match_all("/<\/strong>(.*?)>.*?<a/si", $browseCate[1][0], $tname);
			//print_r($tname);
			$tcateName=trim($tname[1][0]);			
			preg_match_all("/<a.*?href=\"(.*?)\".*?class=\"must\">(.*?)<\/a>/si", $browseCate[1][0], $must);
			//print_r($must);exit;
			$cateName=trim($must[2][0]);
			preg_match_all("/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/si", $browseCate[1][0], $temp);
			$catelist = $temp[1];
			//print_r($catelist);exit;
			preg_match_all('/<table.*?class="lpTb">(.*?)<\/table>/si', $html, $table);	
			//print_r($table);
			preg_match_all("/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/si", $table[1][0], $lists);	
			//print_r($lists);exit;

			if($this->updateScid($lists,$tcateName,$cateName)==true):
				if($page<$pages)
					redirect(base_url().'tool/catetype/'.$cateId.'_'.($page+1), 'refresh');
				else
				{
					unset($catelist[0]);
					foreach ($catelist as $key => $value) {					
						$tempId=str_replace('report_result.jspx?cateType=1&categoryId=', '', $value);
						if($tempId>$cateId)
						{
							redirect(base_url().'tool/catetype/'.$tempId.'_1', 'refresh');
							exit;
						}
						
					}

					$temp = explode('.', $cateId);		
					$key = array_search($temp[1], $arr);
					$temp1 = $key+1;

					if(count($temp)<3)
					{
						if($temp1<count($arr))
						{
							redirect(base_url().'tool/catetype/'.$temp[0].'.'.$arr[$temp1].'_1', 'refresh');
						}
						else
						redirect(base_url().'tool/catetype/'.$temp[0].'.1.1_1', 'refresh');
					}					
					else
					{
						$key = array_search($temp[0], $arr);
						$temp1 = $key+1;					
						$key2 = array_search($temp[2], $arr);		
						$temp2 = $key2+1;	
						$key3 = array_search($temp[1], $arr);
						$temp3 = $key3+1;							

						if($temp2<count($arr))
						{
							redirect(base_url().'tool/catetype/'.$temp[0].'.'.$temp[1].'.'.$arr[$temp2].'_1', 'refresh');
						}
						elseif($temp3<count($arr))
						{
							redirect(base_url()."tool/catetype/".$temp[0].'.'.$arr[$temp3].".1_1", 'refresh');
						}					
						elseif($temp1<count($arr))
						{
							redirect(base_url()."tool/catetype/".$arr[$temp1].".1_1", 'refresh');
						}					
					}
					
				}
			endif;		
	}

	public function updateScid($arr,$tcateName,$cateName){

		if(count($arr[1])==0)
			return false;

		foreach ($arr[1] as $key => $value) {
			$sysId=str_replace('report_detail.jspx?sysId=', '', $value);		
			$this->db->select('category.id,category.cateBid');
			$this->db->from('category');
			$this->db->join('category as cc', 'category.cateBid=cc.id');
			$this->db->where('category.cateType',1);
			$this->db->where('cc.cateName',$tcateName);
			$this->db->where('category.cateName',$cateName);
			$query = $this->db->get();
			$cateId = $query->result();
			$catearr = array(
				'scId'=>$cateId[0]->cateBid,
				'scId2'=>$cateId[0]->id,
			);
			//print_r($catearr);exit;
			$this->db->where('sysid', $sysId);
			$this->db->update('report', $catearr); 	
		}
		return true;
	}

	public function catetype2($set='1.1_1')
	{
		$arr = array("1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","W","X","Y","Z");
		$temp = explode('_', $set);
		$cateId = $temp[0];
		$page = ($temp[1])?$temp[1]:'1';
		$url = "http://report.nat.gov.tw/ReportFront/report_result.jspx?cateType=2&categoryId={$cateId}";
		$html = $this->gethtml($url."&page={$page}");
		preg_match_all('/<label.*?for="pickPage">(.*?)頁<\/label>/si', $html, $pickPage);
		
		if(count($pickPage[1])==0)
		{		
			$temp = explode('.', $cateId);		
			$key = array_search($temp[1], $arr);
			$temp1 = $key+1;
				
			if(count($temp)<3)
				{
					if($temp1<count($arr))
					{
						redirect(base_url().'tool/catetype2/'.$temp[0].'.'.$arr[$temp1].'_1', 'refresh');
					}
					else
					redirect(base_url().'tool/catetype2/'.$temp[0].'.1.1_1', 'refresh');
				}
				else
				{
					$key = array_search($temp[0], $arr);
					$temp1 = $key+1;					
					$key2 = array_search($temp[2], $arr);		
					$temp2 = $key2+1;	
					$key3 = array_search($temp[1], $arr);
					$temp3 = $key3+1;							

					if($temp2<count($arr))
					{
						redirect(base_url().'tool/catetype2/'.$temp[0].'.'.$temp[1].'.'.$arr[$temp2].'_1', 'refresh');
					}
					elseif($temp3<count($arr))
					{
						redirect(base_url()."tool/catetype2/".$temp[0].'.'.$arr[$temp3].".1_1", 'refresh');
					}					
					elseif($temp1<count($arr))
					{
						redirect(base_url()."tool/catetype2/".$arr[$temp1].".1_1", 'refresh');
					}

				}
			}
			
			preg_match_all('/<option.*?>(.*?)<\/option>/si', $pickPage[1][0], $option);
			$pages = count($option[1]);
			preg_match_all('/<div.*?class="browseCate">(.*?)<div.*?class="aRight">/si', $html, $browseCate);
			//echo  $browseCate[1][0];
			preg_match_all("/<\/strong>(.*?)>.*?<a/si", $browseCate[1][0], $tname);
			//print_r($tname);
			$tcateName=trim($tname[1][0]);			
			preg_match_all("/<a.*?href=\"(.*?)\".*?class=\"must\">(.*?)<\/a>/si", $browseCate[1][0], $must);
			//print_r($must);exit;
			$cateName=trim($must[2][0]);
			preg_match_all("/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/si", $browseCate[1][0], $temp);
			$catelist = $temp[1];
			//print_r($catelist);exit;
			preg_match_all('/<table.*?class="lpTb">(.*?)<\/table>/si', $html, $table);	
			//print_r($table);
			preg_match_all("/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/si", $table[1][0], $lists);	
			//print_r($lists);exit;

			if($this->updateScid2($lists,$tcateName,$cateName)==true):
				if($page<$pages)
					redirect(base_url().'tool/catetype2/'.$cateId.'_'.($page+1), 'refresh');
				else
				{
					unset($catelist[0]);
					foreach ($catelist as $key => $value) {					
						$tempId=str_replace('report_result.jspx?cateType=2&categoryId=', '', $value);
						if($tempId>$cateId)
						{
							redirect(base_url().'tool/catetype2/'.$tempId.'_1', 'refresh');
							exit;
						}
						
					}

					$temp = explode('.', $cateId);		
					$key = array_search($temp[1], $arr);
					$temp1 = $key+1;

					if(count($temp)<3)
					{
						if($temp1<count($arr))
						{
							redirect(base_url().'tool/catetype2/'.$temp[0].'.'.$arr[$temp1].'_1', 'refresh');
						}
						else
						redirect(base_url().'tool/catetype2/'.$temp[0].'.1.1_1', 'refresh');
					}					
					else
					{
						$key = array_search($temp[0], $arr);
						$temp1 = $key+1;					
						$key2 = array_search($temp[2], $arr);		
						$temp2 = $key2+1;	
						$key3 = array_search($temp[1], $arr);
						$temp3 = $key3+1;							

						if($temp2<count($arr))
						{
							redirect(base_url().'tool/catetype2/'.$temp[0].'.'.$temp[1].'.'.$arr[$temp2].'_1', 'refresh');
						}
						elseif($temp3<count($arr))
						{
							redirect(base_url()."tool/catetype2/".$temp[0].'.'.$arr[$temp3].".1_1", 'refresh');
						}					
						elseif($temp1<count($arr))
						{
							redirect(base_url()."tool/catetype2/".$arr[$temp1].".1_1", 'refresh');
						}					
					}
					
				}
			endif;		
	}

	public function updateScid2($arr,$tcateName,$cateName){

		if(count($arr[1])==0)
			return false;

		foreach ($arr[1] as $key => $value) {
			$sysId=str_replace('report_detail.jspx?sysId=', '', $value);		
			$this->db->select('category.id,category.cateBid');
			$this->db->from('category');
			$this->db->join('category as cc', 'category.cateBid=cc.id');
			$this->db->where('category.cateType',2);
			$this->db->where('cc.cateName',$tcateName);
			$this->db->where('category.cateName',$cateName);
			$query = $this->db->get();
			$cateId = $query->result();
			$catearr = array(
				'tpcId'=>$cateId[0]->cateBid,
				'pcId'=>$cateId[0]->id,
			);
			//print_r($catearr);exit;
			$this->db->where('sysid', $sysId);
			$this->db->update('report', $catearr); 	
		}
		return true;
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
		$this->db->from('authority');
		$this->db->where('dataType',$cateType);
		$this->db->where('bId',$id);
		$this->db->where('name','其他');
		$this->db->order_by('aId','asc');
		$query = $this->db->get();	
		return $query->result();
	}	

}