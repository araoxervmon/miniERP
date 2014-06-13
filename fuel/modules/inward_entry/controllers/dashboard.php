<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Dashboard extends Fuel_base_controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->config('inward_entry');
		$this->load->helper('array');
		$this->load->helper('file');
		
		$inward_entry_config = $this->config->item('inward_entry');
		
		
		$this->load->view('dashboard', $vars);
	}

}

/* End of file dashboard.php */
/* Location: ./fuel/modules/backup/controllers/dashboard.php */
