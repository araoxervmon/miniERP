<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/tax_details/config/tax_details_constants.php'); 


class Tax_details_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('aspen_tbltaxdetails');
    }
	
function formdisplay()
	{
		$fields['nPartyName']['label'] = 'Party Name';
		$fields['nMatId']['label'] = 'Material Description';
		$fields['fWidth']['label'] = 'Width';
		$fields['fThickness']['label'] = 'Thickness';
		$fields['fLength']['label'] = 'Length';
		$fields['fQuantity']['label'] = 'Weight';
		$fields['dReceivedDate']= datetime_now();
		$fields['nLength']['label'] = 'Length of a cutting instruction';
		$fields['numbers'] = array('type' => 'enum', 'label' => 'Customer Rate', 'options' => array('yes' => 'Add Discount','no' => 'Remove Discount'), 'required' => TRUE);
		return $fields;
	}

 	   
	function CoilTable() {
	   $sql = "select nTaxTypeId,vTypeOfTax,nPercentage from aspen_tbltaxdetails "; 
	  $query = $this->db->query($sql);
	  $arr='';
	  if ($query->num_rows() > 0)
	  {
		 foreach ($query->result() as $row)
		 {
			$arr[] =$row;
		 }
	  } 
	  return $arr;
	 }
	 
	function options_list( $key = 'aspen_tbltaxdetails.nTaxTypeId', $val = 'aspen_tbltaxdetails.nPercentage', $where = array(), $order = 'aspen_tbltaxdetails.nPercentage')
	{
		$key = 'aspen_tbltaxdetails.nTaxTypeId';
		$val = 'aspen_tbltaxdetails.nPercentage';
		$this->db->select('aspen_tbltaxdetails.nTaxTypeId, aspen_tbltaxdetails.nPercentage');
		return parent::options_list($key, $val,$where,$order);
	}
	 
	 
	 
	function savetax() 
	 {
	 	   if( isset( $_POST['taxtype']) && isset( $_POST['percentage'])){
		//$taxid = $_POST['taxid'];
		$taxtype = $_POST['taxtype'];
		$percentage = $_POST['percentage'];
	 }
		$sql = $this->db->query ("Insert into aspen_tbltaxdetails(vTypeOfTax,nPercentage) VALUES( '". $taxtype. "','". $percentage. "')");
	  
	 }
	  
	   function updatetax() 
	 {
	  if( isset( $_POST['taxid']) && isset( $_POST['percentage'])){
		$taxid = $_POST['taxid'];
		$percentage = $_POST['percentage'];
	 }        
		$sql = ("Update aspen_tbltaxdetails SET nPercentage='". $percentage."' ");
       		$sql.=" WHERE aspen_tbltaxdetails.nTaxTypeId='".$taxid."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	  

		function deletetax($taxid='') {
		$sql = " DELETE FROM aspen_tbltaxdetails WHERE nTaxTypeId ='".$taxid." '";
		//echo $sql; die();
		$query = $this->db->query($sql);
	}
	 
	 
	 function list_taxdetailsmodel() {	
		$sql ="select  nTaxTypeId as taxid,vTypeOfTax as taxtype,nPercentage as pecentage from aspen_tbltaxdetails ";
   		
		$query = $this->db->query($sql);
		$arr='';
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arr[] =$row;
		   }
		}
		return $arr;
	}
	 
}

class Taxdetails_model extends Base_module_model {	
 	
}
