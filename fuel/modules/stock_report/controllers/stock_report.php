<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class stock_report extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'stock_report';
	public $view_location = 'stock_report';
	private $stock_report;
	private $gdata;
	private $adata; 
	private $wei ;
	private $tweight;
	function __construct()
	{
		parent::__construct();
		$this->config->load('stock_report');
		$this->load->language('stock_report');
		$this->stock_report = $this->config->item('stock_report');
		$this->load->module_model(STOCK_REPORT_FOLDER, 'stock_report_model');
		$this->load->model('party_details_model');
		$this->data = $this->stock_report_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}
		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('stock_report', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	function editCoil(){
		echo $_GET['partyid'];
	}
		
	function totalweight_check($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$this->load->model('stock_report_model');
		$wei = $this->stock_report_model->totalweight_check($partyname);
		$weijson = json_encode($wei);
		print $weijson;
	
	}
	

	
	function list_party($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['party_account_name'];
		}
		$this->load->model('stock_report_model');
		$containers = $this->stock_report_model->list_partyname($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->pweight = $container->pweight;
			$obj->status = $container->status;
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
			$partyname = $_POST['party_individualaccount_name'];
		}
		$this->load->model('stock_report_model');
		$containers = $this->stock_report_model->list_individualparty($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->description = $container->description;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->pweight = $container->pweight;
			$obj->status = $container->status;
			$obj->process = $container->process;
			$obj->ci = site_url('fuel/cutting_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
            $obj->sl = site_url('fuel/slitting_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
            $obj->rc = site_url('fuel/recoiling').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
            $obj->bi = site_url('fuel/billing_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$partyname.'&process='.$container->process;
			$obj->dl = fuel_url('partywise_register/delete_coil').'/?coilnumber='.$container->coilnumber;
			$obj->tr = site_url('fuel/transfer_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
			$obj->pr = site_url('partywise_register/print_partywise').'/?partyid='.$container->coilnumber.'&partyname='.$partyname;
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
		$this->load->model('stock_report_model');
		$this->stock_report_model->print_partywisemodel($partyid,$partyname);
	}
	
	function delete_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $coil = $args["coilnumber"];
		$this->load->model('stock_report_model');
		$this->stock_report_model->delete_coilnumber($coil);
		echo $coil;
	}
	
	function list_coil() {	
		$this->load->model('stock_report_model');
		$gdata = $this->stock_report_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}
	
	function listChilds($parentid = '')  {	
		if(empty($parentid)) { 
			$parentid = $_POST['partyid'];
		}
		$this->load->model('stock_report_model');
		$childs = $this->stock_report_model->list_childitems($parentid);
		if(!empty($childs)){
			$files = array();
			foreach($childs as $child) {
				$obj = new stdClass();
				if($child->process=='Cutting'){
				$obj->processdate = $child->processdate;
				$obj->length = $child->length;
				$obj->bundlenumber = $child->bundlenumber;
				$obj->bundles = $child->bundles;
				$obj->weight = $child->weight;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='Recoiling'){
				$obj->recoilnumber = $child->recoilnumber;
				$obj->startdate = $child->startdate;
				$obj->enddate = $child->enddate;
				$obj->norecoil = $child->norecoil;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='Slitting'){
				$obj->slittnumber = $child->slittnumber;
				$obj->date = $child->date;
				$obj->width = $child->width;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='NULL'){
				$status = array("status"=>"No Results!");
				}
				//$obj->parentid = $parentid;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function listindividualChilds($parentid = '')  {	
		if(empty($parentid)) { 
			$parentid = $_POST['partyid'];
		}
		$this->load->model('stock_report_model');
		$childs = $this->stock_report_model->listindividualChilds($parentid);
		if(!empty($childs)){
			$files = array();
			foreach($childs as $child) {
				$obj = new stdClass();
				if($child->process=='Cutting'){
				$obj->processdate = $child->processdate;
				$obj->length = $child->length;
				$obj->bundlenumber = $child->bundlenumber;
				$obj->bundles = $child->bundles;
				$obj->weight = $child->weight;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='Recoiling'){
				$obj->recoilnumber = $child->recoilnumber;
				$obj->startdate = $child->startdate;
				$obj->enddate = $child->enddate;
				$obj->norecoil = $child->norecoil;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='Slitting'){
				$obj->slittnumber = $child->slittnumber;
				$obj->date = $child->date;
				$obj->width = $child->width;
				$obj->status = $child->status;
				$obj->process = $child->process;
				}
				else if($child->process=='NULL'){
				$status = array("status"=>"No Results!");
				}
				//$obj->parentid = $parentid;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	/*function cutting_instruction() {
		if (!empty($_POST)) {
		$adata = $this->cutting_instruction_model->getCuttingInstruction();
		//$adatajson = json_encode($adata);
			echo $adata;die();
		return $adata;
		//redirect(fuel_url('cutting_instruction'));
		}else{	
			//redirect(fuel_url('#'));
		}
}*/
}

/* End of file */
/* Location: ./fuel/modules/controllers*/