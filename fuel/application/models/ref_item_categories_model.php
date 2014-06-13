
<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Ref_item_categories_model extends Base_module_model {

    protected $key_field = 'item_category_id';
 
    function __construct()
    {
        parent::__construct('fuel_ref_item_categories');
    }
	
	function list_items($limit = NULL, $offset = NULL, $col = 'item_category_id', $order = 'asc')
    {
		$this->db->select('fuel_ref_item_categories.item_category_id,name,code');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	
	
	 function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $this->load->helper('validator');
		   $fields['name']['label'] = 'Item Name';
		   $fields['code']['label'] = 'Item Description';
		   $fields['item_category_id']['type'] = 'hidden';
		   
		    return $fields;
          
	}
	
	
	 
	  function options_list($key = 'fuel_ref_item_categories.item_category_id', $val = 'fuel_ref_item_categories.name', $where = array(), $order = 'fuel_ref_item_categories.item_category_id')
	 {
		//$val = 'fuel_brands.brand_id';
		$this->db->select('fuel_ref_item_categories.item_category_id');
		return parent::options_list($key, $val, $where, $order);
	 }
	 
	 
	 
	 
	 
	
	
}

class Refitem_categories_model extends Base_module_model {

}