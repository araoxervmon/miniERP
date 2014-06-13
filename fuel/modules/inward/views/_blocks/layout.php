<div id="innerpanel"> 
&nbsp;
&nbsp;
<fieldset>
<legend><strong>Inward Entry-ASPEN</strong><br/></legend>
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
					<label>Party Name<span class="required">*</span></</label>
				</td>  
				<td>
	
	
	
		<?php if(!empty($pname)){ ?>
			<input type="text" id="pname" name="pname" value="<?php echo $pname; ?>" />
			<?php }else{?>
			<input type="text" id="pname" name="pname" onkeyup="suggest(this.value);" onblur="fill();" class="" />
			<div class="suggestionsBox" id="suggestions" style="display: none;"> 
				<img src="<?=img_path('arrow.png') ?>" style="position: relative; top: -11px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="suggestionsList"></div>
			</div>
			<?php } ?>	
				</td>
			</tr>	
			<tr>
				<td>
					<label>Coil Number<span class="required">*</span></label>
				</td>
				<td>  
					<!--<input id="pid" type="text"  />-->
				<input id="pid" type="text" onchange="coilexist();" />
					
					<script>
									function coilexist(){
									var pid = $('#pid').val();
									var isANumber = isNaN(pid) === false;
									if (isANumber == false){
										alert('Please input numeric characters only');
										$('#pid').val('');
									}
										if ( pid != "" )
										{
										var dataString = 'pid='+pid;
									$.ajax({  
									type: "POST",  
									url	: "<?php echo fuel_url('inward/checkcoilno');?>/",  
									data: dataString,
									success: function(msg){  
									if(msg == '1'){
									
										alert('Coilnumber Already Exists');
										$('#pid').val('');
													}
													
															}  
											});  
										}	}						
									
		</script>	
					
				</td>
			</tr>
			<tr>	
				<td>
					<label>Received Date</label>
				</td> 
				<td>
					<input id="date3" type="text" />
						<script>
  $(function() {
    $( "#date3" ).picker();
  });
  </script>	
				</td>
			</tr>
			<tr>
				<td>
					<label>Lorry Number<span class="required">*</span></label>
				</td> 
				<td>
					<input id="lno" name="vLorryNo" type="text"/> 
				</td>
			</tr>	
			<tr>
				<td>
					<label>Invoice/Challan Number<span class="required">*</span></label>
				</td>  
				<td>
					<input id="icno"  type="text" />
				</td>
			</tr>
			<tr>
				<td>   
					<label>Invoice/Challan Date<span class="required">*</span></label>
				</td>
				<td> 
					<input  id="date4"  type="text" />
						<script>
  $(function() {
    $( "#date4" ).picker();
  });
  </script>	
				</td>
			</tr>
			<tr>
				<td>
					<label>Material Description<span class="required">*</span></label>
				</td>
				<td> 
					
			  <select class="selectpicker" id="coil"  name="coil"  style="min-width:175px;">
	   <?php 
	     echo '<option value="'.Select.'">'.Select."</option>";
         foreach($datam as $record) {
          echo '<option value="'.$record->vDescription.'">'.$record->vDescription."</option>";
         } 
     ?>
     </select>
				</td>
			</tr>
			<tr>
				<td>   
					<label>Width in mm<span class="required">*</span></label>
				</td>
				<td> 
					<input id="fWidth"  type="text" onkeyup=""/>
					
					
					<script>
									
									
									$("#fWidth").keyup(function() {
									if(parseInt($(this).val()) > 2000)
									{ 
									alert("Please enter the value below 2000mm.");
									$("#fWidth").val('');
									}
																		});
									

		</script>	

					
				</td>
			</tr>
			<tr>
				<td>
					<label>Thickness in mm<span class="required">*</span></label>
				</td>
				<td> 
	
				
					<input id="fThickness"  type="text" onkeyup=""/>
									<script>
									
									
									$("#fThickness").keyup(function() {
									if(parseInt($(this).val()) > 100)
									{ 
										alert("Please enter the value below 100mm.");
										$("#fThickness").val('');
									}
																		});
									

		</script>	
				</td>
			</tr>
			<tr>
				<td>  
					<label>Length in mm</label>
				</td>
				<td> 
					<input id="fLength"  type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Weight in Kgs.<span class="required">*</span></label>
				</td>
				<td> 
					<input id="fQuantity"  type="text" onchange=""/>
					
					<script>
									
									
									$("#fQuantity").change(function() {
									if(parseInt($(this).val()) < 100)
									{ 
										alert("Please enter the value above 100kg.");
										$("#fQuantity").val('');
									}
																		});
									

		</script>	

					
				</td>
			</tr>
			<tr>
				<td> 
					<label>Status</label>
				</td>
				<td> 
					<input id="status" name="vStatus" type="text" value="RECEIVED" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Heat Number </label>
				</td>
				<td> 
					<input id="hno"  type="text" />
				</td>
			</tr>
				<tr>
				<td>
					<label>Plant Name</label>
				</td>
				<td> 
					<input id="pna"  type="text" />
				</td>
			</tr>
		</table>
	</div>
