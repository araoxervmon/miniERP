<script type="text/javascript">
/* Get the currently selected azure account and ajax load the folder list. */
function load_party_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    // function in _blocks/layout
    loadfolderlist(account_id, accountname);
	totalweight_check();
    $('#content').html('Bundles List!');
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
	totalweight_check();
}
$(document).ready(function() { 

    /*$("#party_account_name").change(function(data) {
        load_party_account();
    });*/
    load_party_account();
});
</script> 

<div id="main_top_panel">
	<h2 class="ico ico_azure_storage"><?=lang('module_cutting_instruction')?></h2>
</div>

<?php include_once(CUTTING_INSTRUCTION_PATH.'views/_blocks/toolbar.php');?>		
<?php include_once(CUTTING_INSTRUCTION_PATH.'views/_blocks/layout.php');?>		

 <input type="hidden" id="textstorage" name="textstorage" />   
