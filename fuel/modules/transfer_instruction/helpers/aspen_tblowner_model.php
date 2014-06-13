<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Aspen_tblowner_model extends Base_module_model {
 
	//public $foreign_keys = array('vIRnumber'=>'aspen_tblinwardentry_model', 'nOwnerPartyId'=> 'aspen_tblpartydetails_model');
	
    function __construct()
    {
        parent::__construct('aspen_tblowner');
    }
	
	function list_items($limit = NULL, $offset = NULL, $col = 'nOwnerPartyId', $order = 'asc')
    {
		$this->db->select('vIRnumber as "Coil Number", nOwnerPartyId as "Party Detail"');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
	
	}

/*class Aspen_tblowner_model extends Data_record {	
 	
}*/