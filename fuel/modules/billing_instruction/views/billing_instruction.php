<script type="text/javascript">
/* Get the currently selected azure account and ajax load the folder list. */
function load_party_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    // function in _blocks/layout
    $('#content').html('Bundles List!');
}

function load_slit_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    loadfolderlist_slit(account_id, accountname);
}
function load_recoil_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    loadfolderlist_recoil(account_id, accountname);
}

function load_cutting_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    loadfolderlist(account_id, accountname);
}

/* Refresh the left folder, then if there was something selected, reselect
    it so that the right pane refreshes.  */
function refresh_folderlist() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
	/*alert(selected);
    var folderid = "";
    if (selected.length > 0) {
        folderid = selected.attr("id");
    }
    $("#party_list").data("selected-folder", folderid);*/
    load_party_account();
}
$(document).ready(function() { 
    load_party_account();
	function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
var pchk = getUrlVars()["process"];

	if(pchk=="Cutting"){
	load_cutting_account();
	}
	else if(pchk=="Slitting"){
	load_slit_account();
	}
	else if(pchk=="Recoiling"){
	load_recoil_account();
	}
});
</script> 
<div id="main_top_panel">
	<h2 class="ico ico_azure_storage"><?=lang('module_billing_instruction')?></h2>
</div>
<?php 

 if($process=='Cutting')
 {  
 include_once(BILLING_INSTRUCTION_PATH.'views/_blocks/layout.php');
}

else if($process=='Slitting')
{ 
 include_once(BILLING_INSTRUCTION_PATH.'views/_blocks/layout_slitting.php');
} 


else if($process=='Recoiling')
{ 
 include_once(BILLING_INSTRUCTION_PATH.'views/_blocks/layout_recoiling.php'); 
}
else if($process=='sf')
{ 
 include_once(BILLING_INSTRUCTION_PATH.'views/_blocks/layout_directsemi.php'); 
}
else 
{ 
 include_once(BILLING_INSTRUCTION_PATH.'views/_blocks/layout_direct.php'); 
}  
?>
