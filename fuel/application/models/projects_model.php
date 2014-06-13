<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Projects_model extends Base_module_model {
	
	public $required = array('title');
	public $foreign_keys = array('department_id' => 'departments_model',
								'project_manager' => 'employees_model',
								'status' => 'project_task_status_model',
							);
	
	function __construct()
    {
        parent::__construct('projects');
    }
	
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $fields['project_manager']['label']   = 'Project Manager'; 
		   $fields['status']['label']   = 'Status'; 
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

class Project_model extends Base_module_model {

}