<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/company_details/config/company_details_constants.php'); 

class Company_details_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('aspen_tblmatdescription');
    }
	
	
	
		/*	 cid cname ide_receive ide_payable addr1 addr2 city state zipcode country update_state ctno toll_no fax email web tax_id vat cst_no service_tax duty_no
		*/
				
	function savecompany($cname, $ide_receive,$ide_payable,$addr1,$addr2,$city,$state, 
							$zipcode,$country,$update_state,$ctno,$toll_no,$fax, 
							$email,$web,$tax_id,$vat,$cst_no,$service_tax,$duty_no)
	{
	$sql = "Insert into aspen_company_details  (
		company_name,identifier_receivable,identifier_payable,addr1,addr2,city,state,zipcode,country,update_company,tele_no,
		sec_tel_no,company_fax,email,website,tax_id,vat_tin,cst_no,service_tax,duty_no) 
		
		VALUES( '". $cname. "','". $ide_receive. "','". $ide_payable. "','". $addr1. "','". $addr2. "', '". $city. "','". $state. "','". $zipcode. "','". $country. "','". $update_state. "','". $ctno. "','". $toll_no. "','". $fax. "','". $email. "','". $web. "','". $tax_id. "','". $vat. "','". $cst_no. "','". $service_tax. "','". $duty_no. "' )";
		
		$query = $this->db->query($sql);
		
	}
	

  
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinLength']['type'] ='Min length';
		$fields['nMaxLength']['type'] ='Max length';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
}	
class Companydetails_model extends Base_module_model {	
 	
}
