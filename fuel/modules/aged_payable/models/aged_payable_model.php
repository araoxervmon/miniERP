<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
 
class aged_payable_model extends Base_module_model {
	
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
	$sqlrpt ="select fuel_suppliers.name as Vendor, fuel_suppliers.phone as phone,fuel_suppliers.supplier_id as vendorid,fuel_inventory_lists.creation_date as postdate,fuel_inventory_lists.item_sku as sku, 
case 
when DATEDIFF('".$todate."', fuel_inventory_lists.creation_date)> 90  then fuel_inventory_lists.item_cost*fuel_inventory_lists.quantity_on_hand else 0 end as 'more90',
case when DATEDIFF('".$todate."', fuel_inventory_lists.creation_date)between 31 and 60 then fuel_inventory_lists.item_cost*fuel_inventory_lists.quantity_on_hand else 0 end as 'between31',
case when DATEDIFF('".$todate."', fuel_inventory_lists.creation_date)between 0 and 31 then fuel_inventory_lists.item_cost*fuel_inventory_lists.quantity_on_hand else 0 end as 'between0'  from fuel_suppliers LEFT JOIN fuel_inventory_lists  ON fuel_inventory_lists.supplier_id=fuel_suppliers.supplier_id  where creation_date BETWEEN '".$frmdate."' AND '".$todate."' and  fuel_suppliers.name ='".$partyname."' ";
		
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
					<div align="center"><h2>S L J  ESSENCE MART</h2><h3>Aged Payables</h3><h3>Report Generated till '.$todate.'</h3></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td><b>Vendor Name: </b> '.$partyname.'</td>
				<td><b>From Date: </b> '.$frmdate.'</td>
				<td><b>To Date: </b> '.$todate.'</td>
			</tr>
			<tr>
				<td align="left">Report Filters:Sorted by: Post Date</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
		
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>Vendor</b></th>
				<th align="center"><b>Telephone Contact</b></th>
				<th align="center"><b>Vendor ID</b></th>
				<th align="center"><b>Post Date</b></th>
				<th align="center"><b>SKU</b></th>
				<th align="center"><b>From 0-30Days</b></th>
				<th align="center"><b>From 31-60Days</b></th>
				<th align="center"><b>Over 90Days</b></th>
			</tr>';
			
		if ($querymain->num_rows() > 0)
		{
			foreach($querymain->result() as $rowitem)
			{
		$html .= '
			<tr>
				<td align="center">'.$rowitem->Vendor.'</td>
				<td align="center">'.$rowitem->phone.'</td>
				<td align="center" >'.$rowitem->vendorid.'</td>
				<td align="right">'.$rowitem->postdate.'</td>
				<td align="right">'.$rowitem->sku.'</td>
				<td align="right">'.$rowitem->more90.'</td>
				<td align="right">'.$rowitem->between31.'</td>
				<td align="right">'.$rowitem->between0.'</td>
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
		"Select name from fuel_suppliers";
		
		
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
	
	function print_partywisemodel($partyid='',$partyname = '') {
		$sqlcutting = "select  item_sku as sku, quantity_on_hand as qty,description as description,item_cost as unitcost,(item_cost*quantity_on_hand) as totalvalue ,item_id as invoiceid from fuel_inventory_lists   where item_sku ='".$partyname."'";
		$querycutting = $this->db->query($sqlcutting);
		
	/*	$sqlitem ="select  aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblmatdescription.vDescription as materialdescription,vInvoiceNo as Invoicenumber,fWidth as Width,fThickness as Thickness,fQuantity as Weight from aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName ='".$partyname."'";
		$queryitem = $this->db->query($sqlitem);
		*/
		$invoice = 'bill_'.$partyid;
		//$partyname = $querymain->row(0)->partyname;
		//$address1 = $querymain->row(0)->address1;
		//$address2 = $querymain->row(0)->address2;
		//$city = $querymain->row(0)->city;
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'Partyslip'.$partyid.'.pdf';
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
					<div align="center"><h1>S L J  ESSENCE MART</h1>
					<h2>Inventory Valuation</h2></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td><b>SKU: </b> '.$partyname.'</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
		
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>SKU</b></th>
				<th align="center"><b>QTY</b></th>
				<th align="center"><b>Description</b></th>
				<th align="center"><b>UnitCost</b></th>
				<th align="center"><b>TotalValue</b></th>
				<th align="center"><b>InvoiceID</b></th>
			</tr>';
			
		if ($querycutting->num_rows() > 0)
		{
			foreach($querycutting->result() as $rowitem)
			{
		$html .= '
			<tr>
				<td align="center">'.$rowitem->sku.'</td>
				<td align="center">'.$rowitem->qty.'</td>
				<td align="center" >'.$rowitem->description.'</td>
				<td align="right">'.$rowitem->unitcost.'</td>
				<td align="right">'.$rowitem->totalvalue.'</td>
				<td align="right">'.$rowitem->invoiceid.'</td>
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
		$sql ="select  fuel_inventory_lists.item_name as name,fuel_inventory_lists.description as description,fuel_inventory_lists.brand_name as brandname,fuel_inventory_lists.quantity_on_hand as quantityonhand, fuel_inventory_lists.creation_date as inwarddate from fuel_inventory_lists  left join fuel_suppliers on fuel_suppliers.supplier_id=fuel_inventory_lists.supplier_id ";
   		if(!empty($partyname)) { 
		$sql .=" WHERE name ='".$partyname."' ";
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
class inventoryvaluation_model extends Base_module_record {
	
}