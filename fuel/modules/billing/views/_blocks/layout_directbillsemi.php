<div id="innerpanel">
<form>
<fieldset>
<legend>Bill Details:</legend>
<table cellpadding="1" cellspacing="10" border="0">
<tr>
	<td>
		<span><label>Bill Number:</label></span>
	</td> 
	<td>
		<input id="billid" name="billid" type="text" onchange="billexist();"/>
	</td>
</tr>
</table>	
</fieldset>
<fieldset>
<legend>Coil Details:</legend>
<table cellpadding="2" cellspacing="10" border="0">
<tr>
	<td>
		<span><label><?=lang('party_id')?></label></span>
	</td>  
	<td>
		<input id="pid" name="pid" type="text" value="<?php echo $partyid; ?>" DISABLED/>
	</td>
	<td> 
		<span><label><?=lang('party_name')?></label></span>
	</td>
	<td>
		<input id="pname" name="nPartyName" type="text" value="<?php echo $partyname; ?>" DISABLED/>
	</td>
	<td>
		<input id="cust_add" name="vCusrateadd" type="hidden" />
	</td>
	<td>
		<input id="cust_rm" name="vCusraterm" type="hidden" />
	</td>
</tr>
			
<tr>	
	<td>
		<span><label><?=lang('Material_description')?></label></span>
	</td> 
	<td>
		<input id="mat_desc" name="vDescription" type="text" DISABLED/>
	</td>
	<td>
		<span><label><?=lang('thickness_txt')?></label></span>
	</td>  
	<td width="100px;">
		<input id="thic" name="fThickness" type="text" DISABLED/>
	</td>
</tr>
				
<tr>
	<td>
		<span><label><?=lang('width_txt')?></label></span>
	</td> 
	<td>
		<input id="wid" name="fWidth" type="text" DISABLED/> 
	</td>
	<td>
		<span><label><?=lang('length_txt')?></label></span>
	</td>
	<td> 
		<input id="len" name="fLength" type="text" DISABLED/>
	</td>
</tr>	

<tr>
	<td>
		<span><label><?=lang('weight_txt')?></label></span>
	</td>
	<td>
		<input id="wei"  type="text" value = <?php echo $weight;?> DISABLED/>
	</td>
	<td>
		<span><label>Invoice/Challan No</label></span>
	</td>
	<td> 
		<input id="inv_no" name="vInvoiceNo"  type="text" DISABLED/>
	</td>
	<td> 
		<input id="editbundlenumber" name="nSno"  type="hidden" />
	</td>
</tr>
</table>
</fieldset>
</form>



<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
	<tr><td>
	<fieldset>
<legend>Aditional Charges:</legend> 
	<div class="pad-10">
	<!--	<input type="checkbox" id="additional_chk" name="additional_chk" value="" /> &nbsp; -->
		<input type="text" id="txtadditional_type" name="txtadditional_type" value="" onfocus="if (this.value=='New Additional Charge Type') {this.value = '';}" onblur="if(this.value=='') {this.value = 'New Additional Charge Type';}" /> 
		&nbsp; 
		<input type="text" id="txtamount_mt" name="txtamount_mt" value="0"/> 

	</div>
	</fieldset>
	</td>
	<td>&nbsp;</td>
	<td>
	<fieldset>
<legend>Handling Charges:</legend> 
	<div class="pad-10">
	<!--	<input type="checkbox" id="additional_chk" name="additional_chk" value="" /> &nbsp; -->
		<input type="text" id="txthandling" name="txthandling"  /> 
		&nbsp; 
		*
		&nbsp;
		<!--<input type="text" id="txtamount_mt" name="txtamount_mt" value="0"/> -->
		<input id="wei" type="text" value = <?php echo $weight;?> DISABLED /> Kgs
		<input class="btn btn-success" id="done"  type="button" value="For Billing" onClick="directbilling(); "/>
	</div>
	</fieldset>
	</td>
	
	
	
	</tr>
	
	
</table>
 
<form>

<div>
	<div id="bundle_number_text_label"> </div>
	<input id="bundle_value" type="hidden" name="bundle_number"  />
	
</div>		

<form>


