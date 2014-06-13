<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Customers extends Fuel_base_controller {

	public $nav_selected =  'customers';
	public $view_location = 'customers';
	private $data;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('customers');
		$this->load->module_model(customers_FOLDER, 'customers_model');
		$this->data = self::autosuggest();
	}
	
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
		}
		else {
			redirect(fuel_url('customers'));
		}
	
	}

}