<?php include_once(BILL_DESCRIPTIONS_PATH.'views/_blocks/toolbar.php');?>	

<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLinkpr").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLinkpr").removeClass("activeLinkpr");
        $(this).addClass("activeLinkpr");
        $(".tabcontentpr").addClass("hidepr");
        $("#"+tabeId+"-1").removeClass("hidepr")   
        return false;	  
      });
    });  
  });
</script><br /><br />
<div id="main_content" style="overflow:hidden;"> 

<div class="tab-boxpr"> 


</div>
 

 

 
<!-- MAIN PARTWISE @START -->
<div class="tabcontentpr" id="contpr-1-1">
<div id="party_list">
<div id="contentsfolder" style="width:100%; height:550px; overflow-x:hidden; overflow-y:auto;">
<div id="partycontent" style="width:100%; min-height:550px; overflow:hidden;"> 


<script src="<?=$this->asset->js_path('jquery.tablesorter.pager', 'partywise_register')?>"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter', 'partywise_register')?>	"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter.widgets', 'partywise_register')?>	"></script>
		
<div id="DynamicGridp_2" >
</div>
	
</div>
</div>
</div>
</div>
<!-- @END -->

<!-- @END -->
</div>


	


	<input id= "billno" type="text" /> 
			<input id= "coilno" type="text" /> 
			<input id= "billtype" type="text" /> 
	<input id= "weight" type="text" /> 
	<input id= "nsnumber" type="text" /> 
	<input id= "bweight" type="text" /> 
	<input id= "pweight" type="text" /> 
		<input id= "in_billweight" type="text" /> 

<script type="text/javascript">

$(document).ready(function() { 

	 $("#del_bill").hide();
});



	$("#party_account_name").change(function(data) {
		 var partyname = $("#party_account_name").val();
		var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
	   $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('bill_descriptions/bill_list');?>",
		data: "partyname=" + partyname,
        dataType: "json"
        }).done(function( msg ) {
	      //  obj = JSON.parse(msg);
			var mediaClass ='';
			mediaClass += '<div id="div1">';
			mediaClass += '<table id="myTabels" class="tablesorter tablesorter-blue">';
			mediaClass +='<thead>';
			mediaClass +='<tr>';
			mediaClass += '  <th>Select</th>';
			mediaClass += '  <th>Bill number</th>';
			mediaClass += '  <th>coilnumber</th>';
			mediaClass += '  <th>Partyname</th>';
			mediaClass += '  <th>Bill Date</th>';
			mediaClass += '  <th>Billed Weight</th>';
			mediaClass += '  <th>Bill Type</th>';
			mediaClass += '  <th>Present Weight</th>';
			mediaClass += '  <th>Grand Total</th>';
			mediaClass += '  <th>Inward Weight</th>';
		//	mediaClass += '  <th>Grand Total in words</th>';
			mediaClass += '  <th>Lorry No</th>';
			mediaClass +='</tr>';
			mediaClass +='</thead>';
			
			for (var i=0;i<msg.length;i++)
			{	
				var item = msg[i];
			//	alert(item);
				mediaClass += '<tr>'; 
				mediaClass += '<td>' + '<input type="radio" id="radio_'+item.billno+'" name="list" value="'+item.billno+'" onClick=selectbundleid('+item.billno+','+item.coilno+',\''+item.billtype + '\','+item.weight+','+item.billedweight+','+item.pweight+','+item.in_billweight+') />' + '</td>';
				mediaClass += '<td>' + item.billno + '</td>';
				mediaClass += '<td>' + item.coilno + '</td>';
				mediaClass += '<td>' + item.partyname + '</td>';
				mediaClass += '<td>' + item.billdate + '</td>'; 
				mediaClass += '<td>' + item.billedweight + '</td>';
				mediaClass += '<td>' + item.billtype + '</td>';
				mediaClass += '<td>' + item.pweight + '</td>';
				mediaClass += '<td>' + item.grandtotal + '</td>';
				mediaClass += '<td>' + item.weight + '</td>';				
			//	mediaClass += '<td>' + item.words + '</td>';		
				mediaClass += '<td>' + item.lorryno + '</td>';
				mediaClass += '</tr>';			
			}
			mediaClass += '</table>';
			mediaClass += '</div>';
			$('#DynamicGridp_2').html(mediaClass);
			 $("#myTabels").tablesorter();
				
		
		});

	
});



function selectbundleid(s,r,u,y,z,i,k){	

var billno =	document.getElementById('billno').value = s;
	document.getElementById('coilno').value = r;
	document.getElementById('billtype').value = u;
document.getElementById('weight').value = y;
document.getElementById('bweight').value = z;
document.getElementById('pweight').value = i;
document.getElementById('in_billweight').value = k;


 var dataString = 'billno='+billno;
    $.ajax({
        type: 'POST',
        url: "<?php echo fuel_url('bill_descriptions/getnsno');?>",
        data: dataString,
        success: function(data){ 
		var obj = JSON.parse(data);
		var arr = [];
		for(var i=0; i<obj.billdata.length; i++)
		{
			 arr[i] = obj.billdata[i].nSno ;
			

		}
		document.getElementById('nsnumber').value = arr;
  }
    });

 $("#del_bill").show();
 
}






function delbutton() {
 var billno = $('#billno').val();
 var coilno = $('#coilno').val(); 
 var billtype = $('#billtype').val();
 var partyname = $("#party_account_name").val();
 var weight = $("#weight").val();
  var nsnumber = $("#nsnumber").val();
   var bweight = $("#bweight").val();
      var pweight = $("#pweight").val();
	  var in_billweight = $("#in_billweight").val();
  alert(coilno);   alert(in_billweight);
  var div1 = $("#div1").html();
  
 if(!$("input[name='list']:checked").val())
 {
  alert('Please select the Radio button');
  return false;
 }
 else
 {
 var dataString = 'partyname='+partyname+'&billno='+billno+'&coilno='+coilno+'&billtype='+billtype+'&weight='+weight+'&nsnumber='+nsnumber+'&bweight='+bweight+'&pweight='+pweight+'&in_billweight='+in_billweight;
    $.ajax({
        type: 'POST',
        url: "<?php echo fuel_url('bill_descriptions/delete_coil');?>",
        data: dataString,
        success: function(){ 
		  alert("Deleted Successfully");
		  window.location.reload();
  }
    });
 }
}









</script>