<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td>
<fieldset>
<legend>Processing Charges:</legend>
<div class="pad-10">
	<input type="text" id="txtoutward_num" name="txtoutward_num" value="Outward Lorry Number" onfocus="if (this.value=='Outward Lorry Number') {this.value = '';}" onblur="if(this.value=='') {this.value = 'Outward Lorry Number';}" /> 
	&nbsp; 
	<input type="text" id="txtscrap" name="txtscrap" value="Scrap Sent" onfocus="if (this.value=='Scrap Sent') {this.value = '';}" onblur="if(this.value=='') {this.value = 'Scrap Sent';}" /> 
	<!--<input id="textsavelorry" type="button" value="Enter" onClick="savelorrydetails" />-->
</div>
								
			<div id="contentsholderprocess" class="flexcroll" style="width:100%; height:200px; overflow-x:hidden; overflow-y:auto;">
			<div id="contentprocess" style="width:100%; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>
		
<div class="pad-10">
	Total: <input type="text" id="totalweight_check" DISABLED/> &nbsp;&nbsp;&nbsp;<input type="text" id="totalrate" DISABLED/>&nbsp; <input type="text" id="totalamt"  DISABLED/>&nbsp;&nbsp;
</div>
</fieldset>
</form>
							
</div>
</td>
</tr>
</table>

<div align="left">
	<input type="hidden" id="txtnsubtotal" DISABLED/>
	<input type="hidden" id="txtservicetax" DISABLED/>
	<input type="hidden" id="txteductax" DISABLED/>
	<input type="hidden" id="txtsecedutax" DISABLED/>
	<input type="hidden" id="txtgrandtotal" DISABLED/>
	<!--<input id="txtcancelbill" type="button" value="Cancel Bill" />	-->
	
	<script type="text/javascript">
function update(){
    var bigNumArry = new Array('', ' Thousand', ' million', ' billion', ' trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('txtgrandtotal').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('container').value = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('container').value = 'messeg tell to enter numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();

    //conver each grup of three digits to english word
    //if all digits are zero the triConvert
    //function return the string "dontAddBigSufix"
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
    if (finlOutPut[b] != "dontAddBigSufix") {
        finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr]; // <<<
        bigScalCntr++;
    }
    else {
        //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
        finlOutPut[b] = ' ';
        bigScalCntr++; //advance the counter  
    }
}

    //convert The output Arry to , more printable string 
    var nonzero = false; // <<<
    for(n = 0; n<finlOutPut.length; n++){
        if (finlOutPut[n] != ' ') { // <<<
            if (nonzero) output += ' , '; // <<<
            nonzero = true; // <<<
        } // <<<
        output +=finlOutPut[n];
    }

    document.getElementById('container').value = output;//print the output
}

