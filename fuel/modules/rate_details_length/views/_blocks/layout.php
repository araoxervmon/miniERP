<div id="innerpanel"> 
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<fieldset>
<legend>Operations</legend>
<form id="userForm" method="post" action="">
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
<input id="priceid" type="hidden" name="priceid"  /><br />
				
						    <td><span><label>Minimum Length in (mm)</label></span></td>
							<td><input id="minlength" type="text" name="Minimum_Length"  onchange="minlength_exist();"/><br /></td>
				
			</tr>
			<tr>
								
							<td><span><label id="max">Maximum Length in (mm)</label></span></td>
							<td><input id= "maxlength" type="text"  name="Maximum_Length" onchange="maxlength_exist();" /><br /></td>
				
			</tr>
			<tr>
				
				
							<td><span><label id="rat">Rate</label></span></td>	
							<td><input id= "rate" type="text"  name="Rate" /><br /></td>
				
			</tr>
</table>


<div class="pad-10">

			<input class="btn btn-success" type="button" value="Save" id="save_id" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input class="btn btn-danger" id="reset" type="reset" value="Reset" onClick="resetForm();" /> &nbsp; &nbsp; &nbsp;
			<input class=" btn-info"  type="button" value="Update/Edit"  id="add_id" onClick="update();" hidden/> &nbsp; &nbsp; &nbsp; 
		</div>

</form>


</fieldset>

<style>.btn-info {
    background-color: #49AFCD;
    background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #FFFFFF;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}</style>

	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div id="party_list">
<div id="contentsholder" class="flexcroll" style="width:100%; height:350px; overflow-x:hidden; overflow-y:auto;">
		<div id="content" style="width:100%; min-height:350px; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				<table cellpadding="0" cellspacing="10" border="2px">
				<div align="center">No Record!</div>
				</table>
			</div>
		</div>
	</div>
	</div>

</div>
   
   <script type="text/JavaScript">
 function confirmDelete(){
var agree=confirm("Are you sure you want to delete this value?");
if(agree)
     return true ;
else
     return false ;
}
</script> 
   
<script language="javascript" type="text/javascript">
function loadfolderlist(account, accname) {
	$('#DynamicGridp_2').hide();
	var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('rate_details_length/listratelength');?>",
        data: "coil=" + account,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGridp_2').hide();
			$('#DynamicGridLoadingp_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#content').html(loading1);  
			} else{
            var ratedata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			//var selectcoil = '<input type="radio" id="radio_'+item.coilnumber+'" name="list" value="'+item.coilnumber+'"   onClick=showchild("'+item.coilnumber+'") />';
			//thisdata["priceid"] = item.priceid;
            thisdata["minlength(in mm)"] = item.minlength;
            thisdata["maxlength(in mm)"] = item.maxlength;
            thisdata["rate(in Rs)"] = item.rate;
			 var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=radioload('+item.minlength+','+item.maxlength+','+item.rate+','+item.priceid+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
			var dl = '<a class="ico_coil_delete" title="Delete" href="'+item.dl+'" onClick=deleteItem('+item.priceid+')><img src="<?php echo img_path('iconset/ico_cancel.png'); ?>" /></a>';
            thisdata["action"] = edit + ' ' + dl;
			//thisdata["action"] = '';
            ratedata.push(thisdata);
			}
			if (ratedata.length) {
            // If there are files
				$('#DynamicGridp_2').hide();
				$('#DynamicGridLoadingp_2').hide();
				$('#content').html(CreateTableViewX(ratedata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholder');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                //var thecont = $(this).data("container");
                //var thename = $(this).data("name");
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
				$('#DynamicGridp_2').hide();
				$('#DynamicGridLoadingp_2').hide();
				var loading1 = '<div id="error_msg"> '+
							   'No Result!'+ 
							   '</div>';
				$('#content').html(loading1); 
				var lfScrollbar = $('#contentsfolder');	 
				fleXenv.updateScrollBars(lcScrollbar);  
                }
			}
    });
}
</script>

 <script type="text/javascript">
 
  function resetForm(){
   document.getElementById('userForm').value=reset;
   $("#save_id").show();
	$("#add_id").hide();
	$("#rate").show();
	$("#max").show();
	$("#maxlength").show();
	$("#rat").show();
 } 
 
 
