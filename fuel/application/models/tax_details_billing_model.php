<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class tax_details_billing_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('bakery_tbltaxdetails');
    }
		
	function list_items($limit = NULL, $offset = NULL, $col = 'TaxId', $order = 'desc')
	
    {	$this->db->select('bakery_tbltaxdetails.nTaxTypeId as TaxId,vTypeOfTax as Taxtype,nPercentage as Percentage');
		$data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	
	function options_list( $key = 'bakery_tbltaxdetails.nTaxTypeId', $val = 'bakery_tbltaxdetails.nPercentage', $where = array(), $order = 'bakery_tbltaxdetails.nPercentage')
	{
		$key = 'bakery_tbltaxdetails.nTaxTypeId';
		$val = 'bakery_tbltaxdetails.nPercentage';
		$this->db->select('bakery_tbltaxdetails.nTaxTypeId, bakery_tbltaxdetails.nPercentage');
		return parent::options_list($key, $val,$where,$order);
	}
	
	function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$CI =& get_instance();
		$CI->load->model('tax_details_billing_model');
		$fields['nTaxTypeId']['label'] = 'Tax ID';
		$fields['vTypeOfTax']['label'] = 'Tax Type';
		$fields['nPercentage']['label'] = 'Percentage';
		$this->form_builder->set_fields($fields);
	    return $fields;
	}
	
 
	
	}
class taxdetails_model extends Base_module_model {

}	