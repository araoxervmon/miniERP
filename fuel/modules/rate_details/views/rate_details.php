<style type="text/css">
	* { font-family: Verdana; font-size: 100%; }
	label { width: 12em; float: left; }
	label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
	p { clear: both; }
	.submit { margin-left: 12em; }
	em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>

<script type="text/javascript">
	
function pullFolders(selectedItem) {

	
	$.post('<?php echo fuel_url("rate_details/CoilName"); ?>',
		{ storage_account : selectedItem },
		function(response) {  
			
		}  
	);
}


 </script> 

<div id="main_top_panel">
	<h2 class="ico ico_azure_storage"><?=lang('module_rate_details')?></h2>
</div>

<?php include_once(RATE_DETAILS_PATH.'views/_blocks/toolbar.php');?>		
<?php include_once(RATE_DETAILS_PATH.'views/_blocks/layout.php');?>		

 <input type="hidden" id="textstorage" name="textstorage" />   
