<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CImport extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	public function index()
	{
		//exit;
	}
	public function getJson()
	{
		$file = "json.txt";
		$json = json_decode(file_get_contents($file), true);
		//count($json);
		foreach ($json['org'] as $key => $row) 
		{
			if(is_array($row['contact_details'])):
			//print_r($row);exit;
			$data = array(
				'org_email'=>$row['contact_details'][6]['value'],
				'org_web'=>@$row['contact_details'][2]['value'],
				'oid'=>$row['identifiers'][1]['identitfier']
			);
			//print_r($data);exit;
			$temp=$row['contact_details'][5]['value'];
			$this->db->update('orginfo', $data, "org_id = '$temp'");
			endif;
		}
		//exit;
	}
	public function set_did()
	{
		$this->db->where('org_level >', '1');
		$this->db->where('director_org_id !=', '');
		$query = $this->db->get('orginfo');
		foreach ($query->result() as $row)
		{
			$temp=$row->director_org_id;
			$this->db->select('group_id');
			$query1 = $this->db->get_where('orginfo', array('org_id'=>$temp),1,0);
			if($trow = $query1->result())
			{
				$n_d_id=$trow[0]->group_id;				
				if($n_d_id>0):
				$data = array('director_id' => $n_d_id);
				$this->db->update('orginfo', $data, "group_id =".$row->group_id);
				endif;
			}
		}		
	}
	public function csvimport()
	{
		$file = fopen("csvname.csv","r");
		if($file):
			$file_path="test.csv";

			// 過濾反斜線 \ 
			$current = file_get_contents($file_path);
			//file_put_contents($file_path, addcslashes($current,'\\'));
			$size = filesize($file_path)+1;
			$row=0;
			while($temp=fgetcsv($file,$size,","))
			{
				if ($row>7)
				{
					$data = array(
						//'director_id' => '',
						'director_org_id' => $temp[17],
						'director_org' => $temp[18],
						'org_id' => $temp[2] ,
						'oid' => '' ,
						'org_fullname' => $temp[3],
						'org_name' => $temp[4],
						'area_code' => $temp[5],
						'address' => $temp[6],				   
						'org_phone_area' => $temp[7],
						'org_phone_num' => $temp[8],
						'org_phone_ext' => $temp[9],
						'org_fax_area' => $temp[10],
						'org_fax_num' => $temp[11],
						'org_fax_ext' => $temp[12],
						'org_level' => $temp[16]
					);
					$query = $this->db->insert('orginfo', $data); 
					//exit;
				}

				$row=$row+1;
			}
		endif;
	}

	public function set_oid($arr)
	{
		//print_r($arr);
		if(count($arr)>0):
			if($arr[0]['value']!=''&&$arr[1]['value']!=''):
			$this->db->where('org_id', $arr[0]['value']);
			//$this->db->where('org_fullname', $arr[1]['value']);
			$query = $this->db->get('orginfo');
			foreach ($query->result() as $row)
			{
				//print_r($row);
				$data = array('oid' => $arr[4]['value'],'org_ename'=>$arr[2]['value'],'org_web'=>$arr[3]['value']);
				$this->db->update('orginfo', $data, "group_id =".$row->group_id);				
				
			}
			endif;
		endif;	
	}
/*
	$html="http://www.gov.tw/OrgInfo/ORPF-GOV-02.aspx?oid=2.16.886.101.90029&type=loc";
	//print_r($this->gethtml2($html));
*/
	public function gethtml2($url)
	{
		$matches=array();
		$oid_array = explode("oid=",$url);
		$html = $this->gethtml($url);
		preg_match_all("/<table.*?>.*?<\/[\s]*table>/si", $html, $matches);
		if($matches[0][2]):
			preg_match_all("/<span[^>]*class=\"font01\"[^>]*>(.*?)<\/span>/si", $matches[0][2], $tb_matches);
			preg_match_all("/<td[^>]*bgcolor=\"#ECE9D8\"[^>]*>(.*?)<\/[\s]*td>/si", $matches[0][2], $th_matches);
			if(count($th_matches[1])>0):
				foreach ( $th_matches[1] as $key => $value) 
				{
					$tname = trim($value);
					$tempv = @($tb_matches[1][$key])?trim($tb_matches[1][$key]):'';
					if($tname=='機關代號'||$tname=='中文名稱'||$tname=='英文名稱'||$tname=='機關網站'):
						
						if($tname=='機關網站'):
							preg_match("/<a[^>]*href=\"(.*?)\"[^>]*>.*?<\/a>/i", $matches[0][2], $website);
							if(count($website)>0)
							$tempv=$website[1];
						endif;
						$thName[] = array('name' => $tname,'value'=>$tempv);
					endif;
				}
				$thName[] = array('name' =>'oid' ,'value'=>str_replace('&type=loc', '', $oid_array[1]) );
				$this->set_oid($thName);
			endif;
			if(count($matches[0])>3):
				$pattern = '/<a[^>]*id=".*_linkOrg"[^>]*title="(.*?)"[^>]*href="(.*?)"[^>]*>.*?<\/a>/i';
				preg_match_all($pattern, $matches[0][3], $matches);

				foreach ( $matches[1] as $key => $value) {
					$arrayName[] = array('name' => $value,'url'=>$matches[2][$key],'arrtemp'=>$this->gethtml2("http://www.gov.tw/OrgInfo/".$matches[2][$key]) );
				}
				$thName[]=$arrayName;
			endif;
			
			return $thName;
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