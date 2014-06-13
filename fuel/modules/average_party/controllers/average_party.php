<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class average_party extends Fuel_base_controller {
	public $nav_selected = 'average_party';
	public $view_location = 'average_party';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('average_party');
		$this->load->language('average_party');
		$this->billing_statement = $this->config->item('average_party');
		$this->load->module_model(AVERAGE_PARTY_FOLDER, 'average_party_model');
		$this->load->model('party_details_model');
		$this->data = $this->average_party_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('average_party', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	function editCoil(){
		echo $_GET['partyid'];
	}
		
		
		 
		function billing_pdf(){
		$queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
		$partyname = $args["partyname"];
		$this->load->module_model(AVERAGE_PARTY_FOLDER, 'average_party_model');
	$billgenerateb = $this->average_party_model->billgeneratemodel($partyname);
	
	}
		
		
	function export_party($partyname = '') {	
	$partyname = $_POST['partyname'];	
		$this->load->model('average_party_model');
		$containers = $this->average_party_model->export_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->coilno = $container->coilno;
			$obj->indate = $container->indate;
			$obj->bdate = $container->bdate;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->quantity = $container->quantity;
			$obj->noofdays = $container->noofdays;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->average_party_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->average_party_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billdate = $container->billdate;
			$obj->receiveddate = $container->receiveddate;
			$obj->weight = $container->weight;
			$obj->coilnumber = $container->coilnumber;
			$obj->days = $container->days;
			$obj->avgwei = $container->avgwei;
			$obj->pr = site_url('average_party/print_partywise').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	

	
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/