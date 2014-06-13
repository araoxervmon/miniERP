<script type="text/javascript">
/* Get the currently selected azure account and ajax load the folder list. */
function load_party_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
    var slitnumber = "<?php echo $slno; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
	
    $('#content').html('Bundles List!');
}

function loadweightgrate_account(){
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	loadweightgrate(account_id, accountname);
}
function loadlengthgrate_account(){
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	loadlength(account_id, accountname);
}

function loadwidth_account(){
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	loadwidth(account_id, accountname);
}

function load_processing_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
    // function in _blocks/layout
    loadprocessingcharge(account_id, accountname);
}
function load_processing_accountslit() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var slitnumber = "<?php echo $slno; ?>";
    // function in _blocks/layout
    loadprocessingchargeslit(account_id, accountname);
}
function load_processing_accountrecoil() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
    // function in _blocks/layout
    loadprocessingchargerecoil(account_id, accountname);
}


function total_account() {
    // function in _blocks/layout
	var txttotalpcs=$('#txttotalpcs').val();
	var txttotalweight=$('#txttotalweight').val();
	var txtamount=$('#txtamount').val();
	loadtotal_account(txttotalpcs,txttotalweight,txtamount);
}

function load_folder_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
    loadfolderlist(account_id, accountname,bundlenumber);	
}
function load_folder_accountslit() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var slitnumber = "<?php echo $slno; ?>";
    loadfolderlistslit(account_id, accountname,slitnumber);	
}
function load_recoil_account() {
    var account_id = "<?php echo $partyid; ?>";
    var accountname = "<?php echo $partyname; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
    loadfolderlistrecoil(account_id, accountname,recoilnumber);	
}
/* Refresh the left folder, then if there was something selected, reselect
    it so that the right pane refreshes.  */
function refresh_folderlist() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	/*alert(selected);
    var folderid = "";
    if (selected.length > 0) {
        folderid = selected.attr("id");
    }
    $("#party_list").data("selected-folder", folderid);*/
    load_party_account();
}

function refresh_folderlistone() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
    load_folder_account();
}

function refresh_folderlistoneslit() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var slitnumber = "<?php echo $slno; ?>";
	load_processing_accountslit();
}
function refresh_folderlistonerecoil() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
	load_processing_accountrecoil();
}
function refresh_folderlisttwo() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	
    load_processing_account();
	loadlengthgrate_account();
    loadweightgrate_account();
	loadwidth_account();
	total_account();
}

function refresh_folderlisttwoslit() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var slitnumber = "<?php echo $slno; ?>";
	load_processing_accountslit();
}
function refresh_folderlisttworecoil() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
	load_processing_accountrecoil();
}

function refresh_folderlistthree() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var bundlenumber = "<?php echo $nsno; ?>";
	
    load_processing_account();
}
function refresh_folderlistthreeslit() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var slitnumber = "<?php echo $slno; ?>";
	load_processing_accountslit();
}

function refresh_folderlistthreerecoil() {
    // Save selected
    var account_id = "<?php echo $partyid; ?>";
    var selected = "<?php echo $partyid; ?>";
    var recoilnumber = "<?php echo $recno; ?>";
	load_processing_accountrecoil();
}


$(document).ready(function() { 

    /*$("#party_account_name").change(function(data) {
        load_party_account();
    });*/
    load_party_account();
	function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
var pchk = getUrlVars()["processchk"];
if(pchk=="Cutting"){
	load_folder_account();
	load_processing_account();
	}
	else if(pchk=="Slitting"){
	load_folder_accountslit();
	load_processing_accountslit();
	}
	else if(pchk=="Recoiling"){
	load_recoil_account();
	load_processing_accountrecoil();
	}
});
</script>

<div id="main_top_panel">
	<h2 class="ico ico_azure_storage"><?=lang('module_billing')?></h2>
</div>
	
<?php 

 if($processchk=='Cutting')
 {  
 include_once(BILLING_PATH.'views/_blocks/layout.php');
}

else if($processchk=='Slitting')
{ 
 include_once(BILLING_PATH.'views/_blocks/layout_directslit.php');
} 


else if($processchk=='Recoiling')
{ 
 include_once(BILLING_PATH.'views/_blocks/layout_directrecoil.php'); 
} 

else if($processchk=='sf')
{ 
 include_once(BILLING_PATH.'views/_blocks/layout_directbillsemi.php'); 
} 

else
{
 include_once(BILLING_PATH.'views/_blocks/layout_directbill.php'); 
}?>
 
