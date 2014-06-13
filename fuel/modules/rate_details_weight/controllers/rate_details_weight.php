<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Rate_details_weight extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'rate_details_weight';
	public $view_location = 'rate_details_weight';
	private $rate_details_weight;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$this->config->load('rate_details_weight');
		$this->load->language('rate_details_weight');
		$this->Rate_details_weight = $this->config->item('Rate_details_weight');
		$this->formdata = $this->Rate_details_weight_model->form_fields();
		$this->gdata = $this->Rate_details_weight_model->CoilTable();
		$this->data = $this->Rate_details_weight_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}



function listrateweight($description = '') {	
		if(empty($description)) { 
			$description = $_POST['coil'];
		}
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$containers = $this->Rate_details_weight_model->list_partyname($description);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->priceid = $container->priceid;
			$obj->minweight = $container->minweight;
			$obj->maxweight = $container->maxweight;
			$obj->rate = $container->rate;
			$obj->edi = fuel_url('rate_details_weight/editrateweight_coil').'/?priceid='.$container->priceid;
			//$obj->dl = fuel_url('rate_details_weight/deleterateweight_coil').'/?priceid='.$container->priceid;
			

			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}

function editrateweight_coil(){
		
	}

	
	function checkweightexist(){
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$checkdata = $this->Rate_details_weight_model->checkweightexist();
	
	}
	
	function minweightexist(){
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$miledata = $this->Rate_details_weight_model->minweightexistmodel($_POST['minweight'],$_POST['coil']);	  
		if($miledata)
		echo "1";
		else
		echo "0";
		//var_dump($miledata);
	}
	
	function maxweightexist(){
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$mildata = $this->Rate_details_weight_model->maxweightexistmodel($_POST['maxweight'],$_POST['coil']);	
		if($mildata)
		echo "1";
		else
		echo "0";
	}

	
	
	
	
	
	
	
	
	
function coil() {
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$gdata = $this->Rate_details_weight_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->coil();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('rate_details_weight', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	
			function deleterateweight_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $priceid = $args["priceid"];
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$this->Rate_details_weight_model->delete_ratedetailweightmodel($priceid);
		//echo $priceid;
	}
	
	
	function tableweight() 
	{
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$ujson = $this->Rate_details_weight_model->tableweight();
		return $ujson;
	}
		
	function formdisplay()
	{	
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$formdata = $this->Rate_details_weight_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->Rate_details_weight_model->deleterow($_POST['deletevalue']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function SelectCoilName() {
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$data = $this->Rate_details_weight_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
		$coildata = $this->Rate_details_weight_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function saveratedetails() {
		if (!empty($_POST)) {
			$arr = $this->Rate_details_weight_model->saverate($_POST['coildescription'],$_POST['minweight'], $_POST['maxweight'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	


	function updateratedetails() {
		if (!empty($_POST)) {
		    $this->load->module_model(RATE_DETAILS_WEIGHT_FOLDER, 'Rate_details_weight_model');
			$arr = $this->Rate_details_weight_model->updaterate($_POST['priceid'],$_POST['minweight'], $_POST['maxweight'], $_POST['rate']);
		
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/