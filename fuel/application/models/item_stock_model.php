<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Item_Stock_model extends Base_module_model {

	public $foreign_keys = array('item_id'=>array('inventory_items_model'));
 

     function __construct()
      {
        parent::__construct('fuel_item_stock');
      }
	
	
	function list_items($limit = NULL, $offset = NULL, $col = 'stock_to_date', $order = 'asc')
    {
		$this->db->select('fuel_item_stock.stock_to_date,quantity_remaining');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	
	 function form_fields($values = array())
	{
		   $fields = parent::form_fields();
		   $CI =& get_instance();
		   $this->load->helper('validator');
	       $fields['stock_to_date']['label'] = 'Stock upto date';
		   $fields['item_id']['label'] = 'Inventory ID';
		   $fields['quantity_remaining']['label'] = 'Quantity Remaining';
		   return $fields;
	  }
	 	 
}

class Itemstock_model extends Base_module_model {

}