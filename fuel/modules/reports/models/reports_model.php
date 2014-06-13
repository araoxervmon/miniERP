<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(MODULES_PATH.'/reports/config/reports_constants.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');

class reports_model extends Base_module_model {
		
    function __construct()
    {
        parent::__construct('aspen_tblinwardentry');// table name
    }
	
	function form_fields($values = array())
	{
		$fields = parent::form_fields();
		$CI =& get_instance();
	    $CI->load->module_model(WORKIN_PROGRESS_FOLDER, 'workin_to_permissions_model');
		$CI->load->module_model(WORKIN_PROGRESS_FOLDER, 'workin_to_users_model');
		$CI->load->module_model(WORKIN_PROGRESS_FOLDER, 'workin_to_cutting_model');
		$fields['vIRnumber']['label'] = 'Coil Number';
		$fields['nPartyId']['label'] = "Parties";
		$fields['nMatId']['label'] = "Material Description";
		
		$workin_to_permissions_model_options = $CI->workin_to_permissions_model->options_list('nPartyId', 'nPartyName');
		$workin_to_users_model_options = $CI->workin_to_users_model->options_list('nMatId', 'vDescription');

	    $workin_to_description_model_options = $CI->workin_to_cutting_model->options_list('nMatId', 'vDescription');
	
		return $fields;
	}
	
	function editCoilDetails() {
		$query = $this->db->query("select * from aspen_tblinwardentry order by col name  limit 0,1"); 
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
	
	function example() {
		return true;
	}
	
	function altermodel()
	{
		if(isset($pid) && isset($pname)) {
			$partyname = $pname;
			$partyid = $pid;
		}
		$query = $this->db->query("UPDATE aspen_tblinwardentry.dReceivedDate ,aspen_tblcuttinginstruction.dDate ,aspen_tblrecoiling.dStartDate ,aspen_tblinwardentry.vIRnumber ,aspen_tblpartydetails.nPartyName ,aspen_tblmatdescription.vDescription ,aspen_tblinwardentry.fThickness ,aspen_tblinwardentry.fWidth ,aspen_tblinwardentry.fQuantity LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblcuttinginstruction  ON aspen_tblcuttinginstruction.vIRnumber=aspen_tblinwardentry.vIRnumber LEFT JOIN aspen_tblrecoiling  ON aspen_tblrecoiling .vIRnumber=aspen_tblinwardentry.vIRnumber LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId SET t1.new_column = t3.column;");
	}
	
	function toolbar_list()
	{
		$query = $this->db->query("select DISTINCT nBillNo as billno,dBillDate as billdate,vIRnumber as coilnumber,fTotalWeight as totalweight,fWeightAmount as weightamount,fServiceTax	as servicetax,fEduTax as edutax,fSHEduTax as sedutax,fGrantTotal as granttotal from aspen_tblbilldetails"); 
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


function workweight_model() {
	$sqlbw = "select sum(fQuantity) as totalweight from aspen_tblinwardentry LEFT JOIN aspen_tblcuttinginstruction on aspen_tblcuttinginstruction .vIRnumber = aspen_tblinwardentry.vIRnumber WHERE aspen_tblinwardentry.vIRnumber = aspen_tblcuttinginstruction.vIRnumber and aspen_tblcuttinginstruction.vStatus='WIP-Cutting'";
	$query = $this->db->query($sqlbw);
	if ($query->num_rows() > 0)
    {
    foreach ($query->result() as $rowbw)
    {
    $bweight =$rowbw->totalweight;
    }
    }
	return $bweight;
  }	
  
  function generate_cuttingslip_model() {
	$sqlcs = "select aspen_tblpartydetails.nPartyName as partyname,aspen_tblmatdescription.vDescription as materialdescription,vInvoiceNo as Invoicenumber,fWidth as Width,fThickness as Thickness,fQuantity as Weight from aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId where aspen_tblinwardentry.vIRnumber='".$_POST['coilnumber']."'";
	$query = $this->db->query($sqlcs);
	if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      $arr[] =$row;
		   }
		} 
		return $arr;
	}
	
	function cutting_slipmodel($partyid='',$partyname = '') {
		$sqlcutting = "select aspen_tblpartydetails.nPartyName as partyname,aspen_tblmatdescription.vDescription as materialdescription,vInvoiceNo as Invoicenumber,fWidth as Width,fThickness as Thickness,fQuantity as Weight from aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId where aspen_tblinwardentry.vIRnumber ='".$partyid."' and aspen_tblpartydetails.nPartyName ='".$partyname."' ";
		$querymain = $this->db->query($sqlcutting);
		
		$invoice = 'bill_'.$partyid;
		$party_name = $querymain->row(0)->partyname;
		$material_descriptio = $querymain->row(0)->materialdescription;
		$Invoice_number = $querymain->row(0)->Invoicenumber;
		$Width = $querymain->row(0)->Width;
		$Thickness = $querymain->row(0)->Thickness;
		$Weight = $querymain->row(0)->Weight;
				
		/* Bill Items */
	/*	$sqlitem = "select sno, qty, item_name, item_price, item_discount, price from fuel_journal_item WHERE ref_id ='".$bid."' order by sno asc";
		$queryitem = $this->db->query($sqlitem);*/
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'cuttingslip_'.$partyid.'.pdf';
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
		$pdf->SetFont('helvetica', '', 10);
		$pdf->AddPage();		
		
		$html = '
		<table cellspacing="0" cellpadding="1" border="1">
			<tr>
				<td align="center">
					<b>Bill Number: '.$invoice.'</b>
				</td>
			</tr>
			<tr>
				<td align="left">
					<b>Party Name: </b> '.$party_name.'</td>
				</tr>			
			<tr>
				<td align="left">
					<b>Material Description: </b> '.$material_descriptio.'</td>
				</tr>
				<tr>
				<td align="left">
					<b>Invoice Number: </b> '.$Invoice_number.'</td>
				</tr>
				<tr>
				<td align="left">
					<b>Width: </b> '.$Width.'</td>
				</tr>
				<tr>
				<td align="left">
					<b>Thickness: </b> '.$Thickness.'</td>
				</tr>
				<tr>
				<td align="left">
					<b>Weight: </b> '.$Weight.'</td>
				</tr>
		</table>';
		
		
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	}


  
}	
class reportsmodel extends Base_module_record {
 
}
