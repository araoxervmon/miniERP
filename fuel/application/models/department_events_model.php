<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Department_events_model extends Base_module_model {
	
	public $required = array('name');
	public $foreign_keys = array('department_id' => 'departments_model');
	
    function __construct()
    {
        parent::__construct('department_events');
    }
	
}

class Department_event_model extends Base_module_model {

}