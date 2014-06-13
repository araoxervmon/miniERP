<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class cutting_instruction extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'cutting_instruction';
	public $view_location = 'cutting_instruction';
	private $cutting_instruction;
	private $partyid;
	private $partyname;
	private $adata;
	private $savevar;
	private $qdata;
	private $rdata;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('cutting_instruction');
		$this->load->language('cutting_instruction');
		$this->cutting_instruction = $this->config->item('cutting_instruction');
		$this->load->module_model(CUTTING_INSTRUCTION_FOLDER, 'cutting_instruction_model');
		$this->data = $this->cutting_instruction_model->formdisplay();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		$this->uri->init_get_params();
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
	}		
}	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['partyname']= $this->partyname;
			$vars['partyid']= $this->partyid;
			/*$vars['qdata']= $this->BundleName();*/
			$vars['rdata']= $this->weightcheck();
			$vars['adata']= $this->cutting_instruction($this->partyid, $this->partyname);	
			$vars['savevar']= $this->save_button($this->partyid);
			$this->_render('cutting_instruction', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->cutting_instruction_model->deleterow($_POST['number']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function listcoildetails($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(CUTTING_INSTRUCTION_FOLDER, 'cutting_instruction_model');
	   $coillists = $this->cutting_instruction_model->coillistdetails($partyid);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->processdate = $cl->processdate;
				$obj->length = $cl->length;
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->noofsheets = $cl->noofsheets;
				$obj->weight = $cl->weight;
				$obj->status = $cl->status;
				//$obj->dl = fuel_url('cutting_instruction/delete_bundle').'/?bundlenumber='.$cl->bundlenumber.'&partynumber='.$cl->pnumber;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }
	
	/*function delete_bundle(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $bundle = $args["bundlenumber"];
        $partynumber = $args["partynumber"];
		$this->load->model('cutting_instruction_model');
		$this->cutting_instruction_model->delete_bundlenumber($bundle, $partynumber);
		echo $bundle;
	}*/
	
	
		function delete_bundle(){
       /* $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $bundle = $args["bundlenumber"];
		$pid = $args["pid"];*/
		$this->load->module_model(CUTTING_INSTRUCTION_FOLDER, 'cutting_instruction_model');
		$this->cutting_instruction_model->delete_bundlenumber($_POST['Bundlenumber'], $_POST['Pid']);
		//echo $priceid;
	}

	
	
	
	
	function totalweight_check(){
		$this->load->module_model(CUTTING_INSTRUCTION_FOLDER, 'cutting_instruction_model');
		$twtchk = $this->cutting_instruction_model->totalweight_checkmodel($_POST['partyid']);
		$twtchkjson = json_encode($twtchk);
		print $twtchkjson;
	
	}
 
/*function BundleName() 
 {
   $this->load->module_model(CUTTING_INSTRUCTION_FOLDER, 'cutting_instruction_model');
   $qdata = $this->cutting_instruction_model->BundleTable($this->partyid);
   
   $qdatajson = json_encode($qdata); 
   return $qdata;
 }*/


function savebundledetails() 
 {
   if (!empty($_POST)) {
    $arr = $this->cutting_instruction_model->savebundle($_POST['pid'],$_POST['bundlenumber'],$_POST['date1'], $_POST['length'], $_POST['rate'], $_POST['bundleweight']);
	//$this->BundleName($_POST['pid']);
    if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
   }
   
   else{
    //redirect(fuel_uri('#'));
   }
}

function weightcheck() 
 {
   if (!empty($_POST)) {
    $leftweight = $this->cutting_instruction_model->weightbundle();
	echo $leftweight;
   }
   
}

	function cutting_instruction($pid, $pname) {
		$adata = $this->cutting_instruction_model->getCuttingInstruction($pid, $pname);
		return $adata;
	}
	
	function save_button()
	{
	if (!empty($_POST)) {
		 $savevar = $this->cutting_instruction_model->savechange($_POST['pid']);
		return $savevar;
	}
	}
	
	function editbundle() {
		if (!empty($_POST)) {
			$arr = $this->cutting_instruction_model->editbundlemodel($_POST['pid'],$_POST['bundlenumber'],$_POST['length'], $_POST['rate'],$_POST['bundleweight']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function cancelcoils(){
		if (!empty($_POST)) {
		$cancel = $this->cutting_instruction_model->cancelcoilmodel($_POST['date1'],$_POST['bundlenumber'],$_POST['pid']);
		return $cancel;
		}	
	}
		
}
/* End of file */
/* Location: ./fuel/modules/controllers*/