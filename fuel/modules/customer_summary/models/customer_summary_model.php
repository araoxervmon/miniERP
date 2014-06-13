<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
 
class customer_summary_model extends Base_module_model {
	
 	public $required = array('dReceivedDate','vIRnumber','vDescription','fThickness','fWidth','nTotalWeight');
	protected $key_field = 'dReceivedDate';
	
    function __construct()
    {
        parent::__construct('aspen_tblinwardentry');
    }
		
	function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$this->form_builder->set_fields($fields);
	    return $fields;
	}

	
	function billgeneratemodel($partyname='',$frmdate='',$todate='') {
	$sqlrpt = "SELECT aspen_tblpartydetails.nPartyName as partyname,
		aspen_tblbilldetails.fServiceTax as tax, 
		  aspen_tblbilldetails.fGrantTotal as gtot, 
		aspen_tblbilldetails.ntotalamount as basic 
		FROM aspen_tblbilldetails
		LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblbilldetails.vIRnumber 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId
   		where
    aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_tblbilldetails.dBillDate BETWEEN '".$frmdate."' AND '".$todate."' order by aspen_tblpartydetails.nPartyName asc";
	
	$sql1=  "SELECT SUM(ntotalamount) as basic FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
	
	$sql2=  "SELECT SUM(fServiceTax  ) as tax FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
	
	$sql3=  "SELECT SUM( fQuantity ) as weight FROM aspen_tblinwardentry LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
	
	$sql4=  "SELECT SUM(fGrantTotal ) as bill FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
	
	
		$querymain = $this->db->query($sqlrpt);		
$querymain1 = $this->db->query($sql1);	
$querymain2 = $this->db->query($sql2);	
$querymain3 = $this->db->query($sql3);	
$querymain4 = $this->db->query($sql4);			
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'cust_'.$partyname.'.pdf';
		$resolution= array(72, 150);
		$pdf->SetAuthor('ASPEN');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');
		$pdf->SetKeywords('Aspen, bill, invoice');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('helvetica', '', 7);
		$pdf->AddPage();
		
		$html = '
					<div align="center"><h2>CUSTOMERWISE BILLING SUMMARY REPORT
BETWEEN DATES
 </h2></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td width="33.33%"><b>Party Name: </b> '.$partyname.'</td>
				<td width="33.33%"><b>From Date: </b> '.$frmdate.'</td>
				<td width="33.33%"><b>To Date: </b> '.$todate.'</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
		
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>Party Name</b></th>
				<th align="center"><b>Basic Amount</b></th>
				<th align="center"><b>Tax</b></th>
				<th align="center"><b>Total Bill Amount</b></th>
			</tr>';
			
		if ($querymain->num_rows() > 0)
		{
			foreach($querymain->result() as $rowitem)
			{
			
		$html .= '
			<tr>
				<td align="center">'.$rowitem->partyname.'</td>
				<td align="center">'.$rowitem->basic.'</td>
				<td align="center" >'.$rowitem->tax.'</td>
				<td align="right">'.$rowitem->gtot.'</td>
			</tr>';
			}
		}
	
		else{
		$html .= '
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
				<td align="center">&nbsp;</td>
			</tr>';
		}
		
		
		$html .= '
			
		</table>';
		
		
		
			$html .= '
					
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
			
		
			</tr>
		</table>';
		
		
	$html .= '
				<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>Total Basic Amount</b></th>
				<th align="center"><b>Total Tax</b></th>
				<th align="center"><b>Total Bill Amount</b></th>
			</tr>';
			
		if ($querymain1->num_rows() > 0)
		{
			foreach($querymain1->result() as $rowitem)
			{
			
		$html .= '
			<tr>
				<td align="center">'.$rowitem->basic.'</td>';
			}
		}
		if ($querymain2->num_rows() > 0)
		{
			foreach($querymain2->result() as $rowitem)
			{
			
		$html .= '
			
				<td align="center">'.$rowitem->tax.'</td>';
			}
		}
		if ($querymain4->num_rows() > 0)
		{
			foreach($querymain4->result() as $rowitem)
			{
			
		$html .= '
		
				<td align="center">'.$rowitem->bill.'</td></tr>';
			}
		}
		$html .= '
			
		</table>';
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	}
	
	
	
	
	function totalbasic_check($partyname = ''){
	$sql=  "SELECT SUM(ntotalamount) as basic FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
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

function totaltax_check($partyname = ''){
	$sql=  "SELECT SUM(fServiceTax  ) as tax FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
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
	
	function totalweight_check($partyname = ''){
	$sql=  "SELECT SUM( fQuantity ) as weight FROM aspen_tblinwardentry LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
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
	
	function totalbill_check($partyname = ''){
	$sql=  "SELECT SUM(fGrantTotal ) as bill FROM aspen_tblbilldetails LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
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
	
	function getPartyDetailsCredentials() {
		if(isset( $_POST['party'])) {
			$uid = $_POST['party'];
		}
		$sql =		   
		"Select nPartyName,nPartyId from aspen_tblpartydetails";
		
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
	
	function print_partywisemodel($billno='',$partyname = '') {
	$sqlrpt = "SELECT aspen_tblpartydetails.nPartyName as Partyname,aspen_tblbilldetails.fServiceTax as Tax, 
				aspen_tblinwardentry.vIRnumber as coilnumber,  aspen_tblbilldetails.fGrantTotal as grandtotal, 
		aspen_tblbilldetails.ntotalamount as tot FROM aspen_tblbilldetails
		LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblbilldetails.vIRnumber 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId
   		WHERE aspen_tblpartydetails.nPartyName='".$partyname."'";
		$querymain = $this->db->query($sqlrpt);			
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'inwardslip_'.$partyname.'.pdf';
		$resolution= array(72, 150);
		$pdf->SetAuthor('ASPEN');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');
		$pdf->SetKeywords('Aspen, bill, invoice');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('helvetica', '', 7);
		$pdf->AddPage();
		
		$html = '
					<div align="center"><h2>CUSTOMERS BILLING STATEMENT</h2></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td width="33.33%"><b>Party Name: </b> '.$partyname.'</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
			
		
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>Bill Date</b></th>
				<th align="center"><b>Bill Number</b></th>
				<th align="center"><b>Coil Number</b></th>
				<th align="center"><b>Type of Material</b></th>
				<th align="center"><b>Weight in (Tonnes)</b></th>
				<th align="center"><b>Basic Amount</b></th>
				<th align="center"><b>Tax</b></th>
				<th align="center"><b>Total Bill Amount</b></th>
			</tr>';
			
		if ($querymain->num_rows() > 0)
		{
			foreach($querymain->result() as $rowitem)
			{
			
		$html .= '
			<tr>
				<td align="center">'.$rowitem->billdate.'</td>
				<td align="center">'.$rowitem->billno.'</td>
				<td align="center" >'.$rowitem->coilnumber.'</td>
				<td align="right">'.$rowitem->description.'</td>
				<td align="right">'.$rowitem->weight.'</td>
				<td align="right">'.$rowitem->totalamt.'</td>
				<td align="right">'.$rowitem->tax.'</td>
				<td align="right">'.$rowitem->totalbillamount.'</td>
			</tr>';
			}
		}else{
		$html .= '
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="right">&nbsp;</td>
			</tr>';
		}
		$html .= '
			
		</table>';	
		
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	}
	
	
	function list_partyname($partyname = '') {	
		$sql ="SELECT aspen_tblpartydetails.nPartyName as partyname,
		aspen_tblbilldetails.fServiceTax as tax, 
		  aspen_tblbilldetails.fGrantTotal as gtot, 
		aspen_tblbilldetails.ntotalamount as basic 
		FROM aspen_tblbilldetails
		LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblbilldetails.vIRnumber 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId";
   		if(!empty($partyname)) { 
		$sql .=" WHERE aspen_tblpartydetails.nPartyName='".$partyname."'";
		}
		//$sql .=" group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";
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
	
	function list_coilitems() {	
		if(isset( $_REQUEST['party'])) {
			$partyname = $_POST['party'];
		}
		$sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, aspen_tblmatdescription.vDescription as description, aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";
   		if(!empty($partyname)) { 
			$sql.=" WHERE aspen_tblpartydetails.nPartyName='".$partyname."'";
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
}
class customer_summarymodel extends Base_module_record {
	
}