</fieldset>	

<fieldset>
	
<table width="100%" cellpadding="0" cellspacing="0" border="0">


<form id="cisave" method="post" action="">

		<div class="pad-10">
			<input class="btn btn-primary" id="newsize" type="button" value="List Inward Entry" onClick="inwardregistrybutton();"/> &nbsp; &nbsp; &nbsp;
				<input class="btn btn-success" id="newsize" type="button" value="Save and preview slip" onClick="functionsave(); "/> &nbsp; &nbsp; &nbsp;
			<!--		<input id="newsize" type="button" value="preview slip" onClick="preview(); "/> &nbsp; &nbsp; &nbsp;-->
		</div>
</form>



</table>
</fieldset>	
</div>

            
<script language="javascript" type="text/javascript">

$(document).ready(function() {
	//$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	$('.selectpicker').selectpicker();
});



function inwardregistrybutton(id)
{
	//var pid   =	$('#pid').val();
	//var pname = $('#pname').val();
	//var dataString = 'partyid='+partyid+'&partyname='+partyname;
	$.ajax({  
		type: "POST",  
		success: function(){  
		setTimeout("location.href='<?= site_url('fuel/inward_entry'); ?>'", 100);
		}
		});
}


function functionsave()
{
	var pname = $('#pname').val();
	//alert(pname);
	var pid = $('#pid').val();
	var date3 = $('#date3').val();
	var lno = $('#lno').val();
	var icno = $('#icno').val();
	var date4 = $('#date4').val();
	var coil = $('#coil').val();
	var fWidth = $('#fWidth').val();
	var fThickness = $('#fThickness').val();
	var fLength = $('#fLength').val();
	var fQuantity = $('#fQuantity').val();
	var status = $('#status').val();
	var hno = $('#hno').val();
	var pna = $('#pna').val();
	    if(pid == '' || pname == ''  || coil == '' || fWidth == '' || fThickness == '' || fQuantity == '')
		{
		alert("Please Enter the required fields")
	}
	
	else if(pname == 'undefined')
	  {
	  alert("Please Enter the Correct Party Name")
	  }
	 else if(coil  == 'Select')
	  {
	  alert("Please Enter the Mat Description")
	  }
else	
{
		var dataString =  'pid='+pid+'&date3='+date3+'&pname='+pname+'&lno='+lno+'&icno='+icno+'&date4='+date4+'&coil='+coil+'&fWidth='+fWidth+'&fThickness='+fThickness+'&fLength='+fLength+'&fQuantity='+fQuantity+'&status='+status+'&hno='+hno+'&pna='+pna;

		$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('inward/savedetails');?>/",  
		   data: dataString,
		   success: function(msg)
		   { 
		   
			alert("Saved successfully!");
			var pname = $('#pname').val();
			var pid = $('#pid').val();
			var dataStringone = '&pname='+pname+'&pid='+pid;
			var url = "<?php echo site_url('inward/inwardbillgenerate');?>/?"+dataStringone;
		    window.open(url);
		//	$('#pname').val('');
			$('#pid').val('');
		//	$('#lno').val('');
		//	$('#icno').val('');
		//	$('#coil').val('');
		//	$('#icno').val('');
		//	$('#fWidth').val('');
			$('#fThickness').val('');
			$('#fQuantity').val('');
			$('#fLength').val('');
		//	$('#hno').val('');
		//	$('#picker').val('');
		//	$('#pna').val('');
			}  
		}); 
		}
	}



function preview()
{
	var pname = $('#pname').val();
	var pid = $('#pid').val();
	var dataString = '&pname='+pname+'&pid='+pid;
    setTimeout("location.href='<?= site_url('inward/inwardbillgenerate'); ?>/?"+ dataString+"'", 3000);
}
	
	
	
	
var section = "demos/picker";
	$(function() {
		$( "#picker" ).picker();
	});







</script>
