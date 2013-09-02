<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	   $cdn_url = 'https://cdn.22kopendata.org/data/';
       
	   $this->load->database();
       
       $table_html = '';
       $no = 0;
       
       $this->db->order_by('id','DESC');
       $this->db->limit(20);
       $query = $this->db->get('salary');
            foreach ($query->result() as $row)
            {
                $no = $no + 1;
                $company_name = $row->company_name;
                $location = $row->location;
                $job_name = $row->job_name;
                $salary = $row->salary;
                $notes1 = $row->notes1;
                if ($notes1 != '')
                {
                    $notes1 = '<span class="label label-important">'.$notes1.'</span>';
                }
                $notes2 = $row->notes2;
                if ($notes2 != '')
                {
                    $notes2 = '<span class="label label-info">'.$notes2.'</span>';
                }
                $data_url = $row->data_url;
                if ($data_url != '')
                {
                    $data_url = '&nbsp;<a href="'.$data_url.'" target="_blank">連結</a>';
                }
                
                $data_pic_name = $row->data_pic_name;
                if ($data_pic_name != '')
                {
                    $data_pic_name = '&nbsp;<a href="'.$cdn_url.$data_pic_name.'" target="_blank">截圖</a>';
                }
                
                $data_file_name = $row->data_file_name;
                if ($data_file_name != '')
                {
                    $data_file_name = '&nbsp;<a href="'.$cdn_url.$data_file_name.'" target="_blank">薪資單</a>';
                }
                
                $table_html = $table_html.'<!--Section Begin-->
                  <tbody>
                    <tr>
                      <th>'.$company_name.'</th>
                      <th>'.$location.'</th>
                      <th>'.$job_name.' '.$notes1.' '.$notes2.'</th>
                      <th>月薪 '.$salary.'元</th>
                      <th>'.$data_url.$data_pic_name.$data_file_name.'
                      </th>
                    </tr>
                  </tbody>
                  <!--Section End-->
                  
                  ';
            }   
            
            //分頁處理
            
            
            //分頁處理-END
        $view_data['table_html'] = $table_html;
        $view_data['city_links'] = $this->html_city_links();
		$this->load->view('homepage',$view_data);
        $this->output->cache(60);
	}
    
    public function _citi_name_switch($city_eng)
    {
        $city_name = "0";
        switch($city_eng){
          case 'taipei':
          $city_name = '台北';
          break;
          
          case 'xinbei':
          $city_name = '新北';
          break;
          
          case 'taoyuan':
          $city_name = '桃園';
          break;
          
          case 'xinzhu':
          $city_name = '新竹';
          break;
          
          case 'miaoli':
          $city_name = '苗栗';
          break;
          
          case 'taizhong':
          $city_name = '台中';
          break;
          
          case 'zhanghua':
          $city_name = '彰化';
          break;
          
          case 'nantou':
          $city_name = '南投';
          break;
          
          case 'yunli':
          $city_name = '雲林';
          break;
          
          case 'jiayi':
          $city_name = '嘉義';
          break;
          
          case 'tainan':
          $city_name = '台南';
          break;
          
          case 'gaoxiong':
          $city_name = '高雄';
          break;
          
          case 'pingdong':
          $city_name = '屏東';
          break;
          
          case 'yilan':
          $city_name = '宜蘭';
          break;
          
          case 'hualian':
          $city_name = '花蓮';
          break;
          
          case 'taidong':
          $city_name = '台東';
          break;
          
          case 'oversea':
          $city_name = '海外';
          break;
        /*
          default:
        　//$city_name = '0';
          break;
          */
        }
        if ($city_name == '')
        {
            $city_name = '0';
        }
        return $city_name;
    }
    
    public function html_city_links()
    {
        $city_links = '
        <div class="alert alert-info">
        <p style="text-align: center; font-size: 16pt;">
        各地區22K芳名錄
        </p>
        <p style="color: #313EB1; text-align: center; font-size: 14pt; font-weight: bold;">
        <a href="frontend/city/taipei">台北市</a>&nbsp;
        <a href="frontend/city/xinbei">新北市</a>&nbsp;
        <a href="frontend/city/taoyuan">桃園</a>&nbsp;
        <a href="frontend/city/miaoli">苗栗</a>&nbsp;
        <a href="frontend/city/taizhong">台中市</a>&nbsp;
        <a href="frontend/city/zhanghua">彰化</a>&nbsp;
        <a href="frontend/city/nantou">南投</a>&nbsp;
        <a href="frontend/city/yunli">雲林</a>&nbsp;
        <a href="frontend/city/jiayi">嘉義</a>&nbsp;
        <a href="frontend/city/tainan">台南市</a>&nbsp;
        <a href="frontend/city/gaoxiong">高雄市</a>&nbsp;
        <a href="frontend/city/pingdong">屏東</a>&nbsp;
        <a href="frontend/city/yilan">宜蘭</a>&nbsp;
        <a href="frontend/city/hualian">花蓮</a>&nbsp;
        <a href="frontend/city/taidong">台東</a>&nbsp;
        <a href="frontend/city/taidong">海外</a>&nbsp;
        </p></div>
        ';
        return $city_links;
    }
    
    public function city($city_eng_name = 0)
	{
	   $cdn_url = 'https://cdn.22kopendata.org/data/';
       
	   $this->load->database();
       
       $city_name = $this->_citi_name_switch($city_eng_name);
       
       $table_html = '';
       $no = 0;
       $this->db->like('location',$city_name);
       $this->db->order_by('id','DESC');
       $query = $this->db->get('salary');
            foreach ($query->result() as $row)
            {
                $no = $no + 1;
                $company_name = $row->company_name;
                $location = $row->location;
                $job_name = $row->job_name;
                $salary = $row->salary;
                $notes1 = $row->notes1;
                if ($notes1 != '')
                {
                    $notes1 = '<span class="label label-important">'.$notes1.'</span>';
                }
                $notes2 = $row->notes2;
                if ($notes2 != '')
                {
                    $notes2 = '<span class="label label-info">'.$notes2.'</span>';
                }
                $data_url = $row->data_url;
                if ($data_url != '')
                {
                    $data_url = '&nbsp;<a href="'.$data_url.'" target="_blank">連結</a>';
                }
                
                $data_pic_name = $row->data_pic_name;
                if ($data_pic_name != '')
                {
                    $data_pic_name = '&nbsp;<a href="'.$cdn_url.$data_pic_name.'" target="_blank">截圖</a>';
                }
                
                $data_file_name = $row->data_file_name;
                if ($data_file_name != '')
                {
                    $data_file_name = '&nbsp;<a href="'.$cdn_url.$data_file_name.'" target="_blank">薪資單</a>';
                }
                
                $table_html = $table_html.'<!--Section Begin-->
                  <tbody>
                    <tr>
                      <th>'.$no.'</th>
                      <th>'.$company_name.'</th>
                      <th>'.$location.'</th>
                      <th>'.$job_name.' '.$notes1.' '.$notes2.'</th>
                      <th>月薪 '.$salary.'元</th>
                      <th>'.$data_url.$data_pic_name.$data_file_name.'
                      </th>
                    </tr>
                  </tbody>
                  <!--Section End-->
                  
                  ';
            }
            
               if ($no == 0 && $city_name != "0")
               {
                    $table_html = '<!--Section Begin-->
                          <tbody>
                            <tr>
                              <th colspan="6"><p style="color: red; text-align: center;">目前該地區沒有22K相關職缺！</p></th>
                            </tr>
                          </tbody>
                          <!--Section End-->
                          
                          ';
               }
               
               if ($city_name != "0")
               {
                $city_name = $city_name.'地區22K芳名錄';
               }
               else
               {
                $city_name = "";
                $table_html = '<!--Section Begin-->
                          <tbody>
                            <tr>
                              <th colspan="6"><p style="color: red; text-align: center;">地區名稱錯誤，請確認您的網址正確性。</p></th>
                            </tr>
                          </tbody>
                          <!--Section End-->
                          
                          ';
               }
        $view_data['table_html'] = $table_html;
        $view_data['city_name'] = $city_name;
        $view_data['city_links'] = $this->html_city_links();
		$this->load->view('city_page',$view_data);
        $this->output->cache(60);
	}
    
    
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */