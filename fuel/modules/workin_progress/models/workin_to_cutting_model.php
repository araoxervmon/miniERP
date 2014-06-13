<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/workin_progress/config/workin_progress_constants.php');

class Workin_to_cutting_model extends Base_module_model {
	
	public $foreign_keys = array('vIRnumber'=>array(WORKIN_PROGRESS_FOLDER=>'workin_progress_model'),'vIRnumber'=> 'workin_to_cutting_model');
	//public $required = array('vIRnumber,nPartyName');
	protected $key_field = 'vIRnumber';
	
	function __construct()
	{
		parent::__construct('aspen_tblcuttinginstruction'); // table name
	}
	
	function options_list($key = 'aspen_tblcuttinginstruction.vIRnumber', $val = 'aspen_tblcuttinginstruction.nSno', $where = array(), $order = 'aspen_tblcuttinginstruction.nNoOfPieces')
	{
		$key = 'aspen_tblcuttinginstruction.vIRnumber';
		$val = 'aspen_tblcuttinginstruction.nSno';
		$sql=
		'select aspen_tblcuttinginstruction.vIRnumber, aspen_tblcuttinginstruction.nSno,aspen_tblcuttinginstruction.nLength,aspen_tblcuttinginstruction.dDate,aspen_tblcuttinginstruction.nNoOfPieces,aspen_tblcuttinginstruction.nTotalWeight';
		//echo $sql;die();
		return parent::options_list($key, $val, $where, $order);
	}
	
	function list_items($limit = NULL, $offset = NULL, $col = 'nPartyId', $order = 'asc')
    {
		$this->db->select('aspen_tblcuttinginstruction.nPartyId,nPartyName');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
}

class Workintocutting_model extends Base_module_model {

}
