<script language="javascript" type="text/javascript">
  $(window).load(function() {
	$("tr#childlist").hide();
	var lfScrollbar = $('#contentsfolder');	 
	fleXenv.updateScrollBars(lfScrollbar); 
  });
  


  function table( ) {
	$('#simpleTable').stupidtable();
	}
  
</script>
<div class="tab-boxpr"> 
	<div style="width:1100px;">
    <a href="javascript:;"><div class="tabLinkpr activeLinkpr" id="contpr-1" style="float:left;"><h1>Bill Book</h1></div></a>
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-2" style="float:left;"><h1>Partywise Billing Summary</h1></div></a>
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-3" style="float:left;"><h1>Process Register</h1></div></a> 
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-4" style="float:left;"><h1>Master And Stock Report</h1></div></a>
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-5" style="float:left;"><h1>ManagmentReport</h1></div></a>
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-6" style="float:left;"><h1>Transfer Stock</h1></div></a>
    <a href="javascript:;"><div class="tabLinkpr" id="contpr-7" style="float:left;"><h1>Transfer</h1></div></a>	
    </div>
</div>


<div id="main_content" style="overflow:hidden;">  
<div class="tabcontentpr" id="contpr-1-1">
<div id="party_list">
<div id="contentsfolder" class="flexcroll" style="width:100%; height:580px; overflow-x:hidden; overflow-y:auto;">
<div id="partycontent" style="width:100%; min-height:550px; overflow:hidden;"> 
	
	<div id="DynamicGridp_2">
	<div id="simpleTable">
        Select a Party Name
	</div>
    </div>
</div>
</div>
</div>
</div>
</div>
<input id="coilid" type="hidden" value="" name="coilid">
<input id="partyid" type="hidden" value="" name="partyid">
  <script type="text/javascript">
function finishtask(id)
{
	var coilnumber = $('#vnum'+id).val();
	var partyname = $('#pname'+id).val();
	document.getElementById('coilid').value = coilnumber;
	document.getElementById('partyid').value = partyname;
}

function loadfolderlist(account, accname) {
	$('#DynamicGridp_2').hide();
	var loading = '<div id="DynamicGridLoadingp_2"> '+ '<div id="simpleTable"> '+ 
            	   ' <img src="<?=img_path() ?>loading.gif" /><span> Loading Party List... </span> '+ 
    	    	   ' </div>';
    $.ajax({
        type: "POST",
        url: "<?php echo fuel_url('reports/workinprogress_list');?>",
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
			/*var selectcoil = '<input type="radio" id="radio_'+item.coilnumber+'" name="list" value="'+item.coilnumber+'"   onClick=showchild("'+item.coilnumber+'") />';
			thisdata["select"] = selectcoil;*/
			thisdata["billno"] = item.billno;
            thisdata["billdate"] = item.billdate;
            thisdata["coilnumber"] = item.coilnumber;
            thisdata["totalweight"] = item.totalweight;
            thisdata["weightamount"] = item.weightamount;
            thisdata["servicetax"] = item.servicetax;
            thisdata["tedutax"] = item.edutax;
            thisdata["sedutax"] = item.sedutax;
            thisdata["granttotal"] = item.granttotal;
			var cs = '<a title="Print" href="'+item.cs+'"><img src="<?php echo img_path('iconset/ico_cutting_slip.png'); ?>" /></a>';
			var al = '<a href="'+item.al+'"><img title="Cutting Instruction" src="<?php echo img_path('iconset/ico_cutting.png'); ?>" /></a>';
			var fi = '<a href="'+item.fi+'"><img title="Finish Task" src="<?php echo img_path('iconset/ico_finish_task.png'); ?>" /></a>';
            thisdata["action"] = cs + '    ' + al + ' ' + fi  ;
			//thisdata["action"] = '';
            partydata.push(thisdata);
			}
			if (partydata.length) {
            // If there are files
				$('#DynamicGridp_2').hide();
				$('#DynamicGridLoadingp_2').hide();
            $('#partycontent').html(CreateTableViewX(partydata, "lightPro", true)); 
			var lcScrollbar = $('#contentsholder');	 
			fleXenv.updateScrollBars(lcScrollbar); 
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
function cuttinginstruction(id)
{
	var coilnumber = $('#vno'+id).val();
	document.getElementById('partnamecheck').value = coilnumber;
}
</script>  