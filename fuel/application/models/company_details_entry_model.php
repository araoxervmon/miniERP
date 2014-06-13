<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class company_details_entry_model extends Base_module_model {
 

	protected $key_field = 'company_id';
 
    function __construct()
    {
        parent::__construct('aspen_company_details');
    }
	
	 function list_items($limit = NULL, $offset = NULL, $col = 'company_id', $order = 'asc')
    {
	
   $this->db->select('company_id ,company_name,city,state,zipcode,country,company_fax,email,website,');
   $data = parent::list_items($limit, $offset, $col, $order);
   return $data;     
 }
 
 	 function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $this->load->helper('validator');
		   $fields['company_id']['type'] = 'hidden';
		   $fields['company_name']['label'] = 'The name of our company*';
		   $fields['identifier_receivable']['label'] = 'The default name or identifier to use for all receivable operations.';
		   $fields['identifier_payable']['label'] = 'The default name or identifier to use for all payable operations.';
		   $fields['addr1']['label'] = 'First address line';
		   $fields['addr2']['label'] = 'Second address line';
		   $fields['city']['label'] = 'The city or town where this company is located';
		   $fields['state']['label'] = 'The state or region where this company is located';
		   $fields['zipcode']['label'] = 'Postal or Zip code where this company is located';
		   $fields['country']['label'] = 'The country this company is located '; 	
		   $fields['update_company']['label'] = 'Note: Please remember to update the company state or region.'; 	
		$fields['tele_no']['label'] = 'Enter the company primary telephone number'; 	
		$fields['sec_tel_no']['label'] = 'Secondary telephone number (may also be toll free number) ';	
		   $fields['company_fax']['label'] = 'Enter the company fax number 	';
		   $fields['email']['label'] = 'Enter the general company email address 	';
		   $fields['website']['label'] = 'Enter the homepage of the company website (without the http://) 	';
		   $fields['vat_tin']['label'] = 'Enter the companys VAT TIN 	';
		   $fields['tax_id']['label'] = 'Enter the company (Federal) tax ID number ';
		    $fields['cst_no']['label'] = 'Enter the company CST number ';
		   $fields['service_tax']['label'] = 'Enter service tax number 	';
		   $fields['duty_no']['label'] = 'Enter excise duty number';
		    return $fields;
          
	}
 
 
 
 
 
 
 
 
 
}

class companydetails_model extends Base_module_model {

}