//simple function to convert from numbers to words from 1 to 999
function triConvert(num){
    var Ones = new Array('', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine', ' Ten', ' eleven', ' twelve', ' thirteen', ' fourteen', ' fifteen', ' sixteen', ' seventeen', ' eighteen', ' nineteen');
    var tens = new Array('', '', ' twenty', ' thirty', ' forty', ' fifty', ' sixty', ' seventy', ' eighty', ' ninety');
    var hundred = ' hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = Ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = Ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += Ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += Ones[parseInt(numString.charAt(1))];

    return output;
}   
</script>

            <input type="hidden" size="80" id="container" DISABLED/>
</div>
<div align="left">
	<!--<input class="btn btn-danger"  style="cursor: pointer;" id="txtcancelbill" type="button" value="Cancel Bill" onclick="cancelbill();" />-->
</div>

<div align="right">
	<input  class="btn btn-success" style="cursor: pointer;" id="txtbillpreview" type="button" value="Preview and Print Bill" onclick="functionpdfprint();" />
	<input class="btn btn-inverse" style="cursor: pointer;" id="txtbillloadingslip" type="button" value="Loading Slip" onclick="functionpdf();" />	
</div>
</div>	

 <script>
 //number to words

function numbertowords() {
 var junkVal=document.getElementById('txtgrandtotal').value;
 junkVal=Math.floor(junkVal);
 var obStr=new String(junkVal);
 numReversed=obStr.split("");
 actnumber=numReversed.reverse();

 if(Number(junkVal) >=0){
  //do nothing
 }
 else{
  alert('wrong Number cannot be converted');
  return false;
 }
 if(Number(junkVal)==0){
  document.getElementById('container').value=obStr+''+'Rupees Zero Only';
  return false;
 }
 if(actnumber.length>9){
  alert('Oops!!!! the Number is too big to covertes');
  return false;
 }

 var iWords=["Zero", " One", " Two", " Three", " Four", " Five", " Six", " Seven", " Eight", " Nine"];
 var ePlace=['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
 var tensPlace=['dummy', ' Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];

 var iWordsLength=numReversed.length;
 var totalWords="";
 var inWords=new Array();
 var finalWord="";
 j=0;
 for(i=0; i<iWordsLength; i++){
  switch(i)
  {
  case 0:
   if(actnumber[i]==0 || actnumber[i+1]==1 ) {
    inWords[j]='';
   }
   else {
    inWords[j]=iWords[actnumber[i]];
   }
   inWords[j]=inWords[j]+' Only';
   break;
  case 1:
   tens_complication();
   break;
  case 2:
   if(actnumber[i]==0) {
    inWords[j]='';
   }
   else if(actnumber[i-1]!=0 && actnumber[i-2]!=0) {
    inWords[j]=iWords[actnumber[i]]+' Hundred and';
   }
   else {
    inWords[j]=iWords[actnumber[i]]+' Hundred';
   }
   break;
  case 3:
   if(actnumber[i]==0 || actnumber[i+1]==1) {
    inWords[j]='';
   }
   else {
    inWords[j]=iWords[actnumber[i]];
   }
   if(actnumber[i+1] != 0 || actnumber[i] > 0){
    inWords[j]=inWords[j]+" Thousand";
   }
   break;
  case 4:
   tens_complication();
   break;
  case 5:
   if(actnumber[i]==0 || actnumber[i+1]==1) {
    inWords[j]='';
   }
   else {
    inWords[j]=iWords[actnumber[i]];
   }
   if(actnumber[i+1] != 0 || actnumber[i] > 0){
    inWords[j]=inWords[j]+" Lakh";
   }
   break;
  case 6:
   tens_complication();
   break;
  case 7:
   if(actnumber[i]==0 || actnumber[i+1]==1 ){
    inWords[j]='';
   }
   else {
    inWords[j]=iWords[actnumber[i]];
   }
   inWords[j]=inWords[j]+" Crore";
   break;
  case 8:
   tens_complication();
   break;
  default:
   break;
  }
  j++;
 }

 function tens_complication() {
  if(actnumber[i]==0) {
   inWords[j]='';
  }
  else if(actnumber[i]==1) {
   inWords[j]=ePlace[actnumber[i-1]];
  }
  else {
   inWords[j]=tensPlace[actnumber[i]];
  }
 }
 inWords.reverse();
 for(i=0; i<inWords.length; i++) {
  finalWord+=inWords[i];
 }
 document.getElementById('container').value=finalWord;
}

//	

//simple function to convert from numbers to words from 1 to 999
function triConvert(num){
    var Ones = new Array('', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine', ' Ten', ' eleven', ' twelve', ' thirteen', ' fourteen', ' fifteen', ' sixteen', ' seventeen', ' eighteen', ' nineteen');
    var tens = new Array('', '', ' twenty', ' thirty', ' forty', ' fifty', ' sixty', ' seventy', ' eighty', ' ninety');
    var hundred = ' hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = Ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = Ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += Ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += Ones[parseInt(numString.charAt(1))];

    return output;
} 
 
 function cancelbill(){
var billid = $('#billid').val();
var pid = $('#pid').val();
var wei = $('#wei').val();
	var checkstr =  confirm('Are you sure you want to Cancel this Bill?');
	var dataString = {billid : billid,pid:pid,wei:wei};
	if(checkstr == true){
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/semicancelbill');?>/",  
		data: dataString,
		datatype : "json",
		success: function(){
			alert("Cancelled Successfully");
			$('#billid').val('');
			window.location="<?php echo fuel_url('partywise_register');?>";
	   }   
	});
	}else{
    return false;
    }
}



 function subtotalvalue(){
	var partyid = $('#pid').val();
	var txtamount_mt = $('#txtamount_mt').val();
	var totalamt=$('#totalamt').val();
	var resultbundle= parseInt(txtamount_mt)+ parseInt(totalamt);
	document.getElementById("txtnsubtotal").value = resultbundle;
	taxspec();
}


function taxspec(){
	var txtnsubtotal = $('#txtnsubtotal').val();
	var servicetax= 0.12 * parseInt(txtnsubtotal);
	var eductax= 0.02 * parseInt(servicetax);
	var secedutax= 0.01 * parseInt(servicetax);
	var grandtotal= parseInt(txtnsubtotal)+ servicetax+ eductax+ secedutax;
	var grandtotals=parseInt(grandtotal)
	document.getElementById("txtservicetax").value = servicetax;
	document.getElementById("txteductax").value = eductax;
	document.getElementById("txtsecedutax").value = secedutax;
	document.getElementById("txtgrandtotal").value = grandtotals;
}

 
 
  function functionpdfprint(){
	subtotalvalue();
	numbertowords();
	var billid = $('#billid').val();
	var partyid = $('#pid').val();
	var pname = $('#pname').val();
	var cust_add = $('#cust_add').val();
	var cust_rm = $('#cust_rm').val();
	var mat_desc = $('#mat_desc').val();
	var thic = $('#thic').val();
	var wid=$('#wid').val();
	var len=$('#len').val();
	var wei=$('#wei').val();
	var inv_no=$('#inv_no').val();
	var totalweight_check=$('#totalweight_check').val();
	var totalrate=$('#totalrate').val();
	var totalamt=$('#totalamt').val();
	var txthandling=$('#txthandling').val();
	var txtadditional_type=$('#txtadditional_type').val();
	var txtamount_mt=$('#txtamount_mt').val();
	var txtoutward_num=$('#txtoutward_num').val();
	var txtscrap=$('#txtscrap').val();
	var txtservicetax=$('#txtservicetax').val();
	var txteductax=$('#txteductax').val();
	var txtsecedutax=$('#txtsecedutax').val();
	var txtgrandtotal=$('#txtgrandtotal').val();
	var container=$('#container').val(); 
	var txtnsubtotal = $('#txtnsubtotal').val();
	//alert(billid); alert(partyid); alert(pname); alert(cust_add); alert(cust_rm); alert(mat_desc); alert(thic); alert(wid); alert(len); alert(wei); alert(inv_no); 
	//alert(totalweight_check); alert(totalrate); alert(totalamt); alert(txthandling); alert(txtadditional_type); alert(txtamount_mt); alert(txtoutward_num ); alert(txtscrap); alert(txtservicetax); alert(txteductax); alert(txtsecedutax);
	//alert(txtgrandtotal); alert(container); alert(txtnsubtotal);
	
	var dataString =  'billid='+billid+'&partyid='+partyid+'&pname='+pname+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&mat_desc='+mat_desc+'&thic='+thic+'&wid='+wid+'&len='+len+'&wei='+wei+'&inv_no='+inv_no+'&totalweight_check='+totalweight_check+'&totalrate='+totalrate+'&totalamt='+totalamt+'&txthandling='+txthandling+'&txtadditional_type='+txtadditional_type+'&txtamount_mt='+txtamount_mt+'&txtoutward_num='+txtoutward_num+'&txtscrap='+txtscrap+'&txtservicetax='+txtservicetax+'&txteductax='+txteductax+'&txtsecedutax='+txtsecedutax+'&txtgrandtotal='+txtgrandtotal+'&container='+container+'&txtnsubtotal='+txtnsubtotal;
	$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('billing/semibill');?>/",  
		   data: dataString,
		   success: function(msg)
		   { 
		   alert('Preview Selected');
			var partyid = $('#pid').val();
			var dataStringone =  'billid='+billid+'&partyid='+partyid+'&pname='+pname+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&mat_desc='+mat_desc+'&thic='+thic+'&wid='+wid+'&len='+len+'&wei='+wei+'&inv_no='+inv_no+'&totalweight_check='+totalweight_check+'&totalrate='+totalrate+'&totalamt='+totalamt+'&txthandling='+txthandling+'&txtadditional_type='+txtadditional_type+'&txtamount_mt='+txtamount_mt+'&txtoutward_num='+txtoutward_num+'&txtscrap='+txtscrap+'&txtservicetax='+txtservicetax+'&txteductax='+txteductax+'&txtsecedutax='+txtsecedutax+'&txtgrandtotal='+txtgrandtotal+'&container='+container+'&txtnsubtotal='+txtnsubtotal;
			var url = "<?php echo fuel_url('billing/semibillingmodelpdf');?>/?"+dataStringone;
		    window.open(url);
		   }  
		});
	}
 
 
 
 function functionpdf(){
 var pid = $('#pid').val();
 var pname = $('#pname').val();
 var mat_desc = $('#mat_desc').val();
 var txtoutward_num = $('#txtoutward_num').val();  
 var totalrate = $('#totalrate').val();
 var totalweight_check = $('#totalweight_check').val();
 var totalamt = $('#totalamt').val();
   
 var dataString = 'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalrate='+totalrate+'&totalweight_check='+totalweight_check+'&totalamt='+totalamt;
 $.ajax({  
     type: "POST",  
    // url : "<?php echo fuel_url('billing_statement/billing_pdf');?>/",  
     data: dataString,
     success: function(msg)
     {  
   
   var dataStringone =  'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalrate='+totalrate+'&totalweight_check='+totalweight_check+'&totalamt='+totalamt;
   var url = "<?php echo fuel_url('billing/billingdirect_pdf');?>/?"+dataStringone;
      window.open(url);
     }  
  }); 

}
 
 
 
 
 
 var json = <?php echo($semidata); ?>;
