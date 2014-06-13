<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Employees_model extends Base_module_model {
	
	public $required = array('name', 'address1', 'email', 'home_phone', 'mobile_phone');
	public $foreign_keys = array('department_id' => 'departments_model',
								'jobtitle_id' => 'Jobtitles_model',
								'userid' => 'users_model',
								'type_id' => 'employee_types_model',
								'category_id' => 'employee_categories_model',
								'paygrade_id' => 'paygrades_model'
							);
	
    function __construct()
    {
        parent::__construct('employees');
    }
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $CI->load->model('countries_model');
		   $options = $this->countries_model->my_custom_options_country();
		   $fields['country_code'] = array('type' => 'select', 'label' => 'Country', 'options' => $options
					                      ,'first_option' => 'India');
		   $fields['gender'] = array('type' => 'enum', 'options' => array('male' => 'Male', 'female' => 'female'), 'required' => TRUE);
		  
		   $fields['unique_id']['type'] = 'hidden'; // should be list of records from this model where manager is yes
		   
		   $fields['pan_id']['label'] = 'Pan no.'; // should be list of records from this model where manager is yes
		   
		   $author_options = $this->options_list();
		 
	       $fields['parent_id'] = array('type' => 'select', 'options' => $author_options);
		   $fields['parent_id']['label'] = 'Reports to'; 
		   $fields['jobtitle_id']['label']    = 'Designation'; 
		   $fields['date_of_joining']['label']    = 'Date of Joining'; 
		   
		   $fields['created_by']['type']    = 'hidden'; 
		   $fields['modified_by']['type']   = 'hidden'; 
		   $fields['created_date']['type']  = 'hidden';
		   $fields['modified_date']['type'] = 'hidden';
		   $fields['category_id']['label']  = 'Category';
		   
		   //create a new folder for each user. upload to the appropriate folder.
		  // $fields['image_upload'] = array('label' => 'Upload Profile Picture', 'type' => 'file', 'overwrite' => TRUE);
		  // $fields['image']['type'] = 'hidden';
		   //$fields['created_by']['type'] = 'hidden';
		   //$fields['modified_by']['type'] = 'hidden';
		   return $fields;
	 }
	 
	 function save($save) {
	 	$CI =& get_instance();
		$user = $CI->fuel_auth->user_data();
		$save['unique_id'] = $CI->fuel_auth->uniqueSecretKey(8);
	 	if(!empty($save['id'])) {
	 		$save['modified_by'] = $user['id'];
			$save['modified_date'] = date();
	 	} else {
	 		$save['created_by'] = $user['id'];
			$save['created_date'] = date();
	 	}
		parent::save($save);
	 }
	  
	  
	function options_list($key = 'id', $val = 'concat(firstname, \' \', lastname)', $where = array(), $order = 'firstname')
	{
		//$this->db->select("id, concat(firstname, lastname, '') as name");
		$this->db->where('is_manager', 'yes');
		$this->db->where('active', 'yes');
		return parent::options_list($key, $val, $where, $order);
	}
}

class Employee_model extends Base_module_model {

}