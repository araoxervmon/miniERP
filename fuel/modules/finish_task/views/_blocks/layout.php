
<style>.btn-inforecoil {
    background-color: #49AFCD;
    background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #FFFFFF;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}
.btn-infoslitting {
    background-color: #49AFCD;
    background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #FFFFFF;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}
</style>
<div id="innerpanel"> 
<fieldset>
<legend>Coil Details</legend>
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
					<label>System Date</label>
				</td>  
				<td>
					<input type="text" id="date" value="<?php echo date("d-m-Y"); ?>" DISABLED/>
				</td>
				<td>
					<label><?=lang('party_id')?></label>
				</td>  
				<td>
					<input id="pid" name="vIRnumber" type="text" DISABLED/>
				</td>
				
			</tr>
			<tr>
				<td>
					<label><?=lang('party_name')?></label>
				</td>
				<td> 
					<input id="pname" type="text" value="<?php echo $partyname; ?>"  DISABLED/>
				</td>	
				<td>
					<label><?=lang('Material_description')?></label>
				</td> 
				<td colspan="3">
					<input id="mat_desc" name="vDescription" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label><?=lang('width_txt')?> (in mm)</label>
				</td> 
				<td>
					<input id="wid" name="fWidth" type="text" DISABLED/>
				</td>
				<td>
					<label><?=lang('thickness_txt')?> (in mm)</label>
				</td>  
				<td>
					<input id="thic" name="fThickness" type="text" DISABLED/>
				</td>
			</tr>	
			<tr>
				<td>
					<label><?=lang('weight_txt')?> (in Kgs)</label>
				</td>
				<td> 
					<input id="wei" name="fQuantity" type="text" DISABLED/>
				</td>
				<td>
					<label>Inward Date</label>
				</td>
				<td> 
					<input id="inwdate" name="dInvoiceDate" type="text" DISABLED />
				</td>
			</tr>
		</table>
	</div>
</fieldset>
<fieldset>
<legend>Finish Instruction</legend>	
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="40%" align="left" valign="top">	
<form id="cisave" method="post" action="">
<div class="pad-10">
			<div id="bundlenumber"> Bundlenumber </div>
			<input id= "txtbundlenumber" type="text"  name="bundlenumber" />
		
		</div>
		<div class="pad-10">
			<div id="actual"> Actual Numbers </div>
			<input id= "txtactual" type="text"/> 
			<input id="coilname" type="hidden" value="" name="coilname" />
		</div>
		<div class="pad-10">
			<div id="weight"> Weight  (in Kgs)</div>
			<input id= "txtweight" type="text" />
		</div>
		<div class="pad-10">
			<!--<input id="save" type="button" value="EDIT/SAVE" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input id="reset" type="reset" value="Reset" />-->
			<input class="btn btn-success" type="button" value="Save" id="save_id" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input class="btn btn-danger" id="reset" type="reset" value="Reset" />
		</div>
		<div class="pad-10">
			<div id="bundleids"> </div>
			<input id= "txtbundleids" type="hidden" /> 
			<input id= "txtbundlestatus" type="hidden" /> 
			<input id= "txtbundleweight" type="hidden" /> 
		</div>
</form>
</td>
<td width="60%" align="left" valign="top">							
    <div id="contentsholder" class="flexcroll" style="width:100%; height:350px; overflow-x:hidden; overflow-y:auto;">
		<div id="content" style="width:100%; min-height:350px; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
		</div>
	</div>
</td>
</tr>
<td>	
</td>
<tr>
<td align="left" colspan="2">
	<div class="pad-10">
		<label>Total Weight in Kg</label>
		<input id="txtboxweight" type="text"  /> &nbsp; &nbsp; &nbsp;
	<!--	<label>Scrap</label>
		<input id="txtboxscrap" type="text" />(No of pcs) &nbsp; &nbsp; &nbsp;
		<input id="gobutton" type="button" value="Go" /> -->
		<table align="right">
		<tr>
		<td><div align="right"><input class=" btn-info" id="finishci" type="button" value="Finsh Cutting" onClick="functionfinish();"/></div></td>
		<td><div align="right"><input class=" btn-inforecoil" id="finishre" type="button" value="Finsh Recoil" onClick="functionrecoil();" hidden/></div></td>
		<td><div align="right"><input class=" btn-infoslitting" id="finishsi" type="button" value="Finsh Slitting" onClick="functionslit();" hidden/></div></td>
		</tr>
		</table>
	</div>
</td>
</tr>
</table>
</fieldset>
</div>


<script language="javascript" type="text/javascript">
function loadfolderlist(account, accname) {
	$('#DynamicGrid_2').hide();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('finish_task/listfinishdetails');?>",
        data: "partyid=" + account,
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
			if(item.status=='WIP-Cutting'){
			var selectbundle = '<input type="radio" SELECTED id="radio_'+item.bundlenumber+'" name="list" value="'+item.bundlenumber+'" onClick=selectbundleid('+item.bundlenumber+',"'+item.status+'",'+item.bundleweight+') />';
			thisdata["select"] = selectbundle;
			thisdata["bundlenumber"] = item.bundlenumber;
            thisdata["date"] = item.date;
            thisdata["length(in mm)"] = item.length;
            thisdata["actualnumber"] = item.actualnumber;
        //  thisdata["totalweight"] = item.totalweight;
            thisdata["bundleweight(in Kgs)"] = item.bundleweight;
            thisdata["status"] = item.status;
        //  thisdata["weight"] = item.weight;
            var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=radioload('+item.bundlenumber+','+item.actualnumber+','+item.weight+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;
			//thisdata["action"] = '';
			}
			
			else if(item.status=='WIP-Recoiling'){
			var selectcoil = '<input type="radio" SELECTED id="radio_'+item.recoilnumber+'" name="list" value="'+item.recoilnumber+'" onClick=radiorecoil('+item.recoilnumber+',"'+item.status+'",'+item.norecoil+') />';
			thisdata["select"] = selectcoil;
			thisdata["recoilnumber"] = item.recoilnumber;
            thisdata["startdate"] = item.startdate;
            thisdata["enddate"] = item.enddate;
            thisdata["norecoil"] = item.norecoil;
            thisdata["status"] = item.status;
            var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=editrecoil('+item.recoilnumber+','+item.norecoil+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;
			}
			else if(item.status=='WIP-Slitting'){
			var selectslit = '<input type="radio" SELECTED id="radio_'+item.slittnumber+'" name="list" value="'+item.slittnumber+'" onClick=radioslitt('+item.slittnumber+',"'+item.status+'",'+item.width+') />';
			thisdata["select"] = selectslit;
			thisdata["slittnumber"] = item.slittnumber;
            thisdata["date"] = item.date;
            thisdata["width"] = item.width;
            thisdata["status"] = item.status;
            var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=editslit('+item.slittnumber+','+item.width+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit;
			}
			else if(item.status=='Ready To Bill' && item.process=='Cutting'){
			
			thisdata["select"] = '';
			thisdata["bundlenumber"] = item.bundlenumber;
            thisdata["date"] = item.date;
            thisdata["length"] = item.length;
            thisdata["actualnumber"] = item.actualnumber;
        //  thisdata["totalweight"] = item.totalweight;
            thisdata["bundleweight"] = item.bundleweight;
            thisdata["status"] = item.status;
        //    thisdata["process"] = item.process;
			
			}
			else if(item.status=='Ready To Bill' && item.process=='Recoiling'){
			
			thisdata["select"] = '';
			thisdata["recoilnumber"] = item.recoilnumber;
            thisdata["startdate"] = item.startdate;
            thisdata["enddate"] = item.enddate;
            thisdata["norecoil"] = item.norecoil;
            thisdata["status"] = item.status;
        //   thisdata["process"] = item.process;
			}
			else if(item.status=='Ready To Bill' && item.process=='Slitting'){
			
			thisdata["select"] = '';
			thisdata["slittnumber"] = item.slittnumber;
            thisdata["date"] = item.date;
            thisdata["width"] = item.width;
            thisdata["status"] = item.status;
        //    thisdata["process"] = item.process;
			}
			partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGrid_2').hide();
				$('#DynamicGridLoading_2').hide();
				$('#content').empty();
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
				$(".ico_coil_edit").click(function (e) {
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


function selectbundleid(s,r,w){	

	document.getElementById('txtbundleids').value = s;	
	document.getElementById('txtbundlestatus').value = r;	
	document.getElementById('txtbundleweight').value = w;

	var txtbundlestatus  =	$('#txtbundlestatus').val();
	if(txtbundlestatus=='WIP-Cutting'){
	$("#finishre").hide();
	$("#finishsi").hide();}
}


function radioload(b, a, w){
	document.getElementById('txtweight').value = w;
	document.getElementById('txtbundlenumber').value = b;
	document.getElementById('txtactual').value = a;
}



function editrecoil(rn, norecoil){

document.getElementById('bundlenumber').innerHTML="Recoil Number";
document.getElementById('actual').innerHTML="Number of Recoil";
	//document.getElementById('txtweight').value = w;
	document.getElementById('txtbundlenumber').value = b;
	document.getElementById('txtactual').value = a;
	
	$("#txtweight").hide();
	$("#weight").hide();
	
}
/*function radiorecoil(s,r,w){
	//document.getElementById('txtweight').value = w;
	document.getElementById('txtbundleids').value = b;
	document.getElementById('txtactual').value = a;
}*/



function radiorecoil(s,r,w){	
	document.getElementById('txtbundleids').value = s;	
	document.getElementById('txtbundlestatus').value = r;	
	document.getElementById('txtbundleweight').value = w;	
	
		var txtbundlestatus  =	$('#txtbundlestatus').val();
	if(txtbundlestatus=='WIP-Recoiling'){
	$("#finishci").hide();
	$("#finishsi").hide();
	$("#finishre").show();}
	
}
function radioslitt(s,r,w){	
	document.getElementById('txtbundleids').value = s;	
	document.getElementById('txtbundlestatus').value = r;	
	document.getElementById('txtbundleweight').value = w;	
	
		var txtbundlestatus  =	$('#txtbundlestatus').val();
	if(txtbundlestatus=='WIP-Slitting'){
	$("#finishci").hide();
	$("#finishsi").show();
	$("#finishre").hide();}
	
}


var json =<?php echo($adata); ?>;
for(key in json){
	if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
}

function totalweightcount(){
	var pid  =	$('#pid').val();
	var dataString = '&pid='+pid;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('finish_task/totalweightcountcalculate');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg2=eval(msg);
		$.each(msg2, function(i, j){
			 var bundleweight = j.bundleweight;
			document.getElementById("txtboxweight").value = bundleweight;});
	   }  
	}); 
}
function functionsave(){	
	var pid  =	$('#pid').val();
	var bundlenumber = $('#txtbundlenumber').val();
	var actual = $('#txtactual').val();
	var weight = $('#txtweight').val();
	if(bundlenumber == '' || actual =='' )
	{
		alert('INVALID');
		return false;
	}
else{
	   var dataString = 'bundlenumber='+bundlenumber+'&actual='+actual+'&weight='+weight+'&pid='+pid;
	   $.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('finish_task/saveweightdetails');?>/",  
	   data: dataString,
	   success: function(msg){
	totalweightcount();
	   $('#txtbundlenumber').val('');
		$('#txtactual').val('');
		$('#txtweight').val('');
		refresh_folderlist();
	   }  
	  }); 
	}
}



function editrecoil(b, a, w){

document.getElementById('bundlenumber').innerHTML="Recoil Number";
document.getElementById('actual').innerHTML="Number of Recoil";
	//document.getElementById('txtweight').value = w;
	document.getElementById('txtbundlenumber').value = b;
	document.getElementById('txtactual').value = a;
	$("#txtweight").hide();
	$("#weight").hide();
}


function editslit(b, a, w){

document.getElementById('bundlenumber').innerHTML="Slit Number";
document.getElementById('actual').innerHTML="Number of Slits";
	//document.getElementById('txtweight').value = w;
	document.getElementById('txtbundlenumber').value = b;
	document.getElementById('txtactual').value = a;
	$("#txtweight").hide();
	$("#weight").hide();
}


function functionfinish() {
 var txtbundleids = $('#txtbundleids').val();
 var txtbundleweight = $('#txtbundleweight').val(); 
 var txtbundlestatus = $('#txtbundlestatus').val();
 var txtboxscrap = $('#txtboxscrap').val();
 var pid  = $('#pid').val();
 var pname = $('#pname').val();
 var txtboxweight = $('#txtboxweight').val();
 var wei = $('#wei').val();
 if(!$("input[name='list']:checked").val())
 {
  alert('Please select the Radio button');
  return false;
 }
 else if(parseInt(txtboxweight) > parseInt(wei) ){
		alert('Sorry the Total weight of bundle is more then weight of coil pleae edit the weight to progress!!');
	}
 else
 {
 var dataString = 'pid='+pid+'&pname='+pname+'&txtbundleids='+txtbundleids+'&txtbundleweight='+txtbundleweight+'&txtboxscrap='+txtboxscrap;
    $.ajax({
        type: 'POST',
        url: "<?php echo fuel_url('finish_task/statuschange');?>",
        data: dataString,
        success: function(){ 
//	window.location.reload();
  refresh_folderlist();
  }
    });
 }
}




function functionslit() {
 var txtbundleids = $('#txtbundleids').val();
 var txtbundleweight = $('#txtbundleweight').val(); 
 var txtbundlestatus = $('#txtbundlestatus').val();
 var txtboxscrap = $('#txtboxscrap').val();
 var pid  = $('#pid').val();
 var pname = $('#pname').val();
if(!$("input[name='list']:checked").val())
 {
  alert('Please select the Radio button');
  return false;
 }
 else
 {
 var dataString = 'pid='+pid+'&pname='+pname+'&txtbundleids='+txtbundleids+'&txtbundleweight='+txtbundleweight+'&txtboxscrap='+txtboxscrap;
    $.ajax({
        type: 'POST',
        url: "<?php echo fuel_url('finish_task/statuschangeslit');?>",
        data: dataString,
        success: function(){ 
	
  alert("Finished Complete");
  refresh_folderlist();
  }
    });
 }
}












function functionrecoil() {
 var txtbundleids = $('#txtbundleids').val();
 var txtbundleweight = $('#txtbundleweight').val(); 
 var txtbundlestatus = $('#txtbundlestatus').val();
 var txtboxscrap = $('#txtboxscrap').val();
 var pid  = $('#pid').val();
 var pname = $('#pname').val();
 if(!$("input[name='list']:checked").val())
 {
  alert('Please select the Radio button');
  return false;
 }
 else
 {
 var dataString = 'pid='+pid+'&pname='+pname+'&txtbundleids='+txtbundleids+'&txtbundleweight='+txtbundleweight+'&txtboxscrap='+txtboxscrap;
    $.ajax({
        type: 'POST',
        url: "<?php echo fuel_url('finish_task/statuschangerecoil');?>",
        data: dataString,
        success: function(){ 
	
  alert("Finished Complete");
  refresh_folderlist();
  }
    });
 }
}
</script>