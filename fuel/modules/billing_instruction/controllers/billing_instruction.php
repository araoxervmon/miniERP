<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Billing_instruction extends Fuel_base_controller {

	public $nav_selected =  'billing_instruction';
	public $view_location = 'billing_instruction';
	private $data;
	private $adata;
	private $sdata;
	private $semidata;
	private $process;
	private $weight;
	private $billing_instruction;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('billing_instruction');
		$this->load->language('billing_instruction');
		$this->billing_instruction = $this->config->item('billing_instruction');
		$this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
		$this->data = $this->billing_instruction_model->example();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		$this->uri->init_get_params();
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
		$this->process = (string) $this->input->get('process', TRUE);
		$this->weight = (string) $this->input->get('weight', TRUE);
	  }	
	}
	
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['partyname']= $this->partyname;
			$vars['partyid']= $this->partyid;
			$vars['process']= $this->process;
			$vars['weight']= $this->weight;
			$vars['adata']= $this->billingtable_cntrlr();
			$vars['sdata']= $this->billingviewcntrlr($this->partyid, $this->partyname);
			$vars['semidata']= $this->billingsemifinished($this->partyid, $this->partyname);
			$this->_render('billing_instruction', $vars);
		}
		else {
			redirect(fuel_url('billing_instruction'));
		}
	
	}
	
	
	function listbilldetails($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
	   $billistdetails = $this->billing_instruction_model->billistdetails($partyid);

	   if(!empty($billistdetails)){
			$files = array();
			foreach($billistdetails as $cl) {
				$obj = new stdClass();
				//$obj->processdate = $cl->processdate;
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->length = $cl->length;
				$obj->weight = $cl->weight;
				$obj->totalnumberofsheets = $cl->totalnumberofsheets;
				$obj->coilnumber = $cl->coilnumber;
				$obj->noofsheetsbilled = $cl->noofsheetsbilled;
				$obj->billingstatus = $cl->billingstatus;
				$obj->balance = $cl->balance;
				$obj->dl = '/?bundlenumber='.$cl->bundlenumber;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	
	function loadfolderlistslit($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
	   $slitdetails = $this->billing_instruction_model->loadfolderlistslit($partyid);

	   if(!empty($slitdetails)){
			$files = array();
			foreach($slitdetails as $sl) {
				$obj = new stdClass();
				$obj->serialnumber = $sl->serialnumber;
				$obj->slitnumber = $sl->slitnumber;
				$obj->width = $sl->width;
				$obj->sdate = $sl->sdate;
				$obj->noofsheetsbilled = $sl->noofsheetsbilled;
				$obj->billingstatus = $sl->billingstatus;
				$obj->dl = '/?slitnumber='.$sl->slitnumber;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	function loadfolderlistrecoil($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
	   $slitdetails = $this->billing_instruction_model->loadfolderlistrecoil($partyid);

	   if(!empty($slitdetails)){
			$files = array();
			foreach($slitdetails as $sl) {
				$obj = new stdClass();
				$obj->recoilnumber = $sl->recoilnumber;
				$obj->noofrecoil = $sl->noofrecoil;
				$obj->sdate = $sl->sdate;
				$obj->edate = $sl->edate;
				$obj->noofsheetsbilled = $sl->noofsheetsbilled;
				$obj->billingstatus = $sl->billingstatus;
				$obj->dl = '/?recoilnumber='.$sl->recoilnumber;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	function delete_bundle(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $bundle = $args["bundlenumber"];
        $coilnumber = $args["coilnumber"];
		$this->load->model('billing_instruction_model');
		$this->billing_instruction_model->delete_bundlenumber($bundle,$coilnumber);
		echo $bundle;
	}
	
	function billingpreview(){
		
	}
	
	function processchk(){
	  $this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
	  $pchk = $this->billing_instruction_model->processchk($_POST['pid']);
	  $pchkjson = json_encode($pchk); 
	  print $pchkjson;
	}

	function billingtable_cntrlr(){
	   $this->load->module_model(BILLING_INSTRUCTION_FOLDER, 'billing_instruction_model');
	   $adata = $this->billing_instruction_model->billintable_model($this->partyid);
	   $qdatajson = json_encode($adata); 
	   return $adata;
	}
	
	function billingviewcntrlr($pid, $pname) {
		$ddata = $this->billing_instruction_model->billingviewmodel($pid, $pname);
		return $ddata;
	}
	function billingsemifinished($pid, $pname) {
		$smdata = $this->billing_instruction_model->billingsemifinished($pid, $pname);
		return $smdata;
	}
}