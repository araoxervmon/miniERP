<script type="text/javascript">
function pullFolders(selectedItem) {
$.post('<?php echo fuel_url("stock_report/list_coil"); ?>',
	{ storage_account : selectedItem },
		function(response) {  
	}
	);
}

 </script> 


</script> 
 
<div id="main_top_panel">
	<h2 class=" ico ico_stock_report">Customer Stock Report </h2>
</div>
<?php include_once(STOCK_REPORT_PATH.'views/_blocks/toolbar.php');?>		
<?php include_once(STOCK_REPORT_PATH.'views/_blocks/layout.php');?>		

