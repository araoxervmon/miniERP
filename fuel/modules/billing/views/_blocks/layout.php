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
		<input id="billid" name="billid" type="text"  />
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
		<input id="wei" name="fQuantity" type="text" DISABLED />
		<input id="presentwei"  type="hidden" />
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

<form>
<fieldset>
<legend>Bundle Details:</legend>
<div class="pad-10" align="center" >
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="40%" align="left" valign="top">	
<form id="cisave" method="post" action="">
		<div class="pad-10">
			<div id="bundle_number_text_label" DISABLED > Bundle Number </div>
			<input id="bundlenumber" type="text" name="bundle_number"  DISABLED/>
			<input id="coilname" type="hidden" value="" name="coilname" />
			<input id= "txtbundleids" type="hidden" /> 
			<input id= "txtbundleweight" type="hidden" /> 
		</div>								
		<div class="pad-10">
			<div id="billed_text_label"> Number to be Billed </div>
			<input id= "billed" type="text"  name="Length"/> 
		</div>
		<div class="pad-10">
			<input id= "bundleweightactual" type="hidden"   /> 
		</div>
		<div class="pad-10">
			<input id= "actualnumberbundle" type="hidden"  /> 
			<input id= "billedweight" type="hidden"  /> 
			<input id= "changednumber" type="hidden"  />
		</div>
		<div class="pad-10">
		<input class="btn btn-info" type="button" value="EDIT/UPDATE" onClick="functioneditcoil();"  id="editdhide" class="textBox" />
		</div>
		</div>
	</form>
</td>
<td width="60%" align="left" valign="top">							
    <div id="contentsholder" class="flexcroll" style="width:100%; height:100%; overflow-x:auto; overflow-y:auto;">
		<div id="content" style="width:100%; min-height:100%; overflow:auto;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
		</div>
	</div>
	
		<div align="right">
			<div class="pad-10" style="float:left">
			<label>Sizes</label>
			<input id="txtsizes"  type="text" DISABLED />
			</div>
			<div  align="right" class="pad-10" style="float:right">
			<input class="btn btn-success" id="saveid" type="button" value="For Billing" onClick="functionsave();" />
			</div>
		</div>
</td>
</tr>
</table>

</fieldset>
</form>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td align="left" valign="top"> 
<form>
<fieldset>
<legend>Aditional Charges:</legend> 
	<div class="pad-10">
	<!--	<input type="checkbox" id="additional_chk" name="additional_chk" value="" /> &nbsp; -->
		<input type="text" id="txtadditional_type" name="txtadditional_type" onfocus="if (this.value=='New Additional Charge Type') {this.value = '';}" onblur="if(this.value=='') {this.value = 'New Additional Charge Type';}" /> 
		&nbsp; 
		<input type="text" id="txtamount_mt" name="txtamount_mt" value="0"/> 

	</div>
</fieldset>

<fieldset>
<legend>Other Charges:</legend>
&nbsp;
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
<tr>
			<td>					
			<div id="contentsholderweight" class="flexcroll" style="width:100%; height:100px;  overflow-x:hidden; overflow-y:auto;">
			<div id="contentweight" style="width:100%; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>
		</td>
</tr>
<tr>
		<td>
		<div id="contentsholderwidth" class="flexcroll" style="width:100%;height:100px; overflow-x:hidden; overflow-y:auto;">
			<div id="contentwidth" style="width:100%; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>
		</td>
</tr>
<tr>
		<td>
				<div id="contentsholderlength" class="flexcroll" style="width:100%; height:100px; overflow-x:hidden; overflow-y:auto;">
			<div id="contentlength" style="width:100%; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>
		</td>
</tr>
	</table>
	

		
</fieldset>

<td width="10px">&nbsp;</td>
<td align="left" valign="top">
<div>
	<div id="bundle_number_text_label"> </div>
	<input id="bundle_value" type="hidden" name="bundle_number"  />
	
</div>		

<form>



<fieldset>
<legend>Processing Charges:</legend>
<div class="pad-10">
	<input type="text" id="txtoutward_num" name="txtoutward_num" value="Outward Lorry Number" onfocus="if (this.value=='Outward Lorry Number') {this.value = '';}" onblur="if(this.value=='') {this.value = 'Outward Lorry Number';}" /> 
	&nbsp; 
	<input type="text" id="txtscrap" name="txtscrap" value="Scrap Sent" onfocus="if (this.value=='Scrap Sent') {this.value = '';}" onblur="if(this.value=='') {this.value = 'Scrap Sent';}" /> 
	<!--<input id="textsavelorry" type="button" value="Enter" onClick="savelorrydetails" />-->
