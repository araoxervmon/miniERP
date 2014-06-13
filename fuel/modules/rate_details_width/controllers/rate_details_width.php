<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Rate_details_width extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'rate_details_width';
	public $view_location = 'rate_details_width';
	private $rate_details_weight;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$this->config->load('rate_details_width');
		$this->load->language('rate_details_width');
		$this->Rate_details_width = $this->config->item('Rate_details_width');
		$this->formdata = $this->Rate_details_width_model->form_fields();
		$this->gdata = $this->Rate_details_width_model->CoilTable();
		$this->data = $this->Rate_details_width_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}

	function listratewidth($description = '') {	
		if(empty($description)) { 
			$description = $_POST['coil'];
		}
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$containers = $this->Rate_details_width_model->list_partyname($description);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->priceid = $container->priceid;
			$obj->minwidth = $container->minwidth;
			$obj->maxwidth = $container->maxwidth;
			$obj->rate = $container->rate;
			$obj->edi = fuel_url('rate_details_width/editratewidth_coil').'/?priceid='.$container->priceid;
			//$obj->dl = fuel_url('rate_details_width/deleteratewidth_coil').'/?priceid='.$container->priceid;
			

			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	

	
	
	
	function editratewidth_coil(){
		
	}

	
		function checkwidthexist(){
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$checkdata = $this->Rate_details_width_model->checkwidthexist();
	
	}
	
	function minwidthexist(){
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$miledata = $this->Rate_details_width_model->minwidthexistmodel($_POST['minwidth'],$_POST['coil']);	  
		if($miledata)
		echo "1";
		else
		echo "0";
		//var_dump($miledata);
	}
	
	function maxwidthexist(){
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$mildata = $this->Rate_details_width_model->maxwidthexistmodel($_POST['maxwidth'],$_POST['coil']);	
		if($mildata)
		echo "1";
		else
		echo "0";
	}

	
	
	
	
function coil() {
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$gdata = $this->Rate_details_width_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->coil();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('rate_details_width', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	function tablewidth() 
	{
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$ujson = $this->Rate_details_width_model->tablewidth();
		return $ujson;
	}
		
	function formdisplay()
	{	
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$formdata = $this->Rate_details_width_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->Rate_details_width_model->deleterow($_POST['deletevalue']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function SelectCoilName() {
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$data = $this->Rate_details_width_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$coildata = $this->Rate_details_width_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function saveratedetails() {
		if (!empty($_POST)) {
			$arr = $this->Rate_details_width_model->saverate($_POST['coildescription'],$_POST['minwidth'], $_POST['maxwidth'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	
	function deleteratewidth_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $priceid = $args["priceid"];
		$this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
		$this->Rate_details_width_model->delete_ratedetailwidthmodel($priceid);
		//echo $priceid;
	}


	function updateratedetails() {
		if (!empty($_POST)) {
		    $this->load->module_model(RATE_DETAILS_WIDTH_FOLDER, 'Rate_details_width_model');
			$arr = $this->Rate_details_width_model->updaterate($_POST['priceid'],$_POST['minwidth'], $_POST['maxwidth'], $_POST['rate']);
		
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/