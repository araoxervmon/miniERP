<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/finish_task/config/finish_task_constants.php');
 
 
class finish_task_model extends Base_module_model {
	
	protected $key_field = 'vIRnumber';// primary key
	
    function __construct()
    {
        parent::__construct('aspen_tblinwardentry'); //table which we are refering
    }
		
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	   $sql = "select nMinThickness,nMaxThickness,nAmount from aspen_tblpricetype1 "; 
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
	
	function totalweightcountmodel($pid){
		$sqlto =  "select 
		round(sum(nBundleweight),0)as bundleweight from aspen_tblcuttinginstruction
		left join aspen_tblinwardentry on aspen_tblcuttinginstruction.vIRnumber=aspen_tblinwardentry.vIRnumber where aspen_tblinwardentry.vIRnumber='".$pid."'";
		$query = $this->db->query($sqlto);
		$arr='';
		if ($query->num_rows() > 0) {
		 	foreach ($query->result() as $row)
			{
				$arr[] =$row;
			}
		}	
		return $arr;
	}
	
	function datetime_now($hms = TRUE){
	if ($hms)
	{
		return date("Y-m-d H:i:s");
	}
	else
	{
		return date("Y-m-d");
	}
}
	
	
	function formdisplay() //this method has to be specified in routes
	{
		
		return true;
	}
	
	function finishmodel($pid, $pname,$txtbundleids,$txtbundleweight,$txtboxscrap)
	{
		if(isset($pid) && isset($pname) && isset($txtbundleids)&& isset($txtbundleweight)&& isset($txtboxscrap)) {
			$partyname = $pname;
			$pid = $pid;
			$txtbundleids = $txtbundleids;
			$txtbundleweight = $txtbundleweight;
			$txtboxscrap = $txtboxscrap;
		}
	
		$query = $this->db->query ("UPDATE aspen_tblinwardentry  SET vStatus='Ready To Bill' WHERE vIRnumber='".$pid."'");
		$query = $this->db->query ("UPDATE aspen_tblcuttinginstruction  SET vStatus='Ready To Bill' WHERE vIRnumber='".$pid."' and nSno='".$txtbundleids."'");

		$sql = $this->db->query ("Insert into aspen_tblbillingstatus    (nSno,vBillingStatus,fWeight,dBillDate,nActualNo,vIRnumber,nScrapSent ) VALUES ('". $txtbundleids. "',
  'Not Billed' ,'". $txtbundleweight. "','0','0','". $pid. "','". $txtboxscrap. "' )");
			
	}
		
	function finishmodelrecoil($pid, $pname,$txtbundleids,$txtbundleweight){
		if(isset($pid) && isset($pname) && isset($txtbundleids)&& isset($txtbundleweight)) {
			$partyname = $pname;
			$partyid = $pid;
			$txtbundleids = $txtbundleids;
			$txtbundleweight = $txtbundleweight;
		}
		$query = $this->db->query ("UPDATE aspen_tblinwardentry  SET vStatus='Ready To Bill' WHERE vIRnumber='".$partyid."'");
		$query = $this->db->query ("UPDATE aspen_tblrecoiling  SET vStatus='Ready To Bill' WHERE vIRnumber='".$partyid."' and nSno='".$txtbundleids."'");

		$sql = $this->db->query ("Insert into aspen_tblbillingstatus    (nSno,vBillingStatus,fWeight,dBillDate,nActualNo,vIRnumber ) VALUES ('". $txtbundleids. "',
		'Not Billed' ,'". $txtbundleweight. "','0','0','". $pid. "' )");
			
	}
		
	function finishmodelslit($pid, $pname,$txtbundleids,$txtbundleweight){
		if(isset($pid) && isset($pname) && isset($txtbundleids)&& isset($txtbundleweight)) {
			$partyname = $pname;
			$partyid = $pid;
			$txtbundleids = $txtbundleids;
			$txtbundleweight = $txtbundleweight;
		}
		$query = $this->db->query ("UPDATE aspen_tblinwardentry  SET vStatus='Ready To Bill' WHERE vIRnumber='".$partyid."'");
		$query = $this->db->query ("UPDATE aspen_tblslittinginstruction  SET vStatus='Ready To Bill' WHERE vIRnumber='".$partyid."' and nSno='".$txtbundleids."'");

	$sql = $this->db->query ("Insert into aspen_tblbillingstatus    (nSno,vBillingStatus,fWeight,dBillDate,nActualNo,vIRnumber ) VALUES ('". $txtbundleids. "',
	'Not Billed' ,'". $txtbundleweight. "','0','0','". $pid. "' )");
			
	}
		
