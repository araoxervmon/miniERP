<div id="innerpanel"> 
  <form id="bil_ins" method="post" action="" class="bil_ins">
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
				<label><?=lang('coil_no')?></label>
				</td> 
				<td>
				<input id="pid" name="vIRnumber" type="text" DISABLED /> 
				</td>
			</tr>
			<tr>
				<td>
				<label><?=lang('coil_desc')?></label>      
				</td>
				<td> 
				<input id="mat_desc" name="vDescription" type="text" DISABLED/>
				</td>
			</tr> 
			<tr>
				<td>  
				<label><?=lang('thickness')?></label>
				</td> 
				<td>
				<input id="thic" name="fThickness" type="text" DISABLED/>(in mm)
				</td>	  
			</tr>
			<tr>
				<td>
				<label><?=lang('width')?></label>
				</td> 
				<td>
				<input id="wid" name="fWidth" type="text" DISABLED/> (in mm)
				</td>
			</tr>
			<tr>
				<td>
				<label><?=lang('weight')?></label>
				</td> 
				<td>
				<input id="wei" name="fQuantity" type="text" DISABLED />(in Kgs)
				</td>
			</tr>
			<tr>
				<td>
				<label><?=lang('inv_no')?></label>
				</td> 
				<td>
				<input id="inv_no" name="vInvoiceNo" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
				<label><?=lang('Party_Name')?></label>
				</td> 
				<td>
				<input id="pname" name="nPartyName" type="text" value="<?php echo $partyname; ?>"DISABLED/>
				</td>
			</tr>
		</table>
		<fieldset>
			<legend>Slitting Details</legend>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<div id="contentsholder" class="flexcroll" style="width:100%; height:350px; overflow-x:hidden; overflow-y:auto;">
			<div id="content" style="width:100%; min-height:350px; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				No Record!
			</div>
			</div>
			</div>										
			</table>
		</fieldset>
		<input class="btn btn-success" id="save" type="button" value="Preview The Bill"  onClick="billingbuttonslit();"/>
		<input class="btn btn-danger" id="new" type="button" value="Close" onClick="closebutton();" />
		<input type="hidden" id="txtrs" name='txtrs' value=''  />
		<input type="hidden" id="processchk" name='processchk' value=''  />
  
   </form>
</div>  

<script>
function updateTextAreaslit() {         
         var allVals = [];
         $('#content :checked').each(function() {
           allVals.push($(this).val());
         });
         $('#txtrs').val(allVals)
      }

function loadfolderlist_slit(account, accname) {
	$('#DynamicGrid_2').hide();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Slit List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
	processchk();
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('billing_instruction/loadfolderlistslit');?>",
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
			
			var selectbundle = '<input class="checkbundle" type="checkbox" id="check_'+item.serialnumber+'" name="list" value="'+item.serialnumber+'" onClick=updateTextAreaslit('+item.slitnumber+') />';
			thisdata["select"] = selectbundle;
			thisdata["serialnumber"] = item.serialnumber;
            thisdata["slitnumber"] = item.slitnumber;
            thisdata["width"] = item.width;
            thisdata["sdate"] = item.sdate;
            thisdata["number to be billed"] = item.noofsheetsbilled;
            thisdata["Billing status"] = item.billingstatus;
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
                loadfolderlist_slit(account, accname);
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

  
var json =<?php echo($sdata); ?>;
for(key in json){
	if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
}

function closebutton(){
	$.ajax({  
		type: "POST",  
		success: function(){  
		setTimeout("location.href='<?= site_url('fuel/dashboard'); ?>'", 3000);
		}
	});
}

function billingbuttonslit(){
	var slno = $('#txtrs').val();
	var processchk = $('#processchk').val();
	var partyid  =	$('#pid').val();
	var partyname = $('#pname').val();
	var dataString = 'partyid='+partyid+'&partyname='+partyname+'&slno='+slno+'&processchk='+processchk;
    $.ajax({
        type: 'POST',
        success: function(){  alert('Preview Selected')
		setTimeout("location.href='<?= site_url('fuel/billing'); ?>/?"+ dataString+"'", 1000);
		}
    });
}
function processchk(){
	var pid  =	$('#pid').val();
	var dataString = 'pid='+pid;
  $.ajax({
            type: 'POST',
			url: "<?php echo fuel_url('billing_instruction/processchk');?>",
			data: dataString,
			success: function(msg){
			var msg5=eval(msg);
			$.each(msg5, function(i, j){
			 var pvalue = j.process;
			document.getElementById("processchk").value = pvalue;});
	   }  
	});
}

</script>