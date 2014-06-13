<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class recoiling extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'recoiling';
	public $view_location = 'recoiling';
	private $ndata;
	private $mdata;
	private $partyid;
	private $partyname;
	
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('recoiling');
		$this->load->language('recoiling');
		$this->recoiling = $this->config->item('recoiling');
		$this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
		$this->data = $this->recoiling_model->example();
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
			$vars['mdata']= $this->RecoilName();
			$vars['partyid']= $this->partyid;
			$vars['ndata']= $this->recoiling_no($this->partyid, $this->partyname);
            $this->_render('recoiling', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
		
	function recoiling_no($pid, $pname) {
		$adata = $this->recoiling_model->getrecoiling($pid, $pname);
		return $adata;
	}
	
	function listrecoildetails($partyid = '') 
	{
	   if(empty($partyid)) { 
			$partyid = $_POST['partyid'];
	   }
	   $this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
	   $coillists = $this->recoiling_model->recoillistdetails($partyid);
	   
	   if(!empty($coillists)){
			$files = array();
			foreach($coillists as $cl) {
				$obj = new stdClass();
				$obj->recoilno = $cl->recoilno;
				$obj->coilno = $cl->coilno;
				$obj->startdate = $cl->startdate;
				$obj->enddate = $cl->enddate;
				$obj->nNoOfRecoils = $cl->nNoOfRecoils;
				$obj->weight = $cl->weight;
			//	$obj->dl = fuel_url('recoiling/delete_recoil').'/?startdate='.$cl->startdate.'&coilno='.$cl->coilno.'&enddate='.$cl->enddate.'&noofrecoil='.$cl->noofrecoil;
				$files[] = $obj;
			}
			echo json_encode($files);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
/*	function delete_recoil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $coilno = $args["coilno"];
        $startdate = $args["startdate"];
        $enddate = $args["enddate"];
        $noofrecoil = $args["noofrecoil"];
		$this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
		$this->recoiling_model->delete_recoil($coilno,$startdate,$enddate,$noofrecoil);
		echo $bundle;
	}*/
	
	function save_button()
	{
	if (!empty($_POST)) {
		 $savevar = $this->recoiling_model->savechange($_POST['pid']);
		return $savevar;
	}
	}
	
		function deleterecoil(){
		$this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
		$this->recoiling_model->delete_recoil($_POST['Recoilnumber'], $_POST['Pid']);
		//echo $priceid;
	}
 
	
	
	function RecoilName(){
   $this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
   $mdata = $this->recoiling_model->RecoilTable($this->partyid);
   
   $mdatajson = json_encode($mdata); 
   return $mdata;
 }
	
	
	
	function saverecoildetails(){
		if (!empty($_POST)){
			$arr = $this->recoiling_model->saverecoil($_POST['pid'],$_POST['date1'], $_POST['datepicker'],$_POST['nocoil'],$_POST['weightcoil']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	function deleterow(){
		if (!empty($_POST)) {
			$arr = $this->recoiling_model->deleterow($_POST['number']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function recoilingcontrlr(){
	   $this->load->module_model(RECOILING_FOLDER, 'recoiling_model');
	   $adata = $this->recoiling_model->recoiling_model($this->partyid);
	   $adatajson = json_encode($adata); 
	   return $adata;
	}
	
}
/* End of file */
/* Location: ./fuel/modules/controllers*/