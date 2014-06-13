<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/rate_details_length/config/rate_details_length_constants.php'); 

class Rate_details_length_model extends Base_module_model {

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

	function checklengthexist(){
		$sqlchk = "select nMinLength as minlength from aspen_tbllength";
		$sqlcheck = $this->db->query($sqlchk);
		if ($sqlcheck->num_rows() > 0){
			foreach ($sqlcheck->result() as $rowpw){
				$sqlcheck =$rowpw->minlength;
			}
		}
	}		
  
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinLength']['type'] ='Min length';
		$fields['nMaxLength']['type'] ='Max length';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	   $sql = "select nMinLength,nMaxLength,nAmount,nPriceId from aspen_tbllength "; 
	   if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tbllength.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";
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
	   if(isset( $_POST['coildescription']) && isset( $_POST['minlength']) && isset( $_POST['maxlength']) && isset( $_POST['rate'])) {
		$matdescrip = $_POST['coildescription'];
		$minlength = $_POST['minlength'];
		$maxlength = $_POST['maxlength'];
		$rate = $_POST['rate'];
	 }
		$sql = $this->db->query ("Insert into aspen_tbllength  (nMatId,nMinLength,nMaxLength ,nAmount) VALUES( (SELECT aspen_tblmatdescription.nMatId  FROM aspen_tblmatdescription where aspen_tblmatdescription.vDescription = '". $matdescrip. "') ,'". $minlength. "' , '". $maxlength. "','". $rate. "')");
	  
	 }
	  
	   function updaterate() 
	 {
	   if(isset( $_POST['priceid']) &&  isset( $_POST['minlength']) && isset( $_POST['maxlength']) && isset( $_POST['rate'])) {
		 $priceid = $_POST['priceid'];
	  // $matdescrip = $_POST['coildescription'];
		$minlength = $_POST['minlength'];
		$maxlength = $_POST['maxlength'];
		$rate = $_POST['rate'];
	 }        
		$sql = ("Update aspen_tbllength SET nMinLength='". $minlength."', nMaxLength='". $maxlength."', nAmount=  '". $rate. "' ");
       		$sql.=" WHERE aspen_tbllength.nPriceId='".$priceid."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	  
	
	 	function delete_ratedetaillengthmodel($priceid ='') {
		$sql = " DELETE FROM aspen_tbllength WHERE nPriceId='".$priceid."'";
		$query = $this->db->query($sql);
	}
	 
	 
	 function list_partyname($description = '') {	
		$sql ="select nMinLength as minlength,nMaxLength as maxlength,nAmount as rate,nPriceId as priceid from aspen_tbllength ";
   		if(!empty($description)) { 
		$sql .=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tbllength.nMatId WHERE aspen_tblmatdescription.vDescription='".$description."'";
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
	
	function minlengthexistmodel(){
		if(isset( $_POST['minlength'] )&&  isset( $_POST['coil'])   ){
			$minlength = $_POST['minlength'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tbllength where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$minlength."' BETWEEN nMinLength AND nMaxLength ";
		$query = $this->db->query($sql);
		$arr='';
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arr[] =$row;
		   }
		   return $arr;
		}
		else
		{
		return false;
		}
	}
	
	function maxlengthexistmodel(){
		if(isset( $_POST['maxlength'] )&&  isset( $_POST['coil'])   ){
			$maxlength = $_POST['maxlength'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tbllength where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$maxlength."' BETWEEN nMinLength AND nMaxLength ";
		$query = $this->db->query($sql);
		$arr='';
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arr[] =$row;
		   }
		   return $arr;
		}
		else
		{
		return false;
		}
	}
}

class Ratedetails_model extends Base_module_model {	
 	
}
