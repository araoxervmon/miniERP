<script type="text/javascript">
function pullFolders(selectedItem) {
$.post('<?php echo fuel_url("bill_descriptions/list_coil"); ?>',
	{ storage_account : selectedItem },
		function(response) {  
	}
	);
}



 </script> 

 
<div id="main_top_panel">
	<h2 class="ico ico_partywise_register">Bill Description</h2>
</div>
	
<?php 

include_once(BILL_DESCRIPTIONS_PATH.'views/_blocks/layout.php');


?>
