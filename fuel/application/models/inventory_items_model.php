<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Inventory_items_model extends Base_module_model {
 
    public $foreign_keys = array('brand_id'=>array('brands_model'),
                                'item_category_id'=>array('ref_item_categories_model'));

    protected $key_field = 'item_id';

    function __construct()
    {
        parent::__construct('fuel_inventory_items');
    } 
	
	 	function list_items($limit = NULL, $offset = NULL, $col = 'item_id', $order = 'asc')
    {
		$this->db->select('fuel_inventory_items.item_id,average_monthly_usage,reorder_level,reorder_quantity');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	
	
		 function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $this->load->helper('validator');
	       $fields['item_id']['type'] = 'hidden';
		   $fields['brand_id']['label'] = 'Brand ID';
		   $fields['item_category_id']['label'] = 'Item Category ID';
		   $fields['description']['label'] = 'Item Description';
		   $fields['average_monthly_usage']['label'] = 'Average Usage';
		   $fields['reorder_level']['type'] = 'Reorder Level';
		   $fields['reorder_quantity']['label'] = 'Reorder Quantity';
		   $fields['other_item_details']['type'] = 'hidden';
		   $fields['created_by']['type'] = 'hidden';
		   $fields['created_date']['type'] = 'hidden';
		   $fields['modified_by']['type'] = 'hidden';
		   $fields['modified_date']['type'] = 'hidden';
		   return $fields;
	  }
	  
	  
	   function options_list($key = 'fuel_inventory_items.item_id', $val = 'fuel_inventory_items.item_id', $where = array(), $order = 'fuel_inventory_items.item_id')
	{
		//$key = 'fuel_inventory_items.item_id';
		//$val = 'fuel_inventory_items.description';
		$this->db->select('fuel_inventory_items.item_id');
		return parent::options_list($key, $val, $where, $order);
	}	

}

class Inventoryitems_model extends Base_module_model {

}