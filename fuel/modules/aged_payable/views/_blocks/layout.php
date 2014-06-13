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
<fieldset>
<legend>Report</legend>
<form id="userForm" method="post" action="">
		<table cellpadding="0" cellspacing="10" border="0">
			<tr>
				<td>   
					<label>From Date</label>
				</td>
				<td> 
					<input id="selector"  type="text" />
							<script>$(selector).datepick({dateFormat: 'yyyy-mm-dd'});	</script>
				</td>
				
				
				
							<td>To Date</td>	
							<td><input id= "selector1" type="text"  name="Rate" /><br /></td>

								<script>$(selector1).datepick({dateFormat: 'yyyy-mm-dd'});	</script>
			</tr>
		
			
</table>


<div class="pad-10">
			<input type="button" value="Click to PDF" id="save_id" onClick="functionpdf();"/> &nbsp; &nbsp; &nbsp;
				<div id="check_bar" style="padding-top:10px;">&nbsp;</div>
		</div>

</form>


</fieldset>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div id="party_list">
<div id="contentsholder" class="flexcroll" style="width:100%; height:200px; overflow-x:hidden; overflow-y:auto;">
		<div id="partycontent" style="width:100%; min-height:200px; overflow:hidden;"> 
			<div id="DynamicGrid_2">
				<table cellpadding="0" cellspacing="10" border="2px">
				<div id="DynamicGridp_2">
        Select a Party Name
	</div>
				</table>
			</div>
		</div>
	</div>
	</div>












</div>
<!-- @END -->

<!-- @END -->
</div>

<?php //echo $totalweight; ?>
<input id="partnamecheck" type="hidden" value="" name="partnamecheck" />


<script language="javascript" type="text/javascript">



	
var section = "demos/datepicker";
	$(function() {
		$( "#datepicker" ).datepicker();
	});





function totalweight_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('aged_payable/totalweight_check');?>/",  
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
function loadfolderlist(account, accname) {
	$('#DynamicGridp_2').hide();
	var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
    $("#partycontent").empty();
	$('#partycontent').html(loading);
    $("#pr_container_name").html("/");
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('aged_payable/list_party');?>",
        data: "party_account_name=" + account,
        dataType: "json"
        }).done(function( msg ) {
			if(msg.length == 0) {
			$('#DynamicGridp_2').hide();
			$('#DynamicGridLoadingp_2').hide();
			var loading1 = '<div id="error_msg"> '+
                           'No Result!'+ 
						   '</div>';
			$('#partycontent').html(loading1);  
			} else{
            var partydata = [];
            for (var i = 0; i < msg.length; i++) {
            var item = msg[i];
            var thisdata = {};
			var selectcoil = '<input type="radio" id="radio_'+item.coilnumber+'" name="list" value="'+item.coilnumber+'"   onClick=showchild("'+item.coilnumber+'") />';
			thisdata["name"] = item.name;
            thisdata["Brandname"] = item.brandname;
            thisdata["Description"] = item.description;
            thisdata["Quantityonhand"] = item.quantityonhand;
            thisdata["InwardDate"] = item.inwarddate;
			totalweight_check();	
		//	var pr = '<a class="ico_print" title="Print" href="'+item.pr+'" target="_blank"><img src="<?php echo img_path('iconset/ico_print.png'); ?>" /></a>';
        //    thisdata["action"] =  pr;
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
				$('#DynamicGridp_2').hide();
				$('#DynamicGridLoadingp_2').hide();
				$('#partycontent').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholder');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
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
				$('#partycontent').html(loading1); 
				var lfScrollbar = $('#contentsfolder');	 
				fleXenv.updateScrollBars(lfScrollbar);  
                }
			}
    });
}

function functionpdf(){
	var party_account_name = $('#party_account_name').val();
	var selector = $('#selector').val();
	var selector1 = $('#selector1').val();
		$("#check_bar").html('<span style="font-size:20px; color:red">Please wait.. Loading PDF might take some time..</span>');
	var dataString =  'partyname='+party_account_name+'&frmdate='+selector+'&todate='+selector1;
	$.ajax({  
		   type: "POST",  
		  // url : "<?php echo fuel_url('billing_statement/billing_pdf');?>/",  
		//   data: dataString,
		   success: function(msg)
		   {  
			$("#check_bar").html('');
			var dataString =  'partyname='+party_account_name+'&frmdate='+selector+'&todate='+selector1;
			var url = "<?php echo fuel_url('aged_payable/billing_pdf');?>/?"+dataString;
		    window.open(url);
		   }  
		}); 

}

</script>  