<style>.btn-info {
    background-color: #49AFCD;
    background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #FFFFFF;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}</style>
<div id="innerpanel"> 
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<fieldset>
<legend>Tax Details</legend>
<form id="userForm" action="">
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td id="txttaxid" type="text">Tax ID</td>
				<td><input id="taxid" type="text" name="taxid"  /><br /></td>
				
				
			</tr>
			<tr>
							<td id="txttaxtype"> Type of Tax </td>
							<td><input id= "taxtype" type="text"  name="taxtype" /><br /></td>
				
			</tr>
			<tr>
				
				
							<td><span><label>Percentage</label></span></td>	
							<td><input id= "percentage" type="text"  name="percentage" /><br /></td>
				
			</tr>
</table>


<div class="pad-10">
		<!--	<input type="button" value="Update/Edit"  id="add_id" onClick="update();"hidden /> &nbsp; &nbsp; &nbsp;
			<input type="button" value="Save" id="save_id" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input id="reset" type="reset" value="Reset" onClick="resetForm();" /> &nbsp; &nbsp; &nbsp;-->
			<input class="btn btn-success" type="button" value="Save" id="save_id" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input class="btn btn-danger" id="reset" type="reset" value="Reset" onClick="resetForm();" /> &nbsp; &nbsp; &nbsp;
			<input class="btn-info"  type="button" value="Update/Edit"  id="add_id" onClick="update();" hidden/> &nbsp; &nbsp; &nbsp; 
		</div>

</form>


</fieldset>

	
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
        url: "<?php echo fuel_url('tax_details/listtaxdetails');?>",
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
            thisdata["taxid"] = item.taxid;
            thisdata["taxtype"] = item.taxtype;
            thisdata["percentage"] = item.pecentage;
			var edit = '<a class="ico_coil_edit" title="Edit" href="#" onClick=radioload('+item.taxid+','+item.pecentage+')><img src="<?php echo img_path('iconset/ico_edit.png'); ?>" /></a>';
			var dl = '<a class="ico_coil_delete" title="Delete" href="'+item.dl+'" onClick=deletetax('+item.taxid+')><img src="<?php echo img_path('iconset/ico_cancel.png'); ?>" /></a>';
            thisdata["action"] =  dl + '  ' + edit;
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
 



 
 function deletetax(id){
	document.getElementById('taxid').value = id;
	var taxid = parseInt($('#taxid').val());
    var checkstr =  confirm('Are you sure you want to delete this?');
	var dataString = 'taxid='+taxid;
//	alert(taxid);
    if(checkstr == true){
      $.ajax({
		url	: "<?php echo fuel_url('tax_details/deletetax');?>/?"+ dataString+"",
			success: function(msg){ 
				refresh_folderlist(); 
			}
		});
    }else{
    return false;
    }
  }
 
 
 function resetForm(){
   document.getElementById('userForm').value=reset;
   document.getElementById('txttaxtype').innerHTML="Type of Tax";
   $("#save_id").show();
	$("#add_id").hide();
	 $("#taxtype").show();
 } 
 



function radioload(p,w)
{	$("#save_id").hide();
	$("#add_id").show();
	$("#taxtype").hide();
	$("#taxid").show();
	document.getElementById('txttaxtype').innerHTML="";
	document.getElementById('taxid').value = p;
	document.getElementById('percentage').value = w;
}



function functionsave()
{
	//var taxid = $('#taxid').val();
	var taxtype = $('#taxtype').val();
	var percentage = $('#percentage').val();
	//var coildescription = $('#coil').val();
	if( taxtype =='' || percentage =='')
	{
		alert('Please Enter the values');
		return false;
	}	

	else{
	var dataString = 'taxtype='+taxtype+'&percentage='+percentage;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('tax_details/savetaxdetails');?>/",  
			data: dataString,
			success: function(msg){  
			alert('Saved successfully');
			
				refresh_folderlist();
			}  
		}); 
	}
		

}



function update()
{
    var taxid = $('#taxid').val();
	var taxtype = $('#taxtype').val();
	var percentage = $('#percentage').val();

	if(percentage =='')
	{
		alert('Please Enter the values');
		return false;
	}	
	else{
	var dataString = 'taxid='+taxid+'&percentage='+percentage;
		$.ajax({  
			type: "POST",  
			url	: "<?php echo fuel_url('tax_details/updatetaxdetails');?>/",
data: dataString,			
			success: function(msg){  
			alert('updated successfully');
		
			document.getElementById('txttaxtype').innerHTML="Type of Tax";
			document.getElementById('txttaxid').innerHTML="";
			$("#taxid").hide();
			$("#taxtype").show();
			$('#percentage').val('');
			$("#add_id").hide();
			$("#save_id").show();
				refresh_folderlist(); 
			}  
		}); 
	}
		

}


</script>




