<script type="text/javascript">
function finiswp(id)
{
    var pid   =	$('#coilid').val();
    var pname =	$('#partyid').val();
	
	var dataString = 'partyid='+pid+'&partyname='+pname+'&task=wip';
	$.ajax({  
		type: "POST",  
		url : "<?php echo fuel_url('finish_task/finishwp');?>/",
		data: dataString,
		success: function(){  
		setTimeout("location.href='<?= fuel_url('finish_task'); ?>/?"+ dataString+"'", 3000);
		}
		});
	
	}
 </script> 
 <script>
var section = "demos/datepicker";
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	
var section = "demos/datepicker";
	$(function() {
		$( "#datepickerto" ).datepicker();
	});	

</script><div id="action">
 <div id="actions" class="erpbuttonbar">
 <table cellpadding="0" cellspacing="0" border="0" width="100px">
<tr>
 <td><span style="font-size:18px" >From:</span></td>
 <td><input  id= "datepicker" class="datepicker" type="text" name="reportdatefrom" /></td>
 <td><span style="font-size:18px" >To:</span></td>
 <td><input  id= "datepickerto" class="datepickerone" type="text" name="reportdatefrom" /></td>
 <td><input id="txtgo" type="button" onclick="" value="GO"></td>
 </tr>
 </table>
 </div>
</div>
<div id="msgtext"></div>