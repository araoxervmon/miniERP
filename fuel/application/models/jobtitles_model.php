<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Jobtitles_model extends Base_module_model {
	
	public $required = array('name');
	
    function __construct()
    {
        parent::__construct('jobtitles');
    }
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $fields['name']['label'] = 'Job Title';
		  
		   //$fields['created_by']['type'] = 'hidden';
		   //$fields['modified_by']['type'] = 'hidden';
		   return $fields;
	  }
}

class Jobtitle_event_model extends Base_module_model {

}