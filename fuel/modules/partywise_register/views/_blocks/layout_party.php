<?php include_once(PARTYWISE_REGISTER_PATH.'views/_blocks/toolbar_party.php');?>	
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
	<div id="DynamicGridp_2">
        Select a Party Name
	</div>
</div>
</div>
</div>
</div>
<!-- @END -->

<!-- SUB PARTWISE @START -->
<div class="tabcontentpr hidepr" id="contpr-2-1" style="height:541px;"> 
<div id="pr-content" style="width:100%">
<h2 class="innercellpr" style="margin-bottom:0px !important;"><div class="pr-content-title">List for <span class="container_root" id="pr_container_name">/</span> coil number:</div></h2>
<div id="contentsholder"  style="width:100%; height:450px; overflow-x:hidden; overflow-y:auto;">
<div id="content" style="width:100%; min-height:450px; overflow:hidden;"> 
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
function totalweight_check(){
	var party_account_name = $('#party_individualaccount_name').val();
	var dataString = '&party_account_name='+party_account_name;
$.ajax({  
	   type: "POST",  
	   url : "<?php echo fuel_url('partywise_register/totalweight_check');?>/",  
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
function loadindividualfolderlist(individualaccount_id, individualaccountname) {
	$('#DynamicGridp_2').hide();
	var loading = '<div id="DynamicGridLoadingp_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
    $("#partycontent").empty();
	$('#partycontent').html(loading);
    $("#pr_container_name").html("/");
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('partywise_register/list_individualparty');?>",
        data: "party_individualaccount_name=" + individualaccount_id,
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
			thisdata["select"] = selectcoil;
			thisdata["coilnumber"] = item.coilnumber;
            thisdata["received date"] = item.receiveddate;
            thisdata["description"] = item.description;
            thisdata["thickness in (mm)"] = item.thickness;
            thisdata["width in (mm)"] = item.width;
            thisdata["Inward weight in (kgs)"] = item.weight;
			thisdata["Present weight in (kgs)"] = item.pweight;
            thisdata["status"] = item.status;
            thisdata["process"] = item.process;
			totalweight_check();
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGridp_2').hide();
				$('#DynamicGridLoadingp_2').hide();
				$('#partycontent').html(CreateTableViewX(partydata, "lightPro", true)); 
				var lcScrollbar = $('#contentsholder');	 
				fleXenv.updateScrollBars(lcScrollbar); 
				$(".ico_coil_delete").click(function (e) {
                // When a delete icon is clicked, stop the href action
                //  and do an ajax call to delete it instead
                e.preventDefault();
                //var thecont = $(this).data("container");
                //var thename = $(this).data("name");
                var data = {account_name: individualaccount_id};
                var href = $(this).attr('href');
                $.post(href, data, function (d) {
                loadindividualfolderlist(individualaccount_id, individualaccountname);
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

function showchild(parentid) {
	$('#pr_container_name').html(parentid);
	 $('#DynamicGrid_2').hide();
	 var loading = '<div id="DynamicGridLoading_2"> '+
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading child coils... </span> '+ 
    	    	   ' </div>';
	 $('#content').html(loading); 
		$.ajax({
				type: "POST",
				url: "<?php echo fuel_url('partywise_register/listindividualChilds');?>",
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
<script type="text/javascript">
function cuttinginstruction(id)
{
	var coilnumber = $('#vno'+id).val();
	document.getElementById('partnamecheck').value = coilnumber;
}
</script>  