	function getfinishmodel($pid, $pname){
		if(isset($pid) && isset($pname)){
				$partyname = $pname;
				$partyid = $pid;
		}
		$sql ="SELECT aspen_tblinwardentry.vIRnumber, aspen_tblinwardentry.dReceivedDate, aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity, aspen_tblinwardentry.vStatus,aspen_tblinwardentry.dInvoiceDate
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
		
	function delete_bundlenumber($bundle='', $partynumber='') {
		$sql ="DELETE FROM aspen_tblcuttinginstruction WHERE vIRnumber ='".$partynumber."' and nSno = '".$bundle."'";
		$query = $this->db->query($sql);
	}	
		
		
	function finishwpmodel($pid, $pname) {
	if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}
		$sql ="select aspen_tblinwardentry.vIRnumber , aspen_tblinwardentry.dReceivedDate ,aspen_tblcuttinginstruction.dDate ,aspen_tblrecoiling.dStartDate ,aspen_tblpartydetails.nPartyName ,aspen_tblmatdescription.vDescription ,aspen_tblinwardentry.fThickness ,aspen_tblinwardentry.fWidth ,aspen_tblinwardentry.fQuantity  From aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblcuttinginstruction  ON aspen_tblcuttinginstruction.vIRnumber=aspen_tblinwardentry.vIRnumber LEFT JOIN aspen_tblrecoiling  ON aspen_tblrecoiling .vIRnumber=aspen_tblinwardentry.vIRnumber LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId  ";
		if(!empty($partyname) && !empty($partyid)) {
		$sql.="WHERE aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_tblinwardentry.vIRnumber='".$partyid."' ";
		}	
		$query = $this->db->query($sql);
		$arrb='';
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arrb[] =$row;
		   }
		}
		return json_encode($arrb[0]);
	}		
				
    function saveweight(){
	   if(isset( $_POST['bundlenumber']) && isset( $_POST['actual']) && isset( $_POST['weight']) && isset( $_POST['pid'])) {
		$bno = $_POST['bundlenumber'];
		$ano = $_POST['actual'];
		$wno = $_POST['weight'];
		$pid = $_POST['pid'];
	 }
	 
	$sqlfin= "Select vprocess from aspen_tblinwardentry where vIRnumber='".$pid."'";
	$query = $this->db->query($sqlfin);
		$arr='';
		if ($query->num_rows() > 0) {
		 	foreach ($query->result() as $row)
			{
				$arr[] =$row;
			}
		}
		json_encode($arr);
	foreach ($arr as $row){
	if($row->vprocess =='Cutting'){
		$sql = "UPDATE aspen_tblcuttinginstruction SET  nBundleweight='".$_POST['weight']. "' , nNoOfPieces='".$_POST['actual']."' WHERE aspen_tblcuttinginstruction.vIRnumber ='".$_POST['pid']. "' AND aspen_tblcuttinginstruction.nSno='".$_POST['bundlenumber']."'" ;
    		$query1=$this->db->query ($sql);
		}
		 else if($row->vprocess =='Recoiling'){
		 $sql = ("UPDATE aspen_tblrecoiling SET  nNoOfRecoils='".$_POST['actual']."'");
       		$sql.=" WHERE aspen_tblrecoiling.nSno='".$_POST['bundlenumber']."' and aspen_tblrecoiling.vIRnumber ='".$_POST['pid']. "'" ;
    		$query1=$this->db->query ($sql);
		 
		 }
		 else if($row->vprocess =='Slitting'){
		 $sql = ("UPDATE aspen_tblslittinginstruction SET  nWidth='".$_POST['actual']."'");
       		$sql.=" WHERE aspen_tblslittinginstruction.nSno='".$_POST['bundlenumber']."' and aspen_tblslittinginstruction.vIRnumber ='".$_POST['pid']. "'" ;
    		$query1=$this->db->query ($sql);
		 
		 }
		}
	  
	}
	function FinishTable($pid) //finish table
	 {
		 if(isset( $_POST['pid'])) {
		  $pid = $_POST['pid'];
		  }
		  $sql = "select nSno,dDate,nLength,nNoOfPieces,nTotalWeight,nBundleweight, CASE WHEN aspen_tblcuttinginstruction.nSno >  '0'
		  THEN aspen_tblcuttinginstruction.nBundleweight
          WHEN aspen_tblcuttinginstruction.nSno =  '0'
		  THEN aspen_tblcuttinginstruction.nTotalWeight
          END AS weight from aspen_tblcuttinginstruction "; 
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
  
  function statuschange(){
	$sql = $this->db->query ("UPDATE aspen_tblcuttinginstruction  SET vStatus='WIP-Cutting' WHERE vIRnumber='".$_POST['partyid']."' and nSno ='".$_POST['txtbundleids']."'");
  }
  
  function finishlist_model($partyid = '') 
{

	$sqlpcheck= "Select vprocess from aspen_tblinwardentry where vIRnumber='".$partyid."'";
	$query = $this->db->query($sqlpcheck);
		$arr='';
		if ($query->num_rows() > 0) {
		 	foreach ($query->result() as $row)
			{
				$arr[] =$row;
			}
		}
		json_encode($arr);
	foreach ($arr as $row){
	if($row->vprocess =='Cutting'){
	$sqlfi = "select aspen_tblcuttinginstruction.nSno as bundlenumber,DATE_FORMAT(aspen_tblcuttinginstruction.dDate, '%d-%m-%Y') as date,aspen_tblcuttinginstruction.nLength as length,aspen_tblcuttinginstruction.nNoOfPieces as actualnumber,aspen_tblcuttinginstruction.nTotalWeight as totalweight,aspen_tblcuttinginstruction.nBundleweight as bundleweight,aspen_tblinwardentry.vprocess as process, CASE WHEN aspen_tblcuttinginstruction.nSno >  '0'
		  THEN aspen_tblcuttinginstruction.nBundleweight
          WHEN aspen_tblcuttinginstruction.nSno =  '0'
		  THEN aspen_tblcuttinginstruction.nTotalWeight
          END AS weight,aspen_tblcuttinginstruction.vStatus as status from aspen_tblcuttinginstruction  
		LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblcuttinginstruction.vIRnumber WHERE aspen_tblcuttinginstruction.vIRnumber='".$partyid."'";
	$query = $this->db->query($sqlfi);}
		  
		  else if($row->vprocess =='Recoiling'){
		  $sqlre = "select aspen_tblrecoiling.nSno as recoilnumber,DATE_FORMAT(aspen_tblrecoiling.dStartDate, '%d-%m-%Y') as startdate,DATE_FORMAT(aspen_tblrecoiling.dEndDate, '%d-%m-%Y') as enddate,aspen_tblrecoiling.nNoOfRecoils as norecoil,aspen_tblrecoiling.vStatus as status,aspen_tblinwardentry.vprocess as process from aspen_tblrecoiling  
		  LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblrecoiling.vIRnumber WHERE aspen_tblrecoiling.vIRnumber='".$partyid."'";
		$query = $this->db->query($sqlre);}
		
		    else if($row->vprocess =='Slitting'){
		    $sqlsl = "select aspen_tblslittinginstruction.nSno as slittnumber,DATE_FORMAT(aspen_tblslittinginstruction.dDate, '%d-%m-%Y') as date,aspen_tblslittinginstruction.nWidth as width, aspen_tblslittinginstruction.vStatus as status,aspen_tblinwardentry.vprocess as process from aspen_tblslittinginstruction  
			LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblslittinginstruction.vIRnumber WHERE aspen_tblslittinginstruction.vIRnumber='".$partyid."'";
	$query = $this->db->query($sqlsl);}
	}
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
  
  function finishweight_model($partyid = '') 
{
	$sqlbw = "select sum(nBundleweight) as bundleweight from aspen_tblcuttinginstruction  WHERE aspen_tblcuttinginstruction.vIRnumber='".$partyid."'";
	$query = $this->db->query($sqlbw);
	if ($query->num_rows() > 0)
    {
    foreach ($query->result() as $rowbw)
    {
    $bweight =$rowbw->bundleweight;
    }
    }
	return $bweight;
  }	
		
}

class finishtask_model extends Base_module_record {
	
 	
}