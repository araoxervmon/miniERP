<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Suppliers_model extends Base_module_model {
	
	public $required = array('name','email', 'phone', 'supplier_cname', 
						 'line_1','city');
	
	protected $key_field = 'supplier_id';
 
    function __construct()
    {
        parent::__construct('fuel_suppliers');
    }
	
	function list_items($limit = NULL, $offset = NULL, $col = 'supplier_id', $order = 'asc')
    {
		$this->db->select('fuel_suppliers.supplier_id,name,phone,supplier_cell_phone,supplier_fax,city,state_id');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
 	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $CI->load->model('countries_model');
		   $this->load->helper('validator');
		   $options = $this->countries_model->my_custom_options_country();
	       $fields['supplier_id']['type'] = 'hidden';
		   $fields['address_id']['type'] = 'hidden';
		   $fields['name']['label'] = 'Store Name';
		   $fields['phone']['label'] = 'Phone No';
		   $fields['supplier_cell_phone']['label'] = 'Mobile Phone';
		   $fields['supplier_fax']['label'] = 'Fax';
		   $fields['description']['type'] = 'hidden';   
		   $fields['address_type_code']['type'] = 'hidden';
		   $fields['country_id']['type'] = 'hidden';
		   $fields['line_1']['label'] = 'Address Line1';
		   $fields['line_2']['label'] = 'Address Line2';
		   $fields['line_3']['label'] = 'Address Line3';
		   $fields['date_from']['type'] = 'hidden';
		   $fields['date_to']['type'] = 'hidden';
		   $fields['city']['label'] = 'City';
		   $fields['state_id']['label'] = 'State';
		   $fields['zip_or_postalcode']['label'] = 'Zip Code';
		   $fields['country_code'] = array('type' => 'select', 'label' => 'Country', 'options' => $options
					                      ,'first_option' => 'India');
		   $fields['created_by']['type'] = 'hidden';
		   $fields['modified_by']['type'] = 'hidden';
		   
		   return $fields;
	  }
	  
	 function options_list($key = 'fuel_suppliers.supplier_id', $val = 'fuel_suppliers.name', $where = array(), $order = 'fuel_suppliers.name')
	{
		$key = 'fuel_suppliers.supplier_id';
		$val = 'fuel_suppliers.name';
		$this->db->select('fuel_suppliers.supplier_id, fuel_suppliers.name');
		return parent::options_list($key, $val, $where, $order);
	}	
	
	
    function save($save) 
	{
		$CI =& get_instance();
		$user = $CI->fuel_auth->user_data();
		$CI->load->module_model(FUEL_FOLDER, 'user_to_permissions_model');
		$save['unique_id'] =$CI->fuel_auth->uniqueSecretKey(36);
			if(!empty($save['id'])) 
				{
					$save['modified_by'] = $user['id'];
					$save['modified_date'] = datetime_now();
				} 
			else 
				{
					$save['created_by'] = $user['id'];
					$save['created_date'] = datetime_now();
				}
		parent::save($save);
  }
	
}

class Suppliersmodel extends Base_module_model {

}