</div>
								
			<div id="contentsholderprocess" class="flexcroll" style="width:100%; height:300px; overflow-x:hidden; overflow-y:auto;">
			<div id="contentprocess" style="width:100%; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>
		
<div class="pad-10">
	Total: <input type="text" id="txttotalpcs" onchange="docalculate();" style="width:80px !important;" DISABLED/> &nbsp;&nbsp; <input type="text" id="txttotalweight" onchange="docalculate();"  style="width:80px !important;"DISABLED/>&nbsp;&nbsp;<input type="text" id="txtamount" onchange="docalculate();"  style="width:80px !important;" DISABLED/>
</div>
</fieldset>
</form>
							
</div>
</td>
</tr>
</table>

<div align="left">
	<input type="hidden" id="txttotallength" DISABLED/>
	<input type="hidden" id="txtweighttotal" DISABLED/>
	<input type="hidden" id="txtwidthtotal" DISABLED/>
	<input type="hidden" id="txtnsubtotal" DISABLED/>
	<input type="hidden" id="txtservicetax" DISABLED/>
	<input type="hidden" id="txteductax" DISABLED/>
	<input type="hidden" id="txtsecedutax" DISABLED/>
	<input type="hidden" id="txtgrandtotal" DISABLED/>
	<!--<input id="txtcancelbill" type="button" value="Cancel Bill" />	-->
	

<script>
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

</script>



<input type="hidden" id="container" size="100" Disabled>

</div>

<div align="left">
	<!--<input class="btn btn-danger"  style="cursor: pointer;" id="txtcancelbill" type="button" value="Cancel Bill" onclick="cancelbill();" />-->
</div>

<div align="right">
	<input class="btn btn-success" style="cursor: pointer;" id="txtbillpreview" type="button" value="Preview and Print Bill" onclick="savebill_details();" />
	<input class="btn btn-inverse" style="cursor: pointer;" id="txtbillloadingslip" type="button" value="Loading Slip" onclick="functionpdf();" />	
</div>
</div>	

<script language="javascript" type="text/javascript">

