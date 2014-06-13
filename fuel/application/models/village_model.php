<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class village_model extends Base_module_model {
 
	protected $key_field = 'id';
 
    function __construct()
    {
        parent::__construct('house_dropdwn');
    }
	
	 function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'asc')
    {
		$this->db->select('house_dropdwn.villages as Villages,house_dropdwn.id');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	function form_fields($values = array())
	{
		$fields = parent::form_fields($values);
		$CI =& get_instance();
		$CI->load->model('village_model');
		$fields['villages']['label'] = 'Village Name';
		$fields['grama_panchayat']['label'] = 'Grama Panchayat';
		$fields['division']['label'] = 'Division';
		$fields['district']['label'] = 'District';
		$fields['states']['label'] = 'States';
		$fields['taluk']['label'] = 'Taluk';
														
		$this->form_builder->set_fields($fields);
	    return $fields;
	}
	
}

class villagemodel extends Base_module_model {

}