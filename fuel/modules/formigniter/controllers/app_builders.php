<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class App_builders extends Fuel_base_controller {

	public $nav_selected =  'app_builders';
	public $view_location = 'app_builders';
	private $data;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('app_builders');
		$this->load->language('app_builders');
		$this->app_builders = $this->config->item('app_builders');
		$this->load->module_model(APP_BUILDERS_FOLDER, 'app_builders_model');
		$this->data = $this->app_builders_model->example();
	}
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data'] = $this->data;
			$vars['instructions'] = lang('module_instructions');
			$this->_render('app_builders', $vars);
		}
		else {
			redirect(fuel_url('dashboard'));
		}
	}
}