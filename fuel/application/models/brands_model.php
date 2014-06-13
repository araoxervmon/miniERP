<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Brands_model extends Base_module_model {
 
 	protected $key_field = 'brand_id';
    
	function __construct()
    {
        parent::__construct('fuel_brands');
    }
	function list_items($limit = NULL, $offset = NULL, $col = 'brand_id', $order = 'asc')
    {
		$this->db->select('fuel_brands.brand_id,brand_name,	brand_short_name,');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	 
	 function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $CI->load->model('countries_model');
		   $this->load->helper('validator');
	       $fields['brand_short_name']['label'] = 'Brand Short Name';
		   $fields['brand_name']['label'] = 'Brand Name';
		   $fields['brand_id']['type'] = 'hidden';
		   return $fields;
	  }
	 
	 	 function options_list($key = 'fuel_brands.brand_id', $val = 'fuel_brands.brand_short_name', $where = array(), $order = 'fuel_brands.brand_id')
	{
		//$val = 'fuel_brands.brand_id';
		$this->db->select('fuel_brands.brand_id');
		return parent::options_list($key, $val, $where, $order);
	 }
	 
}

class Brandsmodel extends Base_module_model {

}