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
					<input id="pid" name="vIRnumber" type="text" DISABLED/>
				</td>
				<td>
					<label><?=lang('party_name')?></label>
				</td>
				<td> 
					<input id="pname" type="text" value="<?php echo $partyname;?>" DISABLED />
				</td>
			</tr>
			<tr>	
				<td>
					<label><?=lang('Material_description')?></label>
				</td> 
				<td>
					<input id="mat_desc" name="vDescription" type="text" DISABLED/>
				</td>
				<td>
					<label><?=lang('width_txt')?></label>
				</td> 
				<td>
					<input id="wid" name="fWidth" type="text" DISABLED/> 
				</td>
			</tr>	
			<tr>
				<td>
					<label><?=lang('thickness_txt')?></label>
				</td>  
				<td>
					<input id="thic" name="fThickness" type="text" DISABLED/>
				</td>
				<td>
					<label><?=lang('weight_txt')?></label>
				</td>
				<td> 
					<input id="wei" name="fQuantity" type="text" DISABLED/>
				</td>
			</tr>
		</table>
	</div>
</fieldset>	

<fieldset>
<legend>Recoiling</legend>	
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="40%" align="left" valign="top">	
<form id="cisave" method="post" action="">
		<div class="pad-10">
			<input id="coilname" type="hidden" value="" name="coilname" />
			<input id="txtrecoilnumber" type="hidden"  />
		</div>
		<div class="pad-10">
			<div id="date_text_label">Recoiling Start Date </div>
			<input type="text" id="date1" value="<?php echo date("Y-m-d"); ?>" />
		</div>								
		<div class="pad-10">
			<div id="recoilenddate_text_label"> Recoiling End Date </div>
			<input id= "datepicker" type="text"  name="recoilenddate" /> 
		</div><script>
  $(function() {
    $( "#datepicker" ).picker();
  });
  </script>	
		<div class="pad-10">
			<div id="nocoil_text_label"> Number of Coil </div>
			<input id= "nocoil" type="text"  name="No coil" /> 
			<input id= "weightcoil" type="hidden"  name="weightcoil" /> 
		</div>
		<div class="pad-10">
			<input class="btn btn-success" id="newsize" type="button" value="Add New Size" onClick="functionsave();"/> &nbsp; &nbsp; &nbsp;
			<input class="btn btn-danger" id="reset" type="reset" value="Reset" />
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
		<input  class="btn btn-success"  id="saveci" type="button" value="Save" onClick="savechange();"/>  
		&nbsp; &nbsp; &nbsp;
	<!--	<input id="finishci" type="button" value="Finsh" onClick="finishinstructionbutton();"/>
	<!--	<input id="cuttinginst" type="button" value="Cutting Instruction" onClick="cuttinginstructionbutton();"/>-->
</td>
</tr>
</table>
</fieldset>	
</div>

<script language="javascript" type="text/javascript">

