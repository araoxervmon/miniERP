<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class State_list_model extends Base_module_model {
	protected $key_field = 'id';
 
    function __construct()
    {
        parent::__construct('fuel_state_list');
    }
	

}

class Statelist_model extends Base_module_model {

}