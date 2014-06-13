<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class finish_task extends Fuel_base_controller {

	public $nav_selected =  'finish_task';
	public $view_location = 'finish_task';
	private $data;
	private $adata;
	private $ddata;
	private $sdata;
	private $ardata;
	private $bdata;
	private $rdata;
	private $ndata;
	private $coilid;
	private $cdata;
	private $partyid;
	private $tweight;
	private $partyname;
	private $taskdata;
	function __construct()
	{
		parent::__construct();
		$this->config->load('finish_task');                               //		"
		$this->load->language('finish_task');							 //all the three has to be loaded in the controller
		$this->finish_task = $this->config->item('finish_task');	    //			"
		$this->load->module_model(FINISH_TASK_FOLDER, 'finish_task_model'); // specifies the folder where our model is
		$this->data = $this->finish_task_model->formdisplay();     
		$this->ardata = $this->finish_task_model->CoilTable();     
	//	$this->adata = $this->finish_task_model->getfinishmodel();
		$this->load->module_model(WORKIN_PROGRESS_FOLDER, 'workin_progress_model'); 
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		$this->uri->init_get_params();
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
		$this->coilid = (string) $this->input->get('coilid', TRUE);
		$this->taskcheck = (string) $this->input->get('&task', TRUE);
	}
	
	}
		
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['partyname']= $this->partyname;
			$vars['partyid']= $this->partyid;
			$vars['ardata']= $this->CoilName();
			$vars['adata']= $this->finishinstruction($this->partyid, $this->partyname);
		//	$vars['tdata']= $this->taskcheck;
			$vars['ndata']= $this->FinishName(); //finish table display//cutting instruction to finish
			$vars['tweight'] = $this->totalb_weight($this->partyid);
		/*	if($this->taskcheck == 'wip'){
			$vars['taskdata']= $this->finishwp($this->partyid, $this->partyname);			
			}
			elseif($this->taskcheck == 'sit') {
			$vars['taskdata']= $this->finish_slit($this->partyid, $this->partyname);	
			}
			else
			{
			$vars['taskdata']= $this->finish_taskcit($this->partyid, $this->partyname);
			}*/
			$this->_render('finish_task', $vars);    //for the view portion to be executed
		}
		else {                          
			redirect(fuel_url('#'));
		}
	
	}
	
	function totalweightcountcalculate(){
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		$totalweightcount = $this->Finish_task_model->totalweightcountmodel($_POST['pid']);
		$totalweightcountjson = json_encode($totalweightcount);
		print $totalweightcountjson;
	
	}
	
	function CoilName() {
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		$ardata = $this->Finish_task_model->CoilTable();
		$adatajson = json_encode($ardata); 
		return $ardata;
	}
	function Date() {
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		$ddata = $this->Finish_task_model->datetime_now();
		return $ddata;
	}
	
	function finishinstruction($pid, $pname) {
		$adata = $this->Finish_task_model->getfinishmodel($pid, $pname);
		return $adata;
	}
	
/*	function finish_slit($pid, $pname) {
		$cdata = $this->Finish_task_model->finishmodelslit($pid, $pname);
		return $cdata;
	}
	
	function finishwp($pid, $pname) {
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		$ardata = $this->Finish_task_model->finishwpmodel($pid, $pname);
		return $ardata;
		
	}
	
	function finish_taskcit($pid, $pname) {
		$bdata = $this->Finish_task_model->finishmodel($pid, $pname);
		return $bdata;
	}
	*/
	
	function FinishName() 
	{
	   $this->load->module_model(FINISH_TASK_FOLDER, 'finish_task_model');
	   $ndata = $this->Finish_task_model->FinishTable($this->partyid);
	   
	   $ndatajson = json_encode($ndata); 
		return $ndata;
	}
	
   	function saveweightdetails() {
		if (!empty($_POST)) {
		    $this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
			$arr = $this->Finish_task_model->saveweight($_POST['bundlenumber'],$_POST['actual'], $_POST['weight'], $_POST['pid']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function listfinishdetails($partyid = '') 
	 {
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
	   $slitlists = $this->Finish_task_model->finishlist_model($partyid);
	   
	   if(!empty($slitlists)){
			$files = array();
			foreach($slitlists as $cl) {
				$obj = new stdClass();
				if($cl->status=='WIP-Cutting'){
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->date = $cl->date;
				$obj->length = $cl->length;
				$obj->actualnumber = $cl->actualnumber;
				$obj->totalweight = $cl->totalweight;
				$obj->bundleweight = $cl->bundleweight;
				$obj->weight = $cl->weight;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
				else if($cl->status=='WIP-Recoiling'){
				$obj->recoilnumber = $cl->recoilnumber;
				$obj->startdate = $cl->startdate;
				$obj->enddate = $cl->enddate;
				$obj->norecoil = $cl->norecoil;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
				else if($cl->status=='WIP-Slitting'){
				$obj->slittnumber = $cl->slittnumber;
				$obj->date = $cl->date;
				$obj->width = $cl->width;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
				else if($cl->status=='Ready To Bill' && $cl->process=='Cutting'){
				$obj->bundlenumber = $cl->bundlenumber;
				$obj->date = $cl->date;
				$obj->length = $cl->length;
				$obj->actualnumber = $cl->actualnumber;
				$obj->bundleweight = $cl->bundleweight;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
				else if($cl->status=='Ready To Bill' && $cl->process=='Recoiling'){
				$obj->recoilnumber = $cl->recoilnumber;
				$obj->startdate = $cl->startdate;
				$obj->enddate = $cl->enddate;
				$obj->norecoil = $cl->norecoil;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
				else if($cl->status=='Ready To Bill' && $cl->process=='Slitting'){
				$obj->slittnumber = $cl->slittnumber;
				$obj->date = $cl->date;
				$obj->width = $cl->width;
				$obj->status = $cl->status;
				$obj->process = $cl->process;
				}
			//	$obj->dl = fuel_url('finish_task/delete_coil').'/?coilnumber='.$cl->bundlenumber;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	 }
	 
	function totalb_weight($partyid = '') {
	   $this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
	   $total = $this->Finish_task_model->finishweight_model($partyid);
	   return $total;
	 }
	 
	 function delete_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $bundle = $args["bundlenumber"];
        $partynumber = $args["partynumber"];
		$this->load->model('Finish_task_model');
		$this->Finish_task_model->delete_bundlenumber($bundle, $partynumber);
		echo $bundle;
	}
	
	function statuschange(){
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		 $bdata = $this->Finish_task_model->finishmodel($_POST['pid'], $_POST['pname'], $_POST['txtbundleids'], $_POST['txtbundleweight'], $_POST['txtboxscrap']);
		return $bdata;
	}

	
	function statuschangerecoil(){
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		 $rdata = $this->Finish_task_model->finishmodelrecoil($_POST['pid'], $_POST['pname'], $_POST['txtbundleids'], $_POST['txtbundleweight']);
		return $rdata;
	}
	
	
	
	function statuschangeslit(){
		$this->load->module_model(FINISH_TASK_FOLDER, 'Finish_task_model');
		 $sdata = $this->Finish_task_model->finishmodelslit($_POST['pid'], $_POST['pname'], $_POST['txtbundleids'], $_POST['txtbundleweight']);
		return $sdata;
	}
	
	
	
}