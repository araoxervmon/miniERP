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
				<input id="wei" name="wei" type="text"  value="<?php echo $weight; ?>"DISABLED />(in Kgs)
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

var json =<?php echo($semidata); ?>;
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
	var partyid  =	$('#pid').val();
	var partyname = $('#pname').val();
	var weight = $('#wei').val();
	var dataString = 'partyid='+partyid+'&partyname='+partyname+'&processchk=sf'+'&weight='+weight;
    $.ajax({
        type: 'POST',
        success: function(){  alert('Preview Selected')
		setTimeout("location.href='<?= site_url('fuel/billing'); ?>/?"+ dataString+"'", 1000);
		}
    });
}
</script>