<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/rate_details_width/config/rate_details_width_constants.php'); 

class Rate_details_width_model extends Base_module_model {

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
		$fields['nMinWidth']['type'] ='Min width';
		$fields['nMaxWidth']['type'] ='Max width';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	   $sql = "select nMinWidth,nMaxWidth,nAmount,nPriceId from aspen_tblwidth "; 
	   if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblwidth.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";
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
	   if(isset( $_POST['coildescription']) && isset( $_POST['minwidth']) && isset( $_POST['maxwidth']) && isset( $_POST['rate'])) {
		$matdescrip = $_POST['coildescription'];
		$minwidth = $_POST['minwidth'];
		$maxwidth = $_POST['maxwidth'];
		$rate = $_POST['rate'];
	 }
		$sql = $this->db->query ("Insert into aspen_tblwidth  (nMatId,nMinWidth,nMaxWidth ,nAmount) VALUES( (SELECT aspen_tblmatdescription.nMatId  FROM aspen_tblmatdescription where aspen_tblmatdescription.vDescription = '". $matdescrip. "') ,'". $minwidth. "' , '". $maxwidth. "','". $rate. "')");
	  
	 }
	  
	 /* function updaterate() 
	 {
	   if(isset($_POST['priceid']) && isset($_POST['coildescription']) && isset( $_POST['minwidth']) && isset( $_POST['maxwidth']) && isset( $_POST['rate'])) {
	   $priceid = $_POST['priceid'];
	   $matdescrip = $_POST['coildescription'];
		$minwidth = $_POST['minwidth'];
		$maxwidth = $_POST['maxwidth'];
		$rate = $_POST['rate'];
		}
		$sql = $this->db->query ("Update aspen_tblwidth SET nMinWidth='". $minwidth."',
															nMaxWidth='". $maxwidth."',
															nAmount=  '". $rate. "'  
													   where nPriceId='". $priceid. "'" );
		
		
	 }*/
					
    
	     function updaterate() 
	 {
	   if(isset( $_POST['priceid']) &&  isset( $_POST['minwidth']) && isset( $_POST['maxwidth']) && isset( $_POST['rate'])) {
		 $priceid = $_POST['priceid'];
	  // $matdescrip = $_POST['coildescription'];
		$minwidth = $_POST['minwidth'];
		$maxwidth = $_POST['maxwidth'];
		$rate = $_POST['rate'];
	 }        
		$sql = ("Update aspen_tblwidth SET nMinWidth='". $minwidth."', nMaxWidth='". $maxwidth."', nAmount=  '". $rate. "' ");
       		$sql.=" WHERE aspen_tblwidth.nPriceId='".$priceid."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	  
	  
	 function deleterow($deletevalue)
	 {
	 $querycheck = $this->db->query("select * from aspen_tblwidth where nPriceId = '".$deletevalue."'");
	 $arr = $querycheck->result();
	 if(!empty($arr)) {
		$sql = $this->db->query("DELETE FROM aspen_tblwidth WHERE nPriceId='".$deletevalue."'");
	}
	else{
		return false;
	}
	 }
	 
	 
 	function delete_ratedetailwidthmodel($priceid ='') {
		$sql = " DELETE FROM aspen_tblwidth WHERE nPriceId='".$priceid."'";
		$query = $this->db->query($sql);
	}
	 
	   
	 function list_partyname($description = '') {	
		$sql ="select nMinWidth as minwidth,nMaxWidth as maxwidth,nAmount as rate,nPriceId as priceid from aspen_tblwidth ";
   		if(!empty($description)) { 
		$sql .=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblwidth.nMatId WHERE aspen_tblmatdescription.vDescription='".$description."'";
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
	 
	 
	 function minwidthexistmodel(){
		if(isset( $_POST['minwidth'] )&&  isset( $_POST['coil'])   ){
			$minwidth = $_POST['minwidth'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblwidth where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$minwidth."' BETWEEN nMinwidth AND nMaxwidth ";
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
	
	function maxwidthexistmodel(){
		if(isset( $_POST['maxwidth'] )&&  isset( $_POST['coil'])   ){
			$maxwidth = $_POST['maxwidth'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblwidth where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$maxwidth."' BETWEEN nMinwidth AND nMaxwidth ";
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
	
	
		function checkwidthexist(){
		$sqlchk = "select nMinwidth as minwidth from aspen_tblwidth";
		$sqlcheck = $this->db->query($sqlchk);
		if ($sqlcheck->num_rows() > 0){
			foreach ($sqlcheck->result() as $rowpw){
				$sqlcheck =$rowpw->minwidth;
			}
		}
	} 
	 
	 
	 
}

class Ratedetailswidth_model extends Base_module_model {	
 	
}
