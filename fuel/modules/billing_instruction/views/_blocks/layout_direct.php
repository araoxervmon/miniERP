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
		<input class="btn btn-success" id="save" type="button" value="Preview The Bill"  onClick="billingbuttondirect();"/>
		<input class="btn btn-danger" id="new" type="button" value="Close" onClick="closebutton();" />
		<input type="hidden" id="txtrs" name='txtrs' value=''  />
		<input type="hidden" id="processchk" name='processchk' value=''  />
  
   </form>
</div> 
<script>

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

function billingbuttondirect(){
	var processchk = $('#processchk').val();
	var partyid  =	$('#pid').val();
	var partyname = $('#pname').val();
	var dataString = 'partyid='+partyid+'&partyname='+partyname+'&processchk='+processchk;
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