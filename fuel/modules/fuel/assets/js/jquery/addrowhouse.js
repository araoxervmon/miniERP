function addrowhouse() {
   var tbl = document.getElementById('tbl');
   var Row = parseInt(document.getElementById('hsb').value);
   var temprow=Row+1;
   var sku = $("#txtsku"+Row).val();
   if(sku == ''){
		alert('Please Enter SKU ');
   }else{
   var mainRow = tbl.insertRow(temprow);
   var trId ="tr"+temprow;
   mainRow.id=trId;
   
   var td =  document.createElement("td");
   td.colSpan='20';
   var table =  document.createElement("table");
   table.border="0";
   table.cellPadding="0";
   table.cellSpacing="4";
   table.width="100%"
   var newRow = table.insertRow(0);
   
   var sec = "'risk'";
     var newCell = newRow.insertCell(0);
   newCell.width="3%"
   newCell.innerHTML = temprow+'<input type="hidden" class="input" name="txtsno'+temprow+'" id="txtsno'+temprow+'" value="'+temprow+'" />';
  
   var newCell = newRow.insertCell(1);
   newCell.width="2%"
   newCell.innerHTML = '<input type="text" class="input" name="txtsku'+temprow+'" id="txtsku'+temprow+'" value="" style="width:110px;/><a onClick="invdata('+temprow+');" style="cursor:pointer;" title="Go" id="add"><img src="../../assets/images/iconset/ico_go_btn.png" alt=">" title="Go" border="0" /> </a>';   
   
   var newCell = newRow.insertCell(2);
   newCell.width="4%"
   newCell.innerHTML = '<input type="text" class="input" name="txtiname'+temprow+'" id="txtiname'+temprow+'" value="" style="width:110px;" /><input type="hidden" class="input" name="txtiitemid'+temprow+'" id="txtiitemid'+temprow+'" value="" />';     
   
   var newCell = newRow.insertCell(3);
   newCell.width="4%"
   newCell.innerHTML = '<input type="text" class="input" name="txtiprice'+temprow+'" id="txtiprice'+temprow+'" value="" style="width:110px;" />';
   
   var newCell = newRow.insertCell(4);
   newCell.width="4%"
   newCell.innerHTML = '<input type="text" class="input" name="txtqty'+temprow+'" id="txtqty'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />';     
   
   var newCell = newRow.insertCell(5);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtdisc'+temprow+'" id="txtdisc'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />';     
   
   var newCell = newRow.insertCell(6);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(7);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(8);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(9);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(10);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(11);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
   
   var newCell = newRow.insertCell(12);
   newCell.width="5%"
   newCell.innerHTML = '<input type="text" class="input" name="txtprice'+temprow+'" id="txtprice'+temprow+'" value="" style="width:110px;" onchange="updateRowTotal('+temprow+', false)" />'; 
  
   td.appendChild(table);
   mainRow.appendChild(td);     
   document.getElementById('hsb').value=temprow;
   
   $().ready(function() {
   $("#txtsku"+temprow).autocomplete("inventory_transfers/autosuggest", {
				width: 260,
				matchContains: true,
				minChars: 0,
				selectFirst: false
				});
   });
   
   var cScrollbar = $('#createtransfer');	 
   fleXenv.updateScrollBars(cScrollbar);
   }
}