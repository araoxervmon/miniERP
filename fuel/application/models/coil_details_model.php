<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
 
class Coil_details_model extends Base_module_model {
	
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


	function totalweight_check($partyname = ''){
	$sql=  "SELECT SUM( fpresent ) as weight FROM aspen_tblinwardentry LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName = '".$partyname."'";
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
		$sqlcutting = "select  nPartyName as partyname,vAddress1 as address1,vAddress2 as address2,vCity as city from aspen_tblpartydetails  where nPartyName ='".$partyname."' ";
		$querymain = $this->db->query($sqlcutting);
		
		$sqlitem ="select  aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblmatdescription.vDescription as materialdescription,vInvoiceNo as Invoicenumber,fWidth as Width,fThickness as Thickness,fQuantity as Weight from aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription  ON aspen_tblmatdescription.nMatId=aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails .nPartyId=aspen_tblinwardentry.nPartyId where aspen_tblpartydetails.nPartyName ='".$partyname."'";
		$queryitem = $this->db->query($sqlitem);
		
		$invoice = 'bill_'.$partyid;
		$partyname = $querymain->row(0)->partyname;
		$address1 = $querymain->row(0)->address1;
		$address2 = $querymain->row(0)->address2;
		$city = $querymain->row(0)->city;
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'Partyslip'.$partyid.'.pdf';
		$pdf->SetAuthor('Abhilash');
		$pdf->SetTitle('Partyslip');
		$pdf->SetSubject('Partyslip');
		$pdf->SetKeywords('Aspen, ERP, Partyslip');
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
				
				<div align="center">
					<h1>ASPEN STEEL (PVT) LTD</h1>
		<h3>Decoilers of:GP,CP,HRPO,HR Coils. Coil upto 20mm thick</h3>
		 <h4>54, MEDAHALLI, OLD MADRAS ROAD, Bangalore - 560049, Karnataka, India</h4>	
				</div>
				&nbsp;
				&nbsp;
				&nbsp;
		<table align="center"  cellspacing="0" cellpadding="3" border="0" >
		
			<tr>
				<td align="left">
					<b>Party Name:</b> '.$partyname.'
				</td>
			</tr>
			<tr>
				<td align="left">
					<b>Address One: </b> '.$address1.'</td>
				</tr>
			<tr>
				<td align="left">
					<b>Address Two: </b> '.$address2.'</td>
				</tr>	
			<tr>
				<td align="left">
					<b>City: </b> '.$city.'</td>
				</tr>				
				
		</table>';
		
				$html .= '
				<table cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td>&nbsp;</td> 
			</tr>
		</table>';
		
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><b>Coil number</b></th>
				<th align="center"><b>Material Description</b></th>
				<th align="center"><b>Invoice Number</b></th>
				<th align="center"><b>Width (in mm)</b></th>
				<th align="center"><b>Thickness (in mm)</b></th>
				<th align="center"><b>Weight (in Kgs)</b></th>
			</tr>';
		if ($queryitem->num_rows() > 0)
		{
			foreach($queryitem->result() as $rowitem)
			{
		$html .= '
			<tr>
				<td align="center">'.$rowitem->coilnumber.'</td>
				<td align="center" >'.$rowitem->materialdescription.'</td>
				<td align="center">'.$rowitem->Invoicenumber.'</td>
				<td align="center">'.$rowitem->Width.'</td>
				<td align="center">'.$rowitem->Thickness.'</td>
				<td align="center">'.$rowitem->Weight.'</td>
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
			</tr>';
		}
		$html .= '
			
		</table>';	
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0">
			<tr>
				<td align="left">&nbsp;</td>
				<td align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center">ASPEN BANGALORE</td>
			</tr>
		</table>';

		
		
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	
	}
	function list_items($limit = NULL, $offset = NULL, $col = 'vIRnumber', $order = 'asc')
    {
		$this->db->select('aspen_tblinwardentry.vIRnumber,aspen_tblinwardentry.dReceivedDate, aspen_tblmatdescription.vDescription, aspen_tblinwardentry.fThickness, aspen_tblinwardentry.fWidth, aspen_tblinwardentry.fQuantity, aspen_tblinwardentry.vStatus');
		$this->db->join('aspen_tblmatdescription', 'aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId', 'left');
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;    	
	}
	
	function list_childitems($parentid){
	$sqlpcheck= "Select vprocess from aspen_tblinwardentry where vIRnumber='".$parentid."'";
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
		$sqlci="SELECT DATE_FORMAT(aspen_tblcuttinginstruction.dDate, '%d-%m-%Y') as processdate, aspen_tblcuttinginstruction.nLength as length, aspen_tblcuttinginstruction.nSno as bundlenumber, aspen_tblcuttinginstruction.nNoOfPieces as bundles, aspen_tblcuttinginstruction.nBundleweight as weight, aspen_tblcuttinginstruction.vStatus as status,aspen_tblinwardentry.vprocess as process
		FROM aspen_tblcuttinginstruction LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblcuttinginstruction.vIRnumber WHERE aspen_tblcuttinginstruction.vIRnumber = '".$parentid."' order by aspen_tblcuttinginstruction.nSno";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess =='Recoiling'){
		$sqlci="select aspen_tblrecoiling.nSno as recoilnumber,DATE_FORMAT(aspen_tblrecoiling.dStartDate, '%d-%m-%Y') as startdate,DATE_FORMAT(aspen_tblrecoiling.dEndDate, '%d-%m-%Y') as enddate,aspen_tblrecoiling.nNoOfRecoils as norecoil,aspen_tblrecoiling.vStatus as status,aspen_tblinwardentry.vprocess as process from aspen_tblrecoiling  
		  LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblrecoiling.vIRnumber WHERE aspen_tblrecoiling.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess =='Slitting'){
			$sqlci="select aspen_tblslittinginstruction.nSno as slittnumber,DATE_FORMAT(aspen_tblslittinginstruction.dDate, '%d-%m-%Y') as date,aspen_tblslittinginstruction.nWidth as width, aspen_tblslittinginstruction.vStatus as status, aspen_tblinwardentry.vprocess as process from aspen_tblslittinginstruction  
			LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblslittinginstruction.vIRnumber WHERE aspen_tblslittinginstruction.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess ==''){
		$sqlci=" SELECT case when vprocess  = '' then 'NULL' else vprocess  end as process from aspen_tblinwardentry WHERE aspen_tblinwardentry.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
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
	
	function listindividualChilds($parentid){
	$sqlpcheck= "Select vprocess from aspen_tblinwardentry where vIRnumber='".$parentid."'";
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
		$sqlci="SELECT DATE_FORMAT(aspen_tblcuttinginstruction.dDate, '%d-%m-%Y') as processdate, aspen_tblcuttinginstruction.nLength as length, aspen_tblcuttinginstruction.nSno as bundlenumber, aspen_tblcuttinginstruction.nNoOfPieces as bundles, aspen_tblcuttinginstruction.nBundleweight as weight, aspen_tblcuttinginstruction.vStatus as status,aspen_tblinwardentry.vprocess as process
		FROM aspen_tblcuttinginstruction LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblcuttinginstruction.vIRnumber WHERE aspen_tblcuttinginstruction.vIRnumber = '".$parentid."' order by aspen_tblcuttinginstruction.nSno";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess =='Recoiling'){
		$sqlci="select aspen_tblrecoiling.nSno as recoilnumber,DATE_FORMAT(aspen_tblrecoiling.dStartDate, '%d-%m-%Y') as startdate,DATE_FORMAT(aspen_tblrecoiling.dEndDate, '%d-%m-%Y') as enddate,aspen_tblrecoiling.nNoOfRecoils as norecoil,aspen_tblrecoiling.vStatus as status,aspen_tblinwardentry.vprocess as process from aspen_tblrecoiling  
		  LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblrecoiling.vIRnumber WHERE aspen_tblrecoiling.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess =='Slitting'){
			$sqlci="select aspen_tblslittinginstruction.nSno as slittnumber,DATE_FORMAT(aspen_tblslittinginstruction.dDate, '%d-%m-%Y') as date,aspen_tblslittinginstruction.nWidth as width, aspen_tblslittinginstruction.vStatus as status, aspen_tblinwardentry.vprocess as process from aspen_tblslittinginstruction  
			LEFT JOIN aspen_tblinwardentry ON aspen_tblinwardentry.vIRnumber = aspen_tblslittinginstruction.vIRnumber WHERE aspen_tblslittinginstruction.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
		else if($row->vprocess ==''){
		$sqlci=" SELECT case when vprocess  = '' then 'NULL' else vprocess  end as process from aspen_tblinwardentry WHERE aspen_tblinwardentry.vIRnumber='".$parentid."'";
		$query = $this->db->query($sqlci);
		}
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
	
	function list_partyname($partyname = '') {	
		$sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, aspen_tblmatdescription.vDescription as description, aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight,aspen_tblinwardentry.fpresent as pweight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber 
		LEFT JOIN aspen_tblslittinginstruction ON aspen_tblslittinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber 
		LEFT JOIN aspen_tblrecoiling ON aspen_tblrecoiling.vIRnumber = aspen_tblinwardentry.vIRnumber"; 
   		if(!empty($partyname)) { 
		$sql .=" Where aspen_tblpartydetails.nPartyName='".$partyname."' AND aspen_tblinwardentry.fpresent >= 5";
		}
		$sql .="  group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";
		//echo $sql;die();
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
	
	function list_individualparty($partyname = '') {	
		$sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, aspen_tblmatdescription.vDescription as description, aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight,aspen_tblinwardentry.fpresent as pweight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber ";
   		if(!empty($partyname)) { 
		$sql .=" Where aspen_tblpartydetails.nPartyName='".$partyname."' AND aspen_tblinwardentry.fpresent >= 5";
		}
		$sql .="  group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";
		//echo $sql;
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
	
	function delete_coilnumber($coil='') {
		$sql ="DELETE FROM aspen_tblinwardentry WHERE vIRnumber ='".$coil."'";
		$query = $this->db->query($sql);
	}
	
	function getcoildetails() {
		
		$this->save($save);
	}
   
}
class Coildetails_model extends Base_module_record {
	
}