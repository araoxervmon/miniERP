<?php include_once(CUSTOMER_BILLING_PATH.'views/_blocks/toolbar_party.php');?>	
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
								<script>
  $(function() {
    $( "#selector" ).picker();
  });
  </script>	
				</td>
				
				
				
							<td>To Date</td>	
							<td><input id= "selector1" type="text"  name="Rate" /><br /></td>

													<script>
  $(function() {
    $( "#selector1" ).picker();
  });
  </script>	
			</tr>
		
			
</table>


<div class="pad-10">
			<input  class="btn btn-success"  type="button" value="Click to PDF" id="save_id" onClick="functionpdf();"/> &nbsp; &nbsp; &nbsp;
		</div>

</form>


</fieldset>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div id="party_list">
<div id="contentsholder" class="flexcroll" style="width:100%; height:550px; overflow-x:hidden; overflow-y:auto;">
		<div id="partycontent" style="width:100%; min-height:550px; overflow:hidden;"> 
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

	

<label>Total Weight</label> &nbsp; <input id="totalweight_calcualation" type="text" DISABLED/>(in Kgs) &nbsp;&nbsp; &nbsp;  
<label>Basic Amount</label> &nbsp; <input id="totalbasic_calcualation" type="text" DISABLED/> &nbsp;&nbsp; &nbsp; 
<label>Tax</label> &nbsp; <input id="totaltax_calcualation" type="text" DISABLED/>&nbsp;&nbsp; &nbsp; 
<label>Total</label> &nbsp; <input id="totalbill_calcualation" type="text" DISABLED/> &nbsp;&nbsp; &nbsp; 		


<script language="javascript" type="text/javascript">



	
var section = "demos/datepicker";
	$(function() {
		$( "#datepicker" ).datepicker();
	});



function partytotalweight_check(){
	var party_individualaccount_name = $('#party_individualaccount_name').val();
	var dataString = '&party_individualaccount_name='+party_individualaccount_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/partytotalweight_check');?>/",  
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

function partytotaltax_check(){
var party_individualaccount_name = $('#party_individualaccount_name').val();
	var dataString = '&party_individualaccount_name='+party_individualaccount_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/partytotaltax_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(i, j){
			 var tax = j.tax;
			document.getElementById("totaltax_calcualation").value = tax;});
	   }  
	}); 
}


function partytotalbasic_check(){
	var party_individualaccount_name = $('#party_individualaccount_name').val();
	var dataString = '&party_individualaccount_name='+party_individualaccount_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/partytotalbasic_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(l, k){
			 var basic = k.basic;
			document.getElementById("totalbasic_calcualation").value = basic;});
	   }  
	}); 
}


function totalweight_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/totalweight_check');?>/",  
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


function totalbasic_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/totalbasic_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(l, k){
			 var basic = k.basic;
			document.getElementById("totalbasic_calcualation").value = basic;});
	   }  
	}); 
}


function totaltax_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/totaltax_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(n, m){
			 var tax = m.tax;
			document.getElementById("totaltax_calcualation").value = tax;});
	   }  
	}); 
}

function totalbill_check(){
	var party_account_name = $('#party_account_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/totalbill_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(o, p){
			 var bill = p.bill;
			document.getElementById("totalbill_calcualation").value = bill;});
	   }  
	}); 
}

function partytotalbill_check()
{
	var party_individualaccount_name = $('#party_individualaccount_name').val();
	var dataString = '&party_individualaccount_name='+party_individualaccount_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('customer_billing/partytotalbill_check');?>/",  
		data: dataString,
		datatype : "json",
		success: function(msg){
		var msg3=eval(msg);
		$.each(msg3, function(o, p){
			 var bill = p.bill;
			document.getElementById("totalbill_calcualation").value = bill;});
	   }  
	}); 
}

function loadindividualfolderlist(account, accname) {
	$('#DynamicGridp_2').hide();
	var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
    $("#partycontent").empty();
	$('#partycontent').html(loading);
    $("#pr_container_name").html("/");
			partytotalweight_check();
			partytotalbill_check();
			
			totalbasic_check();	
			totaltax_check();
			totalbill_check();
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('customer_billing/list_individualparty');?>",
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
			partytotaltax_check();
			var selectcoil = '<input type="radio" id="radio_'+item.coilnumber+'" name="list" value="'+item.coilnumber+'"   onClick=showchild("'+item.coilnumber+'") />';
			thisdata["billdate"] = item.billdate;
            thisdata["billno"] = item.billno;
            thisdata["coilnumber"] = item.coilnumber;
            thisdata["Type of Material"] = item.description;
            thisdata["weight in (Tonnes)"] = item.weight;
            thisdata["Basic Amount"] = item.totalamt;
            thisdata["Service Tax"] = item.tax;
			 thisdata["Total Bill Amount"] = item.totalbillamount;
			var pr = '<a class="ico_print" title="Print" href="'+item.pr+'" target="_blank"><img src="<?php echo img_path('iconset/ico_print.png'); ?>" /></a>';
            //thisdata["action"] = '';
			//thisdata["action"] = '';
			
			partytotalbasic_check();
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
	
	var dataString =  'partyname='+party_account_name+'&frmdate='+selector+'&todate='+selector1;
	$.ajax({  
		   type: "POST",  
		  // url : "<?php echo fuel_url('billing_statement/billing_pdf');?>/",  
		//   data: dataString,
		   success: function(msg)
		   {  
			
			var dataString =  'partyname='+party_account_name+'&frmdate='+selector+'&todate='+selector1;
			var url = "<?php echo fuel_url('customer_billing/billing_pdf');?>/?"+dataString;
		    window.open(url);
		   }  
		}); 

}

</script>  