<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class customer_summary extends Fuel_base_controller {
	public $nav_selected = 'customer_summary';
	public $view_location = 'customer_summary';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('customer_summary');
		$this->load->language('customer_summary');
		$this->customer_summary = $this->config->item('customer_summary');
		$this->load->module_model(CUSTOMER_SUMMARY_FOLDER, 'customer_summary_model');
		$this->load->model('party_details_model');
		$this->data = $this->customer_summary_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('customer_summary', $vars);
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
		$this->load->module_model(CUSTOMER_SUMMARY_FOLDER, 'customer_summary_model');
	$billgenerateb = $this->customer_summary_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->customer_summary_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
		
	function totalbasic_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$bas = $this->customer_summary_model->totalbasic_check($partyname);
		$basjson = json_encode($bas);
		print $basjson;
	
	}
	
		function totaltax_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$tax = $this->customer_summary_model->totaltax_check($partyname);
		$taxjson = json_encode($tax);
		print $taxjson;
	
	}
	
	
		function totalbill_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$bill = $this->customer_summary_model->totalbill_check($partyname);
		$billjson = json_encode($bill);
		print $billjson;
	
	}
	
	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->customer_summary_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->partyname = $container->partyname;
			$obj->basic = $container->basic;
			$obj->tax = $container->tax;
			//$obj->tot = $container->tot;Total Billing amount
			$obj->gtot = $container->gtot;
			//$obj->pr = site_url('customer_summary/print_partywise').'/?billno='.$container->billno.'&partyname='.$partyname;
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
		$this->customer_summary_model->print_partywisemodel($billno,$partyname);
	}
	
	function list_coil() {	
		$gdata = $this->customer_summary_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/