<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class slitting_instruction_model extends Base_module_model {
	
 	public $required = array('vIRnumber','nSno','dDate','nLength','nNoOfPieces','nTotalWeight');
	protected $key_field = 'vIRnumber';
	
    function __construct()
    {
        parent::__construct('aspen_tblslittinginstruction');
    }
		
	function getcoildetails() {
		
		$this->save($save);
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

	function totalwidthmodel($partyid){
	$sqlsw = "select 
	round(sum(nWidth),0)as width from aspen_tblslittinginstruction
	left join aspen_tblinwardentry on aspen_tblslittinginstruction.vIRnumber=aspen_tblinwardentry.vIRnumber where aspen_tblinwardentry.vIRnumber='".$partyid."'";
		$query = $this->db->query($sqlsw);
		$arr='';
		if ($query->num_rows() > 0) {
		 	foreach ($query->result() as $row)
			{
				$arr[] =$row;
			}
		}	
		return $arr;
	}
	
	function delete_slitnumbermodel($Slitingnumber='', $Pid='') {
		$sql ="DELETE FROM aspen_tblslittinginstruction WHERE vIRnumber ='".$Pid."' and nSno = '".$Slitingnumber."'";
		$query = $this->db->query($sql);
	}
	
  
	function editbundlemodel(){
	   if(isset( $_POST['bundlenumber']) && isset( $_POST['width_v']))
	   {
		$bundlenumber = $_POST['bundlenumber'];
		$width_v = $_POST['width_v'];
	 }
		$sql = ("UPDATE aspen_tblslittinginstruction SET nWidth='". $width_v. "'");
       		$sql.=" WHERE aspen_tblslittinginstruction.nSno='".$bundlenumber."'";
    		$query1=$this->db->query ($sql);
	  
	 }
	 
	 function savechangemodel (){ 
		$sqlnsno = $this->db->query ("SELECT nSno FROM aspen_tblslittinginstruction");

		if ($sqlnsno->num_rows() >= 0){
		   foreach ($sqlnsno->result() as $row){
				$arr[] =$row;
			}
		}
		json_encode($arr);
		foreach ($arr as $row){
			if($row->nSno > 0){
			$sql = $this->db->query ("UPDATE aspen_tblslittinginstruction  SET vStatus='WIP-Slitting' WHERE vIRnumber='".$_POST['pid']."' and nSno!=0");
			$sql = $this->db->query ("UPDATE aspen_tblinwardentry  SET vprocess='Slitting' WHERE vIRnumber='".$_POST['pid']."'");
  
			}
		}
		$sql = $this->db->query ("UPDATE aspen_tblinwardentry  SET vStatus='Work In Progress' WHERE vIRnumber='".$_POST['pid']."'");
		
  
	}
	
	
	
	
	function getCuttingInstruction($pid, $pname) {
		if(isset($pid) && isset($pname)) {
			$partyid = $pid;
			$partyname = $pname;
		}
		$sql ="SELECT aspen_tblinwardentry.vIRnumber, aspen_tblinwardentry.dReceivedDate, aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity, aspen_tblinwardentry.vStatus
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
		//var_dump($arr);die();
		return json_encode($arr[0]);
		}	
		
		
		
function BundleTable($pid) 
 {
 if(isset( $_POST['pid'])) {
  $pid = $_POST['pid'];
  }
  $sql = "select nSno,dDate,nWidth from aspen_tblslittinginstruction  "; 
  if(isset($pid)) {
  $sql.="WHERE aspen_tblslittinginstruction.vIRnumber='".$pid."'";
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
		
		
	function savebundleslitting() 
  {
    if(isset( $_POST['pid']) && isset( $_POST['bundlenumber']) && isset( $_POST['date1']) && isset( $_POST['width_v'])) {
	$pid = $_POST['pid'];
  $bundlenumber = $_POST['bundlenumber'];
  $date1 = $_POST['date1'];
  $width_v = $_POST['width_v'];
  
  }
  $sql = $this->db->query ("Insert into aspen_tblslittinginstruction  (vIRnumber,dDate,nWidth) VALUES(  '". $pid. "','". $date1. "','". $width_v. "')");
   //echo $sql; die();
  }
		
	function deleteslittingmodel($deleteid)
	{
		 $querycheck = $this->db->query("select * from aspen_tblslittinginstruction where nSno = '".$deleteid."'");
	 $arr = $querycheck->result();
	 if(!empty($arr)) {
		$sql = $this->db->query("DELETE FROM aspen_tblslittinginstruction WHERE nSno='".$deleteid."'");
	}
	else{
		return false;
	  }
    }
	
	function slitlistdetails($partyid = '') 
 {
	$sqlci = "select aspen_tblslittinginstruction.nSno as Sno,DATE_FORMAT(aspen_tblslittinginstruction.dDate, '%d-%m-%Y') AS Slittingdate,aspen_tblslittinginstruction.nWidth as width, aspen_tblslittinginstruction.vIRnumber as pnumber, (aspen_tblslittinginstruction.nWidth / aspen_tblinwardentry.fWidth)* aspen_tblinwardentry.fQuantity as weight FROM aspen_tblslittinginstruction  left join aspen_tblinwardentry on aspen_tblinwardentry.vIRnumber = aspen_tblslittinginstruction.vIRnumber WHERE aspen_tblslittinginstruction.vIRnumber='".$partyid."'";
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
		
	function delete_coilnumber($Sno='', $partynumber='') {
		$sql ="DELETE FROM aspen_tblslittinginstruction WHERE vIRnumber ='".$partynumber."' and nSno = '".$Sno."'";
		$query = $this->db->query($sql);
	}	
		
		
		
}

class Splittinginstructions_model extends Base_module_record {
	
 	
}