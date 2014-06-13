<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/rate_details_weight/config/rate_details_weight_constants.php'); 

class Rate_details_weight_model extends Base_module_model {

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
  
  function tableweight() {
	$sql = $this->db->query ("select * from aspen_tblweight "); 
	  /* if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblpricetype1.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";*/
	var_dump($sql);die();
  }
  
  
  
  
  
  
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinWeight']['type'] ='Min weight';
		$fields['nMaxWeight']['type'] ='Max weight';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	   $sql = "select nMinWeight,nMaxWeight,nAmount,nPriceId from aspen_tblweight "; 
	   if(!empty($coilname)) { 
	   $sql.=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblweight.nMatId WHERE aspen_tblmatdescription.vDescription='".$coilname."'";
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
	   if(isset( $_POST['coildescription']) && isset( $_POST['minweight']) && isset( $_POST['maxweight']) && isset( $_POST['rate'])) {
		$matdescrip = $_POST['coildescription'];
		$minweight = $_POST['minweight'];
		$maxweight = $_POST['maxweight'];
		$rate = $_POST['rate'];
	 }
		$sql = $this->db->query ("Insert into aspen_tblweight  (nMatId,nMinWeight,nMaxWeight ,nAmount) VALUES( (SELECT aspen_tblmatdescription.nMatId  FROM aspen_tblmatdescription where aspen_tblmatdescription.vDescription = '". $matdescrip. "') ,'". $minweight. "' , '". $maxweight. "','". $rate. "')");
	  
	 }
	  
	   function updaterate() 
	 {
	   if(isset( $_POST['priceid']) &&  isset( $_POST['minweight']) && isset( $_POST['maxweight']) && isset( $_POST['rate'])) {
		 $priceid = $_POST['priceid'];
	  // $matdescrip = $_POST['coildescription'];
		$minweight = $_POST['minweight'];
		$maxweight = $_POST['maxweight'];
		$rate = $_POST['rate'];
	 }        
		$sql = ("Update aspen_tblweight SET nMinWeight='". $minweight."', nMaxWeight='". $maxweight."', nAmount=  '". $rate. "' ");
       		$sql.=" WHERE aspen_tblweight.nPriceId='".$priceid."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	  
		
	 	function delete_ratedetailweightmodel($priceid ='') {
		$sql = " DELETE FROM aspen_tblweight WHERE nPriceId='".$priceid."'";
		$query = $this->db->query($sql);
	}
	 
	
	
	 function list_partyname($description = '') {	
		$sql ="select nMinWeight as minweight,nMaxWeight as maxweight,nAmount as rate,nPriceId as priceid from aspen_tblweight ";
   		if(!empty($description)) { 
		$sql .=" LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblweight.nMatId WHERE aspen_tblmatdescription.vDescription='".$description."'";
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
	 
	 
	 
	  
	 function minweightexistmodel(){
		if(isset( $_POST['minweight'] )&&  isset( $_POST['coil'])   ){
			$minweight = $_POST['minweight'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblweight where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$minweight."' BETWEEN nMinweight AND nMaxweight ";
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
	
	function maxweightexistmodel(){
		if(isset( $_POST['maxweight'] )&&  isset( $_POST['coil'])   ){
			$maxweight = $_POST['maxweight'];
			$coil = $_POST['coil'];
		}
		$sql ="SELECT * FROM aspen_tblweight where nMatId=(SELECT nMatId  FROM aspen_tblmatdescription where vDescription =  '". $coil. "' ) and '".$maxweight."' BETWEEN nMinweight AND nMaxweight ";
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
	
	
		function checkweightexist(){
		$sqlchk = "select nMinweight as minweight from aspen_tblweight";
		$sqlcheck = $this->db->query($sqlchk);
		if ($sqlcheck->num_rows() > 0){
			foreach ($sqlcheck->result() as $rowpw){
				$sqlcheck =$rowpw->minweight;
			}
		}
	} 
	 
	 
	 
	 
	 
}

class Ratedetailsweight_model extends Base_module_model {	
 	
}
