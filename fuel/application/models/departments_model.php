<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Departments_model extends Base_module_model {
	
	public $required = array('name');
	
	protected $key_field = 'id';
 
    function __construct()
    {
        parent::__construct('departments');
    }
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $fields['name']['label'] = 'Department Name';
		  
		   //$fields['created_by']['type'] = 'hidden';
		   //$fields['modified_by']['type'] = 'hidden';
		   return $fields;
	  }
}

class Department_model extends Base_module_model {

}