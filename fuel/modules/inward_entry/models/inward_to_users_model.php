<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/inward_entry/config/inward_entry_constants.php');

class Inward_to_users_model extends Base_module_model {
	
	public $foreign_keys = array('vIRnumber'=>array(INWARD_ENTRY_FOLDER=>'inward_entry_model'),'nPartyId'=>array(INWARD_ENTRY_FOLDER=>'inward_to_permissions_model'),'nMatId'=>'inward_to_users_model');
	public $required = array();
	protected $key_field = 'nMatId';
	
	function __construct()
	{
		parent::__construct('aspen_tblmatdescription'); // table name
	}
	
	function options_list($key = 'aspen_tblmatdescription.nMatId', $val = 'aspen_tblmatdescription.vDescription', $where = array(), $order = 'aspen_tblmatdescription.vDescription')
	{
		$key = 'aspen_tblmatdescription.nMatId';
		$val = 'aspen_tblmatdescription.vDescription';
		$this->db->select('aspen_tblmatdescription.nMatId, aspen_tblmatdescription.vDescription');
		return parent::options_list($key, $val, $where, $order);
	}
	
	function list_items($limit = NULL, $offset = NULL, $col = 'nMatId', $order = 'asc')
    {
		$this->db->select('aspen_tblmatdescription.vDescription,nMatId');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
}

class Inwardtousers_model extends Base_module_model {

}
