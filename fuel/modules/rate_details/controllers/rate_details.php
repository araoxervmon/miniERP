<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Rate_details extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'rate_details';
	public $view_location = 'rate_details';
	private $rate_details;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$this->config->load('rate_details');
		$this->load->language('rate_details');
		$this->Rate_details = $this->config->item('Rate_details');
		$this->formdata = $this->Rate_details_model->form_fields();
		$this->gdata = $this->Rate_details_model->CoilTable();
		$this->data = $this->Rate_details_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}


function CoilName() {
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$gdata = $this->Rate_details_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->CoilName();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('rate_details', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	function tablewidth() 
	{
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$ujson = $this->Rate_details_model->tablewidth();
		return $ujson;
	}
		
	function formdisplay()
	{	
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$formdata = $this->Rate_details_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->Rate_details_model->deleterow($_POST['partyid']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function SelectCoilName() {
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$data = $this->Rate_details_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(RATE_DETAILS_FOLDER, 'Rate_details_model');
		$coildata = $this->Rate_details_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function saveratedetails() {
		if (!empty($_POST)) {
			$arr = $this->Rate_details_model->saverate($_POST['partyid'],$_POST['coildescription'],$_POST['minthickness'], $_POST['maxthickness'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function updateratedetails() {
		if (!empty($_POST)) {
			$arr = $this->Rate_details_model->updaterate($_POST['coildescription'],$_POST['minthickness'], $_POST['maxthickness'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/