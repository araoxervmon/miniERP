<?php
require_once(FUEL_PATH.'/controllers/module.php');

class party_controller extends Module {
	
	function __construct()
	{
		parent::__construct();
	}
		
	function autosuggest()
	{
	
		if(isset($_POST['nPartyId'])) { 
		$CI =& get_instance();
		$this->load->library('form_builder');
		$CI->load->module_model(INWARD_ENTRY_FOLDER, 'inward_entry_model');
		$form_fields = $this->inward_entry_model->form_fields();
			if(strlen($nPartyId) >0) {

				$query = $db->query("SELECT nPartyName FROM aspen_tblpartydetails WHERE nPartyName LIKE '$nPartyId%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->nPartyName).'\');">'.$result->nPartyName.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
			}
		}
			
		$this->form_builder->set_fields($form_fields);
		$form = $this->form_builder->render($form_fields);
		
		}
	}
	
}