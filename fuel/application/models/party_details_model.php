<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class party_details_model extends Base_module_model {
 
	public $required = array('nPartyName','nPartyId','vAddress1','vAddress2','vCity','vState','vCountry','nPinId','nTinNumber');
	protected $key_field = 'nPartyId';
 
    function __construct()
    {
        parent::__construct('aspen_tblpartydetails');
    }
	
	 function list_items($limit = NULL, $offset = NULL, $col = 'nPartyName', $order = 'asc')
    {
		$this->db->select('aspen_tblpartydetails.nPartyName,vCity,vState,nTinNumber');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$CI =& get_instance();
		$CI->load->model('party_details_model');
		$material_description_model_options = $CI->party_details_model->options_list('nPartyId', 'nPartyName');
		if ($CI->fuel_auth->has_permission('party_details_model'))
		    {
		        $fields['nPartyName']['class'] = 'add_edit party_details_model';
		    }
		    $fields['Description'] = array('type' => 'select', 'options' => $material_description_model_options,
										'before_html' => '<input type="hidden" id="party" name="party" /></br></br>',
										'after_html' => '<div id="coil_details"> </div>',
									'size' => '5', 'onClick' =>'selectParty(this.options[selectedIndex].text);');
														
		$this->form_builder->set_fields($fields);
	    return $fields;
	}
	
	function options_list($key = 'aspen_tblpartydetails.nPartyId', $val = 'aspen_tblpartydetails.nPartyName', $where = array(), $order = 'aspen_tblpartydetails.nPartyName')
	{
		$key = 'aspen_tblpartydetails.nPartyId';
		$val = 'aspen_tblpartydetails.nPartyName';
		$this->db->select('aspen_tblpartydetails.nPartyId, aspen_tblpartydetails.nPartyName');
		return parent::options_list($key, $val, $where, $order);
	}
}

class partydetails_model extends Base_module_model {

}