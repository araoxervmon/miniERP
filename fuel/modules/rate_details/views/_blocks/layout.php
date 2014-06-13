<script type="text/javascript">
  $(document).ready(function() {
   $("#save_id").submit(function() {
  functionsave();
  return false;
 });
});

  $(document).ready(function() {
   $("#delete_id").submit(function() {
  functiondelete();
  return false;
 });
});

</script>

<div id="main_content">
<div style="padding:0px 20px 0px 20px; "> 
	<div style=" width:100%; border: 0px solid #D6D7D6; align:center !important; overflow-x: hidden; overflow-y:hidden; right:0;">
	<div style="padding:10px 10px;">
    <div style=" width:100%; height:15%; border: 1px solid #D6D7D6; !important; ">
    <div align="left"> 
		<div style="padding:5px 5px;">
		<div id="min_measurements_text_label"> Minimum Thickness </div><input id="minthickness" style=" padding: 3px 0;" type="text" name="Minimum_Thickness"  /><br />
		</div>
	<div style="padding:5px 5px;">
	<div id="max_measurements_text_label"> Maximum Thickness</div><input id= "maxthickness" style=" padding: 3px 0;" type="text"  name="Maximum_Thickness" /><br />
	</div>
	<input id="coilname" type="hidden" value="" name="coilname">

	<div style="padding:5px 5px;">
	<div id="rate_text_label"> Rate </div><input id= "rate" style=" padding: 3px 0;" type="text"  name="Rate" />
	</div>
	<div style="padding:5px 5px 5px 5px; float:center">
	<a href="javascript:timedRefresh(1000)">
	<input type="submit" value="Add" name="submit" id="add_id" onClick="update();">
	</a>
	
	<a href="javascript:timedRefresh(1000)">
	<input type="button" value="Save" id="save_id" onClick="functionsave();" />
	</a>
	</div>
 </div>
 </div>
 </div>
 
 <div style="padding:10px 10px 0px 10px;">
 <div style=" width:100%; height:15%; border: 1px solid #D6D7D6; !important;  align:center;">
 <div style="padding:10px 10px;">
 <div style=" width:60%; height:15%; border: 0px solid #D6D7D6; !important;  align:center;">
 <div style="align:center !important; width:100%; border:1px solid #D6D7D6; height:200px; overflow-x:auto; overflow-y:auto;">
<form name="form" method="POST">
<table align="center !important" width="100%"  border="1px" cellspacing="0" cellpadding="0">
	<tr>
		<th>Select</th>&nbsp;
		<th><div id="min_label"> Minimum Thickness </div></th>&nbsp;
		<th><div id="max_label"> Maximum Thickness</div></th>&nbsp;
		<th><div id="rate_text_label"> Rate(Rs.)</div></th>
		<th style="display:none;">Party id</th>
	</tr>
<?php
  if (!empty($gdata)){
  $i=1;
    foreach($gdata as $folder)
    {
		
    echo '
      <tr>
	  <td align="center" valign="top">  
		<input type="radio" id="radio_'.$i.'" name="list" value="'.$i.'"  onclick="radioload('.$i.')" />
	  </td> 
     
	  <td align="center" valign="top">  
		<input id="mint'.$i.'" value="'.$folder->nMinThickness .'"  />   
	</td>   
		
	  <td align="center" valign="top"> 
		<input id="maxt'.$i.'" value="'.$folder->nMaxThickness .'" />   
	</td>   
		
	<td align="center" valign="top"> 
		<input id="r'.$i.'" value="'.$folder->nAmount .'" />   
    </td>  
	
	<td align="center" valign="top" style="display:none;">  
		<input id="price'.$i.'" value="'.$folder->nPriceId .'"  />   
	</td> 	
    	
	</tr>';
	$i++;
}
}else
{
	echo '<tr><td>';
	echo 'NO RESULT!!!';
	echo '</td></tr>';
}
?> 
</table>
</form> 
</div>
</div>
</div>
</div>
</div>
   <div style="padding-left:10px;">
   <div style=" width:100%; height:15%; border: 0px solid #D6D7D6; !important;  align:center;">
   <div style="padding-top:20px;">
   <form id="deletefrm" method="post" action="">
   <input id="deletevalue" type="hidden" name="deletevalue"  />
  <a href="javascript:timedRefresh(1000)"> <input type="button" value="Delete" id="delete_id" onClick="deleterecord();" /></a>
   <span id="deletemsg"> </span>
   </form>
   </div>  
   </div>  
   </div>  
   
<div style="padding:10px 10px;">
  <div style=" width:100%; height:15%; border: 1px solid #D6D7D6; !important;  align:center;">
  <div align="center;">
	<table width="60%;">
		<tr>
		<th>
		<div class="spacer end">
		<input type="button" value="<?=lang('length_btn')?>" class="ico ico_create_container" onclick="changeLinklength()"  name="modal"  >
		</div>
		</th>
		<th>
		<div class="spacer end">
	   <input type="button" value="<?=lang('width_btn')?>" id="width_btn"  onclick="changeLinkwidth()"  name="modal"  >
	   </div>
	   </th>
		<th>
	   <div class="spacer end">
	   <input type="button" value="<?=lang('weight_btn')?>" class="ico ico_delete_container" onclick="changeLinkweight()"  name="modal"  >
	   </div>
	   </th>
		<th>
	   <div class="spacer end">
		<input type="button" value="<?=lang('thickness_btn')?>" class="ico ico_delete_container" onclick="changeLinkthickness()"  name="modal"  >
	   </div>
	   </th>
		</tr>
  </table>