function cancelbill(){
var billid = $('#billid').val();
var pid = $('#pid').val();
var presentwei = $('#presentwei').val();
var actualnumberbundle = $('#actualnumberbundle').val();
alert(actualnumberbundle);
	var checkstr =  confirm('Are you sure you want to Cancel this Bill?');
	var dataString = {billid : billid,pid:pid,presentwei:presentwei,actualnumberbundle:actualnumberbundle};
	if(checkstr == true){
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/cuttingcancel');?>/",  
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



function functionpdf(){
	var pid = $('#pid').val();
	var pname = $('#pname').val();
	var mat_desc = $('#mat_desc').val();  	  
	var thic = $('#thic').val();  
	var wid = $('#wid').val();
	var txtoutward_num = $('#txtoutward_num').val();  
	var txttotalpcs = $('#txttotalpcs').val();
	var txttotalweight = $('#txttotalweight').val();
	var txtamount = $('#txtamount').val();
	var actualnumberbundle = $('#actualnumberbundle').val();
	var partyid = $('#pid').val();
	var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length > 0;
	if( atLeastOneIsChecked == false)
		{
			alert('Please select the check box to get to know the quantity of the material');
		return false;
		}
		else
		{
	var dataString = 'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalpcs='+txttotalpcs+'&thic='+thic+'&wid='+wid+  '&totalweight='+txttotalweight+'&totamount='+txtamount+'&actualnumberbundle='+actualnumberbundle+'&partyid='+partyid;
	$.ajax({  
		   type: "POST",  
		  // url : "<?php echo fuel_url('billing_statement/billing_pdf');?>/",  
		   data: dataString,
		   success: function(msg)
		   {  
			
			var dataStringone =  'coilno='+pid+'&partyname='+pname+'&description='+mat_desc+'&lorryno='+txtoutward_num+'&totalpcs='+txttotalpcs+'&thic='+thic+'&wid='+wid+  '&totalweight='+txttotalweight+'&totamount='+txtamount+'&actualnumberbundle='+actualnumberbundle+'&partyid='+partyid;
			var url = "<?php echo fuel_url('billing/billing_pdf');?>/?"+dataStringone;
		    window.open(url);
		   }  
		}); 
	}
}










function loadfolderlist(account, accname,bundlenumber) {
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
			var selectbundle = '<input class="grand_total_check" name="chk[]" type="checkbox" id="radio_'+item.bundlenumber+'" name="list" value="'+item.bundlenumber+'" onClick=selectbundleid('+item.bundlenumber+','+item.weight+','+item.notobebilled+') />';
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
function selectbundleid(s,r,bw,ac){	
	document.getElementById('txtbundleids').value = s;	
	document.getElementById('txtbundleweight').value = r;	
	document.getElementById('changednumber').value = bw;	
	document.getElementById('actualnumberbundle').value = ac;	
	
	var allVals = [];
         $('#content :checked').each(function() {
           allVals.push($(this).val());
		   //alert($(this).val());
         });
		// alert(allVals);
		// alert('Inside functn');
         $('#actualnumberbundle').val(allVals)
}

function countlenvalue(){
	var pid=$('#pid').val();
	var dataString = 'pid='+pid;
	
$.ajax({
            type: 'POST',
			url: "<?php echo fuel_url('billing/countlenvalue');?>",
			data: dataString,
			success: function(msg){
			var msg5=eval(msg);
			$.each(msg5, function(i, j){
			 var value = j.value;
			document.getElementById("txtsizes").value = value;});
	   }  
	});
}


function presentweight(){
	var pid=$('#pid').val();
	var dataString = 'pid='+pid;
	
$.ajax({
            type: 'POST',
			url: "<?php echo fuel_url('billing/presentweight');?>",
			data: dataString,
			success: function(msg){
			var msg5=eval(msg);
			$.each(msg5, function(i, j){
			 var weight = j.weight;
			document.getElementById("presentwei").value = weight;});
	   }  
	});
}

function loadprocessingcharge(account, accname) {
	$('#DynamicGrid_2').hide();
	var mat_desc=$('#mat_desc').val();
	var thic=$('#thic').val();
	var actualnumberbundle=$('#actualnumberbundle').val();
	var cust_add=$('#cust_add').val();
	var cust_rm=$('#cust_rm').val();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Processing Details... </span> '+ 
    	    	   ' </div>';
    $("#contentprocess").empty();
	$('#contentprocess').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing/finalbillingcntrlr');?>",
        data: "partyid=" + account+ "&mat_desc="+mat_desc+"&thic="+thic+"&actualnumberbundle="+actualnumberbundle+"&cust_add="+cust_add+"&cust_rm="+cust_rm,
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
			thisdata["No of pcs"] = item.noofpcs;
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


/**/
function loadweightgrate(account, accname) {
	$('#DynamicGrid_2').hide();
	var mat_desc=$('#mat_desc').val();
	var wei=$('#wei').val();
	var txttotalweight=$('#txttotalweight').val();
	
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Weight Details... </span> '+ 
    	    	   ' </div>';
    $("#contentweight").empty();
	$('#contentweight').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing/weightchargecntrlr');?>",
         data: "partyid=" + account+ "&mat_desc="+mat_desc+"&wei="+wei+"&txttotalweight="+txttotalweight,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGrid_2').hide();
			$('#DynamicGridLoading_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#contentweight').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			thisdata["weight"] = '';
            thisdata["weight(in M/T)"] = item.weight;
            thisdata["Rate(in M/T)"] = item.rate;
            thisdata["Amount"] = item.amount;
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#contentweight').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholderweight');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                var data = {account_name: account};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadweightgrate(account, accname);
                });
                });
			} else {
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsholderweight');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}

function loadlength(account, accname) {
	$('#DynamicGrid_2').hide();
	var mat_desc=$('#mat_desc').val();
	var len=$('#len').val();
	var actualnumberbundle=$('#actualnumberbundle').val();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Length Details... </span> '+ 
    	    	   ' </div>';
    $("#contentlength").empty();
	$('#contentlength').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing/lengthchargecntrlr');?>",
        data: "partyid=" + account+ "&mat_desc="+mat_desc+"&len="+len+"&actualnumberbundle="+actualnumberbundle,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGrid_2').hide();
			$('#DynamicGridLoading_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#contentlength').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			thisdata["Length"] = item.length;
            thisdata["weight(in M/T)"] = item.weight;
            thisdata["Rate(in M/T)"] = item.rate;
            thisdata["Amount"] = item.amount;
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#contentlength').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholderlength');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                var data = {account_name: account};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadlength(account, accname);
                });
                });
			} else {
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsholderlength');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}

function loadwidth(account, accname) {
	$('#DynamicGrid_2').hide();
	var mat_desc=$('#mat_desc').val();
	var wid=$('#wid').val();
	var txttotalweight=$('#txttotalweight').val();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Weight Details... </span> '+ 
    	    	   ' </div>';
    $("#contentwidth").empty();
	$('#contentwidth').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing/widthchargecntrlr');?>",
         data: "partyid=" + account+ "&mat_desc="+mat_desc+"&wid="+wid+"&txttotalweight="+txttotalweight,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGrid_2').hide();
			$('#DynamicGridLoading_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#contentwidth').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			thisdata["Width"] = '';
            thisdata["weight(in M/T)"] = item.weight;
            thisdata["Rate(in M/T)"] = item.rate;
            thisdata["Amount"] = item.amount;
        /*    var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=functionedit('+item.bundlenumber+','+item.notobebilled+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;
			//thisdata["action"] = '';*/
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#contentwidth').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholderwidth');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                var data = {account_name: account};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadwidth(account, accname);
                });
                });
			} else {
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsholderwidth');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}
/*
function total_account(){
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totalcalculation_bill');?>/",  
		data: "txttotalpcs=" + txttotalpcs+ "&txttotalweight="+txttotalweight+"&wid="+wid,
		success: function(msg){
		alert('SAVED');
		refresh_folderlisttwo();
	   }  
	}); 

}*/
/**/
 var json = <?php echo($sdata); ?>;
for(key in json)
{
  if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
}

function weightcount(bundleid){
	var partyid = $('#pid').val();
	var dataString = 'bundleid='+bundleid+'&partyid='+partyid;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/finalbillingcalculate');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg2=eval(msg);
		$.each(msg2, function(i, j){
			 var weight = j.weight;
			document.getElementById("txttotalweight").value = weight;});
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

function totalengthvalue(){
	var actualnumberbundle = $('#actualnumberbundle').val();
	var partyid = $('#pid').val();
	var mat_desc=$('#mat_desc').val();
	var dataString = 'actualnumberbundle='+actualnumberbundle+'&partyid='+partyid+'&mat_desc='+mat_desc;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totalengthvalue');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var rate = j.rate;
			document.getElementById("txttotallength").value = rate;});
	   }  
	}); 
}
function totaweightvalue(){
	
	var txttotalweight=$('#txttotalweight').val();
	var partyid = $('#pid').val();
	var mat_desc=$('#mat_desc').val();
	var wei=$('#wei').val();
	var dataString = 'txttotalweight='+txttotalweight+'&partyid='+partyid+'&mat_desc='+mat_desc+'&wei='+wei;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totaweightvalue');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msgwt=eval(msg);
		$.each(msgwt, function(i, j){
			 var wtrate = j.wtrate;
			document.getElementById("txtweighttotal").value = wtrate;});
	   }  
	}); 
}
function totawidthvalue(){
	var txttotalweight=$('#txttotalweight').val();
	var partyid = $('#pid').val();
	var mat_desc=$('#mat_desc').val();
	var wid=$('#wid').val();
	var dataString = 'txttotalweight='+txttotalweight+'&partyid='+partyid+'&mat_desc='+mat_desc+'&wid='+wid;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totawidthvalue');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msgwd=eval(msg);
		$.each(msgwd, function(i, j){
			 var widrate = j.widrate;
			document.getElementById("txtwidthtotal").value = widrate;});
	   }  
	}); 
}

