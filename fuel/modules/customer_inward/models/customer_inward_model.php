<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
 
class customer_inward_model extends Base_module_model {
	
 	public $required = array('dReceivedDate','vIRnumber','vDescription','fThickness','fWidth','nTotalWeight');
	protected $key_field = 'dReceivedDate';
	
    function __construct()
    {
        parent::__construct('aspen_hist_tblinwardentry');
    }
		
	function form_fields($values = array())
	{
	    $fields = parent::form_fields($values);
		$this->form_builder->set_fields($fields);
	    return $fields;
	}

	
	
	
	function export_partyname($partyname='',$frmdate='',$todate='') {	
		$sql ="select aspen_tblpartydetails.nPartyName as partyname, aspen_tblmatdescription.vDescription as description, vIRnumber as coilnumber, 	DATE_FORMAT(dReceivedDate, '%d-%m-%Y')  as receiveddate,  fWidth as width,  fThickness as thickness,  fQuantity as weight, vStatus as status from aspen_hist_tblinwardentry
  LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_hist_tblinwardentry.nMatId 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_hist_tblinwardentry.nPartyId 
		where
    aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_hist_tblinwardentry.dReceivedDate BETWEEN '".$frmdate."' AND '".$todate."' order by aspen_hist_tblinwardentry.vIRnumber asc";
		
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
	
	
	
	
	
	function billgeneratemodel($partyname='',$frmdate='',$todate='') {
	$sqlrpt = "select aspen_tblpartydetails.nPartyName as partyname, aspen_tblmatdescription.vDescription as materialdescription, vIRnumber as Coilnumber, 	DATE_FORMAT(dReceivedDate, '%d-%m-%Y')  as receiveddate,  fWidth as Width,  fThickness as Thickness,  fQuantity as Weight, vStatus as Status from aspen_hist_tblinwardentry
  LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_hist_tblinwardentry.nMatId 
		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_hist_tblinwardentry.nPartyId 
		where
    aspen_tblpartydetails.nPartyName='".$partyname."' and aspen_hist_tblinwardentry.dReceivedDate BETWEEN '".$frmdate."' AND '".$todate."' order by aspen_hist_tblinwardentry.vIRnumber asc";
		
//	echo $sqlrpt; die();
		
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
					<div align="center"><h2>CUSTOMERS MATERIAL INWARD REPORT
BETWEEN DATES
</h2></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td><b>Party Name: </b> '.$partyname.'</td>
				<td><b>From Date: </b> '.$frmdate.'</td>
				<td><b>To Date: </b> '.$todate.'</td>
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
			
				<th align="center"><b>Coil Number</b></th>
				<th align="center"><b>Inward Date</b></th>
				<th align="center"><b>Material Description</b></th>
				<th align="center"><b>Thickness (mm)</b></th>
				<th align="center"><b>Width (mm)</b></th>
				<th align="center"><b>Weight (Kgs)</b></th>
				<th align="center"><b>Status</b></th>
			</tr>';
			
		if ($querymain->num_rows() > 0)
		{
			foreach($querymain->result() as $rowitem)
			{
		$html .= '
			<tr>
			
				<td align="center">'.$rowitem->Coilnumber.'</td>
				<td align="center">'.$rowitem->receiveddate.'</td>
				<td align="center" >'.$rowitem->materialdescription.'</td>
				<td align="right">'.$rowitem->Thickness.'</td>
				<td align="right">'.$rowitem->Width.'</td>
				<td align="right">'.$rowitem->Weight.'</td>
				<td align="right">'.$rowitem->Status.'</td>
			</tr>';
			}
		}else{
		$html .= '
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
				<td align="center">&nbsp;</td>
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
	
	
	
	
	
	
	function totalweight_check($partyname='',$frmdate='',$todate=''){
	$sql=  "SELECT SUM( fQuantity ) as weight FROM aspen_hist_tblinwardentry LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_hist_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."' and aspen_hist_tblinwardentry.dReceivedDate BETWEEN '".$frmdate."' AND '".$todate."'";
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
		$sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, aspen_tblmatdescription.vDescription as description, aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber WHERE aspen_tblpartydetails.nPartyName='".$partyname."' group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";
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
class customerinward_model extends Base_module_record {
	
}