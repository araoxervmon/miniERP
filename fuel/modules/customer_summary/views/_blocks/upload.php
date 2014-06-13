<form method="post">
<div align="left">
<div style="padding:30px;">
<input type="hidden" name="textstorage" id="textstorage">
<input type="hidden" name="selected_folder_upload" id="selected_folder_upload">
		<div id="container">
					<?php 
					echo '<select name="selected_folder" id="selected_folder" onclick="setSelected(this.options[selectedIndex].value)" onchange="this.form.submit();" style="border: 1px solid #79bbdb !important; -moz-border-radius:0em; -webkit-border-radius:0em; border-radius:0em; padding:.6em .5em .6em !important;" ><br/>';

					foreach($folders as $folder) {
					if ($_POST['selected_folder'] == $folder->id) {
					//echo $_POST['selected_folder'];
						echo '<option value="'.$folder->id.'" selected>'.$folder->id."</option>";}else {
						echo '<option value="'.$folder->id.'">'.$folder->id."</option>";
						}				
					}
					echo '</select>';
				?>
		</div>		
		
		<div id="file-uploader" style="padding:5px 2px 0px;">
			<noscript>
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
			</noscript>
		</div>
</div>
</div>
</form>
