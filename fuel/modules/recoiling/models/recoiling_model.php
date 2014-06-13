<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class recoiling_model extends Base_module_model {
	
	protected $key_field = 'vIRnumber';
	function __construct(){
        parent::__construct('aspen_tblrecoiling');
    }
		
	function example(){
		return true;
	}
	
	function getrecoiling($pid, $pname){
		if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}
		$sql ="SELECT aspen_tblinwardentry.vIRnumber,  aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity, aspen_tblinwardentry.vStatus
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
	
	function delete_recoil($Recoilnumber='', $Pid='') {
		$sql ="DELETE FROM aspen_tblrecoiling WHERE vIRnumber ='".$Pid."' and nSno = '".$Recoilnumber."'";
		$query = $this->db->query($sql);
	}
	
	function savechange(){ 
		$sqlnsno = $this->db->query ("SELECT nSno FROM aspen_tblrecoiling");

	if ($sqlnsno->num_rows() >= 0)
		{
		   foreach ($sqlnsno->result() as $row)
		   {
		      $arr[] =$row;
		   }
		}
		json_encode($arr);
	foreach ($arr as $row){
		if($row->nSno > 0){
	$sql = $this->db->query ("UPDATE aspen_tblrecoiling  SET vStatus='WIP-Recoiling' WHERE vIRnumber='".$_POST['pid']."' and nSno!=0");
	$sql = $this->db->query ("UPDATE aspen_tblinwardentry  SET vprocess='Recoiling' WHERE vIRnumber='".$_POST['pid']."'");
		}
	}
	$sql = $this->db->query ("UPDATE aspen_tblinwardentry  SET vStatus='Work In Progress' WHERE vIRnumber='".$_POST['pid']."'");
  
	}
	
	function recoillistdetails($partyid = ''){
	$sqlri = "select nSno as recoilno,vIRnumber as coilno, dStartDate as startdate, dEndDate as enddate, nNoOfRecoils, nBundleweight as weight from aspen_tblrecoiling WHERE aspen_tblrecoiling.vIRnumber='".$partyid."'";
	$query = $this->db->query($sqlri);
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
	
	/*function delete_recoil( $coilno='',$startdate='',$enddate='',$noofrecoil='') {
		$sql ="DELETE FROM aspen_tblrecoiling WHERE vIRnumber ='".$coilno."' and dStartDate = '".$startdate."'and dEndDate = '".$enddate."'and nNoOfRecoils = '".$noofrecoil."'";
		$query = $this->db->query($sql);
	}
	*/
	function RecoilTable($pid){
		if(isset( $_POST['pid'])){
			$pid = $_POST['pid'];
		}
		$sql = "select vIRnumber,dStartDate,dEndDate,nNoOfRecoils from aspen_tblrecoiling  "; 
			if(isset($pid)) {
				$sql.="WHERE aspen_tblrecoiling.vIRnumber='".$pid."'";
			}
		$query = $this->db->query($sql);
		$arra='';
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row){
				$arra[] =$row;
			}
		} 
		return $arra;
	}
	
   function saverecoil(){
		if(isset( $_POST['pid']) &&  isset( $_POST['date1']) && isset( $_POST['datepicker']) && isset( $_POST['nocoil'])&& isset( $_POST['weightcoil']) ){
			$pid = $_POST['pid'];
			$date1 = $_POST['date1'];
			$datepicker = $_POST['datepicker'];
			$nocoil = $_POST['nocoil'];
			$weightcoil = $_POST['weightcoil'];
		}
		$sql = $this->db->query ("Insert into aspen_tblrecoiling  (vIRnumber,dStartDate,dEndDate,nNoOfRecoils,nBundleweight) VALUES(  '". $pid. "','". $date1. "','". $datepicker. "','". $nocoil. "' ,'". $weightcoil. "')");
	}

function deleterow($deleteid)
	 {
	 $querycheck = $this->db->query("select * from aspen_tblrecoiling where nNoOfRecoils = '".$deleteid."'");
	 $arr = $querycheck->result();
	 if(!empty($arr)) {
		$sql = $this->db->query("DELETE FROM aspen_tblrecoiling WHERE nNoOfRecoils='".$deleteid."'");
	}
	else{
		return false;
	  }
        }	
			
}

class recoilingmodel extends Base_module_record {
 	
}