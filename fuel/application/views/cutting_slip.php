<div id="innerpanel"> 
<legend>Cutting Slip Details</legend>
	<div>  
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>
					<label>System Date</label>
				</td>  
				<td>
					<input type="text" id="date" value="<?php echo date("Y-m-d"); ?>" />
				</td>
				<td>
					<label>CoilNumber</label>
				</td>  
				<td>
					<input id="pid" name="vIRnumber" type="text" />
				</td>
				
			</tr>
			<tr>
				<td>
					<label>PartyName</label>
				</td>
				<td> 
					<input id="pname" type="text" />
				</td>	
				<td>
					<label>Material Description</label>
				</td> 
				<td colspan="3">
					<input id="mat_desc" name="vDescription" type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Width</label>
				</td> 
				<td>
					<input id="wid" name="fWidth" type="text" /> 
				</td>
				<td>
					<label>Thickness</label>
				</td>  
				<td>
					<input id="thic" name="fThickness" type="text" />
				</td>
			</tr>	
			<tr>
				<td>
					<label>Weight</label>
				</td>
				<td> 
					<input id="wei" name="fQuantity" type="text" />
				</td>
				<td>
					<label>Invoice No</label>
				</td>
				<td> 
					<input id="inwdate" name="dInvoiceDate" type="text"  />
				</td>
			</tr>
		</table>
	</div>
</div>