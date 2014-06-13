<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/inward_entry/config/inward_entry_constants.php');
class Inward_entry_model extends Base_module_model {
 
 public $required = array('nPartyName','vIRnumber', 'dReceivedDate', 'vLorryNo', 'vInvoiceNo', 'dInvoiceDate', 'nMatId', 'fWidth', 'fThickness', 'fQuantity');
 public $foreign_keys = array('nPartyId'=>array(INWARD_ENTRY_FOLDER=>'inward_to_permissions_model'),'nMatId'=>array(INWARD_ENTRY_FOLDER=>'inward_to_users_model'));
 
 protected $key_field = 'vIRnumber';
 public $filters = array('aspen_tblpartydetails.nPartyName', 'aspen_tblinwardentry.vIRnumber', 'aspen_tblinwardentry.dReceivedDate', 'aspen_tblinwardentry.dInvoiceDate');
 
    function __construct()
    {
        parent::__construct('aspen_tblinwardentry');// table name
    }
 
 function list_items($limit = NULL, $offset = NULL, $col = 'vIRnumber', $order = 'asc')
    {
   $this->db->select('aspen_tblpartydetails.nPartyName as partyname ,aspen_tblinwardentry.vIRnumber , aspen_tblinwardentry.dReceivedDate ,aspen_tblmatdescription.vDescription as Material, aspen_tblinwardentry.fThickness as Thickness, aspen_tblinwardentry.fWidth as Width,aspen_tblinwardentry.fQuantity as Quantity, aspen_tblinwardentry.vStatus as Status');
   $this->db->join('aspen_tblowner', 'aspen_tblowner.vIRnumber = aspen_tblinwardentry.vIRnumber', 'left');
   $this->db->join('aspen_tblpartydetails', 'aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId', 'left');
   $this->db->join('aspen_tblmatdescription', 'aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId', 'left');
   $data = parent::list_items($limit, $offset, $col, $order);
   return $data;     
 }
 
function save($post) 
  {
  parent::save($post);
  return true;
  }
 /*
 function save($data) {
		$CI =& get_instance();
			if(!empty($data['nPartyId'])) { 
			$id = parent::save($data);
			//Now log to User_jobs table
			if(!empty($data['id'])) $id = $data['id'];
			$this->_createJob($id, $data['nPartyId']);
			
			$this->session->set_flashdata('success',  lang('data_saved'));
			redirect(fuel_url('inward_entry/edit').'/'.$id);
			//redirect(fuel_url('cloud_accounts'));
			} else {
				$this->session->set_flashdata('error', 'Cloud provider and credentials mandatory!');
				redirect(fuel_url('inward_entry/create'));
			}
	}
	
	function _createJob($id, $nPartyId) {
		$sql = "select nPartyId from aspen_tblpartydetails where nPartyName=".'".$nPartyId."';
		 
		$query = $this->db->query($sql);
		//$userdata = getLoggedUser($this->session->userdata);
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		   		// check if record exists -
			   $arr[] =$row;
						  
		   }
		}
		
	}
	*/
  
 
   function form_fields($values = array())
  {
   $fields = parent::form_fields();
   $CI =& get_instance();
   $CI->load->model('inward_entry_model');
   $CI->load->module_model(INWARD_ENTRY_FOLDER, 'inward_to_permissions_model');
   $CI->load->module_model(INWARD_ENTRY_FOLDER, 'inward_to_users_model');
  // $CI->load->module_model(PARTYWISE_REGISTER_FOLDER,'party_details_model');
   $this->load->helper('validator');

   $fields['vIRnumber']['label'] = 'Coil Number';
   
   $fields['vLorryNo']['label'] = 'Lorry No';
   $fields['vInvoiceNo']['label'] = 'Invoice/Challan Number';
   $fields['dInvoiceDate']['label'] = 'Invoice/Challan Date';
   $fields['fThickness']=  array('type' => 'label', 'label' => 'Thickness in mm',
										
										'onkeyup' =>'');
   $fields['fQuantity']=  array('type' => 'label', 'label' => 'Weight in Kgs',
										
										'onchange' =>'');
   $fields['fLength']['label'] = 'Length in mm';
   //$fields['vStatus']['label'] = 'Received';
   $fields['dSysDate']['type'] = 'hidden';
   $fields['nMatId']['label'] = "Material Description";
   $fields['dReceivedDate']= datetime_now();
   $fields['vHeatnumber']['label'] = "Heat Number";
   $fields['fWidth'] = array('type' => 'label', 'label' => 'width in mm',
										
										'onkeyup' =>'');
										
	
    $fields['nPartyId']['label'] = "Parties";
	/*$fields['nPartyId'] = array('type' => 'label', 'label' => 'Parties', 
         'after_html' => '<div id="suggestions"> <div id="suggestionsList"> <div id="nPartyId"> </div></div></div>',
         //'onkeyup' => "suggest(this.value ,'".fuel_url('party_controller/autosuggest')."')"
         'onkeyup' => "'".fuel_url('autosuggest')."'"
             );*/
	$fields['vStatus'] = array('type' => 'label', 'label' => 'Status', 
        
            'value' => 'Received' );
	/*$optionsstatus = $this->inward_entry_model->dropdownstatus();
			$fields['vState'] = array('type' => 'select','label' => 'State', 'options' => $optionsstatus
			                      ,'first_option' => 'Received');*/
								  
   $inward_to_permissions_model_options = $CI->inward_to_permissions_model->options_list('nPartyId', 'nPartyName');
   $inward_to_users_model_options = $CI->inward_to_users_model->options_list('nMatId', 'vDescription');
  
   return $fields;
  }
   
 function dropdownstatus( $val = 'aspen_tblinwardentry.vStatus', $val = 'aspen_tblinwardentry.vStatus',                                 $where = 'aspen_tblinwardentry.vStatus',$order = 'aspen_tblinwardentry.vStatus')
	{
		$val = 'aspen_tblinwardentry.vStatus';
		$this->db->select('DISTINCT aspen_tblinwardentry.vStatus');
		return parent::options_list( $val, $order);
	}
	
 function options_list()
	{
		  $sql ="Select nPartyName from aspen_tblpartydetails";
		  return;
	}
  
  function editCoilDetails() {
   $query = $this->db->query("select * from aspen_tblinwardentry order by col name  limit 0,1"); 
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
 
} 
class Inwardentrys_model extends Base_module_record {
 
}