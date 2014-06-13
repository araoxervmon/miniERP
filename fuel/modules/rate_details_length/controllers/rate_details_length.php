<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Rate_details_length extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'rate_details_length';
	public $view_location = 'rate_details_length';
	private $rate_details;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$this->config->load('rate_details_length');
		$this->load->language('rate_details_length');
		$this->Rate_details_length = $this->config->item('Rate_details_length');
		$this->formdata = $this->Rate_details_length_model->form_fields();
		$this->gdata = $this->Rate_details_length_model->CoilTable();
		$this->data = $this->Rate_details_length_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}

function listratelength($description = '') {	
		if(empty($description)) { 
			$description = $_POST['coil'];
		}
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$containers = $this->Rate_details_length_model->list_partyname($description);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->priceid = $container->priceid;
			$obj->minlength = $container->minlength;
			$obj->maxlength = $container->maxlength;
			$obj->rate = $container->rate;
			$obj->edi = fuel_url('rate_details_length/editratelength_coil').'/?priceid='.$container->priceid;
		//	$obj->dl = fuel_url('rate_details_length/deleteratelength_coil').'/?priceid='.$container->priceid;
			

			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}

	function editratelength_coil(){
		
	}
	
	function checklengthexist(){
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$checkdata = $this->Rate_details_length_model->checklengthexist();
	
	}
	
	function minlengthexist(){
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$miledata = $this->Rate_details_length_model->minlengthexistmodel($_POST['minlength'],$_POST['coil']);	  
		if($miledata)
		echo "1";
		else
		echo "0";
		//var_dump($miledata);
	}
	
	function maxlengthexist(){
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$mildata = $this->Rate_details_length_model->maxlengthexistmodel($_POST['maxlength'],$_POST['coil']);	
		if($mildata)
		echo "1";
		else
		echo "0";
	}


function coil() {
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$gdata = $this->Rate_details_length_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->coil();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('rate_details_length', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	
		
	function formdisplay()
	{	
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$formdata = $this->Rate_details_length_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->Rate_details_length_model->deleterow($_POST['partyid']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function SelectCoilName() {
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$data = $this->Rate_details_length_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$coildata = $this->Rate_details_length_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function saveratedetails() {
		if (!empty($_POST)) {
			$arr = $this->Rate_details_length_model->saverate($_POST['coildescription'],$_POST['minlength'], $_POST['maxlength'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function deleteratelength_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $priceid = $args["priceid"];
		$this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
		$this->Rate_details_length_model->delete_ratedetaillengthmodel($priceid);
		//echo $priceid;
	}


	function updateratedetails() {
		if (!empty($_POST)) {
		    $this->load->module_model(RATE_DETAILS_LENGTH_FOLDER, 'Rate_details_length_model');
			$arr = $this->Rate_details_length_model->updaterate($_POST['priceid'],$_POST['minlength'], $_POST['maxlength'], $_POST['rate']);
		
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/