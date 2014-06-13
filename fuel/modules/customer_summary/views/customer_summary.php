<script type="text/javascript">
function pullFolders(selectedItem) {
$.post('<?php echo fuel_url("customer_summary/list_coil"); ?>',
	{ storage_account : selectedItem },
		function(response) {  
	}
	);
}

$('#cuttingInstruction').click(function(){
	var containername   = document.getElementById('textstorage').value;
	var source_provider =  document.getElementById('party').value;
	if(containername == "") {
		alert( "<?=lang('select_container_msg')?>");
		return;
	}  
});
 </script> 
<script type="text/javascript">
/* Get the currently selected azure account and ajax load the folder list. */
function load_party_account() {
    var account_id = $("#party_account_name").val();
    var accountname = $("#party_account_name :selected").html();
    // function in _blocks/layout
    loadfolderlist(account_id, accountname);
    $('#content').html('Select a Parent Coil!');
}

/* Refresh the left folder, then if there was something selected, reselect
    it so that the right pane refreshes.  */
function refresh_folderlist() {
    // Save selected
    var account_id = $("#party_account_name").val();
    var selected = $("#party_account_name :selected").html();
	alert(selected);
    var folderid = "";
    if (selected.length > 0) {
        folderid = selected.attr("id");
    }
    $("#party_list").data("selected-folder", folderid);
    load_party_account();
}
$(document).ready(function() { 

    $("#party_account_name").change(function(data) {
        load_party_account();
    });
    load_party_account();
});
</script> 
 

<div id="main_top_panel">
	<h2 class=" ico ico_customer_summary">Customer Summary </h2>
</div>

<?php include_once(CUSTOMER_SUMMARY_PATH.'views/_blocks/toolbar.php');?>		
<?php include_once(CUSTOMER_SUMMARY_PATH.'views/_blocks/layout.php');?>		

 <input type="hidden" id="textstorage" name="textstorage" />   

