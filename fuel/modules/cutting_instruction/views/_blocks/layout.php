<style>.btn-info {
    background-color: #49AFCD;
    background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #FFFFFF;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}</style>
<div id="innerpanel"> 
<fieldset>
<legend>Coil Details</legend>
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
					<label><?=lang('party_id')?></label>
				</td>  
				<td>
					<input id="pid" name="vIRnumber" type="text" DISABLED />
				</td>
				<td>
					<label><?=lang('party_name')?></label>
				</td>
				<td> 
					<input id="pname" type="text" value="<?php echo $partyname; ?>"  DISABLED />
				</td>
			</tr>
			<tr>	
				<td>
					<label><?=lang('Material_description')?></label>
				</td> 
				<td colspan="3">
					<input id="mat_desc" name="vDescription" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label><?=lang('width_txt')?></label>
				</td> 
				<td>
					<input id="wid" name="fWidth" type="text" DISABLED/> (in mm)
				</td>
				<td>
					<label><?=lang('length_txt')?></label>
				</td>
				<td> 
					<input id="len" type="text" DISABLED />(in mm)
				</td>
			</tr>	
			<tr>
				<td>
					<label><?=lang('thickness_txt')?></label>
				</td>  
				<td>
					<input id="thic" name="fThickness" type="text" DISABLED/>(in mm)
				</td>
				<td>
					<label><?=lang('weight_txt')?></label>
				</td>
				<td> 
					<input id="wei" name="fQuantity" type="text" DISABLED/>(in Kgs)
				</td>
			</tr>
		</table>
	</div>
</fieldset>
	

<fieldset>
<legend>Cutting Instruction</legend>	
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="40%" align="left" valign="top">	
<form id="cisave" method="post" action="">
		<div class="pad-10">
			<div id="bundle_number_text_label" hidden> Bundle Number </div>
			<input id="bundlenumber" type="hidden" name="bundle_number"  />
			<input id="coilname" type="hidden" value="" name="coilname" />
		</div>
		<div class="pad-10">
			<div id="date_text_label"> Date </div>
			<input type="text" id="date1" value="<?php echo date("Y-m-d"); ?>" />
		</div>								
		<div class="pad-10">
			<div id="length_text_label"> Length </div>
			<input id= "length" type="text"  name="Length" /> (in mm)
		</div>
		<div class="pad-10">
			<input type="radio" id="bal_num" name="browser" value="number" onClick="number();" checked>
			<label><?=lang('number_txt')?></label>
			<input type="radio" id="bal_radio" name="browser" value="Balance" onClick="balance();"/>
			<label><?=lang('balance_txt')?></label></br>
			<input id= "rate" type="text"  name="Rate" onkeyup="doweight();" />
		</div>
		<div class="pad-10">
			<div id="bundle_weight_text_label"> Weight  </div>
			<input id="bundleweight" type="text" name="bundle_weight" DISABLED />(in Kgs)
	<!--	<input type="button" value="Approximate Weight" id="weight_id" onclick="doweight();" />-->
		</div>
		<div class="pad-10">
			<!--<input id="newsize" type="button" value="Add New Size" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input id="edit" type="button" value="UPDATE/EDIT" onClick="functionedit();" hidden/> &nbsp; &nbsp; &nbsp;
			<input id="reset" type="reset" value="Reset" onclick="fucntionreset()"/>-->
			<input class="btn btn-success" type="button" value="Add New Size" id="newsize" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input class="btn btn-danger" id="reset" type="reset" value="Reset" onClick="fucntionreset();" /> &nbsp; &nbsp; &nbsp;
			<input class=" btn-info"  type="button" value="UPDATE/EDIT"  id="edit" onClick="functionedit();" hidden/> &nbsp; &nbsp; &nbsp; 
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
<td align="right">

		<label>Total Weight</label>
		<input id="totalweight_calcualation" type="text" DISABLED/>(in Kgs)  
		&nbsp; &nbsp; &nbsp;
		<input class="btn btn-danger" id="cancelcoil" type="button" value="Cancel" onClick="cancelcoil();"/> 
		&nbsp; &nbsp; &nbsp;
		<input class="btn btn-success"  id="saveci" type="button" value="Save" onClick="savechange();"/>  
		&nbsp; &nbsp; &nbsp;
			<div id="check_bar" style="padding-top:10px;">&nbsp;</div>
		<!--<input id="finishci" type="button" value="Finsh" onClick="finishinstructionbutton();"/>-->
</td>
</tr>
</table>
&nbsp; &nbsp; &nbsp;
</fieldset>
</div>


<script language="javascript" type="text/javascript">
function totalweight_check(){
	var partyid = $('#pid').val();
	var dataString = '&partyid='+partyid;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('cutting_instruction/totalweight_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var weight = j.weight;
			document.getElementById("totalweight_calcualation").value = weight;});
	   }  
	}); 
}

