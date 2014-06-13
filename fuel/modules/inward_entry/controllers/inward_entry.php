<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Inward_entry extends Fuel_base_controller {

	public $nav_selected =  'inward_entry';
	public $view_location = 'inward_entry';
	private $data;
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('inward_entry');
		$this->load->module_model(INWARD_ENTRY_FOLDER, 'inward_entry_model');
		$this->data = self::autosuggest();
	}
	
	function index(){
		if(!empty($this->data) && isset($this->data)) {
			$vars['data']= $this->data;
		}
		else {
			redirect(fuel_url('inward_entry'));
		}
	
	}
	
	function autosuggest()
	{
		if(isset($_POST['nPartyId'])) {
			$nPartyId = $_POST['nPartyId'];
		    //$nPartyId = $this->db->real_escape_string($_POST['nPartyId']);
			if(strlen($nPartyId) >0) {

				$query  = $this->db->query("SELECT nPartyName FROM aspen_tblpartydetails WHERE nPartyName LIKE '$nPartyId%' LIMIT 10");
				 $arr='';
				 if ($query->num_rows() > 0){
				echo '<ul style=" color:black;">';
					 foreach ($query->result() as $row){
	         			echo '<li onClick="fill(\''.addslashes($row->nPartyName).'\');">'.$row->nPartyName.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} 
			else{
			//do nothing
			}
			
		} else {
			echo 'There should be no direct access to this script!';
		}
		
	}
	

}