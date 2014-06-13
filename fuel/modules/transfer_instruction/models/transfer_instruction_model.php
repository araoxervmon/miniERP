<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class transfer_instruction_model extends Base_module_model {
	

    function __construct()
    {
        parent::__construct('aspen_tblcuttinginstruction');
    }
	
	
	function transfer_instruction()
	{
	return true;
	}

	function savetransfer($pid,$pname, $date3,$frompartyname,$todate)
	{
		$sql = "Insert into aspen_tbltransferdetails  (
		vIRnumber,nFromPartyId,nToPartyId,dDate) 
		VALUES('". $pid. "',(SELECT aspen_tblpartydetails.nPartyId  FROM aspen_tblpartydetails where aspen_tblpartydetails.nPartyName = '". $frompartyname. "'), (SELECT aspen_tblpartydetails.nPartyId  FROM aspen_tblpartydetails where aspen_tblpartydetails.nPartyName = '". $pname. "'), '". $todate. "')";
		$sql1 = "Insert into aspen_hist_tbltransferdetails  (
		vIRnumber,nFromPartyId,nToPartyId,dDate) 
		VALUES('". $pid. "',(SELECT aspen_tblpartydetails.nPartyId  FROM aspen_tblpartydetails where aspen_tblpartydetails.nPartyName = '". $frompartyname. "'), (SELECT aspen_tblpartydetails.nPartyId  FROM aspen_tblpartydetails where aspen_tblpartydetails.nPartyName = '". $pname. "'), '". $date3. "')";
		$sql2 = "UPDATE  aspen_tblinwardentry SET aspen_tblinwardentry.nPartyId=
		(SELECT aspen_tblpartydetails.nPartyId  FROM aspen_tblpartydetails where aspen_tblpartydetails.nPartyName = '". $pname. "') WHERE aspen_tblinwardentry.vIRnumber='".$_POST['pid']."'";
		$query = $this->db->query($sql);
		$query = $this->db->query($sql1);
		$query = $this->db->query($sql2);
		
	}
	
	
	
 function gettransferInstruction($pid, $pname) {
		if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}

		$sql ="SELECT aspen_tblinwardentry.vIRnumber, aspen_tblinwardentry.dReceivedDate, aspen_tblinwardentry.vLorryNo,aspen_tblinwardentry.vInvoiceNo, aspen_tblinwardentry.dInvoiceDate, aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fLength,aspen_tblinwardentry.fQuantity, aspen_tblinwardentry.vStatus, 
		aspen_tblinwardentry.vHeatnumber, aspen_tblinwardentry.vPlantname
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
  
  
  
  
 function party() {
		$sql = "select nPartyName from aspen_tblpartydetails";
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

class transfer_instructionmodel extends Base_module_record {
	
 	
}