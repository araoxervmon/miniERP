<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Workin_progress extends Fuel_base_controller {
	private $data;
	private $adata;
	public $nav_selected = 'workin_progress';
	public $view_location = 'workin_progress';
	private $workin_progress;
	private $tweight;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('workin_progress');
		$this->load->language('workin_progress');
		$this->workin_progress = $this->config->item('workin_progress');
		$this->load->module_model(WORKIN_PROGRESS_FOLDER, 'workin_progress_model');
		$this->data = $this->workin_progress_model->example();
		$this->adata = $this->workintoolbar();
		if(isset($this->data)) {
			if(isset($this->data[0]))  {
			}
		}	
	}
	
	function index()
	{
		if(!empty($this->data) && isset($this->data)) {
			$vars['adata']= $this->adata;
			$vars['tweight'] = $this->totalb_weight();
			$vars['cuttingslip'] = $this->generate_cuttingslip();
		//	$this->load->view('cutting_slip'); view file of cutting slip
			$vars['workinprogress_lists'] = json_decode($this->workinprogress_list());
			$this->_render('workin_progress', $vars);
			
			
		} else {
			redirect(fuel_url('#'));
		}
	}
	function workintoolbar()
	{
		$adata = $this->workin_progress_model->toolbar_list();
		return $adata;
	}
	
	function workinprogress_list(){
		$containers = $this->workin_progress_model->toolbar_list();
		if(!empty($containers)){
		foreach($containers as $container) {
			$obj = new stdClass();
			$obj->coilnumber = $container->coilnumber;
			$obj->receiveddate = $container->receiveddate;
			$obj->sizegivendate = $container->sizegivendate;
			$obj->recoilingdate = $container->recoilingdate;
			$obj->slittingdate = $container->slittingdate;
			$obj->partyname = $container->partyname;
			$obj->materialdescription = $container->materialdescription;
			$obj->thickness = $container->thickness;
			$obj->width = $container->width;
			$obj->weight = $container->weight;
			$obj->process = $container->process;
			$obj->cs = site_url('workin_progress/cutting_slip').'/?partyid='.$container->coilnumber.'&partyname='.$container->partyname;
            $obj->al = site_url('fuel/cutting_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$container->partyname;
            $obj->fi = site_url('fuel/finish_task').'/?partyid='.$container->coilnumber.'&partyname='.$container->partyname.'&task=wip';
            $obj->bl = site_url('fuel/billing_instruction').'/?partyid='.$container->coilnumber.'&partyname='.$container->partyname.'&process=sf'.'&weight='.$container->weight;
			$obj->deleteparty = '?delete';
			$folders[] = $obj;
		}
			 
		}else{
			$status = array("status"=>"No Results!");
            echo json_encode($status);
		}
		return json_encode($folders);
	}
	
	function cutting_slip(){
        $queryStr = $_SERVER['QUERY_STRING'];
        parse_str($queryStr, $args);
        $partyid = $args["partyid"];
        $partyname = $args["partyname"];
		$this->workin_progress_model->cutting_slipmodel($partyid,$partyname);
	}
	
	function alter() {
		$alterdata = $this->workin_progress_model->altermodel();
		return $alterdata;
	}
	
	 function totalb_weight() {
	   $total = $this->workin_progress_model->workweight_model();
	   return $total;
	}
	
	function generate_cuttingslip(){
		if (!empty($_POST)) {	
		$cuttingslip = $this->workin_progress_model->generate_cuttingslip_model($_POST['coilnumber']);
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
