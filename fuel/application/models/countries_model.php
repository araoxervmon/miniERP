<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class countries_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('countries');
    }
	
	function my_custom_options_country( $val = 'countries.country', 
									$val = 'countries.ccode', 
									$where = 'countries.country',
									$order = 'countries.country')
	{
		$val = 'countries.country';
		$this->db->select('DISTINCT countries.country ');
		return parent::options_list( $val, $order);
	}
	
	function list_items($limit = NULL, $offset = NULL, $col = 'ccode', $order = 'asc')
    {
		$data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
 
 
	
	}
class countriesmodel extends Base_module_model {

}	