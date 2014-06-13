<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/billing_instruction/config/billing_instruction_constants.php');

class Billing_instruction_model extends Base_module_model {
    function __construct()
    {
        parent::__construct('aspen_tblbilldetails');// table name
    }
	
	function example(){
		return true;
	}
	
	function delete_bundlenumber($bundle='',$coilnumber='') {
		$sql ="DELETE FROM aspen_tblbillingstatus WHERE nSno = '".$bundle."' and vIRnumber='".$coilnumber."'";
		$query = $this->db->query($sql);
	}	
	
	 function billintable_model($pid){
		 if(isset( $_POST['pid'])) {
			$pid = $_POST['pid'];
		  }
		  $sql = "select * from aspen_tblcuttinginstruction "; 
		  if(isset($pid)) {
			$sql.="WHERE aspen_tblcuttinginstruction.vIRnumber='".$pid."'";
		  }
			$query = $this->db->query($sql);
			$arra='';
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$arra[] =$row;
				}
			} 
		return $arra;
	  }
	  
	function processchk($pid){
	$sqllv = "SELECT aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry WHERE vIRnumber='".$pid."'";
		$query = $this->db->query($sqllv);
		$arr='';
		if ($query->num_rows() > 0) {
		 	foreach ($query->result() as $row)
			{
				$arr[] =$row;
			}
		}	
		return $arr;
	}
	
	function billistdetails($partyid = '') {
	$sqlci = "select Distinct aspen_tblbillingstatus.nSno as bundlenumber,aspen_tblcuttinginstruction.nBundleweight as weight,aspen_tblcuttinginstruction.nLength as length,aspen_tblcuttinginstruction.vIRnumber as coilnumber,aspen_tblcuttinginstruction.nNoOfPieces as totalnumberofsheets,aspen_tblbillingstatus.nActualNo as noofsheetsbilled ,aspen_tblbillingstatus.vBillingStatus as billingstatus,aspen_tblcuttinginstruction.nNoOfPieces - aspen_tblbillingstatus.nActualNo
  AS balance from aspen_tblcuttinginstruction
		  LEFT JOIN aspen_tblbillingstatus  ON aspen_tblcuttinginstruction.vIRnumber=aspen_tblbillingstatus.vIRnumber  WHERE  aspen_tblcuttinginstruction.nSno = aspen_tblbillingstatus.nSno and aspen_tblcuttinginstruction.vIRnumber='".$partyid."' Group by  aspen_tblbillingstatus.nSno";
	$query = $this->db->query($sqlci);
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
	
	function loadfolderlistslit($partyid = '') {
	$sqlsi = "select Distinct aspen_tblslittinginstruction.nSno as serialnumber,aspen_tblslittinginstruction.vIRnumber as slitnumber,aspen_tblslittinginstruction.nWidth as width,aspen_tblslittinginstruction.dDate as sdate,aspen_tblbillingstatus.nActualNo as noofsheetsbilled ,aspen_tblbillingstatus.vBillingStatus as billingstatus from aspen_tblslittinginstruction
		  LEFT JOIN aspen_tblbillingstatus  ON aspen_tblslittinginstruction.vIRnumber=aspen_tblbillingstatus.vIRnumber  WHERE  aspen_tblslittinginstruction.nSno = aspen_tblbillingstatus.nSno and aspen_tblslittinginstruction.vIRnumber='".$partyid."' and  aspen_tblslittinginstruction.vStatus =  'Ready To Bill' Group by  aspen_tblbillingstatus.nSno";
		
	$query = $this->db->query($sqlsi);
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
	function loadfolderlistrecoil($partyid = '') {
	$sqlsi = "select Distinct aspen_tblrecoiling.nSno as recoilnumber,aspen_tblrecoiling.nNoOfRecoils as noofrecoil,aspen_tblrecoiling.dStartDate as sdate,aspen_tblrecoiling.dEndDate as edate,aspen_tblbillingstatus.nActualNo as noofsheetsbilled ,aspen_tblbillingstatus.vBillingStatus as billingstatus from aspen_tblrecoiling
		  LEFT JOIN aspen_tblbillingstatus  ON aspen_tblrecoiling.vIRnumber=aspen_tblbillingstatus.vIRnumber  WHERE  aspen_tblrecoiling.nSno = aspen_tblbillingstatus.nSno and aspen_tblrecoiling.vIRnumber='".$partyid."' and  aspen_tblrecoiling.vStatus =  'Ready To Bill' Group by  aspen_tblbillingstatus.nSno";
		
	$query = $this->db->query($sqlsi);
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

	
	function billingviewmodel($pid, $pname){
		if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}
		$sql ="SELECT aspen_tblinwardentry.vIRnumber,  aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity,aspen_tblinwardentry.vInvoiceNo, aspen_tblinwardentry.vStatus
		FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId ";
		if(!empty($partyname) && !empty($partyid)) {
		$sql.="WHERE aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_tblinwardentry.vIRnumber='".$partyid."' ";
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
		return json_encode($arr[0]);
	}
	function billingsemifinished($pid, $pname){
		if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}
		$sql ="SELECT aspen_tblinwardentry.vIRnumber,  aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity,aspen_tblinwardentry.vInvoiceNo, aspen_tblinwardentry.vStatus
		FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId ";
		if(!empty($partyname) && !empty($partyid)) {
		$sql.="WHERE aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_tblinwardentry.vIRnumber='".$partyid."' ";
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
		return json_encode($arr[0]);
	}
 
} 
class Billinginstruction_model extends Base_module_record {
 
}