for(key in json)
{
  if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
	handling();
}

function functionpdf(){
 var pid = $('#pid').val();
 var pname = $('#pname').val();
 var mat_desc = $('#mat_desc').val();
 var txtoutward_num = $('#txtoutward_num').val();  
 var totalrate = $('#totalrate').val();
 var totalweight_check = $('#totalweight_check').val();
 var totalamt = $('#totalamt').val();
   
 var dataString = 'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalrate='+totalrate+'&totalweight_check='+totalweight_check+'&totalamt='+totalamt;
 $.ajax({  
     type: "POST",  
    // url : "<?php echo fuel_url('billing_statement/billing_pdf');?>/",  
     data: dataString,
     success: function(msg)
     {  
   
   var dataStringone =  'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalrate='+totalrate+'&totalweight_check='+totalweight_check+'&totalamt='+totalamt;
   var url = "<?php echo fuel_url('billing/billingdirect_pdf');?>/?"+dataStringone;
      window.open(url);
     }  
  }); 

}

function handling(){
	var pid = $('#pid').val();
	var mat_desc=$('#mat_desc').val();
	var dataString ='pid='+pid+'&mat_desc='+mat_desc;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/handling');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var value = j.value;
			document.getElementById("txthandling").value = value;});
	   }  
	}); 
}

