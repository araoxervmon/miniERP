<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Dashboard extends Fuel_base_controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->config('app_builders');
		$this->load->helper('array');
		$this->load->helper('file');
		
		$inward_entry_config = $this->config->item('app_builders');
		
		
		$this->load->view('dashboard', $vars);
	}

}

/* End of file dashboard.php */
/* Location: ./fuel/modules/backup/controllers/dashboard.php */
