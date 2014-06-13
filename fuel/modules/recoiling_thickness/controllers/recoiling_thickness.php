<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class recoiling_thickness extends Fuel_base_controller {
	private $data;
	private $gdata;
	public $nav_selected = 'recoiling_thickness';
	public $view_location = 'recoiling_thickness';
	private $recoiling_thickness;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->module_model(RECOILING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$this->config->load('recoiling_thickness');
		$this->load->language('recoiling_thickness');
		$this->recoiling_thickness = $this->config->item('recoiling_thickness');
		$this->formdata = $this->recoiling_thickness_model->form_fields();
		$this->gdata = $this->recoiling_thickness_model->CoilTable();
		$this->data = $this->recoiling_thickness_model->select_coilname();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}		
}

function listratethickness($description = '') {	
		if(empty($description)) { 
			$description = $_POST['coil'];
		}
		$this->load->module_model(RECOILING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$containers = $this->recoiling_thickness_model->list_partyname($description);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->priceid = $container->priceid;
			$obj->minthickness = $container->minthickness;
			$obj->maxthickness = $container->maxthickness;
			$obj->rate = $container->rate;
			$obj->edi = fuel_url('recoiling_thickness/editratethickness_coil').'/?priceid='.$container->priceid;
		//	$obj->dl = fuel_url('rate_details_thickness/deleteratethickness_coil').'/?priceid='.$container->priceid;
			

			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	
	function editratewidth_coil(){
		
	}
	
	
		function deleteratethic_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $priceid = $args["priceid"];
		$this->load->module_model(RECOILING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$this->recoiling_thickness_model->delete_ratedetailthickmodel($priceid);
		//echo $priceid;
	}
	
	
	
function coil() {
		$this->load->module_model(RECOILING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$gdata = $this->recoiling_thickness_model->CoilTable();
		$gdatajson = json_encode($gdata); 
		return $gdata;
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['gdata']= $this->coil();
			$vars['formdata']= $this->formdisplay();
			$vars['data']= $this->data;
			$this->_render('recoiling_thickness', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	function tablethickness() 
	{
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$ujson = $this->recoiling_thickness_model->tablewidth();
		return $ujson;
	}
		
	function formdisplay()
	{	
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$formdata = $this->recoiling_thickness_model->form_fields();
		$datajson = json_encode($formdata); 
		return $formdata;
	}
	
	function deleterow()
	{
		if (!empty($_POST)) {
			$arr = $this->recoiling_thickness_model->deleterow($_POST['deletevalue']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to delete';
		}
		else{	
			//redirect(fuel_url('#'));
		}
	}
	
	function SelectCoilName() {
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$data = $this->recoiling_thickness_model->select_coilname();
		$datajson = json_encode($data); 
		return $data;
	}
	
	function listtable() {
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$coildata = $this->recoiling_thickness_model->listcoilname();
		$datajson = json_encode($coildata); 
		return $coildata;
	}
	
	
	function saveratedetails() {
		if (!empty($_POST)) {
			$arr = $this->recoiling_thickness_model->saverate($_POST['coildescription'],$_POST['minthickness'], $_POST['maxthickness'], $_POST['rate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	function deleteratethickness_coil(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $priceid = $args["priceid"];
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$this->recoiling_thickness_model->delete_ratedetailthicknessmodel($priceid);
		//echo $priceid;
	}


	function checkthickness(){
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$checkdata = $this->recoiling_thickness_model->checkthicknessexist();
	
	}
	
	function minthickness(){
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$miledata = $this->recoiling_thickness_model->minthicknessexistmodel($_POST['minthickness'],$_POST['coil']);	  
		if($miledata)
		echo "1";
		else
		echo "0";
		//var_dump($miledata);
	}
	
	function maxthickness(){
		$this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
		$mildata = $this->recoiling_thickness_model->maxthicknessexistmodel($_POST['maxthickness'],$_POST['coil']);	
		if($mildata)
		echo "1";
		else
		echo "0";
	}

	
	
	
	
	function updateratedetails() {
		if (!empty($_POST)) {
		    $this->load->module_model(SLITTING_THICKNESS_FOLDER, 'recoiling_thickness_model');
			$arr = $this->recoiling_thickness_model->updaterate($_POST['priceid'],$_POST['minthickness'], $_POST['maxthickness'], $_POST['rate']);
		
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
		}
		
		else{
			//redirect(fuel_uri('#'));
		}
	}
}
/* End of file */
/* Location: ./fuel/modules/controllers*/