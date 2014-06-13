<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');

class Party_details_model extends Base_module_model {
 
	public $required = array();
	protected $key_field = 'nPartyId';
	
    function __construct()
    {
        parent::__construct('aspen_tblpartydetails');
    }
	
	function options_list($key = 'aspen_tblpartydetails.nPartyId', $val = 'aspen_tblpartydetails.nPartyName', $where = array(), $order = 'aspen_tblpartydetails.nPartyName')
	{
		$key = 'aspen_tblpartydetails.nPartyId';
		$val = 'aspen_tblpartydetails.nPartyName';
		$this->db->select('aspen_tblpartydetails.nPartyId, aspen_tblpartydetails.nPartyName');
		return parent::options_list($key, $val, $where, $order);
	}
	
	function list_items($limit = NULL, $offset = NULL, $col = 'nPartyId', $order = 'asc')
    {
		$this->db->select('aspen_tblpartydetails.*');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
	
}

class Party_detail_model extends Base_module_model {	
 	
}