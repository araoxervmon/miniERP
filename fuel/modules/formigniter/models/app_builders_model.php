<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/app_builders/config/app_builders_constants.php');
class App_builders_model extends Base_module_model {

    function __construct(){
        parent::__construct('fuel_inventory_items');
    } 
	
	function example(){
		return true;
	}
	
}
class Appbuilders_model extends Base_module_model {
}