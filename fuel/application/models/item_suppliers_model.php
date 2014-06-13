<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Item_suppliers_model extends Base_module_model {

	  public $foreign_keys = array('name'=>array('suppliers_model'),
	                              'item_id'=>array('inventory_items_model'));
      protected $key_field = 'item_id';
 
    function __construct()
    {
        parent::__construct('fuel_item_suppliers');
    }
	
		
	function list_items($limit = NULL, $offset = NULL, $col = 'item_id', $order = 'asc')
    {
		$this->db->select('fuel_item_suppliers.item_id,value_supplied_to_date,quantity_supplied_to_date,first_item_supplied_date,last_item_supplied_date,delivery_lead_time,standard_price,percentage_discount,min_order_quantity,max_order_quantity,');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	
	
	function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
           $fields['name']['label'] = 'Store Name';
		   $fields['value_supplied_to_date']['label'] = 'Amount of the Product';
		   $fields['quantity_supplied_to_date']['label'] = 'quantity Supplied';
		   $fields['first_item_supplied_date']['label'] = 'First Item Received';
		   $fields['last_item_supplied_date']['label'] = 'Last item Received';
		   $fields['delivery_lead_time']['label'] = 'Expected Delivery Time';
		   $fields['standard_price']['label'] = 'Price of the Product';
		   $fields['percentage_discount']['label'] = 'Discount Percentage';   
		   $fields['min_order_quantity']['label'] = 'Minimum Order Reqd';
		   $fields['max_order_quantity']['label'] = 'Maximum Order Reqd';
		   $fields['supplier_id']['type'] = 'hidden';
		   $fields['description']['type'] = 'hidden';
		   $fields['date_added']['type'] = 'hidden';
		   $fields['created_by']['type'] = 'hidden';
		   $fields['last_modified']['type'] = 'hidden';
		   $fields['modified_by']['type'] = 'hidden';
		   return $fields;
	  }
	  
	   /*function options_list($key = 'fuel_item_suppliers.supplier_id', $val = 'fuel_item_suppliers.name', $where = array(), $order = 'fuel_item_suppliers.name')
	{
		$key = 'fuel_suppliers.supplier_id';
		$val = 'fuel_suppliers.name';
		$this->db->select('fuel_suppliers.supplier_id, fuel_suppliers.name');
		return parent::options_list($key, $val, $where, $order);
	}	*/
	 
}

class Itemsuppliers_model extends Base_module_model {

}