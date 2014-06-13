<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
 
class total_average_model extends Base_module_model {
	
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

	
	function billgeneratemodel($frmdate='',$todate='') {
	$sqlrpt = "Select SUM( aspen_tblbilldetails.fGrantTotal ) AS total, aspen_tblpartydetails.nPartyName AS PartyName
FROM aspen_tblbilldetails
LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId
where aspen_tblbilldetails.dBillDate BETWEEN '".$frmdate."' AND '".$todate."' 
GROUP BY aspen_tblpartydetails.nPartyName order by aspen_tblpartydetails.nPartyName asc";
	
		//echo $sqlrpt; die();
		
		$querymain = $this->db->query($sqlrpt);

						
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'Total_Party_Holding_Report';
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
					<div align="center"><h1>TOTAL PARTY HOLDING REPORT </h1></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				
			<td align="center"><h2>From Date:'.$frmdate.'</h2></td>
				<td align="center"><h2>To Date:'.$todate.'</h2></td>
			</tr>
			<tr>
				
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><h2>Partyname</h2></th>
				<th align="center"><h2>Total Billed Amount</h2></th>
			</tr>';
			
			
		if ($querymain->num_rows() > 0)
		{
			foreach($querymain->result() as $rowitem)
			{
		$html .= '
			<tr>
				<td align="center"><h3>'.$rowitem->PartyName.'</h3></td>
				<td align="center"><h3>'.$rowitem->total.'</h3></td>
			</tr>';
			}
		}else{
		$html .= '
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
			</tr>';
		}
		$html .= '
			
		</table>';	
		
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	}
	
	
	
	
	function export_partyname($frmdate='' , $todate='') {	
		$sql ="Select SUM( aspen_tblbilldetails.fGrantTotal ) AS total, aspen_tblpartydetails.nPartyName AS partyname
FROM aspen_tblbilldetails
LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblbilldetails.nPartyId
where aspen_tblbilldetails.dBillDate BETWEEN '".$frmdate."' AND '".$todate."' 
GROUP BY aspen_tblpartydetails.nPartyName order by aspen_tblpartydetails.nPartyName asc";
		
		$query = $this->db->query($sql);
		
		//echo $sql;
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
	
	
	function list_partyname($partyname = '') {	
		$sql ="SELECT DATE_FORMAT(aspen_tblbilldetails.dBillDate , '%d-%m-%Y') as billdate, DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, 
		DATEDIFF(aspen_tblbilldetails.dBillDate , aspen_tblinwardentry.dReceivedDate) as days ,
		aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vIRnumber as coilnumber, 
		( SELECT (days * weight) / (SELECT sum( fQuantity ) FROM aspen_tblinwardentry )) AS avgwei
		FROM aspen_tblinwardentry 
		LEFT JOIN aspen_tblbilldetails ON aspen_tblbilldetails.vIRnumber = aspen_tblinwardentry.vIRnumber 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId WHERE aspen_tblpartydetails.nPartyName = '".$partyname."' group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc " ;
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
class totalaverage_model extends Base_module_record {
	
}