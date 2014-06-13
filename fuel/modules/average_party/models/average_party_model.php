<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');
require_once(APPPATH.'helpers/tcpdf/config/lang/eng.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php'); 

class average_party_model extends Base_module_model {	 	

public $required = array('dReceivedDate','vIRnumber','vDescription','fThickness','fWidth','nTotalWeight');	
protected $key_field = 'dReceivedDate';	   
 
function __construct()   
 {       
 parent::__construct('aspen_hist_tblinwardentry');    
 
 }			
 
 function form_fields($values = array())	
 {	    $fields = parent::form_fields($values);		
 $this->form_builder->set_fields($fields);	    
 return $fields;	
 }		
 
 
 
 function export_partyname($partyname='') 
{	
 $sql ="SELECT `vIRnumber` AS coilno, `dReceivedDate` AS indate, `dBillDate` AS bdate, `fThickness` as thickness , `fWidth` as width , `fQuantity` as quantity , DATEDIFF( dBillDate, dReceivedDate ) AS noofdays
FROM `aspen_hist_tblinwardentry` LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_hist_tblinwardentry.nPartyId 	
where aspen_tblpartydetails.nPartyName='".$partyname."' and `fpresent` <= 1 ";	
		
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
	
	
 
 
 
 
 function billgeneratemodel($partyname='') 
 {	

 $sqlrpt ="SELECT `vIRnumber` AS coilno, `dReceivedDate` AS indate, `dBillDate` AS bdate, `fThickness` as thickness , `fWidth` as width , `fQuantity` as quantity , DATEDIFF( dBillDate, dReceivedDate ) AS noofdays
FROM `aspen_hist_tblinwardentry` LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_hist_tblinwardentry.nPartyId 	
where aspen_tblpartydetails.nPartyName='".$partyname."' and `fpresent` <= 1 ";	
						
 $querymain = $this->db->query($sqlrpt);							
 $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);		
 $pdfname= 'averagePartyHolding.pdf';		
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
 <div align="center"><h2>PARTYWISE AVERAGE HOLDING  REPORT </h2></div>			
 <table width="100%" cellspacing="0" cellpadding="5" border="0">		
 <tr>				
 <td align="center"><h2>Party Name: '.$partyname.'  </h2></td>		
 </tr>			
 <tr>			
 <td align="center">&nbsp;</td>				
 </tr>		
 </table>';			
 $html .= '		
 <table cellspacing="0" cellpadding="5" border="0.5px">		
 <tr>				
 <th align="center"><b>Coil Number</b></th>		
 <th align="center"><b>Received Date</b></th>			
 <th align="center"><b>Width (Kgs)</b></th>
 <th align="center"><b>Thickness (Kgs)</b></th>
 <th align="center"><b>Weight (Kgs)</b></th> 			
 <th align="center"><b>Billed Date</b></th>
 <th align="center"><b>No. of days</b></th>				
 </tr>';				
 if ($querymain->num_rows() > 0)	
 {		
 foreach($querymain->result() as $rowitem)		
 {		$html .= '			
 <tr>			
 <td align="center">'.$rowitem->coilno.'</td>		
 <td align="center">'.$rowitem->indate.'</td>			
 <td align="center" >'.$rowitem->width.'</td>				
 <td align="center">'.$rowitem->thickness.'</td>			
 <td align="center">'.$rowitem->quantity.'</td>	
 <td align="center">'.$rowitem->bdate.'</td>	 
 <td align="center">'.$rowitem->noofdays.'</td>			
 </tr>';			
 }		}else{		
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
 
 function getPartyDetailsCredentials() 
 {		
 if(isset( $_POST['party'])) 
 {			
 $uid = $_POST['party'];		
 }		
 $sql =		   		"Select nPartyName,nPartyId from aspen_tblpartydetails";		
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
 $sql ="SELECT DATE_FORMAT(aspen_tblbilldetails.dBillDate , '%d-%m-%Y') as billdate, DATE_FORMAT(aspen_tblinwardentry.dReceivedDate, '%d-%m-%Y') as receiveddate, 		DATEDIFF(aspen_tblbilldetails.dBillDate , aspen_tblinwardentry.dReceivedDate) as days ,		aspen_tblinwardentry.fQuantity as weight, aspen_tblinwardentry.vIRnumber as coilnumber, 		( SELECT (days * weight) / (SELECT sum( fQuantity ) FROM aspen_tblinwardentry )) AS avgwei		FROM aspen_tblinwardentry 		LEFT JOIN aspen_tblbilldetails ON aspen_tblbilldetails.vIRnumber = aspen_tblinwardentry.vIRnumber 		LEFT JOIN aspen_tblpartydetails ON aspen_tblpartydetails.nPartyId = aspen_tblinwardentry.nPartyId 		WHERE aspen_tblpartydetails.nPartyName='".$partyname."' group by aspen_tblinwardentry.vIRnumber order by aspen_tblinwardentry.dReceivedDate desc";		
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
 
 
 
 class averageparty_model extends Base_module_record {

 }