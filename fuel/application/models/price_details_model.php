 <?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class price_details_model extends Base_module_model {
 
 public $required = array('nMinThickness','nMaxThickness','nAmount');
 protected $key_field = 'nMatId';
 
    function __construct()
    {
        parent::__construct('aspen_tblpricetype1');
    }
 
  function list_items($limit = NULL, $offset = NULL, $col = 'nMatId', $order = 'asc')
    {
		$this->db->select('aspen_tblpricetype1.nMinThickness,nMaxThickness,nAmount');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
 /*
function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$fields['nMinThickness']['type'] ='Min thickness';
		$fields['nMaxThickness']['type'] ='Max Thickness';
		$fields['nAmount']['type'] ='Amount';
	
		$this->form_builder->set_fields($fields);
		return $fields;
	}*/
	
}

class pricedetails_model extends Base_module_model {

}