<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Billing extends Fuel_base_controller {

	public $nav_selected =  'billing';
	public $view_location = 'billing';
	private $billing;
	private $data;
	private $sdata;
	private $sltdata;
	private $dirdata;
	private $semidata;
	private $recdata;
	private $partyname;
	private $partyid;
	private $nsno;
	private $processchk;
	private $totalweight;
	private $qdata;
	private $updata;
	private $adata;
	private $ldata;
	private $widata;
	private $vdata; 
	private $hdata;
	private $finalbillgenerateb;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('billing');
		$this->load->language('billing');
		$this->billing_instruction = $this->config->item('billing');
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$this->data = $this->billing_model->example();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		$this->uri->init_get_params();
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
		$this->nsno = (string) $this->input->get('nsno', TRUE);
		$this->slno = (string) $this->input->get('slno', TRUE);
		$this->recno = (string) $this->input->get('recno', TRUE);
		$this->processchk = (string) $this->input->get('processchk', TRUE);
		$this->weight = (string) $this->input->get('weight', TRUE);
	  }	
	}
	
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['partyname']= $this->partyname;
			$vars['partyid']= $this->partyid;
			$vars['partyid']= $this->partyid;
			$vars['nsno']= $this->nsno;
			$vars['slno']= $this->slno;
			$vars['recno']= $this->recno;
			$vars['weight']= $this->weight;
			$vars['processchk']= $this->processchk;
			if($vars['processchk']=='Slitting'){
			$vars['sltdata']= $this->billingpreviewviewcntrlr_slit($this->partyid, $this->partyname,$this->slno);
			}
			else if($vars['processchk']=='Cutting'){
			$vars['sdata']= $this->billingpreviewviewcntrlr($this->partyid, $this->partyname,$this->nsno);
			}
			else if($vars['processchk']=='Recoiling'){
			$vars['recdata']= $this->billingpreviewviewcntrlr_recoil($this->partyid, $this->partyname,$this->recno);
			}
			else if($vars['processchk']==''){
			$vars['dirdata']= $this->billingpreviewviewcntrlr_dirdata($this->partyid, $this->partyname);
			}
			else if($vars['processchk']=='sf'){
			$vars['semidata']= $this->billingpreviewviewcntrlr_semidata($this->partyid, $this->partyname);
			}
			$vars['qdata']= $this->billingbundle();
			$this->_render('billing', $vars);
		}
		else {
			redirect(fuel_url('billing'));
		}
	
	}
	
	function listbundledetails($partyid = '',$nsno = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$nsno = $_POST['nsno'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->bundlelistdetails($partyid,$nsno);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->weight = $cl->weight;
				$obj->actualnumber = $cl->actualnumber;
				$obj->length = $cl->length;
				$obj->notobebilled = $cl->notobebilled;
				$obj->billedweight = $cl->billedweight;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }
	 
	 function listbundledetailsslit($partyid = '',$slno = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$slno = $_POST['slno'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->listbundledetailsslit($partyid,$slno);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->slitnumber = $cl->slitnumber;
				$obj->Width = $cl->Width;
				$obj->sdate = $cl->sdate;
				$obj->actualweight = $cl->actualweight;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }
	 
	 function loadfolderlistrecoilcntrlr($partyid = '',$recno = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$recno = $_POST['recno'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $recoil = $this->billing_model->listbundledetailsrecoil($partyid,$recno);
	   
	   if(!empty($recoil)){
			$files = array();
			foreach($recoil as $rl) {
				$obj = new stdClass();
				$obj->recoilnumber = $rl->recoilnumber;
				$obj->numberofrecoils = $rl->numberofrecoils;
				$obj->stdate = $rl->stdate;
				$obj->enddate = $rl->enddate;
				$obj->weight = $rl->weight;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }
	/* function listprocessingcharges($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->billdetailsprocessingcharges($partyid);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->weight = $cl->weight;
				$obj->actualnumber = $cl->actualnumber;
				$obj->length = $cl->length;
				$obj->notobebilled = $cl->notobebilled;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }*/
	 
		function billing_pdf(){
		$queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
		$coilno = $args["coilno"];
		$partyname = $args["partyname"];
        $description = $args["description"];
		$thic = $args["thic"];
		$wid = $args["wid"];
		$lorryno = $args["lorryno"];
		$totalpcs = $args["totalpcs"];
        $totalweight = $args["totalweight"];
		$totamount = $args["totamount"];
		$actualnumberbundle = $args["actualnumberbundle"];
		$partyid = $args["partyid"];
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$billgenerateb = $this->billing_model->billgeneratemodel($coilno,$partyname,$description,$lorryno,$thic,$wid,$totalpcs,$totalweight,$totamount,$actualnumberbundle,$partyid);
	
	}
	 
	/* 
	function additionalbilling(){
		$vardata = $this->billing_model->additionalbillingmodel($_POST['txtadditional_type'], $_POST['txtamount_mt']);
		return $vardata;		
	}*/
	
	function billingpreviewviewcntrlr($pid, $pname, $nsno) {
		$sdata = $this->billing_model->billingpreviewviewmodel($pid, $pname,$nsno);
		return $sdata;
	}
	
	function billingpreviewviewcntrlr_slit($pid, $pname, $slno) {
		$sltdata = $this->billing_model->billingpreviewviewcntrlr_slit($pid, $pname,$slno);
		return $sltdata;
	}
	function billingpreviewviewcntrlr_recoil($pid, $pname, $recno) {
		$recdata = $this->billing_model->billingpreviewviewcntrlrrecoil($pid, $pname,$recno);
		return $recdata;
	}
	function billingpreviewviewcntrlr_dirdata($pid, $pname) {
		$dirdata = $this->billing_model->billingpreviewviewcntrlr_dirdata($pid, $pname);
		return $dirdata;
	}
	function billingpreviewviewcntrlr_semidata($pid, $pname) {
		$semidata = $this->billing_model->billingpreviewviewcntrlr_semidata($pid, $pname);
		return $semidata;
	}
	function billingbundle(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$qdata = $this->billing_model->billbundle($this->partyid);
		$qdatajson = json_encode($qdata); 
		return $qdata;
	}
	
	
	function countlenvalue() {
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$vdata = $this->billing_model->lenvalue($_POST['pid']);
		$vdatajson = json_encode($vdata); 
		print $vdatajson;
	}
	
	function presentweight() {
		$pwtdata = $this->billing_model->presentweight($_POST['pid']);
		$pwtdatajson = json_encode($pwtdata); 
		print $pwtdatajson;
	}

	function savebundle(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$savedata = $this->billing_model->savebundlemodel($this->partyid,$_POST['txtbundleids'],$_POST['txtbundleweight'],$_POST['pid']);
		return $savedata;
	}
	
	function editupdate(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$updata = $this->billing_model->editupdatemodel($_POST['bundlenumber'],$_POST['billed'],$_POST['pid'],$_POST['bundleweightcalculate']);
		return $updata;
	}
	
	function weightchargecntrlr($partyid = '',$mat_desc = '',$wei = '',$txttotalweight='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$wei = $_POST['wei'];
			$txttotalweight = $_POST['txttotalweight'];
	   }
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$adata = $this->billing_model->otherchargecntrlrmodel($partyid,$mat_desc,$wei,$txttotalweight);
	   if(!empty($adata)){
			$files = array();
			foreach($adata as $cl) {
				$obj = new stdClass();
				$obj->weighttext = $cl->weighttext;
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	

	
	
	
	function finalbillingcalculate(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$finalbill = $this->billing_model->finalbillingcalculatemodel($_POST['bundleid'],$_POST['partyid']);
		$finalbilljson = json_encode($finalbill);
		print $finalbilljson;
	
	}
	
	function finaltotal(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$totalbill = $this->billing_model->finaltotalmodel($_POST['bundleid'],$_POST['partyid']);
		$totalbilljson = json_encode($totalbill);
		print $totalbilljson;
	
	}
	
	function totalamount_calculate(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$totalamtt = $this->billing_model->totalamount_calculatemodel($_POST['bundleid'],$_POST['partyid'],$_POST['txttotalweight'],$_POST['thic'],$_POST['mat_desc'],$_POST['actualnumberbundle'],$_POST['cust_add'],$_POST['cust_rm']);
		$totalamttjson = json_encode($totalamtt);
		print $totalamttjson;
	
	}
			
		
		function totalrate(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$trate = $this->billing_model->totalrate_checkmodel($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc']);
		$tratejson = json_encode($trate);
		print $tratejson;
	}	
	
	
	
	function totalamt(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$tamt = $this->billing_model->totalamt($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc'],$_POST['wei']);
		$tamtjson = json_encode($tamt);
		print $tamtjson;
	}	
	
	
	function totalweight_checks(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$twtchks = $this->billing_model->totalweight_checkmodels($_POST['partyid']);
		$twtchksjson = json_encode($twtchks);
		print $twtchksjson;
	
	}	
		
	function totalslitrates(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$trates = $this->billing_model->totalrate_slitmodel($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc']);
		$tratesjson = json_encode($trates);
		print $tratesjson;
	}	
		
	function totalraterecoil(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$trecoil = $this->billing_model->totalraterecoilmodel($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc']);
		$trecoiljson = json_encode($trecoil);
		print $trecoiljson;
	}
	
	function totalamts(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$tamts = $this->billing_model->totalamts($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc'],$_POST['wei']);
		$tamtsjson = json_encode($tamts);
		print $tamtsjson;
	}	
	
	function totalnorecoil(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$trecoilamt = $this->billing_model->totalnorecoilmodel($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc'],$_POST['wei']);
		$trecoilamtjson = json_encode($trecoilamt);
		print $trecoilamtjson;
	}		
	
	function finalbillingcalculatenoofpcs(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$finalbillpcs = $this->billing_model->finalbillingcalculatenoofpcsmodel($_POST['bundleid'],$_POST['partyid']);
		$finalbillpcsjson = json_encode($finalbillpcs);
		print $finalbillpcsjson;
	
	}		
	function totalengthvalue(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$finaltotalength = $this->billing_model->totalengthvalue($_POST['actualnumberbundle'],$_POST['partyid'],$_POST['mat_desc']);
		$finaltotalengthjson = json_encode($finaltotalength);
		print $finaltotalengthjson;
	
	}
	
	function totaweightvalue(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$finaltotaweight= $this->billing_model->totaweightvalue($_POST['txttotalweight'],$_POST['partyid'],$_POST['mat_desc'],$_POST['wei']);
		$finaltotaweightjson = json_encode($finaltotaweight);
		print $finaltotaweightjson;
	
	}		
	function totawidthvalue(){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$finaltotawidth= $this->billing_model->totawidthvalue($_POST['txttotalweight'],$_POST['partyid'],$_POST['mat_desc'],$_POST['wid']);
		$finaltotawidthjson = json_encode($finaltotawidth);
		print $finaltotawidthjson;
	
	}	
			
	function handling( ) {
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$hdata = $this->billing_model->handling($_POST['pid'],$_POST['mat_desc']);
		$hdatajson = json_encode($hdata); 
		print $hdatajson;
	}
	
	function directbilling(){
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$cust_add = $_POST['cust_add'];
			$cust_rm = $_POST['cust_rm'];
			$txthandling = $_POST['txthandling'];
			$wei = $_POST['wei'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->directbilling($partyid,$mat_desc,$cust_add,$cust_rm,$txthandling,$wei);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				//$obj->noofpcs = $cl->noofpcs;
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
		
	function finalbillgenerate() {
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
        $actualnumberbundle = $args["actualnumberbundle"];
		$cust_add = $args['cust_add'];
		$cust_rm = $args['cust_rm'];
		$billid = $args['billid'];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$finalbillgenerateb = $this->billing_model->finalbillgeneratemodel($partyid,$actualnumberbundle,$cust_add,$cust_rm,$billid);
	}
	

/*	function semibillingmodelpdf(){
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$directbilling = $this->billing_model->semibillingmodelpdf($partyid);
	
	}*/
	
	
	
			function semibillingmodelpdf(){
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $billid = $args["billid"];
		$pname = $args["pname"];
		$partyid = $args["partyid"];
		$cust_add = $args["cust_add"];   
        $cust_rm = $args["cust_rm"];
		$mat_desc = $args["mat_desc"];
		$wid = $args["wid"];
		$thic = $args["thic"];
		$len = $args["len"];
        $wei = $args["wei"];
		$inv_no = $args["inv_no"];
		$totalweight_check = $args["totalweight_check"];
		$totalrate = $args["totalrate"];
		$totalamt = $args["totalamt"];
		$txthandling = $args["txthandling"];
		$txtadditional_type = $args["txtadditional_type"];
        $txtamount_mt = $args["txtamount_mt"];
		$txtoutward_num = $args["txtoutward_num"];
		$txtscrap = $args["txtscrap"];
		$txtservicetax = $args["txtservicetax"];
		$txteductax = $args["txteductax"];
        $txtsecedutax = $args["txtsecedutax"];
		$txtgrandtotal = $args["txtgrandtotal"];
		$container = $args["container"];
		$txtnsubtotal = $args["txtnsubtotal"];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$semibillingmodelpdf = $this->billing_model->semibillingmodelpdf($partyid,$billid,$pname,$cust_add,$cust_rm,$mat_desc,$wid,$thic,$len,$wei,$inv_no,$totalweight_check,
	$totalrate,$totalamt,$txthandling, $txtadditional_type,$txtamount_mt,$txtoutward_num,$txtscrap,$txtservicetax,$txteductax,$txtsecedutax,$txtgrandtotal ,$container,$txtnsubtotal);
	}
	
	function recoilpdf(){
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$recoilbilling = $this->billing_model->recoilpdf($partyid);
	
	}
	function slittingpdf(){
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$recoilbilling = $this->billing_model->slittingpdf($partyid);
	
	}
	
	function recoilcancel(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->recoilcancel($_POST['partyid']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function cuttingcancel(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->cuttingcancel($_POST['billid'],$_POST['pid'],$_POST['presentwei'],$_POST['actualnumberbundle']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function directbillcancel(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->directbillcancel($_POST['billid'],$_POST['pid'],$_POST['wei']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function actualweight(){
		$actualweight = $this->billing_model->actualweight($_POST['pid']);
		$actualweightjson = json_encode($actualweight);
		print $actualweightjson;
	}
	function semicancelbill(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->semicancelbill($_POST['billid'],$_POST['pid'],$_POST['wei']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function slittingcancel(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->slittingcancel($_POST['partyid']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function semifinishedcancel(){
		if (!empty($_POST)){
		$savebilldata = $this->billing_model->semifinishedcancel($_POST['partyid']);
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function savebilldetails(){
		if (!empty($_POST)){
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$savebilldata = $this->billing_model->savebilldetails_model($_POST['billid'],$_POST['partyid'],$_POST['txtamount'],$_POST['txttotalweight'],$_POST['txtscrap'],$_POST['txtoutward_num'],$_POST['txttotalpcs'],$_POST['mat_desc'],$_POST['thic'],$_POST['actualnumberbundle'],$_POST['pname'],$_POST['wid'],$_POST['len'],$_POST['wei'],$_POST['txttotallength'],$_POST['txtweighttotal'],$_POST['txtwidthtotal'],$_POST['txtadditional_type'],$_POST['txtamount_mt'],$_POST['txtnsubtotal'],$_POST['txtservicetax'],$_POST['txteductax'],$_POST['txtsecedutax'],$_POST['txtgrandtotal'],$_POST['container']);  
		if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function lengthchargecntrlr($partyid = '',$mat_desc = '',$len = '',$actualnumberbundle='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$len = $_POST['len'];
			$actualnumberbundle = $_POST['actualnumberbundle'];
	   }
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$ldata = $this->billing_model->lengthchargecntrlrmodel($partyid,$mat_desc,$len,$actualnumberbundle);
	   if(!empty($ldata)){
			$files = array();
			foreach($ldata as $cl) {
				$obj = new stdClass();
				$obj->length = $cl->length;
				$obj->noofpcs = $cl->noofpcs;
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function widthchargecntrlr($partyid = '',$mat_desc = '',$wid = '',$txttotalweight='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$wid = $_POST['wid'];
			$txttotalweight = $_POST['txttotalweight'];
	   }
		$this->load->module_model(BILLING_FOLDER, 'billing_model');
		$widata = $this->billing_model->widthcntrlrmodel($partyid,$mat_desc,$wid,$txttotalweight);
	   
	   if(!empty($widata)){
			$files = array();
			foreach($widata as $cl) {
				$obj = new stdClass();
				$obj->noofpcs = $cl->noofpcs;
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	
	function directbillingd($partyid = '',$mat_desc = '',$txthandling = '',$wei='',$cust_add='',$cust_rm='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$txthandling = $_POST['txthandling'];
			$wei = $_POST['wei'];
			$cust_add = $_POST['cust_add'];
			$cust_rm = $_POST['cust_rm'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->directbillingmodel($partyid,$mat_desc,$txthandling,$wei,$cust_add,$cust_rm);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function finalbillingcntrlr($partyid = '',$mat_desc = '',$thic = '',$actualnumberbundle='',$cust_add='',$cust_rm='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$thic = $_POST['thic'];
			$actualnumberbundle = $_POST['actualnumberbundle'];
			$cust_add = $_POST['cust_add'];
			$cust_rm = $_POST['cust_rm'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $coillists = $this->billing_model->finalbillingmodel($partyid,$mat_desc,$thic,$actualnumberbundle,$cust_add,$cust_rm);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->noofpcs = $cl->noofpcs;
				$obj->weight = $cl->weight;
				$obj->rate = $cl->rate;
				$obj->amount = $cl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function finalbillingcntrlrrecoil($mat_desc = '',$thic = '',$partyid = '',$txtrecoilid='',$cust_add='',$cust_rm='',$txtrecoilweight='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$thic = $_POST['thic'];
			$txtrecoilid = $_POST['txtrecoilid'];
			$cust_add = $_POST['cust_add'];
			$cust_rm = $_POST['cust_rm'];
			$txtrecoilweight = $_POST['txtrecoilweight'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $recoillist = $this->billing_model->finalbillingcntrlrrecoilmodel($mat_desc,$thic,$partyid,$txtrecoilid,$cust_add,$cust_rm,$txtrecoilweight);
	   
	   if(!empty($recoillist)){
			$files = array();
			foreach($recoillist as $rl) {
				$obj = new stdClass();
				$obj->numberofrecoils = $rl->numberofrecoils;
				$obj->weight = $rl->weight;
				$obj->rate = $rl->rate;
				$obj->amount = $rl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function finalbillingcntrlrslit($partyid = '',$mat_desc = '',$thic = '',$txtbundleids='',$cust_add='',$cust_rm='') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
			$mat_desc = $_POST['mat_desc'];
			$thic = $_POST['thic'];
			$txtbundleids = $_POST['txtbundleids'];
			$cust_add = $_POST['cust_add'];
			$cust_rm = $_POST['cust_rm'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $slitlist = $this->billing_model->finalbillingcntrlrslitmodel($partyid,$mat_desc,$thic,$txtbundleids,$cust_add,$cust_rm);
	   
	   if(!empty($slitlist)){
			$files = array();
			foreach($slitlist as $sl) {
				$obj = new stdClass();
				$obj->weight = $sl->weight;
				$obj->rate = $sl->rate;
				$obj->amount = $sl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	
	function loadweightgratecntrl($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $weightlist = $this->billing_model->listloadweightgchargemodel($partyid);
	   
	   if(!empty($weightlist)){
			$files = array();
			foreach($weightlist as $wl) {
				$obj = new stdClass();
				$obj->materialdescription = $wl->materialdescription;
				$obj->minweight = $wl->minweight;
				$obj->maxweight = $wl->maxweight;
				$obj->amount = $wl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function loadlengthcharge($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $weightlist = $this->billing_model->listloadlengthchargemodel($partyid);
	   
	   if(!empty($weightlist)){
			$files = array();
			foreach($weightlist as $wl) {
				$obj = new stdClass();
				$obj->materialdescription = $wl->materialdescription;
				$obj->minlength = $wl->minlength;
				$obj->maxlength = $wl->maxlength;
				$obj->amount = $wl->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
/*	function listadditionalcharge($partyid = ''){
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $additionlist = $this->billing_model->listadditionalchargemodel($partyid);
	   
	   if(!empty($additionlist)){
			$files = array();
			foreach($additionlist as $al){
				$obj = new stdClass();
				$obj->materialdescription = $al->materialdescription;
				$obj->minweight = $al->minweight;
				$obj->maxweight = $al->maxweight;
				$obj->amount = $al->amount;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}*/
	
	function listprocessingcharge($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $additionlist = $this->billing_model->billdetailsprocessingcharges($partyid);
	   
	   if(!empty($additionlist)){
			$files = array();
			foreach($additionlist as $al) {
				$obj = new stdClass();
				$obj->billnumber = $al->billnumber;
				$obj->billdata = $al->billdata;
				$obj->coilnumber = $al->coilnumber;
				$obj->totalweight = $al->totalweight;
				$obj->weightamount = $al->weightamount;
				$obj->servicetax = $al->servicetax;
				$obj->edutax = $al->edutax;
				$obj->shedtax = $al->shedtax;
				$obj->granttotal = $al->granttotal;
				$obj->scrapsent = $al->scrapsent;
				$obj->outlorryno = $al->outlorryno;
				$obj->partyid = $al->partyid;
				$obj->billtype = $al->billtype;
				$obj->billstatus = $al->billstatus;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function billingdirect_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrate = $args["totalrate"];
		$totalweight_check = $args["totalweight_check"];
	    $totalamt = $args["totalamt"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodelsemi($coilno,$partyname,$description,$lorryno,$totalrate,$totalweight_check,$totalamt);
  
	}
	
 
		function billing_direct(){
		//print_r($_POST); die();
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $billid = $args["billid"];
		$partyid = $args["partyid"];
		$pname = $args["pname"];
		$cust_add = $args["cust_add"];
		$cust_rm = $args["cust_rm"];
		$mat_desc = $args["mat_desc"];
		$thic = $args["thic"];
		$wid = $args["wid"];
		$len = $args["len"];
		$wei = $args["wei"];
		$inv_no = $args["inv_no"];
		$totalweight_check = $args["totalweight_check"];
		$totalrate = $args["totalrate"];
		$totalamt = $args["totalamt"];
		$txthandling = $args["txthandling"];
		$txtadditional_type = $args["txtadditional_type"];
		$txtamount_mt = $args["txtamount_mt"];
		$txtoutward_num = $args["txtoutward_num"];
		$txtscrap = $args["txtscrap"];
		$txtservicetax = $args["txtservicetax"];
		$txteductax = $args["txteductax"];
		$txtsecedutax = $args["txtsecedutax"];
		$txtgrandtotal = $args["txtgrandtotal"];
		$container = $args["container"];
	$this->load->module_model(BILLING_FOLDER, 'billing_model');
	$billing_direct = $this->billing_model->billing_direct($billid,$partyid,$pname,$cust_add,$cust_rm,$mat_desc,$thic,$wid,$len,$wei,$inv_no,$totalweight_check,$totalrate,$totalamt,$txthandling,$txtadditional_type,$txtamount_mt,$txtoutward_num,$txtscrap,$txtservicetax,$txteductax,$txtsecedutax,$txtgrandtotal,$container);
	
	}
	
	
	
	function billingdirectprint_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrate = $args["totalrate"];
		$totalweight_check = $args["totalweight_check"];
	    $totalamt = $args["totalamt"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodeldirectprint($coilno,$partyname,$description,$lorryno,$totalrate,$totalweight_check,$totalamt);
  
	}
	
	
	
	function billingslit_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrates = $args["totalrates"];
		$totalweight_checks = $args["totalweight_checks"];
	    $totalamtsslit = $args["totalamtsslit"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodelslit($coilno,$partyname,$description,$lorryno,$totalrates,$totalweight_checks,$totalamtsslit);
  
	}
	
	
	
		function billingslitprint_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrates = $args["totalrates"];
		$totalweight_checks = $args["totalweight_checks"];
	    $totalamts = $args["totalamts"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodelslitprint($coilno,$partyname,$description,$lorryno,$totalrates,$totalweight_checks,$totalamts);
  
	}
	
	 
	function totalamtslit(){
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $tamtslit = $this->billing_model->totalamtslit($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc']);
	  $tamtslitjson = json_encode($tamtslit);
	  print $tamtslitjson;
	 }
	 
	function totalamtrecoil(){
	  $this->load->module_model(BILLING_FOLDER, 'billing_model');
	  $tamtrec = $this->billing_model->totalamtrecoil($_POST['partyid'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['txthandling'],$_POST['mat_desc'],$_POST['txtrecoilweight']);
	  $tamtrecjson = json_encode($tamtrec);
	  print $tamtrecjson;
	 }
	
	
	function billingrecoilprint_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrates = $args["totalrates"];
		$totalnorecoil = $args["totalnorecoil"];
	    $txtamount = $args["txtamount"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodelrecoilprint($coilno,$partyname,$description,$lorryno,$totalrates,$totalnorecoil,$txtamount);
  
	}

	
	
	
	
	function billingrecoil_pdf() {
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $args);
	    $coilno = $args["coilno"];
	    $partyname = $args["partyname"];
		$description = $args["description"];
	    $lorryno = $args["lorryno"];
	    $totalrates = $args["totalrates"];
		$totalnorecoil = $args["totalnorecoil"];
	    $totalamount = $args["totalamount"];
	    $this->load->module_model(BILLING_FOLDER, 'billing_model');
	    $billgenerateb = $this->billing_model->billgeneratemodelrecoil($coilno,$partyname,$description,$lorryno,$totalrates,$totalnorecoil,$totalamount);
  
	}
	
	
	function directbillingbill() {
	if (!empty($_POST)){
	    $directbill = $this->billing_model->directbillingbill($_POST['billid'],$_POST['partyid'],$_POST['pname'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['mat_desc'],$_POST['thic'],$_POST['wid'],$_POST['len'],$_POST['wei'],$_POST['inv_no'],$_POST['totalweight_check'],$_POST['totalrate'],$_POST['totalamt'],$_POST['txthandling'],$_POST['txtadditional_type'],$_POST['txtamount_mt'],$_POST['txtoutward_num'],$_POST['txtscrap'],$_POST['txtservicetax'],$_POST['txteductax'],$_POST['txtsecedutax'],$_POST['txtgrandtotal'],$_POST['container']);
		if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function semibill() {
	if (!empty($_POST)){
	    $directbill = $this->billing_model->semibill($_POST['billid'],$_POST['partyid'],$_POST['pname'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['mat_desc'],$_POST['thic'],$_POST['wid'],$_POST['len'],$_POST['wei'],$_POST['inv_no'],$_POST['totalweight_check'],$_POST['totalrate'],$_POST['totalamt'],$_POST['txthandling'],$_POST['txtadditional_type'],$_POST['txtamount_mt'],$_POST['txtoutward_num'],$_POST['txtscrap'],$_POST['txtservicetax'],$_POST['txteductax'],$_POST['txtsecedutax'],$_POST['txtgrandtotal'],$_POST['container'],$_POST['txtnsubtotal']);
		if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function functionpdfrecoilprint(){	
		if (!empty($_POST)){
			$directbill = $this->billing_model->functionpdfrecoilprint($_POST['billid'],$_POST['partyid'],$_POST['pname'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['mat_desc'],$_POST['thic'],$_POST['wid'],$_POST['len'],$_POST['wei'],$_POST['inv_no'],$_POST['totalweight_check'],$_POST['totalrate'],$_POST['totalamt'],$_POST['txthandling'],$_POST['txtadditional_type'],$_POST['txtamount_mt'],$_POST['txtoutward_num'],$_POST['txtscrap'],$_POST['txtservicetax'],$_POST['txteductax'],$_POST['txtsecedutax'],$_POST['txtgrandtotal'],$_POST['container'],$_POST['txtnsubtotal']);
		if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function functionpdfslittingprint(){	
		if (!empty($_POST)){
			$directbill = $this->billing_model->functionpdfslittingprint($_POST['billid'],$_POST['partyid'],$_POST['pname'],$_POST['cust_add'],$_POST['cust_rm'],$_POST['mat_desc'],$_POST['thic'],$_POST['wid'],$_POST['len'],$_POST['wei'],$_POST['inv_no'],$_POST['totalweight_check'],$_POST['totalrate'],$_POST['totalamt'],$_POST['txthandling'],$_POST['txtadditional_type'],$_POST['txtamount_mt'],$_POST['txtoutward_num'],$_POST['txtscrap'],$_POST['txtservicetax'],$_POST['txteductax'],$_POST['txtsecedutax'],$_POST['txtgrandtotal'],$_POST['container'],$_POST['txtslitsubtotal']);
		if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function checkbillno() {
	  if (!empty($_REQUEST)) {
	  $checkrecordinfo = $this->billing_model->checkbillno($_REQUEST);
	  return $checkrecordinfo;
	  }else {
	  echo 'ERROR';
	  }
	}
}	