function loadfolderlist(account, accname) {
	$('#DynamicGrid_2').hide();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Bundle List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('cutting_instruction/listcoildetails');?>",
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
            thisdata["bundlenumber"] = item.bundlenumber;
			thisdata["processdate"] = item.processdate;
            thisdata["length(in mm)"] = item.length;
            thisdata["noofsheets"] = item.noofsheets;
            thisdata["weight(in Kgs)"] = item.weight;
            //var dl = '<a class="ico_coil_delete" title="Delete" href="'+item.dl+'"><img src="<?php echo img_path('iconset/ico_cancel.png'); ?>" /></a>';
			var dl = '<a class="ico_coil_delete" title="Delete" href="'+item.dl+'" onClick=deleteItem('+item.bundlenumber+')><img src="<?php echo img_path('iconset/ico_cancel.png'); ?>" /></a>';
			
            var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=radioload('+item.bundlenumber+','+item.processdate+','+item.length+','+item.noofsheets+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
            thisdata["action"] =  edit+' '+dl;
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
</script>
<script>
var json = <?php echo($adata); ?>;
for(key in json)
{
  if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
}





function deleteItem(pd){
	document.getElementById('bundlenumber').value = pd;
	var bundlenumber = $('#bundlenumber').val();
	var pid = $('#pid').val();
    var checkstr =  confirm('Are you sure you want to delete this?');
	var dataString = {Bundlenumber : bundlenumber,Pid:pid};
    if(checkstr == true){
      $.ajax({
	    type: "POST",
		url	: "<?php echo fuel_url('cutting_instruction/delete_bundle');?>",
		data : dataString,
		datatype: json,
			success: function(msg){ 
				refresh_folderlist(); 
			}
		});
    }else{
    return false;
    }
  }








function radioload(b, p, l,bn)
{
	$("#edit").show();
	$("#newsize").hide();
	//$("#newsize").hide();
	//document.getElementById('date1').value = p;
	document.getElementById('bundlenumber').value = b;
	document.getElementById('length').value = l;
	document.getElementById('rate').value = bn;
}

function fucntionreset(){
	$('#length').val('');
	$('#rate').val('');
	$('#bundleweight').val('');
	
		$("#edit").hide();
		$("#newsize").show();
}

function finishinstructionbutton(id)
{
	var partyid   =	$('#pid').val();
	var partyname = $('#pname').val();
	var dataString = 'partyid='+partyid+'&partyname='+partyname+'&task=cit';
	$.ajax({  
		type: "POST",  
		success: function(){  
		setTimeout("location.href='<?= site_url('fuel/finish_task'); ?>/?"+ dataString+"'", 3000);
		}
		});
}
 
function dobalanceradio()
{
	var pid   =	$('#pid').val();
	var bundlenumber = $('#nsno').val();
	var date1 = $('#date1').val();
	var length = $('#len').val();
	var rate = $('#rate').val();
	var bundleweight = $('#bundleweight').val();
	//var result= weight-(0.00785 *width*thickness*length)
	//var resultbundle= (0.00000785 *width*thickness*length);

	
	var dataString = 'pid='+pid+'&bundlenumber='+bundlenumber+'&date1='+date1+'&length='+length+'&bundleweight='+bundleweight+'&rate='+rate;
$.ajax({  
		type: "POST",  
		url	: "<?php echo site_url('cutting_instruction/dobalancedetails');?>/",  
		data: dataString,
		success: function(){  
		}
		});
	
}
function savechange(id){
    var pid   =	$('#pid').val();
	var bundlenumber = $('#bundlenumber').val();
	var bundleweight = $('#totalweight_calcualation').val();
	var wei = $('#wei').val();
	if(parseInt(bundleweight) > parseInt(wei) ){
		alert('Sorry the Total weight of bundle is more then weight of coil pleae edit the weight to progress!!');
	}
		
	else{
	$("#check_bar").html('<span style="font-size:20px; color:red">Please wait.. Saving might take some time..</span>');
	'<i class="icon-refresh icon-spin"></i>';
	var dataString = 'pid='+pid+'&bundlenumber='+bundlenumber;
     $.ajax({
                type: 'POST',
                url: "<?php echo fuel_url('cutting_instruction/save_button');?>",
				data: dataString,
                success: function(){  
				$("#check_bar").html('');
				alert("Saved Succesfully");
				refresh_folderlist();
			}
        });
    }
}	
	
function doweight() {
	var pid   =	$('#pid').val();
	var width = $('#wid').val();
	var thickness = $('#thic').val();
	var length = $('#length').val();
	var rate = $('#rate').val();
	var weight = $('#wei').val();
	//alert(width + ' - ' + thickness + ' - ' + length + ' - ' + rate + ' - ' + weight);
	if(width == '' || thickness == '' || length == '' ){
		$('#width').val('');
	//	$('#length').val('');
		$('#rate').val('');
		alert("All fields are mandatory");
	}
	else{
	var result= weight-(0.00000785 *width*thickness*length*rate)
	var resultbundle= (0.00000785 *width*thickness*length*rate);
	var resultbundle = Math.round(resultbundle).toFixed(3);
	document.getElementById('bundleweight').value = resultbundle;
	}
}
/**working on**/

function balance(){
	var bal_radio = document.getElementById('bal_radio');
	var weight = $('#wei').val();
	var pid   =	$('#pid').val();
	var thickness = $('#thic').val();
	//var rate = $('#rate').val();
	var width = $('#wid').val();
	var length = $('#length').val();
	//var resultbundle= (0.00000785 *width*thickness*length*rate);
	
if(bal_radio.checked) {
       // document.getElementById('rate').value = 'rate';
		//document.getElementById('length').value='';
    }
	var dataString = 'weight='+weight+'&pid='+pid;
	
	$.ajax({
                type: 'POST',
                url: "<?php echo fuel_url('cutting_instruction/weightcheck');?>",
				data: dataString,
				success: function(msg){  
				var rate = (msg)/(0.00000785 *width*thickness*length);
				var rate = Math.floor(rate);
				document.getElementById('bundleweight').value=msg;
				document.getElementById('rate').value=rate;
				}
            });
	}
function functionedit(){
	var pid   =	$('#pid').val();
	var bundlenumber = $('#bundlenumber').val();
	var length = $('#length').val();
	var rate = $('#rate').val();
	var bundleweight = $('#bundleweight').val();
	totalweight_check();	
	if(bundlenumber == '' || length =='' || rate =='')
	{
		alert('INVALID');
		return false;
	}
	else{
	   var dataString = 'bundlenumber='+bundlenumber+'&pid='+pid+'&length='+length+'&rate='+rate+'&bundleweight='+bundleweight;
	   $.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('cutting_instruction/editbundle');?>/",  
	   data: dataString,
	   success: function(msg){
		refresh_folderlist();
		$('#bundlenumber').val('');
		$('#length').val('');
		$('#rate').val('');
		$('#bundleweight').val('');
		$("#edit").hide();
		$("#newsize").show();
	   }  
	  }); 
	}
	}
 
 function functionsave(){
 var bundlenumber = $('#bundlenumber').val();
 var date1 = $('#date1').val();
 var pid = $('#pid').val();
 var length = $('#length').val();
 var rate = $('#rate').val();
 var bundleweight = $('#bundleweight').val();
	totalweight_check();	
 if( rate ==''|| bundleweight =='')
 {
  alert('ENTER SOMETHING');
  return false;
 }
 else{
 var dataString = 'bundlenumber='+bundlenumber+'&date1='+date1+'&length='+length+'&rate='+rate+'&pid='+pid+'&bundleweight='+bundleweight;
 alert('SAVED');
  $.ajax({  
   type: "POST",  
   url : "<?php echo fuel_url('cutting_instruction/savebundledetails');?>/",  
   data: dataString,
   success: function(){  
		refresh_folderlist();
		$('#bundlenumber').val('');
		$('#length').val('');
		$('#rate').val('');
		$('#bundleweight').val('');
	}
	});
   /*dataType: "json"
   }).done(function( msg ) {
       refresh_folderlist();
   });*/
 }
}

 function number(){
 var bal_num = document.getElementById('bal_num');
if(bal_num.checked) {
        document.getElementById('rate').value = '';
}
}
	
function cancelcoil(){
	var date1 = $('#date1').val();
	var pid   =	$('#pid').val();
	var bundlenumber = $('#bundlenumber').val();
	var dataString = 'date1='+date1+'&bundlenumber='+bundlenumber+'&pid='+pid;
     $.ajax({
                type: 'POST',
                url: "<?php echo fuel_url('cutting_instruction/cancelcoils');?>",
				data: dataString,
                success: function(){  
				alert("Changed Succesfully");
				refresh_folderlist();
			}
        });
    }
	
</script>