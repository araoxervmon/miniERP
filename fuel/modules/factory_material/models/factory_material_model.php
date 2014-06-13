<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');

class factory_material_model extends Base_module_model {

	function __construct()
    {
        parent::__construct('aspen_tblmatdescription');
    }
	

  function select_coilname() {
   $query = $this->db->query("select * from aspen_tblmatdescription order by vDescription "); 
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

  

  
  
  	
		function export_partyname($frmdate='',$todate='') {	
		$sql ="SELECT aspen_tblmatdescription.vDescription as description , SUM( aspen_tblinwardentry.fQuantity ) as inweight, SUM( aspen_tblinwardentry.fpresent ) as outweight
FROM  `aspen_tblinwardentry` 
LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId WHERE  fpresent >= 1 and aspen_tblinwardentry.dReceivedDate BETWEEN '".$frmdate."' AND '".$todate."'
GROUP BY vDescription";
		
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
	
	
	
  
		  function billgeneratemodel($frmdate='',$todate='') {
	$sqlrpt = "SELECT aspen_tblmatdescription.vDescription as description , SUM( aspen_tblinwardentry.fQuantity ) as inweight, SUM( aspen_tblinwardentry.fpresent ) as outweight
FROM  `aspen_tblinwardentry` 
LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId WHERE  fpresent >= 1 and aspen_tblinwardentry.dReceivedDate BETWEEN '".$frmdate."' AND '".$todate."'
GROUP BY vDescription";


	
		$querymain = $this->db->query($sqlrpt);

		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdfname= 'factoryMovement.pdf';
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
					<div align="center"><h1>TOTAL FACTORY MATERIAL MOVEMENT</h1></div>
				<table width="100%" cellspacing="0" cellpadding="5" border="0">
			<tr>
				
				<td align="center"><h2>From Date:&nbsp;&nbsp;&nbsp;'.$frmdate.'</h2></td>
				<td align="center"><h2>To Date:&nbsp;&nbsp;&nbsp;'.$todate.'</h2></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
		
			</tr>
		</table>';
		
		$html .= '
		<table cellspacing="0" cellpadding="5" border="0.5px">
			<tr>
				<th align="center"><h2>Material Description</h2></th>		
				<th align="center"><h2>Total Inward Weight</h2></th>					
				<th align="center"><h2>Total Outward Weight</h2></th>
			</tr>';				

			 if ($querymain->num_rows() > 0)	
 {		
 foreach($querymain->result() as $rowitem)		
 {		$html .= '			
 <tr>
 <td align="center"><h2>'.$rowitem->description.'</h2></td>			
 <td align="center"><h2>'.$rowitem->inweight.'</h2></td>			
 <td align="center" ><h2>'.$rowitem->outweight.'</h2></td>		
 </tr>';			
 }		}
			

		else{
		$html .= '
			<tr>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td align="center" >&nbsp;</td>
			</tr>';
		}
		$html .= '
			
		</table>';	
		
		
		$pdf->writeHTML($html, true, 0, true, true);
		$pdf->Ln();
		$pdf->lastPage();
		$pdf->Output($pdfname, 'I');
	}
	
	
	
	
  function form_fields()
  {
		$CI =& get_instance();
		$fields['nMinLength']['type'] ='Min length';
		$fields['nMaxLength']['type'] ='Max length';
		$fields['nAmount']['type'] ='Amount';	
	    return $fields;
  
  }
 	   
	function CoilTable() {
	 if(isset( $_POST['coil'])) {
	   $coilname = $_POST['coil'];
	  }
	  $sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate,aspen_tblpartydetails.nPartyName as partyname,aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber ";
   		if(!empty($coilname)) { 
			$sql .=" WHERE  aspen_tblmatdescription.vDescription='".$coilname."'";
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
	 
	
	
	


	 
	 
	 function list_partyname($description = '') {	
		$sql ="SELECT DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate,aspen_tblpartydetails.nPartyName as partyname, aspen_tblmatdescription.vDescription as description, aspen_tblinwardentry.fThickness as thickness, aspen_tblinwardentry.fWidth as width, aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vStatus as status , aspen_tblinwardentry.vIRnumber as coilnumber,aspen_tblinwardentry.vprocess as process FROM aspen_tblinwardentry LEFT JOIN aspen_tblmatdescription ON aspen_tblmatdescription.nMatId = aspen_tblinwardentry.nMatId LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId LEFT JOIN aspen_tblcuttinginstruction ON aspen_tblcuttinginstruction.vIRnumber = aspen_tblinwardentry.vIRnumber ";
   		if(!empty($description)) { 
			$sql .=" WHERE  aspen_tblmatdescription.vDescription='".$description."'";
		}
		$sql .=" group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate asc";
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

class factorymaterial_model extends Base_module_model {	
 	
}
