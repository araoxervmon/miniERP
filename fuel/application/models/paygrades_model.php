<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Paygrades_model extends Base_module_model {
	//protected $key_field = 'id';
	
	public $foreign_keys = array('jobtitle_id' => 'jobtitles_model');
 
    function __construct()
    {
        parent::__construct('paygrades');
    }
	
	 
}

class Paygrade_model extends Base_module_model {

}