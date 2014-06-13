<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Material_Description_model extends Base_module_model {
 
	//public $required = array('vDescription','nMatId');
	protected $key_field = 'nMatId';
 
    function __construct()
    {
        parent::__construct('aspen_tblmatdescription');
    }
	
	 function list_items($limit = NULL, $offset = NULL, $col = 'MaterialDescription', $order = 'asc')
    {
		$this->db->select('aspen_tblmatdescription.vDescription as MaterialDescription,aspen_tblmatdescription.nMatId');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;     
	}
	function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$CI =& get_instance();
		$CI->load->model('material_description_model');
		$material_description_model_options = $CI->material_description_model->options_list('nMatId', 'vDescription');
		if ($CI->fuel_auth->has_permission('material_description_model'))
		    {
		        $fields['vDescription']['label'] = 'New Material Description';
		    }
		    $fields['Description'] = array('type' => 'select', 'options' => $material_description_model_options,
										'before_html' => '<input type="hidden" id="party" name="party" /></br></br>',
										'after_html' => '<div id="coil_details"> </div>',
									'size' => '5', 'onClick' =>'selectParty(this.options[selectedIndex].text);');
			$fields['nMatId']['type'] = 'hidden';
														
		$this->form_builder->set_fields($fields);
	    return $fields;
	}
	
	function options_list($key = 'aspen_tblmatdescription.nMatId', $val = 'aspen_tblmatdescription.vDescription', $where = array(), $order = 'aspen_tblmatdescription.vDescription')
	{
		$key = 'aspen_tblmatdescription.nMatId';
		$val = 'aspen_tblmatdescription.vDescription';
		$this->db->select('aspen_tblmatdescription.nMatId, aspen_tblmatdescription.vDescription');
		return parent::options_list($key, $val, $where, $order);
	}
}

class MaterialDescription_model extends Base_module_model {

}