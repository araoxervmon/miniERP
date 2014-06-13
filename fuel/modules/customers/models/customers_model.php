<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/customers/config/customers_constants.php');
class Customers_model extends Base_module_model {

	public $required = array( 'cust_id', 'name', 'email', 'phone', 'customer_cname', 'line_1', 'city', 'country');
	
	protected $key_field = 'customer_id';
 
    function __construct()
    {
        parent::__construct('fuel_customers');
    }
	
	function list_items($limit = NULL, $offset = NULL, $col = 'customer_id', $order = 'asc')
    {
		$this->db->select('fuel_customers.customer_id, cust_id, name, phone, customer_cell_phone, customer_fax, city, state_id');
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
	       $fields['customer_id']['type'] = 'hidden';
		   $fields['cust_id']['label'] = 'Customer ID';
		   $fields['address_id']['type'] = 'hidden';
		   $fields['name']['label'] = 'Store Name';
		   $fields['phone']['label'] = 'Phone No';
		   $fields['customer_cell_phone']['label'] = 'Mobile Phone';
		   $fields['customer_fax']['label'] = 'Fax';
		   $fields['description']['type'] = 'hidden';   
		   $fields['address_type_code']['type'] = 'hidden';
		   //$fields['ccode']['type'] = 'hidden';
		   $fields['line_1']['label'] = 'Address Line1';
		   $fields['line_2']['label'] = 'Address Line2';
		   $fields['line_3']['label'] = 'Address Line3';
		   $fields['date_from']['type'] = 'hidden';
		   $fields['date_to']['type'] = 'hidden';
		   $fields['city']['label'] = 'City';
		   $fields['state_id']['label'] = 'State';
		   $fields['zip_or_postalcode']['label'] = 'Zip Code';
		   $fields['country'] = array('type' => 'select', 'label' => 'Country', 'options' => $options ,'first_option' => 'India');
		   $fields['created_by']['type'] = 'hidden';
		   $fields['modified_by']['type'] = 'hidden';
		   $fields['tan_id']['label'] = 'TAN Number';
		   $fields['cst_id']['label'] = 'CST Number';
		   $fields['bank_name']['label'] = 'Bank Name';
		   $fields['account_type']['label'] = 'Bank Account Type';
		   $fields['account_number']['label'] = 'Bank Account Number';
		   
		   return $fields;
	  }
	  
	 function options_list($key = 'fuel_customers.customer_id', $val = 'fuel_customers.name', $where = array(), $order = 'fuel_customers.name')
	{
		$key = 'fuel_customers.customer_id';
		$val = 'fuel_customers.name';
		$this->db->select('fuel_customers.customer_id, fuel_customers.name');
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

class Customersmodel extends Base_module_model {

}