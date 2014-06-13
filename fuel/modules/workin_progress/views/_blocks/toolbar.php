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
 <div id="msgtext"></div>