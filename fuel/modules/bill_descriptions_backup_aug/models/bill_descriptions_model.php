<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/bill_descriptions/config/bill_descriptions_constants.php'); 
class bill_descriptions_model extends Base_module_model {
 

	
    function __construct()
    {
        parent::__construct('aspen_tblowner');
    }
	


	function getPartyDetailsCredentials() {
		if(isset( $_POST['party'])) {
			$uid = $_POST['party'];
		}
		$sql =		   
		"Select nPartyName,nPartyId from aspen_tblpartydetails order by nPartyName";
		
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
	

	
		function bill_list($partyname = '')
	{
		$query = $this->db->query("select aspen_tblbilldetails.nBillNo as billno, aspen_tblbilldetails.fTotalWeight as billedweight, aspen_tblpartydetails. nPartyName as partyname,aspen_tblinwardentry.fQuantity as weight,aspen_tblinwardentry.vIRnumber as coilno,aspen_tblinwardentry.billedweight as in_billweight, aspen_tblinwardentry.fpresent as pweight,aspen_tblbilldetails.BillStatus as billstatus,aspen_tblbilldetails. vBillType as billtype, aspen_tblbilldetails.grandtot_words as words, aspen_tblbilldetails.vIRnumber as coilno, aspen_tblbilldetails.dBillDate as billdate, fGrantTotal as grandtotal,aspen_tblbilldetails.vOutLorryNo as lorryno from aspen_tblbilldetails
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.`nPartyId` = aspen_tblbilldetails.`nPartyId`
LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.`vIRnumber` = aspen_tblbilldetails.`vIRnumber` Where aspen_tblpartydetails.nPartyName='".$partyname."' "); 
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

	
	
	function getnsno($billno)
	{
		$query = $this->db->query("SELECT aspen_tblbilldetails.nBillNo AS billno, aspen_tblbillingstatus.nSno
FROM aspen_tblbilldetails
INNER JOIN aspen_tblbillingstatus ON aspen_tblbillingstatus.`vIRnumber` = aspen_tblbilldetails.`vIRnumber`
WHERE aspen_tblbilldetails.nBillNo='".$billno."' "); 
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
	
	
		function delete_bill( $partyname,$billno,$coilno,$billtype,$weight,$nsnumber,$bweight,$pweight,$in_billweight)
	{
	 if( $billtype == 'Cutting')
	{
		$sql = $this->db->query("DELETE FROM aspen_tblbilldetails WHERE nBillNo='".$billno."'");
		$sql12="UPDATE aspen_tblbillingstatus SET vBillingStatus='Ready To Bill' WHERE vIRnumber='".$coilno."' AND nSno IN (".$nsnumber.")";  
		$sql13="UPDATE aspen_tblcuttinginstruction SET vStatus='Ready To Bill' WHERE vIRnumber='".$coilno."' AND nSno IN (".$nsnumber.") ";
		$sql15="UPDATE aspen_tblinwardentry SET vStatus='Ready To Bill' WHERE vIRnumber='".$coilno."' ";
		$sql16="UPDATE aspen_tblinwardentry SET aspen_tblinwardentry.fpresent= '".$pweight."' + '".$bweight."' *1000 where aspen_tblinwardentry.vIRnumber='".$coilno."' ";
		$sql18="UPDATE aspen_hist_tblinwardentry SET vStatus='Ready To Bill' WHERE vIRnumber='".$coilno."' ";
		$sql19="UPDATE aspen_hist_tblinwardentry SET aspen_hist_tblinwardentry.fpresent= '".$pweight."' + '".$bweight."' *1000 where aspen_hist_tblinwardentry.vIRnumber = '".$coilno."' ";
	    $sql20="UPDATE aspen_hist_tblinwardentry SET aspen_hist_tblinwardentry.billedweight= '".$in_billweight."' - (".$bweight." * 1000)  where aspen_hist_tblinwardentry.vIRnumber = '".$coilno."' ";
		$sql21="UPDATE aspen_tblinwardentry SET aspen_tblinwardentry.billedweight= '".$in_billweight."' - (".$bweight." * 1000) where aspen_tblinwardentry.vIRnumber='".$coilno."' ";
		$sql17="UPDATE aspen_tblbillingstatus SET aspen_tblbillingstatus.nActualNo= 0 , aspen_tblbillingstatus.fbilledWeight= 0 where aspen_tblbillingstatus.vIRnumber='".$coilno."'  ";
		$sql144="UPDATE aspen_hist_tblinwardentry SET dBillDate = dReceivedDate  WHERE vIRnumber='".$coilno."'";
		$sql145="UPDATE aspen_tblinwardentry SET dBillDate = dReceivedDate  WHERE vIRnumber='".$coilno."'";
	
		$query = $this->db->query($sql15);
		$query1 = $this->db->query($sql12);
		$query2 = $this->db->query($sql13);
		$query3= $this->db->query($sql16);
		$query4= $this->db->query($sql17);
		$query8= $this->db->query($sql18);
		$query9= $this->db->query($sql19);	
		$query8= $this->db->query($sql20);
		$query9= $this->db->query($sql21);	
			$query44 = $this->db->query($sql144);
		$query45 = $this->db->query($sql145);
	}
	
	
		else if( $billtype == 'Directbilling')
	{
	
		$sql = $this->db->query("DELETE FROM aspen_tblbilldetails WHERE nBillNo='".$billno."'");
		$sql15="UPDATE aspen_tblinwardentry SET vStatus='RECEIVED'  WHERE vIRnumber='".$coilno."'";
		$sql16="UPDATE aspen_tblinwardentry SET fpresent='".$weight."'  WHERE vIRnumber='".$coilno."'";
		$sql17="UPDATE aspen_hist_tblinwardentry SET vStatus='RECEIVED'  WHERE vIRnumber='".$coilno."'";
		$sql18="UPDATE aspen_hist_tblinwardentry SET fpresent='".$weight."'  WHERE vIRnumber='".$coilno."'";
	 
		$sql186="UPDATE aspen_hist_tblinwardentry SET billedweight=(fQuantity - fpresent) WHERE vIRnumber='".$coilno."'";
		$sql187="UPDATE aspen_tblinwardentry SET billedweight=(fQuantity - fpresent ) WHERE vIRnumber='".$coilno."'";
			
		$sql144="UPDATE aspen_hist_tblinwardentry SET dBillDate = dReceivedDate  WHERE vIRnumber='".$coilno."'";
		$sql145="UPDATE aspen_tblinwardentry SET dBillDate = dReceivedDate  WHERE vIRnumber='".$coilno."'";
			
		$query = $this->db->query($sql15);
		$query = $this->db->query($sql16);
		$query = $this->db->query($sql17);
		$query = $this->db->query($sql18);
		$query86 = $this->db->query($sql186);
		$query87 = $this->db->query($sql187);
		$query44 = $this->db->query($sql144);
		$query45 = $this->db->query($sql145);

	}
	
	
		else if( $billtype == 'SemiFinished')
	{
	
		$sql = $this->db->query("DELETE FROM aspen_tblbilldetails WHERE nBillNo='".$billno."'");
		$sql15="UPDATE aspen_tblinwardentry SET vStatus='Work In Progress'  WHERE vIRnumber='".$coilno."'";
		$sql16="UPDATE aspen_tblinwardentry  SET 
		fpresent='".$wei."' WHERE aspen_tblinwardentry.vIRnumber='".$coilno."'";
		
		$sql17="UPDATE aspen_hist_tblinwardentry SET vStatus='Work In Progress'  WHERE vIRnumber='".$coilno."'";
		$sql18="UPDATE aspen_hist_tblinwardentry  SET 
		fpresent='".$wei."' WHERE aspen_hist_tblinwardentry.vIRnumber='".$coilno."'";
		
		$query = $this->db->query($sql15);
		$query = $this->db->query($sql16);
		$query = $this->db->query($sql17);
		$query = $this->db->query($sql18);
	
	
	}
	
	
	}
	
}

class billdescriptions_model extends Base_module_model {	
 	
}