function totalvalue(bundleid){
	var partyid = $('#pid').val();
	var actualnumberbundle = $('#actualnumberbundle').val();
	var txttotalweight = $('#txttotalweight').val();
	var thic=$('#thic').val();
	var mat_desc=$('#mat_desc').val();
	var cust_add=$('#cust_add').val();
	var cust_rm=$('#cust_rm').val();
	var dataString = 'bundleid='+bundleid+'&partyid='+partyid+'&txttotalweight='+txttotalweight+'&thic='+thic+'&mat_desc='+mat_desc+'&actualnumberbundle='+actualnumberbundle+'&cust_add='+cust_add+'&cust_rm='+cust_rm;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/totalamount_calculate');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg5=eval(msg);
		$.each(msg5, function(i, j){
			 var total = j.total;
			document.getElementById("txtamount").value = total;});
	   }  
	}); 
}
function subtotalvalue(){
	var partyid = $('#pid').val();
	var txtamount_mt = $('#txtamount_mt').val();
	var txttotallength = $('#txttotallength').val();
	var txtweighttotal=$('#txtweighttotal').val();
	var txtwidthtotal=$('#txtwidthtotal').val();
	var txtamount=$('#txtamount').val();
	var resultbundle= parseInt(txtamount_mt) + parseInt(txttotallength) + parseInt(txtweighttotal) + parseInt(txtwidthtotal) + parseInt(txtamount);
	document.getElementById("txtnsubtotal").value = resultbundle;
	taxspec();
}