function loadfolderlist(account, accname) {
	$('#DynamicGrid_2').hide();
	var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading coil List... </span> '+ 
    	    	   ' </div>';
    $("#content").empty();
	$('#content').html(loading);
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('recoiling/listrecoildetails');?>",
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
			thisdata["Recoil Number"] = item.recoilno;
			thisdata["coil Number"] = item.coilno;
            thisdata["Startdate"] = item.startdate;
            thisdata["Enddate"] = item.enddate;
            thisdata["noofrecoil"] = item.nNoOfRecoils;
            thisdata["weight"] = item.weight;
			
			var dl = '<a class="ico_coil_delete" title="Delete" href="'+item.dl+'" onClick=deleteItem('+item.recoilno+','+item.coilno+')><img src="<?php echo img_path('iconset/ico_cancel.png'); ?>" /></a>';
            thisdata["action"] =  dl;
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

function deleteItem(rd){
	document.getElementById('txtrecoilnumber').value = rd;
	var recoilnumber = $('#txtrecoilnumber').val();
	var pid = $('#pid').val();
    var checkstr =  confirm('Are you sure you want to delete this?');
	var dataString = {Recoilnumber : recoilnumber,Pid:pid};
    if(checkstr == true){
      $.ajax({
	    type: "POST",
		url	: "<?php echo fuel_url('recoiling/deleterecoil');?>",
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

var json = <?php echo($ndata); ?>;
for(key in json){
	if(json.hasOwnProperty(key))
	$('input[name='+key+']').val(json[key]);
}

function functionsave(){
	var pid = $('#pid').val();
	var date1 = $('#date1').val();
	var datepicker = $('#datepicker').val();
	var nocoil = $('#nocoil').val();
	var wei = $('#wei').val();
	var weightcheck = wei/nocoil;
	document.getElementById('weightcoil').value = weightcheck;
	var weightcoil = $('#weightcoil').val();
	
	if(pid =='' || date1 =='' || datepicker ==''||  nocoil ==''){
		alert('ENTER SOMETHING');
		return false;
	}
	else{
		var dataString =  'pid='+pid+'&date1='+date1+'&datepicker='+datepicker+'&nocoil='+nocoil+'&weightcoil='+weightcoil;

		$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('recoiling/saverecoildetails');?>/",  
		   data: dataString,
		   success: function(msg){ 
			$('#datepicker').val('');
			$('#nocoil').val('');
		refresh_folderlist(); 
		}  
		}); 
	}
}

function addDate(){
	date = new Date();             
	var month = date.getMonth()+1;
	var day = date.getDate();
	var year = date.getFullYear();

	if (document.getElementById('date1').value == ''){
		document.getElementById('date1').value = year + '-' + '0' +month + '-' + '0'+ day;
	}
}



function savechange(id){
    var pid   =	$('#pid').val();
	var dataString = 'pid='+pid;
     $.ajax({
                type: 'POST',
                url: "<?php echo fuel_url('recoiling/save_button');?>",
				data: dataString,
                success: function(){  
				alert("Saved Succesfully");
				refresh_folderlist();
			}
        });
}

function timedRefresh(timeoutPeriod){
	setTimeout("location.reload(true);",timeoutPeriod);
}

/*
function finishinstructionbutton(id)
{
	var pid   =	$('#pid').val();
	var party = $('#pname').val();
	var dataString = 'partyid='+pid+'&partyname='+party+'&task=cit';
	$.ajax({  
		type: "POST",  
		url	: "<?php echo site_url('finish_task/finish_taskcit');?>/",  
		data: dataString,
		success: function(){  
		setTimeout("location.href='<?= site_url('fuel/finish_task'); ?>/?"+ dataString+"'", 3000);
		}
		});
}
*/


function radioload(id){
	var pid = $('#nsno'+id).val();
	var date1 = $('#date'+id).val();
	var datepicker = $('#enddate'+id).val();
	var nocoil = $('#norecoil'+id).val();
	if(pid == '' || date1 == '' || datepicker == '' || nocoil == '' ){
		$('#pid').val('');
		$('#date1').val('');
		$('#datepicker').val('');
		$('#nocoil').val('');
	}
	else 
	{
		document.getElementById('date1').value = date1;
		document.getElementById('datepicker').value = datepicker;
		document.getElementById('nocoil').value = nocoil;
		document.getElementById('deletevalue').value = nocoil;
		document.getElementById('pid').value = pid;
	}
	
}
function deleterecord()
{
	var deleteid = $('#deletevalue').val();
	var dataString = 'number='+deleteid;
	//JSON.stringify(dataString, replacer);
	$.ajax({  
		type: "POST",  
		url	: "<?php echo fuel_url('recoiling/deleterow');?>/",  
		data: dataString,
		success: function(msg){  
		$("#deletemsg").html(msg);
		$('#deletevalue').val('');
		//setTimeout("location.href='<?= site_url('fuel/cutting_instruction'); ?>'", 3000);
		}  
	}); 
}	
</script>
