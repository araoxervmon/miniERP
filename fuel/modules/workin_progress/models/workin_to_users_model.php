<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/workin_progress/config/workin_progress_constants.php');

class Workin_to_users_model extends Base_module_model {
	
	public $foreign_keys = array('vIRnumber'=>array(WORKIN_PROGRESS_FOLDER=>'workin_progress_model'),'nPartyId'=>array(WORKIN_PROGRESS_FOLDER=>'workin_to_permissions_model'),'nMatId'=>'workin_to_users_model');
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

class Workintousers_model extends Base_module_model {

}
