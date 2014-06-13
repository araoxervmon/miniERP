<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee_types_model extends Base_module_model {
	
	public $required = array('name');
	
    function __construct()
    {
        parent::__construct('employee_types');
    }
	
}

class Employee_type_model extends Base_module_model {

}