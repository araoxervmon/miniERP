<div id="innerpanel"> 
&nbsp;
&nbsp;
<fieldset>
<legend><strong>Company Details</strong><br/></legend>
&nbsp;
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
					<label>The name of our company<span class="required">*</span></label>
				</td>
				<td>  
					<input id="cname" type="text"   />
				</td>
			</tr>
			<tr>
				<td>
					<label>The default name or identifier to use for all receivable operations.<span class="required">*</span></label>
				</td> 
				<td>
					<input id="ide_receive" name="ide_receive" type="text"/> 
				</td>
			</tr>	
			<tr>
				<td>   
					<label>The default name or identifier to use for all payable operations.<span class="required">*</span></label>
				</td>
				<td>
					<input id="ide_payable" name="ide_payable" type="text"/> 
							
				</td>
			</tr>
			<tr>
				<td>
					<label>First address line<span class="required">*</span></label>
				</td>
				<td>
					
					<input id="addr1" name="addr1" type="text"/> 
							
				</td>
			</tr>
			<tr>
				<td>   
					<label>Second address line<span class="required">*</span></label>
				</td>
				<td>  
					<input id="addr2" name="addr2" type="text"/> 
					
				</td>
			</tr>
			<tr>
				<td>
					<label>The city or town where this company is located<span class="required">*</span></label>
				</td>
				<td> 
	
				
					<input id="city"  type="text" onkeyup=""/>
				</td>
			</tr>
			<tr>
				<td>  
					<label>The state or region where this company is located</label>
				</td>
				<td> 
					<input id="state"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Postal or Zip code where this company is located<span class="required">*</span></label>
				</td>
				<td>
					<input id="zipcode"  type="text" onchange=""/>
				</td>
			</tr>
			<tr>
				<td> 
					<label>The country this company is located </label>
				</td>
				<td>  
					<input id="country" name="country" type="text" value="INDIA" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Note: Please remember to update the company state or region. </label>
				</td>
				<td> 
					<input id="update_state"  type="text" />
				</td>
			</tr>
				<tr>
				<td>
					<label>Enter the company's primary telephone number</label>
				</td>
				<td> 
					<input id="ctno"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Secondary telephone number (may also be toll free number)</label>
				</td>
				<td> 
					<input id="toll_no"  type="text" />
				</td>
			</tr>
			<tr>
				<td> 
					<label>Enter the company's fax number</label>
				</td>
				<td> 
					<input id="fax"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Enter the general company email address</label>
				</td>
				<td> 
					<input id="email"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Enter the homepage of the company website (without the http://)</label>
				</td>
				<td> 
					<input id="web"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Enter the company's (Federal) tax ID number</label>
				</td>
				<td> 
					<input id="tax_id"  type="text" />
				</td>
			</tr>
			<tr>	

				<td>
					<label>Enter the company's VAT TIN </label>
				</td>
				<td> 
					<input id="vat"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Enter the company's CST number 	</label>
				</td>
				<td> 
					<input id="cst_no"  type="text" />
				</td>
			</tr><tr>
				<td>
					<label>Enter service tax number 	</label>
				</td>
				<td> 
					<input id="service_tax"  type="text" />
				</td>
			</tr><tr>
				<td>
					<label>
Enter excise duty number</label>
				</td>
				<td>
					<input id="duty_no"  type="text" />
				</td>
			</tr>
		</table>
	</div>
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">


<form id="cisave" method="post" action="">

		<div class="pad-10">
		<input id="newsize" type="button" value="Company Registry" onClick="inwardregistrybutton();"/> &nbsp; &nbsp; &nbsp;
				<input id="newsize" type="button" value="Save" onClick="functionsave(); "/> &nbsp; &nbsp; &nbsp;
			<!--		<input id="newsize" type="button" value="preview slip" onClick="preview(); "/> &nbsp; &nbsp; &nbsp;-->
		</div>
</form>



</table>
</fieldset>	

</div>

<script language="javascript" type="text/javascript">

function inwardregistrybutton(id)
{
	//var pid   =	$('#pid').val();
	//var pname = $('#pname').val();
	//var dataString = 'partyid='+partyid+'&partyname='+partyname;
	$.ajax({  
		type: "POST",  
		success: function(){  
		setTimeout("location.href='<?= site_url('fuel/company_details_entry'); ?>'", 100);
		}
		});
}


                     
function functionsave()
{
	var cid = $('#cid').val();
	var cname = $('#cname').val();
	var ide_receive = $('#ide_receive').val();
	var ide_payable = $('#ide_payable').val();
	var addr1 = $('#addr1').val();
	var addr2 = $('#addr2').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var zipcode = $('#zipcode').val();
	var country = $('#country').val();
	var update_state = $('#update_state').val();
	var ctno = $('#ctno').val();
	var toll_no = $('#toll_no').val();
	var fax = $('#fax').val();
	var email = $('#email').val();
	var web = $('#web').val();
	var tax_id = $('#tax_id').val();
	var vat = $('#vat').val();
	var cst_no = $('#cst_no').val();
	var update_state = $('#update_state').val();
	var ctno = $('#ctno').val();
	var service_tax = $('#service_tax').val();
	var duty_no = $('#duty_no').val();
	
	/*cid cname ide_receive ide_payable addr1 addr2 city state zipcode country update_state ctno toll_no fax email web tax_id vat cst_no service_tax duty_no*/
	//alert(cname);
	

		var dataString =  'cname='+cname+'&ide_receive='+ide_receive+'&ide_payable='+ide_payable+'&addr1='+addr1+'&addr2='+addr2+'&city='+city+'&state='+state+'&zipcode='+zipcode+'&country='+country+'&update_state='+update_state+'&ctno='+ctno+'&toll_no='+toll_no+'&fax='+fax+'&email='+email+ '&web='+web+'&tax_id='+tax_id+'&vat='+vat+'&cst_no='+cst_no+'&service_tax='+service_tax+'&duty_no='+duty_no;

		$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('company_details/savedetails');?>/",  
		   data: dataString,
		   success: function(msg)
		   { 
		   
			alert("saved successfully");
			}  
		}); 
	
	}

</script>