function noofpcs(bundleid){
	var partyid = $('#pid').val();
	var dataString = 'bundleid='+bundleid+'&partyid='+partyid;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/finalbillingcalculatenoofpcs');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var pcs = j.pcs;
			document.getElementById("txttotalpcs").value = pcs;});
	   }  
	}); 
}

function totalweight_check(){
	var partyid = $('#pid').val();
	var wei = $('#wei').val();
	var weight = wei/1000;
	document.getElementById("totalweight_check").value = weight;
}




function totalamt(){
	var partyid = $('#pid').val();
	var cust_add = $('#cust_add').val();
    var cust_rm = $('#cust_rm').val();
	var txthandling = $('#txthandling').val();
	var mat_desc=$('#mat_desc').val();
	var wei = $('#wei').val();
	 var dataString = 'partyid='+partyid+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&txthandling='+txthandling+'&mat_desc='+mat_desc+'&wei='+wei;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totalamt');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var amt = j.amt;
			document.getElementById("totalamt").value = amt;});
	   }  
	}); 
}




function totalrate(){
	var partyid = $('#pid').val();
	var cust_add = $('#cust_add').val();
    var cust_rm = $('#cust_rm').val();
	var txthandling = $('#txthandling').val();
	var mat_desc=$('#mat_desc').val();
	 var dataString = 'partyid='+partyid+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&txthandling='+txthandling+'&mat_desc='+mat_desc;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totalrate');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var rate = j.rate;
			document.getElementById("totalrate").value = rate;});
	   }  
	}); 
}

