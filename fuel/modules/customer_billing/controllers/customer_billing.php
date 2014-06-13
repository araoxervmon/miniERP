<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class customer_billing extends Fuel_base_controller {
	public $nav_selected = 'customer_billing';
	public $view_location = 'customer_billing';
	private $data;
	private $gdata;
	private $wei;
	private $tax;
	private $basic;
	private $bill;
	private $chkuser;
	function __construct()
	{
		parent::__construct();
		$this->config->load('customer_billing');
		$this->load->language('customer_billing');
		$this->customer_billing = $this->config->item('customer_billing');
		$this->load->module_model(CUSTOMER_BILLING_FOLDER, 'customer_billing_model');
		$this->load->model('party_details_model');
		$this->data = $this->customer_billing_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['chkuser']= $this->chk_user();
			$this->_render('customer_billing', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	function editCoil(){
		echo $_GET['partyid'];
	}
		
	
	function chk_user(){
		$chkuser = $this->customer_billing_model->chk_user();
		return $chkuser;
	}	
		 
	function billing_pdf(){
		$queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
		$partyname = $args["partyname"];
		$frmdate = $args["frmdate"];
        $todate = $args["todate"];
		$this->load->module_model(CUSTOMER_BILLING_FOLDER, 'customer_billing_model');
	$billgenerateb = $this->customer_billing_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->customer_billing_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	function partytotalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_individualaccount_name'];
		}
		$wei = $this->customer_billing_model->partytotalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}


	
	function totalbasic_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$bas = $this->customer_billing_model->totalbasic_check($partyname);
		$basjson = json_encode($bas);
		print $basjson;
	
	}
	
		function totaltax_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$tax = $this->customer_billing_model->totaltax_check($partyname);
		$taxjson = json_encode($tax);
		print $taxjson;
	
	}
	
	
	function partytotalbasic_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_individualaccount_name'];
		}
		$bas = $this->customer_billing_model->partytotalbasic_check($partyname);
		$basjson = json_encode($bas);
		print $basjson;
	
	}
	
	
	function partytotaltax_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_individualaccount_name'];
		}
		$tax = $this->customer_billing_model->partytotaltax_check($partyname);
		$taxjson = json_encode($tax);
		print $taxjson;
	
	}
	
	
		function totalbill_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$bill = $this->customer_billing_model->totalbill_check($partyname);
		$billjson = json_encode($bill);
		print $billjson;
	
	}
	
	
	function partytotalbill_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_individualaccount_name'];
		}
		$bill = $this->customer_billing_model->partytotalbill_check($partyname);
		$billjson = json_encode($bill);
		print $billjson;
	
	}
	
	
	function export_party($partyname = '',$frmdate = '', $todate = '') {
	$partyname = $_POST['partyname'];	
	$frmdate = $_POST['frmdate'];	
	$todate = $_POST['todate'];	
		$this->load->model('customer_billing_model');
		$containers = $this->customer_billing_model->export_partyname($partyname,$frmdate, $todate);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billno = $container->billno;
			$obj->coilnumber = $container->coilnumber;
			$obj->SHEdutax = $container->SHEdutax;
			$obj->description = $container->description;
			$obj->educationtax = $container->educationtax;
			$obj->Sertax = $container->Sertax;
			$obj->weight = $container->weight;
			$obj->oweight = $container->oweight;
			$obj->billdate = $container->billdate;
			$obj->totalamt = $container->totalamt;
			$obj->totalbillamount = $container->totalbillamount;
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
		$containers = $this->customer_billing_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			
			$obj->billdate = $container->billdate;
			$obj->billno = $container->billno;
			$obj->coilnumber = $container->coilnumber;
			$obj->description = $container->description;
			$obj->totalamt = $container->totalamt;
			$obj->weight = $container->weight;
			$obj->Sertax = $container->Sertax;
			$obj->SHEdutax = $container->SHEdutax;
			$obj->educationtax = $container->educationtax;
			$obj->totalbillamount = $container->totalbillamount;
			$obj->pr = site_url('customer_billing/print_partywise').'/?billno='.$container->billno.'&partyname='.$partyname;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function list_individualparty($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->customer_billing_model->list_individualparty($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			
			$obj->billdate = $container->billdate;
			$obj->billno = $container->billno;
			$obj->coilnumber = $container->coilnumber;
			$obj->description = $container->description;
			$obj->totalamt = $container->totalamt;
			$obj->weight = $container->weight;
			//$obj->basic = $container->basic;
			$obj->tax = $container->tax;
			$obj->totalbillamount = $container->totalbillamount;
			$obj->pr = site_url('customer_billing/print_partywise').'/?billno='.$container->billno.'&partyname='.$partyname;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function list_coil() {	
		$gdata = $this->customer_billing_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/