function radioload(b, a, w, p)
{	$("#save_id").hide();
	$("#add_id").show();
	document.getElementById('minlength').value = b;
	document.getElementById('maxlength').value = a;
	document.getElementById('rate').value = w;
	document.getElementById('priceid').value = p;
	
}


function functionsave()
{
	var minlength = $('#minlength').val();
	var maxlength = $('#maxlength').val();
	var rate = $('#rate').val();
	var coildescription = $('#coil').val();
	if(minlength == '' || maxlength =='' || rate =='')
	{
		alert('Please Enter the values');
		return false;
	}	
	else if(coildescription == 'Select')
	{
	alert('Please Select the coil description');
		return false;
	}
	else{
	var dataString = 'coildescription='+coildescription+'&minlength='+minlength+'&maxlength='+maxlength+'&rate='+rate;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('rate_details_length/saveratedetails');?>/",  
			data: dataString,
			success: function(msg){  
			alert('Saved successfully');
			$('#minlength').val('');
			$('#maxlength').val('');
			$('#rate').val('');
				refresh_folderlist();
			}  
		}); 
	}
		

}



function update()
{
    var priceid = $('#priceid').val();
	var minlength = $('#minlength').val();
	var maxlength = $('#maxlength').val();
	var rate = $('#rate').val();
	//var coildescription = $('#coil').val();
	if(minlength == '' || maxlength =='' || rate =='')
	{
		alert('INVALID');
		return false;
	}
	else{
	var dataString = 'priceid='+priceid+'&minlength='+minlength+'&maxlength='+maxlength+'&rate='+rate;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('rate_details_length/updateratedetails');?>/",
data: dataString,			
			success: function(msg){  
			alert('updated successfully');
			$('#minlength').val('');
			$('#maxlength').val('');
			$('#rate').val('');
			$("#save_id").show();
			$("#add_id").hide();
				refresh_folderlist(); 
			}  
		}); 
	}
		

}

function deleteItem(pd){
	document.getElementById('priceid').value = pd;
	var priceid = $('#priceid').val();
    var checkstr =  confirm('Are you sure you want to delete this?');
	var dataString = 'priceid='+priceid;
	//alert(priceid);
     if(checkstr == true){
	  $.ajax({
	  type: "POST",  
	  data: dataString,
		url	: "<?php echo fuel_url('rate_details_length/deleteratelength_coil');?>/?"+ dataString+"",
			success: function(msg){ 
				refresh_folderlist(); 
			}
		});
    }else{
    return false;
    }
  }

function checkvalue_exist()
{
var minlength = $('#minlength').val();
	var coil = $('#coil').val();
var dataString = 'minlength='+minlength+'&coil='+coil;
  $.ajax({
  url	: "<?php echo fuel_url('rate_details_length/checklengthexist');?>/",
  success: function(msg){  
			alert(msg); 
			}
  });
}

function minlength_exist()
{
	
	var minlength = $('#minlength').val();
	var coil = $('#coil').val();
	var dataString = 'minlength='+minlength+'&coil='+coil;
	  $.ajax({
	  type: "POST",  
	  data: dataString,
	  url	: "<?php echo fuel_url('rate_details_length/minlengthexist');?>/",
	success: function(msg){ 
	  if(msg == '1'){
	  alert('The Number you are trying to enter is present in the already entered range/s!!!!');
			$("#maxlength").hide();
			$("#rate").hide();
			$("#rat").hide();
			$("#max").hide();
			alert('Please click reset button to Restart!!!!');
			
			}
			else {
			}
		}
		
	  });
}	  
function maxlength_exist()
{
		

	var maxlength = $('#maxlength').val();
	var coil = $('#coil').val();
	var dataString = 'maxlength='+maxlength+'&coil='+coil;
	  $.ajax({
	  type: "POST",  
	  data: dataString,
	  url	: "<?php echo fuel_url('rate_details_length/maxlengthexist');?>/",
	  success: function(msg){ 
	  if(msg == '1'){
	  alert('please click reset button!!!!');
			$("#rate").hide();}
			else {
			
			
			}
		}
	 });
}
</script>




