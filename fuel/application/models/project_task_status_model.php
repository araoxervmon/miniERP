<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Project_Task_Status_model extends Base_module_model {
	
	public $required = array('name');
							
	
	function __construct()
    {
        parent::__construct('project_task_status');
    }
	
	

	
	 
}

class Project_Task_Status_Record extends Base_module_model {

}