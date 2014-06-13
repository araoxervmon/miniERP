<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/rate_details_thickness/config/rate_details_thickness_constants.php'); 

class Rate_details_thickness_model extends Base_module_model {

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
  
  function tablethickness() {
	$sql = $this->db->query ("select * from aspen_tblpricetype1 "); 
	  /* if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblpricetype1.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";*/
	var_dump($sql);die();
  }
  
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinThickness']['type'] ='Minthickness';
		$fields['nMaxThickness']['type'] ='MaxThickness';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	    	function delete_ratedetailthickmodel($priceid ='') {
		$sql = " DELETE FROM aspen_tblpricetype1 WHERE nPriceId='".$priceid."'";
		$query = $this->db->query($sql);
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
		$rate = $_POST['rate'];
	 }
		$sql = $this->db->query ("Insert into aspen_tblpricetype1  (nMatId,nMinThickness,nMaxThickness ,nAmount) VALUES( (SELECT aspen_tblmatdescription.nMatId  FROM aspen_tblmatdescription where aspen_tblmatdescription.vDescription = '". $matdescrip. "') ,'". $minthickness. "' , '". $maxthickness. "','". $rate. "')");
	  
	 }
	 function updaterate() 
	 {
	   if(isset( $_POST['priceid']) &&  isset( $_POST['minthickness']) && isset( $_POST['maxthickness']) && isset( $_POST['rate'])) {
		 $priceid = $_POST['priceid'];
	  // $matdescrip = $_POST['coildescription'];
		$minthickness = $_POST['minthickness'];
		$maxthickness = $_POST['maxthickness'];
		$rate = $_POST['rate'];
	 }        
		$sql = ("Update aspen_tblpricetype1 SET nMinThickness='". $minthickness."', nMaxThickness='". $maxthickness."', nAmount=  '". $rate. "' ");
       		$sql.=" WHERE aspen_tblpricetype1.nPriceId='".$priceid."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	  
	
	
	 	function delete_ratedetailthicknessmodel($priceid ='') {
		$sql = " DELETE FROM aspen_tblpricetype1 WHERE nPriceId='".$priceid."'";
		$query = $this->db->query($sql);
	}
	 
	 
	 
	 
	 
	 
	 
	
	 function list_partyname($description = '') {	
		$sql ="select nMinThickness as minthickness,nMaxThickness as maxthickness,nAmount as rate,nPriceId as priceid from aspen_tblpricetype1 ";
   		if(!empty($description)) { 
		$sql .=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblpricetype1.nMatId WHERE aspen_tblmatdescription.vDescription='".$description."'";
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
	 
	 
	 
	 
	 
	   
	 function minthicknessexistmodel(){
		if(isset( $_POST['minthickness'] )&&  isset( $_POST['coil'])   ){
			$minthickness = $_POST['minthickness'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblpricetype1 where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$minthickness."' BETWEEN nMinthickness AND nMaxthickness ";
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
	
	function maxthicknessexistmodel(){
		if(isset( $_POST['maxthickness'] )&&  isset( $_POST['coil'])   ){
			$maxthickness = $_POST['maxthickness'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblpricetype1 where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$maxthickness."' BETWEEN nMinthickness AND nMaxthickness ";
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
	
	
		function checkthicknessexist(){
		$sqlchk = "select nMinthickness as minthickness from aspen_tblpricetype1";
		$sqlcheck = $this->db->query($sqlchk);
		if ($sqlcheck->num_rows() > 0){
			foreach ($sqlcheck->result() as $rowpw){
				$sqlcheck =$rowpw->minthickness;
			}
		}
	} 
	 
	 
	 
	 
	 
	 
	 
	 
	  
}

class Ratedetailsthickness_model extends Base_module_model {	
 	
}
