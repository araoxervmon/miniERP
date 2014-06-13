<?php

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class transfer_instruction extends Fuel_base_controller 
{

	private $data;
	public $nav_selected = 'transfer_instruction';
	public $view_location = 'transfer_instruction';
	private $datam;
	private $adata;
	private $transfer;
	private $partyname;


function __construct()
	{
		parent::__construct();
		$this->config->load('transfer_instruction');
		$this->load->module_model(TRANSFER_INSTRUCTION_FOLDER, 'transfer_instruction_model');
		$this->data = $this->transfer_instruction_model->transfer_instruction();
			if(isset($this->data)) {
			if(isset($this->data[0]))  {
		}
		
		$this->uri->init_get_params();
		$this->datam = $this->transfer_instruction_model->party();
		$this->partyid = (string) $this->input->get('partyid', TRUE);
		$this->partyname = (string) $this->input->get('partyname', TRUE);
	}	

}


function index()
	{
		if(!empty($this->data) && isset($this->data)) {
		
		$vars['partyname']= $this->partyname;
			$vars['partyid']= $this->partyid;
			$vars['data']= $this->data;
			$vars['datam']= $this->datam;
			$vars['adata']= $this->transfer($this->partyid, $this->partyname);	
            $this->_render('transfer_instruction', $vars);
		} else {
			redirect(fuel_url('#'));
		}
	}
	
function transfer($pid, $pname) {
		$adata = $this->transfer_instruction_model->gettransferInstruction($pid, $pname);
		return $adata;
	} 

	
	function savedetails(){
		if (!empty($_POST)){
		$this->load->module_model(TRANSFER_INSTRUCTION_FOLDER, 'transfer_instruction_model');
			$arr = $this->transfer_instruction_model->savetransfer($_POST['pid'],$_POST['pname'], $_POST['date3'],$_POST['frompartyname'],$_POST['todate']);
			if(empty($arr)) echo 'Success'; else echo 'Unable to save';
	
		}
		else{
			//redirect(fuel_uri('#'));
		}
	}
	
}
/* End of file */
/* Location: ./fuel/modules/controllers*/