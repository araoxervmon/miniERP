<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Deduction_types_model extends Base_module_model {
	
	public $required = array('name');
	public $foreign_keys = array('paygrade_id' => 'paygrades_model');
	
	protected $key_field = 'id';
 
    function __construct()
    {
        parent::__construct('deduction_types');
    }
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $fields['name']['label'] = 'Deduction Type';
		  
		   //$fields['created_by']['type'] = 'hidden';
		   //$fields['modified_by']['type'] = 'hidden';
		   return $fields;
	  }
}

class Deduction_type_model extends Base_module_model {

}