<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/rate_details/config/rate_details_constants.php'); 

class Rate_details_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('aspen_tblmatdescription');
    }
	

  function select_coilname() {
   $query = $this->db->query("select * from aspen_tblmatdescription order by vDescription "); 
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
  
  function tablewidth() {
	$sql = $this->db->query ("select * from aspen_tblwidth "); 
	  /* if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblpricetype1.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";*/
	var_dump($sql);die();
  }
  
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinThickness']['type'] ='Min thickness';
		$fields['nMaxThickness']['type'] ='Max Thickness';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	   $sql = "select nMinThickness,nMaxThickness,nAmount,nPriceId from aspen_tblpricetype1 "; 
	   if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblpricetype1.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";
	  }
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
	function saverate() 
	 {
	   if(isset( $_POST['coildescription']) && isset( $_POST['minthickness']) && isset( $_POST['maxthickness']) && isset( $_POST['rate'])) {
		$matdescrip = $_POST['coildescription'];
		$minthickness = $_POST['minthickness'];
		$maxthickness = $_POST['maxthickness'];
		$rate = $_POST['minthickness'];
	 }
		$sql = $this->db->query ("Insert into aspen_tblpricetype1  (nMatId,nMinThickness,nMaxThickness ,nAmount) VALUES( (SELECT aspen_tblmatdescription.nMatId  FROM aspen_tblmatdescription where aspen_tblmatdescription.vDescription = '". $matdescrip. "') ,'". $minthickness. "' , '". $maxthickness. "','". $rate. "')");
	  
	 }
	  
	  function updaterate() 
	 {
	   if(isset( $_POST['partyid'],$_POST['coildescription']) && isset( $_POST['minthickness']) && isset( $_POST['maxthickness']) && isset( $_POST['rate'])) {
	   $priceid = $_POST['partyid'];
	   $matdescrip = $_POST['coildescription'];
		$minthickness = $_POST['minthickness'];
		$maxthickness = $_POST['maxthickness'];
		$rate = $_POST['rate'];
		$sql = ("Update aspen_tblpricetype1 SET nMinThickness='". $minthickness."',
		nMaxThickness='". $maxthickness. "' ,nAmount='". $rate. "' ");
		$sql.= "where nPriceId='". $priceid. "'";
		$query=$this->db->query ($sql);
	 }
		else{
			 echo 'do nothing!';
		}
	 }
	  
	 function deleterow($deleteid)
	 {
	 $querycheck = $this->db->query("select * from aspen_tblpricetype1 where nPriceId = '".$deleteid."'");
	 $arr = $querycheck->result();
	 if(!empty($arr)) {
		$sql = $this->db->query("DELETE FROM aspen_tblpricetype1 WHERE nPriceId='".$deleteid."'");
	}
	else{
		return false;
	}
	 }
}

class Ratedetails_model extends Base_module_model {	
 	
}
