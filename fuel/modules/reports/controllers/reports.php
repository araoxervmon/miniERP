<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class reports extends Fuel_base_controller {
	private $data;
	public $nav_selected = 'reports';
	public $view_location = 'reports';
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('reports');
		$this->load->language('reports');
		$this->reports = $this->config->item('reports');
		$this->load->module_model(REPORTS_FOLDER, 'reports_model');
		$this->data = $this->reports_model->example();
		$this->load->library('pagination');
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
			}
		}	
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
			$vars['cuttingslip'] = $this->generate_cuttingslip();
			$this->_render('reports', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	function workintoolbar()
	{
		$adata = $this->reports_model->toolbar_list();
		return $adata;
	}
	
	function workinprogress_list(){
		$containers = $this->reports_model->toolbar_list();
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->billno = $container->billno;
			$obj->billdate = $container->billdate;
			$obj->coilnumber = $container->coilnumber;
			$obj->totalweight = $container->totalweight;
			$obj->weightamount = $container->weightamount;
			$obj->servicetax = $container->servicetax;
			$obj->edutax = $container->edutax;
			$obj->sedutax = $container->sedutax;
			$obj->granttotal = $container->granttotal;

			$obj->cs = site_url('workin_progress/cutting_slip').'/?partyid='.$container->coilnumber.'&partyname='.$container->billno;
            $obj->al = site_url('fuel/cutting_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$container->billno;
            $obj->fi = site_url('fuel/finish_task').'/?partyid='.$container->coilnumber.'&partyname='.$container->billno.'&task=wip';
			$obj->deleteparty = '?delete';
			$folders[] = $obj;
		}
			echo json_encode($folders);
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
	}
	
	function cutting_slip(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
        $partyname = $args["partyname"];
		$this->reports_model->cutting_slipmodel($partyid,$partyname);
	}
	
	
	
	function generate_cuttingslip(){
		if (!empty($_POST)) {	
		$cuttingslip = $this->reports_model->generate_cuttingslip_model($_POST['coilnumber']);
		if(!empty($cuttingslip)){
		$this->load->view('cutting_slip');
		$this->_render('cutting_slip');
		return $cuttingslip;
		}
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}	
}

/* End of file */
/* Location: ./fuel/modules/controllers*/
