
<script type="text/javascript">
function pullFolders(selectedItem) {

	
	$.post('<?php echo fuel_url("partywise_register/list_coil"); ?>',
		{ storage_account : selectedItem },
		function(response) {  
			
		}  
	);
}
$(document).ready(function() { 

    $("#party_account_name").change(function(data) {
        load_party_account();
    });
    load_party_account();
});

function load_party_account() {
    // function in _blocks/layout
    loadfolderlist();
    $('#content').html('Select a Parent Coil!');
}

</script> 

<div id="main_top_panel">
	<h2 class="ico ico_reports">Reports</h2>
</div>
	
<?php include_once(REPORTS_PATH.'views/_blocks/toolbar.php');?>	
<?php include_once(REPORTS_PATH.'views/_blocks/layout.php');?>		
