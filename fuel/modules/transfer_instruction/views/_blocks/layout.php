<div id="innerpanel"> 
<fieldset>
<legend>Transer Instruction</legend>
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			
			<tr>
				<td>
					<label>From Party:</label>
				</td>
				<td>
					<input id="frompartyname"  type="text" value="<?php echo $partyname; ?>"  DISABLED  />
				</td>
			<td>
					<label>To Party:</label>
				</td>
				<td> 
						<select id="pname"  name="pname" style="min-width:200px;" >
			<?php
				echo '<option value="'.Select.'">'.Select."</option>";
				foreach($datam as $record) {
                    echo '<option value="'.$record->nPartyName.'">'.$record->nPartyName."</option>";
				}
			?>
		</select>
				
				</td>
			</tr>
	
			<tr>
				<td>
					<label><?=lang('party_id')?></label>
				</td>  
				<td>
					<input id="pid" name="vIRnumber" type="text" DISABLED />
				</td>
				<td>
					<label>To Date</label>
				</td>
				<td>
					<input id="todate" type="text" value="<?php echo date("d-m-Y");?>" DISABLED/>
				</td>
		
			</tr>
			<tr>	
				<td>
					<label>Received Date</label>
				</td> 
				<td> 
					<input id="date3" type="text" value="<?php echo date("d-m-Y");?>" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Lorry Number</label>
				</td> 
				<td>  
					<input id="lno" name="vLorryNo" type="text"/ DISABLED> 
				</td>
			</tr>	
			<tr>
				<td>
					<label>Invoice/Challan Number</label>
				</td>  
				<td>
					<input id="icno"  name="vInvoiceNo" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>   
					<label>Invoice/Challan Date</span></label>
				</td>
				<td> 
					<input id="datepicker" name="dInvoiceDate" type="text" DISABLED/>
					</td>
			</tr>
			<tr>	
				<td>
					<label><?=lang('Material_description')?></label>
				</td> 
				<td colspan="3">
					<input id="mat_desc" name="vDescription" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label><?=lang('width_txt')?> (in mm)</label>
				</td> 
				<td> 
					<input id="wid" name="fWidth" type="text" DISABLED/> 
				</td>
			</tr>
				<tr>
				<td>
					<label><?=lang('thickness_txt')?> (in mm)</label>
				</td>  
				<td> 
					<input id="thic" name="fThickness" type="text" DISABLED/>
				</td>
			</tr>
			<tr>
				<td>
					<label><?=lang('length_txt')?> (in mm)</label>
				</td>
				<td>
					<input id="len" name="fLength" type="text" DISABLED />
				</td>
			</tr>	
		
			<tr>
				<td>
					<label><?=lang('weight_txt')?> (in Kgs)</label>
				</td>
				<td> 
					<input id="wei" name="fQuantity" type="text" DISABLED/>
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
					<input id="hno"  name="vHeatnumber" type="text" DISABLED/>
				</td>
			</tr>
				<tr>
				<td>
					<label>Plant Name</label>
				</td>
				<td> 
					<input id="pna"  name="vPlantname" type="text" DISABLED/>
				</td>
			</tr>
		</table>
	</div>
		
<table width="100%" cellpadding="0" cellspacing="0" border="0">


<form id="cisave" method="post" action="">

		<div class="pad-10">
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
				<input class="btn btn-success" id="newsize" type="button" value="Save" onClick="functionsave(); "/> &nbsp; &nbsp; &nbsp;
					
		</div>
</form>



</table>
</fieldset>
	



</div>

<script language="javascript" type="text/javascript">

var json = <?php echo($adata); ?>;
for(key in json)
{
  if(json.hasOwnProperty(key))
    $('input[name='+key+']').val(json[key]);
}


function functionsave()
{
	var pname = $('#pname').val();
	var frompartyname = $('#frompartyname').val();
	var pid = $('#pid').val();
	var date3 = $('#date3').val();
	var todate = $('#todate').val();
	if(pname == 'Select')
	{
	alert('Please select a party name');
	}
	else
	{
		var dataString =  'pid='+pid+'&date3='+date3+'&pname='+pname+'&frompartyname='+frompartyname+'&todate='+todate;
		$.ajax({  
		   type: "POST",  
		   url : "<?php echo fuel_url('transfer_instruction/savedetails');?>/",  
		   data: dataString,
		   success: function(msg)
		   { 
			alert("Transfered Succesfully");
			}  
		}); 
		}
}







</script>
