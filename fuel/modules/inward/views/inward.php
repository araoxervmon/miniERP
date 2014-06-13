 <script>
 function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#pname').addClass('load');
			$.post("<?php echo fuel_url('inward/autosuggest');?>", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#pname').removeClass('load');
				}
			});
		}
	}


	
	/*function fill(thisValue) {
		$('#pname').val(thisValue);
		var pname = thisValue;
		if(thisValue != 'No Record'){
			setTimeout("location.href='<?= site_url('fuel/inward'); ?>/?pname="+pname+"'");
		}else{
			setTimeout("$('#suggestions').fadeOut();", 600);
		}
	}*/
	
	
	
	function fill(thisValue) {
		$('#pname').val(thisValue);
		var pname = thisValue;
		if(thisValue != 'No Record'){
			//alert(pname);
        document.getElementById('pname').value = pname;
			setTimeout("$('#suggestions').fadeOut();", 200);
	
			
		}
	}
	
	
	
	</script>
<div id="main_top_panel">

	<h2 class="ico ico ico_inward">Inward Register</h2>
</div>

<?php include_once(INWARD_PATH.'views/_blocks/toolbar.php');?>		
<?php include_once(INWARD_PATH.'views/_blocks/layout.php');?>		
 
