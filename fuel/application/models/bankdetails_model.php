<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Bankdetails_model extends Base_module_model {
	//protected $key_field = 'id';
	
	public $foreign_keys = array('employee_id' => 'employees_model');
 
    function __construct()
    {
        parent::__construct('bankdetails');
    }
	
	 
}

class Bankdetail_model extends Base_module_model {

}