function taxspec(){
	var txtnsubtotal = $('#txtnsubtotal').val();
	var servicetax=  Math.round(0.12 * parseInt(txtnsubtotal));
	var eductax=  Math.round(0.02 * parseInt(servicetax));
	var secedutax=  Math.round(0.01 * parseInt(servicetax));
	var grandtotal= Math.round(parseInt(txtnsubtotal)+ parseInt(servicetax)+ parseInt(eductax)+ parseInt(secedutax));
	document.getElementById("txtservicetax").value = servicetax;
	document.getElementById("txteductax").value = eductax;
	document.getElementById("txtsecedutax").value = secedutax;
	document.getElementById("txtgrandtotal").value = grandtotal;
}
function functionsave(){
billexist();
 var txtbundleids=$('#txtbundleids').val();
 var mat_desc=$('#mat_desc').val();
 var thic=$('#thic').val();
 var partyid = $('#pid').val();
 var actualnumberbundle = $('#actualnumberbundle').val();
var cust_add=$('#cust_add').val();
var cust_rm=$('#cust_rm').val();
var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length > 0;
 weightcount(actualnumberbundle);
 noofpcs(actualnumberbundle);
 totalvalue(actualnumberbundle);
 totalengthvalue();
 if( atLeastOneIsChecked == false)
 {
  alert('Please select the check box');
  return false;
 }
 else if ( billid == ' ')
  {
  alert('Please Enter the bill number');
 }
 else
 {
 
 var dataString = 'mat_desc='+mat_desc+'&thic='+thic+'&partyid='+partyid+'&actualnumberbundle='+actualnumberbundle+"&cust_add="+cust_add+"&cust_rm="+cust_rm;
$.ajax({  
    type: "POST",  
    url : "<?php echo fuel_url('billing/finalbillingcntrlr');?>/",  
  data: dataString,
  success: function(msg){
  alert('Updated Sheets');
  refresh_folderlisttwo();
 totaweightvalue();
 totawidthvalue();
 presentweight();
    }  
 }); 
 }
}
function showTextBox(id) {

	$(".textBox").show();

}

function functionedit(b,n,ac,bw){
	document.getElementById('bundlenumber').value = b;
	document.getElementById('billed').value = n;
	document.getElementById('bundleweightactual').value = bw;
	document.getElementById('actualnumberbundle').value = ac;

}
function loadtotal_account(bundleid){

	var partyid = $('#pid').val();
	var dataString = 'bundleid='+bundleid+'&partyid='+partyid;
	$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/finalbillingcalculate');?>/",  
	   data: dataString,
	   success: function(msg){
	   }  
	  }); 

}
function functioneditcoil(){
	var bundlenumber = $('#bundlenumber').val();
	var billed = $('#billed').val();
	var pid = $('#pid').val();
	var bundleweightactual = $('#bundleweightactual').val();
	var actualnumberbundle = $('#actualnumberbundle').val();
	var billedweight = $('#billedweight').val();
	countlenvalue();
	if(bundlenumber == '' || billed =='')
	{
		alert('INVALID');
		return false;
	}
	else if(parseInt(billed) > parseInt(actualnumberbundle)){
		alert('Billed number exceeds actual number');
		return false;
	}
	else{
	   var bundleweightcalculate= (((bundleweightactual/actualnumberbundle)*billed)/1000);
	   document.getElementById('billedweight').value = bundleweightcalculate;
	   var dataString = 'bundlenumber='+bundlenumber+'&billed='+billed+'&pid='+pid+'&bundleweightcalculate='+bundleweightcalculate;
	   $.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('billing/editupdate');?>/",  
	   data: dataString,
	   success: function(msg){
		$('#bundlenumber').val('');
		$('#billed').val('');
	   refresh_folderlistone();
	   }  
	  }); 
	}
}


