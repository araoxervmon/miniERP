<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/partywise_register/config/partywise_register_constants.php'); 
class Partywise_register_model extends Base_module_model {
 
	public $foreign_keys = array('vIRnumber'=>'partywise_register_model','nPartyId'=>array(PARTYWISE_REGISTER_FOLDER=>'party_details_model'));
	public $required = array();
	protected $key_field = 'nOwnerPartyId';
	
    function __construct()
    {
        parent::__construct('aspen_tblowner');
    }
	
	function list_items($limit = NULL, $offset = NULL, $col = 'nOwnerPartyId', $order = 'asc')
    {
		$this->db->select('aspen_tblowner.vIRnumber,nOwnerPartyId');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
	function form_fields($values = array())
	{
		
		$fields = parent::form_fields();
		$CI =& get_instance();
		$CI->load->model('party_details_model');
	    
		$fields['vIRnumber']['type'] = 'hidden';
		$fields['nOwnerPartyId']['type'] = 'hidden';
		$fields['nPartyId']['label'] = "Parties";
		
		$party_details_model_options = $CI->party_details_model->options_list('nPartyId', 'nPartyName');
		
		if ($CI->fuel_auth->has_permission('party_details_model'))
		    {
		        $fields['nPartyId']['class'] = 'add_edit party_details_model';
		    }
		    $fields['nPartyId'] = array('type' => 'select', 'options' => $party_details_model_options,
										'before_html' => '<input type="text" id="party" name="party" /></br></br>',
										'after_html' => '<div id="coil_details"> </div>',
										'size' => '5', 'onClick' =>'selectParty(this.options[selectedIndex].text);');
		/*if(!empty($user_cloud_providers_options)) { 
			if ($CI->fuel_auth->has_permission('user_cloud_providers'))
		    {
		        $fields['user_cloud_provider_id']['class'] = 'add_edit user_cloud_providers';
		    }
		    $fields['user_cloud_provider_id'] = array('type' => 'select', 'options' => $user_cloud_providers_options);
			$fields['user_cloud_provider_id']['label'] = "Link Cloud Account";
			
		} else {
			$fields['user_cloud_provider_id'] = '<a href="'.fuel_url('user_cloud_providers').'">Add yours</a>';
		}*/
		return $fields;
	}

	function getPartyDetailsCredentials() {
		if(isset( $_POST['party'])) {
			$uid = $_POST['party'];
		}
		$sql =		   
		"Select nPartyName,nPartyId from aspen_tblpartydetails order by nPartyName";
		
		$query = $this->db->query($sql);
		$arr='';
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arr[] =$row;
		   }
		} 
		return $arr;
	}
	
	function chk_user(){
	$CI =& get_instance();
	$userdata = $CI->fuel_auth->user_data();
	$query = $this->db->select ('nPartyName')
						  -> from  ('aspen_tblpartydetails')
				 	      -> where ('nPartyName', $userdata['user_name'])
						  ->join('fuel_users ', 'aspen_tblpartydetails.nPartyName = fuel_users.user_name', 'left')
						  ->get();
		
		return $query->result();
	}
}

class Partywiseregisters_model extends Base_module_model {	
 	
}