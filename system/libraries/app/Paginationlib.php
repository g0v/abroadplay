<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*Initialize the pagination rules for cities page 
* @return Pagination
*/
class Paginationlib {
     //put your code here
     function __construct() {
          $this->ci =& get_instance();
     }
     
     public function initPagination($base_url,$total_rows,$cur_page='1'){
         $config['base_url']          = base_url().$base_url;
         $config['total_rows']        = $total_rows;
         $config['cur_page']          = $cur_page;
         $this->ci->pagination->initialize($config);
         return $config;    
     }  
}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */