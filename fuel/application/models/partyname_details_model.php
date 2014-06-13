 <?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class partyname_details_model extends Base_module_model {
 
 public $required = array('nPartyName' ,'vAddress1','vAddress2','vCity','nTinNumber','nPinId');
 protected $key_field = 'nPartyId';
 
    function __construct()
    {
        parent::__construct('aspen_tblpartydetails');
    }
 
  function list_items($limit = NULL, $offset = NULL, $col = 'nPartyId', $order = 'asc')
    {
		$this->db->select('aspen_tblpartydetails.nPartyId,nPartyName as Partyname,vCity as City,vState as State,nTinNumber as TinNumber');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
 

 function my_custom_options_state( $val = 'aspen_tblpartydetails.vState', $val = 'aspen_tblpartydetails.vState',                                 $where = 'aspen_tblpartydetails.vState',$order = 'aspen_tblpartydetails.vState')
	{
		$val = 'aspen_tblpartydetails.vState';
		$this->db->select('DISTINCT aspen_tblpartydetails.vState');
		return parent::options_list( $val, $order);
	}
 		
 function my_custom_options_country( $val = 'aspen_tblpartydetails.vCountry', 
									$val = 'aspen_tblpartydetails.vCountry', 
									$where = 'aspen_tblpartydetails.vCountry',
									$order = 'aspen_tblpartydetails.vCountry')
	{
		$val = 'aspen_tblpartydetails.vCountry';
		$this->db->select('DISTINCT aspen_tblpartydetails.vCountry');
		return parent::options_list( $val, $order);
	}
 
 
 function form_fields($values = array())
	{
			$fields = parent::form_fields($values);
			$CI =& get_instance();
			$CI->load->model('partyname_details_model');
			$fields['nPartyId']['type'] = 'hidden';
			$fields['nPartyName']['label'] = 'Party Name';
			$fields['vAddress1']['label'] = 'Address1';
			$fields['vAddress2']['label'] = 'Address2';
			$fields['vCity']['label'] = 'City';
			$fields['nTinNumber']['label'] = 'Tin number';
			$fields['nPinId']['label'] = 'Pincode';
			$options = $this->partyname_details_model->my_custom_options_country();
			$fields['vCountry'] = array('type' => 'select','label' => 'Country', 'options' => $options
			                      ,'first_option' => 'India');
			$optionsstate = $this->partyname_details_model->my_custom_options_state();
			$fields['vState'] = array('type' => 'select','label' => 'State', 'options' => $optionsstate
			                      ,'first_option' => 'Karnataka');
		/*	$fields['vCusrate'] = array('type' => 'enum', 'label' => 'Customer Rate', 'options' => array('yes' => 'Add Discount','no' => 'Remove Discount'), 'required' => TRUE);*/
			$fields['vCusrate']['type']= 'hidden';
			$fields['vCusrateadd']= array('label' => 'Special Price : Add %');
			$fields['vCusraterm']= array('label' => 'Special Price : Reduce %');
			$fields['vemailaddress']['label'] = 'Email Address';
			$fields['ncstno']['label'] = 'CST No';
			$partyname_details_model_options = $CI->partyname_details_model->options_list('nPartyId', 'nPartyName');$this->form_builder->set_fields($fields);
		    return $fields;
	}
 
 
 function options_list($key = 'aspen_tblpartydetails.nPartyId', $val = 'aspen_tblpartydetails.nPartyName', 
					   $where = array(), $order = 'aspen_tblpartydetails.nPartyName')
	{
			$key = 'aspen_tblpartydetails.nPartyId';
			$val = 'aspen_tblpartydetails.nPartyName';
			$this->db->select('aspen_tblpartydetails.nPartyId, aspen_tblpartydetails.nPartyName');
			return parent::options_list($key, $val, $where, $order);
	}
}

class partynamedetails_model extends Base_module_model {

}