
<script language="javascript" type="text/javascript">
  $(window).load(function() {
	$("tr#childlist").hide();
	var lfScrollbar = $('#contentsfolder');	 
	fleXenv.updateScrollBars(lfScrollbar); 
  });
</script>
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
	<div style="width:640px;">
    <a href="javascript:;"><div class="tabLinkpr activeLinkpr" id="contpr-1" style="float:left;"><h1>Main CoilDetails</h1></div></a> 
    <a href="javascript:;"><div class="tabLinkpr " id="contpr-2" style="float:left;"><h1>ProcessedDetail</h1></div></a>
	</div>
</div>

 
<!-- MAIN PARTWISE @START -->
<div class="tabcontentpr" id="contpr-1-1">
<div id="party_list">
<div id="contentsfolder" style="width:100%; height:550px; overflow-x:hidden; overflow-y:auto;">
<div id="partycontent" style="width:100%; min-height:550px; overflow:hidden;"> 


<script src="<?=$this->asset->js_path('jquery.tablesorter.pager', 'stock_report')?>"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter', 'stock_report')?>	"></script>
<script src="<?=$this->asset->js_path('jquery.tablesorter.widgets', 'stock_report')?>	"></script>
		
<div id="DynamicGridp_2" >
</div>
	
</div>
</div>
</div>
</div>
<!-- @END -->



<!-- SUB PARTWISE @START -->
<div class="tabcontentpr hidepr" id="contpr-2-1" style="height:541px;"> 
<div id="pr-content" style="width:100%; height:500px; overflow-x:hidden; overflow-y:hidden;">
<h2 class="innercellpr" style="margin-bottom:0px !important;"><div class="pr-content-title">List for <span class="container_root" id="pr_container_name">/</span> coil number:</div></h2>
<div id="contentsholder" style="width:100%; height:500px; overflow-x:hidden; overflow-y:auto;">
<div id="content" style="width:100%; min-height:500px; overflow-x:hidden; overflow-y:auto;">
	<div id="DynamicGrid_2">
        Select a Parent Coil
	</div>
</div>
</div>
</div>
</div>
<!-- @END -->
</div>

<?php //echo $totalweight; ?>
<input id="partnamecheck" type="hidden" value="" name="partnamecheck" />
	
<div align="right">
<label>Total Weight</label>
		<input id="totalweight_calcualation" type="text" DISABLED/>(in Kgs)  
		&nbsp; &nbsp; &nbsp;
</div>





<script language="javascript" type="text/javascript">




$(document).ready(function() { 

	 $("#export").hide();

});










function totalweight_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('stock_report/totalweight_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var weight = j.weight;
			document.getElementById("totalweight_calcualation").value = weight;});
	   }  
	}); 
}

</script>

<script type="text/javascript">


	$("#party_account_name").change(function(data) {
		 var account_id = $("#party_account_name").val();
		 	 $("#export").show();
		var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
	   $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('stock_report/list_party');?>",
		data: "party_account_name=" + account_id,
        dataType: "json"
        }).done(function( msg ) {
	      //  obj = JSON.parse(msg);
			var mediaClass ='';
			mediaClass += '<table id="myTabels" class="tablesorter tablesorter-blue">';
			mediaClass +='<thead>';
			mediaClass +='<tr>';
			mediaClass += '  <th>Select</th>';
			mediaClass += '  <th>Coilnumber</th>';
			mediaClass += '  <th>Received Date</th>';
			mediaClass += '  <th>Description</th>';
			mediaClass += '  <th>Thickness</th>';
			mediaClass += '  <th>Width</th>';
			mediaClass += '  <th>Present Weight</th>';
			mediaClass += '  <th>Status</th>';
			mediaClass +='</tr>';
			mediaClass +='</thead>';
			
			for (var i=0;i<msg.length;i++)
			{
				var item = msg[i];
				mediaClass += '<tr>';
				
		 	mediaClass += '<td>' + '<input type="radio" id="radio_'+item.coilnumber+'" name="list" value="'+item.coilnumber+'"   onClick=showchild("'+item.coilnumber+'") />' + '</td>';
				mediaClass += '<td>' + item.coilnumber + '</td>';
				mediaClass += '<td>' + item.receiveddate + '</td>';
				mediaClass += '<td>' + item.description + '</td>';
				mediaClass += '<td>' + item.thickness + '</td>';
				mediaClass += '<td>' + item.width + '</td>';
				mediaClass += '<td>' + item.pweight + '</td>';
				mediaClass += '<td>' + item.status + '</td>';

				mediaClass += '</tr>';			
				
			}
			mediaClass += '</table>';
			
			$('#DynamicGridp_2').html(mediaClass);
			 $("#myTabels").tablesorter();
			totalweight_check();
			
	
		});

	
});



var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
	return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
		window.location.href = uri + base64(format(template, ctx))
	}
})()


function showchild(parentid) {
	$('#pr_container_name').html(parentid);
	 $('#DynamicGrid_2').hide();
	 var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading child coils... </span> '+ 
    	    	   ' </div>';
	 $('#content').html(loading); 
		$.ajax({
				type: "POST",
				url: "<?php echo fuel_url('stock_report/listChilds');?>",
                // Parent ID
				data: "partyid=" + parentid,
                dataType: "json"
				}).done(function(msg) {
				//alert(msg);
					if(msg.length == 0) {
						 $('#DynamicGrid_2').hide();
						 $('#DynamicGridLoading_2').hide();
						 var loading1 = '<div id="error_msg"> '+
                                        'No Result!'+ 
									    '</div>';
						 $('#content').html(loading1);  
					} else{
						var data = [];
                        for (var i = 0; i < msg.length; i++) {
                            var item = msg[i];
                            var thisdata = {};
							if(item.process=='Cutting'){
							thisdata["Processdate"] = item.processdate;
                            thisdata["Length in (mm)"] = item.length;
                            thisdata["BundleNumber"] = item.bundlenumber;
                            thisdata["No of sheets"] = item.bundles;
                            thisdata["Weight in (Kgs)"] = item.weight;
                            thisdata["Status"] = item.status;
							}
							else if(item.process=='Recoiling'){
							thisdata["RecoilNumber"] = item.recoilnumber;
							thisdata["Start-Date"] = item.startdate;
							thisdata["End-Date"] = item.enddate;
							thisdata["No Recoil"] = item.norecoil;
							thisdata["Status"] = item.status;
							}
							else if(item.process=='Slitting'){
							thisdata["SlittNumber"] = item.slittnumber;
							thisdata["Date"] = item.date;
							thisdata["Width in(mm)"] = item.width;
							thisdata["Status"] = item.status;
							}
							else if(item.process=='NULL'){
							'<div id="error_msg"> '+
										'No Result!'+ 
									    '</div>';
							}
                            data.push(thisdata);
                        }
						if (data.length) {
                            // If there are files
                            $('#content').html(CreateTableViewX(data, "lightPro", true)); 
							var lcScrollbar = $('#contentsholder');	 
							fleXenv.updateScrollBars(lcScrollbar); 
						} else {
							$('#DynamicGrid_2').hide();
							$('#DynamicGridLoading_2').hide();
							var loading1 = '<div id="error_msg"> '+
										'No Result!'+ 
									    '</div>';
							$('#content').html(loading1); 
							var lcScrollbar = $('#contentsholder');	 
							fleXenv.updateScrollBars(lcScrollbar);  
                        }
					}
				});
}
</script>
