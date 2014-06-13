<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class aged_payable extends Fuel_base_controller {
	public $nav_selected = 'aged_payable';
	public $view_location = 'aged_payable';
	private $data;
	private $gdata;
	private $wei;
	function __construct()
	{
		parent::__construct();
		$this->config->load('aged_payable');
		$this->load->language('aged_payable');
		$this->aged_payable = $this->config->item('aged_payable');
		$this->load->module_model(AGED_PAYABLE_FOLDER, 'aged_payable_model');
		$this->load->model('party_details_model');
		$this->data = $this->aged_payable_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0])) {
		}
	}		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('aged_payable', $vars);
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
		$this->load->module_model(AGED_PAYABLE_FOLDER, 'aged_payable_model');
	$billgenerateb = $this->aged_payable_model->billgeneratemodel($partyname,$frmdate,$todate);
	
	}
		
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$wei = $this->aged_payable_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$containers = $this->aged_payable_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->name = $container->name;
			$obj->description = $container->description;
			$obj->brandname = $container->brandname;
			$obj->quantityonhand = $container->quantityonhand;
			$obj->inwarddate = $container->inwarddate;
			$obj->pr = site_url('aged_payable/print_partywise').'/?partyid='.$container->inwarddate.'&partyname='.$partyname;
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
		$this->aged_payable_model->print_partywisemodel($partyid,$partyname);
	}
	
	function list_coil() {	
		$gdata = $this->aged_payable_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/