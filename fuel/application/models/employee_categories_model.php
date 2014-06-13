<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee_categories_model extends Base_module_model {
	
	public $required = array('name');
	
    function __construct()
    {
        parent::__construct('employee_category');
    }
	
}

class Employee_category_model extends Base_module_model {

}