function savebill_details(){
billexist();
	subtotalvalue();
	numbertowords();
	var billid = $('#billid').val();
	var partyid = $('#pid').val();
	var txtamount = $('#txtamount').val();
	var txttotalweight = $('#txttotalweight').val();
	var txtscrap = $('#txtscrap').val();
	var txtoutward_num = $('#txtoutward_num').val();
	var txttotalpcs = $('#txttotalpcs').val();
	var mat_desc = $('#mat_desc').val();
	var thic = $('#thic').val();
	var actualnumberbundle = $('#actualnumberbundle').val();
	var pname = $('#pname').val();
	var wid=$('#wid').val();
	var len=$('#len').val();
	var wei=$('#wei').val();
	var txttotallength=$('#txttotallength').val();
	var txtweighttotal=$('#txtweighttotal').val();
	var txtwidthtotal=$('#txtwidthtotal').val();
	var txtadditional_type=$('#txtadditional_type').val();
	var txtamount_mt=$('#txtamount_mt').val();
	var txtnsubtotal=$('#txtnsubtotal').val();
	var txtservicetax=$('#txtservicetax').val();
	var txteductax=$('#txteductax').val();
	var txtsecedutax=$('#txtsecedutax').val();
	var txtgrandtotal=$('#txtgrandtotal').val();  
	var container=$('#container').val(); 
	var dataString =  'billid='+billid+'&partyid='+partyid+'&txtamount='+txtamount+'&txttotalweight='+txttotalweight+'&txtscrap='+txtscrap+'&txtoutward_num='+txtoutward_num+'&txttotalpcs='+txttotalpcs+'&mat_desc='+mat_desc+'&thic='+thic+'&actualnumberbundle='+actualnumberbundle+'&pname='+pname+'&wid='+wid+'&len='+len+'&wei='+wei+'&txttotallength='+txttotallength+'&txtweighttotal='+txtweighttotal+'&txtwidthtotal='+txtwidthtotal+'&txtadditional_type='+txtadditional_type+'&txtamount_mt='+txtamount_mt+'&txtnsubtotal='+txtnsubtotal+'&txtservicetax='+txtservicetax+'&txteductax='+txteductax+'&txtsecedutax='+txtsecedutax+'&txtgrandtotal='+txtgrandtotal+'&container='+container;
	$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('billing/savebilldetails');?>/",  
		   data: dataString,
		   success: function(msg)
		   { 
		   alert('Preview Selected');
			var partyid = $('#pid').val();
			var actualnumberbundle=$('#actualnumberbundle').val();
			var cust_add=$('#cust_add').val();
			var cust_rm=$('#cust_rm').val();
			var billid=$('#billid').val();
			var dataStringone = 'partyid='+partyid+'&actualnumberbundle='+actualnumberbundle+'&cust_add='+cust_add+'&cust_rm='+cust_rm+'&billid='+billid;
			var url = "<?php echo fuel_url('billing/finalbillgenerate');?>/?"+dataStringone;
		    window.open(url);
			//window.open('url', 'window name', 'window settings');
		//	previewbill();/?&partyid=000911177
		   }  
		}); 
}

function chknumberbilled()
{
	var billed = $('#billed').val();
	var pid = $('#pid').val();
	var bundlenumber = $('#bundlenumber').val();
	var dataString = 'billed='+billed+'&pid='+pid+'&bundlenumber='+bundle_number_text_label;
	  $.ajax({
	  type: "POST",  
	  data: dataString,
	  url	: "<?php echo fuel_url('billing/chknumberbilled');?>/",
	  success: function(msg){ 
	  if(msg == '1'){
	  alert('The Number you are trying to enter is present in the already entered range/s!!!!');
			 $('#billed').val('');
			}
		}
	  });
}	  

function previewbill()
{
	var partyid = $('#pid').val();
	var dataString = 'partyid='+partyid;
    setTimeout("location.href='<?= site_url('billing/finalbillgenerate'); ?>/?"+ dataString+"'", 100);
}
</script>	
