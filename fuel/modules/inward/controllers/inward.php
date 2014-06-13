<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class inward extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'inward';
	public $view_location = 'inward';
	private $datam;
	private $fdata;
	
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('inward');
		$this->load->language('inward');
		$this->inward = $this->config->item('inward');
		$this->load->module_model(INWARD_FOLDER, 'inward_model');
		$this->data = $this->inward_model->example();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		
		$this->uri->init_get_params();
		$this->pname = (string) $this->input->get('pname', TRUE);
		if($this->pname == 'undefined' || $this->pname == '' || $this->pname == 'No Result'){
			$this->pname = '';
		}
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
		$this->datam = $this->inward_model->mat();
		$this->fdata = $this->inward_model->party();
		
	}		
}	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			
			$vars['data']= $this->data;
			$vars['pname'] = $this->pname;
			$vars['datam']= $this->datam;
			$vars['fdata']= $this->fdata;
            $this->_render('inward', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
	
	
		function checkcoilno() {
		if (!empty($_REQUEST)) {
		$checkrecordinfo = $this->inward_model->checkcoilno($_REQUEST);
		return $checkrecordinfo;
		}else {
		echo 'ERROR';
		}
	}
	
	

		function inwardbillgenerate(){
	 $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $pname = $args["pname"];
		$pid = $args["pid"];
	$this->load->module_model(INWARD_FOLDER, 'inward_model');
	$inwardbillgenerateb = $this->inward_model->inwardbillgeneratemodel($pname,$pid);
	
	}
		

	function savedetails(){
		if (!empty($_POST)){
		$this->load->module_model(INWARD_FOLDER, 'inward_model');
			$arr = $this->inward_model->saveinwardentry($_POST['pid'],$_POST['pname'], $_POST['date3'],$_POST['lno'],$_POST['icno'],$_POST['date4'], $_POST['coil'],$_POST['fWidth'], $_POST['fThickness'],$_POST['fLength'],$_POST['fQuantity'],$_POST['status'],$_POST['hno'],$_POST['pna']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
	
	
	
	
			
function autosuggest($pname = ''){
		if(empty($pname)) { 
			$pname = $_POST['queryString'];
		}
		$pnamelists = $this->inward_model->list_pnamelists($pname);
		return $pnamelists;
	}

	
	
}
/* End of file */
/* Location: ./fuel/modules/controllers*/