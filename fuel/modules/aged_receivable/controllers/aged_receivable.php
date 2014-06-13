<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class aged_receivable extends Fuel_base_controller {
	public $nav_selected = 'aged_receivable';
	public $view_location = 'aged_receivable';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('aged_receivable');
		$this->load->language('aged_receivable');
		$this->aged_receivable = $this->config->item('aged_receivable');
		$this->load->module_model(AGED_RECEIVABLE_FOLDER, 'aged_receivable_model');
		$this->load->model('party_details_model');
		$this->data = $this->aged_receivable_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('aged_receivable', $vars);
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
		$this->load->module_model(AGED_RECEIVABLE_FOLDER, 'aged_receivable_model');
	$billgenerateb = $this->aged_receivable_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->aged_receivable_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->aged_receivable_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->name = $container->name;
			$obj->phone = $container->phone;
			$obj->totalamount = $container->totalamount;
			$obj->amountpaid = $container->amountpaid;
			$obj->balanceamount = $container->balanceamount;
			$obj->pr = site_url('aged_receivable/print_partywise').'/?partyid='.$container->name.'&partyname='.$partyname;
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
		$this->aged_receivable_model->print_partywisemodel($partyid,$partyname);
	}
	
	function list_coil() {	
		$gdata = $this->aged_receivable_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/