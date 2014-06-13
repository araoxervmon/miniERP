<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class customer_inward extends Fuel_base_controller {
	public $nav_selected = 'customer_inward';
	public $view_location = 'customer_inward';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('customer_inward');
		$this->load->language('customer_inward');
		$this->customer_inward = $this->config->item('customer_inward');
		$this->load->module_model(CUSTOMER_INWARD_FOLDER, 'customer_inward_model');
		$this->load->model('party_details_model');
		$this->data = $this->customer_inward_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('customer_inward', $vars);
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
		$frmdate = $args["frmdate"];
        $todate = $args["todate"];
		$this->load->module_model(CUSTOMER_INWARD_FOLDER, 'customer_inward_model');
	$billgenerateb = $this->customer_inward_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '',$frmdate = '', $todate = '') {
		if(empty($partyname)) { 
			$partyname = $_POST['partyname'];
			$frmdate = $_POST['frmdate'];	
			$todate = $_POST['todate'];	
		}
		$wei = $this->customer_inward_model->totalweight_check($partyname,$frmdate, $todate);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	
	
	
	
	function export_party($partyname = '',$frmdate = '', $todate = '') {
	$partyname = $_POST['partyname'];	
	$frmdate = $_POST['frmdate'];	
	$todate = $_POST['todate'];	
		$this->load->model('customer_inward_model');
		$containers = $this->customer_inward_model->export_partyname($partyname,$frmdate, $todate);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->partyname = $container->partyname;
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->status = $container->status;
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
		$containers = $this->customer_inward_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->status = $container->status;
			$obj->process = $container->process;
			$obj->pr = site_url('customer_inward/print_partywise').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function print_partywise(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
        $partyname = $args["partyname"];
		$this->customer_inward_model->print_partywisemodel($partyid,$partyname);
	}
	
	function list_coil() {	
		$gdata = $this->customer_inward_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/