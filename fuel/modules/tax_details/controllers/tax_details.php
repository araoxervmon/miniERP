<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Tax_details extends Fuel_base_controller {
	private $data;
	private $gdata;
	private $rate_details;
	public $nav_selected = 'tax_details';
	public $view_location = 'tax_details';
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$this->config->load('tax_details');
		$this->load->language('tax_details');
		$this->Tax_details = $this->config->item('Tax_details');
		$this->formdata = $this->Tax_details_model->form_fields();
		$this->gdata = $this->Tax_details_model->CoilTable();
		$this->data = $this->Tax_details_model->formdisplay();	
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
			}
		}		
	}

	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['gdata']= $this->coil();
			$this->_render('tax_details', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}

	function listtaxdetails() {	
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$containers = $this->Tax_details_model->list_taxdetailsmodel();
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->taxid = $container->taxid;
			$obj->taxtype = $container->taxtype;
			$obj->pecentage = $container->pecentage;
			$obj->edi = fuel_url('tax_details/editratelength_coil').'/?taxid='.$container->taxid;
			//$obj->dl = fuel_url('tax_details/deletetax').'/?taxid='.$container->taxid;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}

	function coil() {
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$gdata = $this->Tax_details_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}

		

	function SelectCoilName() {
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$data = $this->Tax_details_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$coildata = $this->Tax_details_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function savetaxdetails() {
		if (!empty($_POST)) {
			$arr = $this->Tax_details_model->savetax($_POST['taxtype'], $_POST['percentage']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	
	function deletetax(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $taxid = $args["taxid"];
		$this->load->module_model(TAX_DETAILS_FOLDER, 'Tax_details_model');
		$this->Tax_details_model->deletetax($taxid);
	}



		function updatetaxdetails() {
		if (!empty($_POST)) {
			$arr = $this->Tax_details_model->updatetax($_POST['taxid'],$_POST['percentage']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/