<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Timesheets_model extends Base_module_model {
	
//	public $required = array('name');
	public $foreign_keys = array('project_id' => 'projects_model',
								'task_id' => 'project_tasks_model',
								'userid' => 'users_model',
								'employee_id' => 'employees_model',
							);
	
	function __construct()
    {
        parent::__construct('timesheets');
    }
	 
}

class Timesheet_model extends Base_module_model {

}