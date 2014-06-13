<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class bill_descriptions extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'bill_descriptions';
	public $view_location = 'bill_descriptions';
	private $partywise_register;
	private $gdata;
	private $adata; 
	private $wei ;
	private $bdata; 
	private $getnsno; 
	private $tweight;
	private $chkuser;
	function __construct()
	{
		parent::__construct();
		$this->config->load('bill_descriptions');
		$this->load->language('bill_descriptions');
		$this->bill_descriptions = $this->config->item('bill_descriptions');
		$this->load->module_model(BILL_DESCRIPTIONS_FOLDER, 'bill_descriptions_model');
		$this->data = $this->bill_descriptions_model->getPartyDetailsCredentials();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
	}
		
}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$this->_render('bill_descriptions', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}


	
	
	
		function bill_list($partyname = '') {	
		if(empty($partyname)) { 
			$partyname = $_POST['partyname'];
		}
		$this->load->model('bill_descriptions_model');
		$containers = $this->bill_descriptions_model->bill_list($partyname);
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billno = $container->billno; 
			$obj->coilno = $container->coilno;			
			$obj->partyname = $container->partyname;  
			$obj->billdate = $container->billdate; 
			$obj->billtype = $container->billtype;  
			$obj->billedweight = $container->billedweight;
			$obj->in_billweight = $container->in_billweight;	
			$obj->grandtotal = $container->grandtotal;
			$obj->words = $container->words;
			$obj->lorryno = $container->lorryno; 
			$obj->weight = $container->weight; 
			$obj->pweight = $container->pweight; 
		//$obj->dl = fuel_url('bill_descriptions/delete_coil').'/?partyid='.$container->coilnumber.'&partyname='.$partyname.'&process='.$container->process;
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	

		function delete_coil(){
		$this->load->module_model(BILL_DESCRIPTIONS_FOLDER, 'bill_descriptions_model');
		 $bdata = $this->bill_descriptions_model->delete_bill( $_POST['partyname'], $_POST['billno'], $_POST['coilno'], $_POST['billtype'] ,$_POST['weight'],$_POST['nsnumber'],$_POST['bweight'],$_POST['pweight'],$_POST['in_billweight']);
		return $bdata;
	}

	
	
		function getnsno(){
		$this->load->module_model(BILL_DESCRIPTIONS_FOLDER, 'bill_descriptions_model');
		 $getnsno = $this->bill_descriptions_model->getnsno( $_POST['billno']);
		print json_encode(array('billdata' => $getnsno));
	}


	function list_coil() {	
		$this->load->model('coil_details_model');
		$gdata = $this->coil_details_model->list_coilitems();
		$gdatajson = json_encode($gdata); 
		return $gdata;		
	}



	
	
	
	

}

/* End of file */
/* Location: ./fuel/modules/controllers*/