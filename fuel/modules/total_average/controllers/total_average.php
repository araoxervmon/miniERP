<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class total_average extends Fuel_base_controller {
	public $nav_selected = 'total_average';
	public $view_location = 'total_average';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('total_average');
		$this->load->language('total_average');
		$this->total_average = $this->config->item('total_average');
		$this->load->module_model(TOTAL_AVERAGE_FOLDER, 'total_average_model');
		$this->load->model('party_details_model');
		$this->data = $this->total_average_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('total_average', $vars);
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
		$frmdate = $args["frmdate"];
        $todate = $args["todate"];
		$this->load->module_model(TOTAL_AVERAGE_FOLDER, 'total_average_model');
	$billgenerateb = $this->total_average_model->billgeneratemodel($frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->total_average_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	
	
	
	function export_party($frmdate = '' , $todate = '') {
	$frmdate = $_POST['frmdate'];	
	$todate = $_POST['todate'];	
		$this->load->model('total_average_model');
		$containers = $this->total_average_model->export_partyname($frmdate ,$todate );
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->partyname = $container->partyname;
			$obj->total = $container->total;
			$folders[] = $obj;

			
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->total_average_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billdate = $container->billdate;
			$obj->receiveddate = $container->receiveddate;
			$obj->weight = $container->weight;
			$obj->coilnumber = $container->coilnumber;
			$obj->days = $container->days;
			$obj->avgwei = $container->avgwei;
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