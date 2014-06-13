<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Dashboard extends Fuel_base_controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->config('rate_details_width');
		$this->load->helper('array');
		$this->load->helper('file');
		
		$partywise_register_config = $this->config->item('rate_details_width');
		
		$this->load->view('dashboard', $vars);
	}

}
