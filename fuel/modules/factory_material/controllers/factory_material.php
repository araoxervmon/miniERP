<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class factory_material extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'factory_material';
	public $view_location = 'factory_material';
	private $rate_details;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$this->config->load('factory_material');
		$this->load->language('factory_material');
		$this->factory_material = $this->config->item('factory_material');
		$this->formdata = $this->factory_material_model->form_fields();
		$this->gdata = $this->factory_material_model->CoilTable();
		$this->data = $this->factory_material_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}



	function export_party($frmdate = '', $todate = '') {	
	$frmdate = $_POST['frmdate'];	
	$todate = $_POST['todate'];	
		$this->load->model('factory_material_model');
		$containers = $this->factory_material_model->export_partyname($frmdate, $todate);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->description = $container->description;
			$obj->inweight = $container->inweight;
			$obj->outweight = $container->outweight;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}



function listratelength($description = '') {	
		if(empty($description)) { 
			$description = $_POST['coil'];
		}
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$containers = $this->factory_material_model->list_partyname($description);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->description = $container->description;	
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->partyname = $container->partyname;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->status = $container->status;
			//$obj->edi = fuel_url('factory_material/editratelength_coil').'/?priceid='.$container->priceid;
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
	
		function SelectCoilName() {
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$data = $this->factory_material_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	




function coil() {
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$gdata = $this->factory_material_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->coil();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('factory_material', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	
		
	function formdisplay()
	{	
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$formdata = $this->factory_material_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
 
		function billing_pdf(){
		$queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
		$frmdate = $args["frmdate"];
        $todate = $args["todate"];
		$this->load->module_model(FACTORY_MATERIAL_FOLDER, 'factory_material_model');
		$billgenerateb = $this->factory_material_model->billgeneratemodel($frmdate,$todate);
	
	}
	

	
	

	
	
}
/* End of file */
/* Location: ./fuel/modules/controllers*/