function directbilling(){
 var mat_desc=$('#mat_desc').val();
 var partyid = $('#pid').val();
var cust_add=$('#cust_add').val();
var cust_rm=$('#cust_rm').val();
 var txthandling=$('#txthandling').val();
var wei=$('#wei').val(); 
//noofpcs(actualnumberbundle);
 //totalvalue(actualnumberbundle);
 //totalengthvalue();
 //totaweightvalue();
 //totawidthvalue();
 var dataString = 'partyid='+partyid+'&mat_desc='+mat_desc+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&txthandling='+txthandling+'&wei='+wei;
$.ajax({  
    type: "POST",  
    url : "<?php echo fuel_url('billing/directbilling');?>/",  
  data: dataString,
  success: function(msg){
  alert('Updated To Bill');
 refresh_folderlistthree();
    }  
 }); 
}

function loadfolderlist(account, accname,bundlenumber) {
handling();
	$('#DynamicGrid_2').hide();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Bundle List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing/listbundledetails');?>",
        data: "partyid=" + account+"&nsno="+bundlenumber,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGrid_2').hide();
			$('#DynamicGridLoading_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#content').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			var selectbundle = '<input class="grand_total_check" type="checkbox" id="radio_'+item.bundlenumber+'" name="list" value="'+item.bundlenumber+'" onClick=selectbundleid('+item.bundlenumber+','+item.weight+','+item.notobebilled+') />';
			thisdata["select"] = selectbundle;
			thisdata["bundlenumber"] = item.bundlenumber;
            thisdata["weight(inkgs)"] = item.weight;
            thisdata["actualnumber"] = item.actualnumber;
            thisdata["length(in mm)"] = item.length;
            thisdata["number to be billed"] = item.notobebilled;
          //  thisdata["billed weight"] = item.billedweight;
            var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=functionedit('+item.bundlenumber+','+item.notobebilled+','+item.actualnumber+','+item.weight+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#content').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholder');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                var data = {account_name: account};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadfolderlist(account, accname);
                });
                });
			} else {
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsholder');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}

function loadprocessingcharge(account, accname) {
	 var mat_desc=$('#mat_desc').val();
 var partyid = $('#pid').val();
var cust_add=$('#cust_add').val();
var cust_rm=$('#cust_rm').val();
 var txthandling=$('#txthandling').val();
var wei=$('#wei').val();
totalweight_check();
totalrate();
totalamt();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Processing Details... </span> '+ 
    	    	   ' </div>';
    $("#contentprocess").empty();
	$('#contentprocess').html(loading);
    $.ajax({
        type: "POST", 
        url: "<?php echo fuel_url('billing/directbilling');?>",
        data: "partyid=" + account+ "&mat_desc="+mat_desc+"&txthandling="+txthandling+"&wei="+wei+"&cust_add="+cust_add+"&cust_rm="+cust_rm,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGrid_2').hide();
			$('#DynamicGridLoading_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#contentprocess').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
            thisdata["weight(in M/T)"] = item.weight;
            thisdata["Rate(in M/T)"] = item.rate;
            thisdata["Amount"] = item.amount;
           /* var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=functionedit('+item.bundlenumber+','+item.notobebilled+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;*/
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#contentprocess').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholderprocess');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                var data = {account_name: account};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadprocessingcharge(account, accname);
                });
                });
			} else {
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsholderprocess');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}


function billexist(){
        var billid = $('#billid').val();
        var isANumber = isNaN(billid) === false;
        if (isANumber == false){
          alert('Please input numeric characters only for Bill Number');
          $('#billid').val('');
         }
          if ( billid != "" )
          {
          var dataString = 'billid='+billid;
         $.ajax({  
         type: "POST",  
         url : "<?php echo fuel_url('billing/checkbillno');?>/",  
         data: dataString,
         success: function(msg){  
         if(msg == '1'){
         
          alert('Billnumber Already Exists. Please Enter a new number!');
          $('#billid').val('');
             }
             
               }  
           });  
        }
} 
 </script>