<script type="text/javascript">
function pullFolders(selectedItem) {
$.post('<?php echo fuel_url("partywise_register/list_coil"); ?>',
	{ storage_account : selectedItem },
		function(response) {  
	}
	);
}

 </script> 
<script type="text/javascript">

function load_individualparty_account() {
    var individualaccount_id = $("#party_individualaccount_name").val();
    var individualaccountname = $("#party_individualaccount_name :selected").html();
    // function in _blocks/layout
    loadindividualfolderlist(individualaccount_id, individualaccountname);
    $('#content').html('Select a Parent Coil!');
}


$(document).ready(function() { 
	$("#party_individualaccount_name").change(function(data) {
        load_individualparty_account();
    });
});
</script> 
 
<div id="main_top_panel">
	<h2 class="ico ico_partywise_register"><?=lang('module_partywise_register')?></h2>
</div>
	
<?php 
$CI =& get_instance();
$userdata = $CI->fuel_auth->user_data();
if(($userdata['super_admin']== 'yes')) {
include_once(PARTYWISE_REGISTER_PATH.'views/_blocks/layout.php');
}
else if($userdata['user_name']== $chkuser[0]->nPartyName) {
	include_once(PARTYWISE_REGISTER_PATH.'views/_blocks/layout_party.php');
}
?>
