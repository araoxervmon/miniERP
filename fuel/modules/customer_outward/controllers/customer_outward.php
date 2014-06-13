<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class customer_outward extends Fuel_base_controller {
	public $nav_selected = 'customer_outward';
	public $view_location = 'customer_outward';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('customer_outward');
		$this->load->language('customer_outward');
		$this->customer_outward = $this->config->item('customer_outward');
		$this->load->module_model(CUSTOMER_OUTWARD_FOLDER, 'customer_outward_model');
		$this->load->model('party_details_model');
		$this->data = $this->customer_outward_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('customer_outward', $vars);
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
		$this->load->module_model(CUSTOMER_OUTWARD_FOLDER, 'customer_outward_model');
	$billgenerateb = $this->customer_outward_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '', $frmdate= '', $todate= '') {	
			$partyname = $_POST['partyname'];
				$frmdate = $_POST['frmdate'];	
				$todate = $_POST['todate'];	
		$wei = $this->customer_outward_model->totalweight_check($partyname,$frmdate, $todate);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	
	function export_party($partyname = '',$frmdate = '', $todate = '') {
	$partyname = $_POST['partyname'];	
	$frmdate = $_POST['frmdate'];	
	$todate = $_POST['todate'];	
		$this->load->model('customer_outward_model');
		$containers = $this->customer_outward_model->export_partyname($partyname,$frmdate, $todate);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billdate = $container->billdate;
			$obj->billno = $container->billno;
			$obj->coilnumber = $container->coilnumber;
				$obj->billtype = $container->billtype;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->bweight = $container->bweight;
			$obj->vehicleno = $container->vehicleno;
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
		$containers = $this->customer_outward_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			
			$obj->billno = $container->billno;
			$obj->coilnumber = $container->coilnumber;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->billdate = $container->billdate;
			$obj->vehicleno = $container->vehicleno;
			$obj->pr = site_url('customer_outward/print_partywise').'/?billno='.$container->billno.'&partyname='.$partyname;
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
        $billno = $args["billno"];
        $partyname = $args["partyname"];
		$this->customer_outward_model->print_partywisemodel($billno,$partyname);
	}
	
	function list_coil() {	
		$gdata = $this->customer_outward_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/