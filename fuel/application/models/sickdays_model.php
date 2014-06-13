<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Sickdays_model extends Base_module_model {
	
	function __construct()
    {
        parent::__construct('sickdays');
    }
	
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $fields['datesick']['label']    = 'Date sick?'; 
		   $fields['userid']['type']    = 'hidden'; 
		   $fields['employee_id']['type']   = 'hidden'; 
		   
		   //create a new folder for each user. upload to the appropriate folder.
		  // $fields['image_upload'] = array('label' => 'Upload Profile Picture', 'type' => 'file', 'overwrite' => TRUE);
		  // $fields['image']['type'] = 'hidden';
		   //$fields['created_by']['type'] = 'hidden';
		   //$fields['modified_by']['type'] = 'hidden';
		   return $fields;
	 }
	 
	function save($save) {
	 	$CI =& get_instance();
		//logged in user
		$user = $CI->fuel_auth->user_data();
		$save['userid'] = $user['id'];
		
		//get the employee_id from employee table based on userid
	 	$save['employee_id'] = '';
		parent::save($save);
	 }
	
	 
}

class Sickday_model extends Base_module_model {

}