</div>
</div>
</div>
</div>
</div>
</div>
   
  <div class="tabcontentstorage hidestorage" id="contstorage-2-1"> 
  <div style="padding-bottom:10px;">
  <div class="storageboxcorner">
  <h2 class="innercellcstorage" style="margin-bottom:0px !important;">
  <div style="padding:10px 5px 5px; font-size:14px; color:#231f20;"><?=lang('upload_file')?></div></h2>
 
  </div>
  </div>
  </div> 
<script type="text/javascript">
function changeLinklength()
{
document.getElementById('min_measurements_text_label').innerHTML="Minimum Length";
document.getElementById('max_measurements_text_label').innerHTML="Maximum Length";
document.getElementById('min_label').innerHTML="Minimum Length";
document.getElementById('max_label').innerHTML="Maximum Length";
}

function changeLinkweight()
{
document.getElementById('min_measurements_text_label').innerHTML="Minimum Weight";
document.getElementById('max_measurements_text_label').innerHTML="Maximum Weight";
document.getElementById('min_label').innerHTML="Minimum Weight";
document.getElementById('max_label').innerHTML="Maximum Weight";
}
function changeLinkthickness()
{
document.getElementById('min_measurements_text_label').innerHTML="Minimum Thickness";
document.getElementById('max_measurements_text_label').innerHTML="Maximum Thickness";
document.getElementById('min_label').innerHTML="Minimum Thickness";
document.getElementById('max_label').innerHTML="Maximum Thickness";
}

function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}


/*	function deleteElement($name1){ 
	var el = document.getElementById($name1);
	el.parentNode.removeChild(el);
	return false;
}*/
</script> 
<script type="text/javascript">
 function functionsave()
{
	var minthickness = $('#minthickness').val();
	var maxthickness = $('#maxthickness').val();
	var rate = $('#rate').val();
	var coildescription = $('#coil').val();
	if(minthickness == '' || maxthickness =='' || rate =='')
	{
		alert('INVALID');
		return false;
	}
	else{
	var dataString = 'coildescription='+coildescription+'&minthickness='+minthickness+'&maxthickness='+maxthickness+'&rate='+rate;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('rate_details/saveratedetails');?>/",  
			data: dataString,
			success: function(msg){  
			}  
		}); 
	}
		

}

function deleterecord()
{
var deleteid = $('#deletevalue').val();
var dataString = 'partyid='+deleteid;
	//JSON.stringify(dataString, replacer);
	$.ajax({  
		type: "POST",  
		url	: "<?php echo fuel_url('rate_details/deleterow');?>/",  
		data: dataString,
		success: function(msg){  
		$("#deletemsg").html(msg);
		$('#deletevalue').val('');
		setTimeout("location.href='<?= site_url('fuel/rate_details'); ?>'", 3000);
		}  
	}); 
}


function update()
{
	var minthickness = $('#minthickness').val();
	var maxthickness = $('#maxthickness').val();
	var rate = $('#rate').val();
	var coildescription = $('#coil').val();
    var deleteid = $('#deletevalue').val();
	if(minthickness == '' || maxthickness =='' || rate =='')
	{
		alert('INVALID');
		return false;
	}
	else{
	var dataString = 'partyid='+deleteid+'&coildescription='+coildescription+'&minthickness='+minthickness+'&maxthickness='+maxthickness+'&rate='+rate;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('rate_details/updateratedetails');?>/",  
			data: dataString,
			success: function(msg){  
			}  
		}); 
	}
		

}


</script>
<script type="text/javascript">
/*function loadrecordlist() {
	$.ajax({
        type: "POST",
        url: "<?php echo fuel_url('rate_details/deleterow');?>",
        // Account name
        data: '',
        dataType: "json"
        }).done(function( msg ) {
			for (var i = 0; i < msg.length; i++) {
                var li = $("<li>");
                var anch = $("<a>");
                anch.html(msg[i].text);
                li.attr("id", "partyid."+deleteid+"."+msg[i].id);
                li.append(anch);
                ul.append(li);
            }
		}
}*/
</script>

<script type="text/javascript">
function radioload(id)
{
	var minthickness = $('#mint'+id).val();
	var maxthickness = $('#maxt'+id).val();
	var amount = $('#r'+id).val();
	var priceid = $('#price'+id).val();
	if(minthickness == '' || maxthickness == '' || amount == ''){
		$('#minthickness').val('');
		$('#maxthickness').val('');
		$('#rate').val('');
	}
	else 
	{
		document.getElementById('minthickness').value = minthickness;
		document.getElementById('maxthickness').value = maxthickness;
		document.getElementById('rate').value = amount;
		document.getElementById('deletevalue').value = priceid;
	}
	
}
function changeLinkwidth()
{
var width = $('#width_btn').val();
var dataString = 'width='+width;
  $.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('rate_details/tablewidth');?>/",  
			data: dataString,
			success: function(msg){  
			}  
		});

	
}
</script>


