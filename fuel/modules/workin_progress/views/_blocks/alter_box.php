<form class="cmxform" id="comment_create_container_azure" method="post" action="<?php echo fuel_url('workin_progress/alter_box');?>">
<div id="boxes">
	<!-- Start of Login Dialog -->  
	<div id="create" class="window" style="left:390px !important;">
	<div style="padding:5px 20px">
		<div style="color:#2f94c8; font-size:16px;"><?=lang('Alter_btn')?></div>
		<div class="d-header">
	
		<div style="padding:30px 0px; font-size:13px; font-weight:bold; color:#ffffff !important;">
			<?=lang('key_container_name')?>
		</div>
	  <div style="padding:10px 20px;">
			<div style="color:#2f94c8; font-size:14px; padding:0px 0px 10px;"><label for="cname"></label><?php echo lang('container_name');?></label><em><font color="red">*</font></em> </div>
			<input type="text" id="container_name" name="container_name" class="required" size="25" class="required" minlength="5" style="border:1px solid #9ecde5; width:300px; padding:5px;" />
            <span id="alter_box_error" style="color:red"></span>
	  </div>
	  <table width="100%">
	  <tr>
	  <td width="48%" align="left" valign="top">
	  <div style="padding:0px 10px 0px 20px;">
            <strong>Visibility:</strong><br />
            <input type="radio" id="scope_public" name="scope_identifier" value ="public" checked /> Public <br />
            <input type="radio" id="scope_private" name="scope_identifier" value ="private" /> Private 
	  </div>
	  </td>
	  <td width="4%">&nbsp;</td>
	  <td width="48%" align="left" valign="top">
      <div id="folder_location_box" style="padding:0px 10px;">
          <strong>Folder location:</strong><br />
          <input type="radio" name="create_location" value ="child" checked /> Child of <span id="create_parent_folder_name"></span> <br />
          <input type="radio" name="create_location" value="root"> Root folder 
      </div>
	  </td>
	  </tr>
	  </table>
		<style type="text/css">
		div#createcontaineraction input[type="button"], input[type="submit"] { border:0px !important;  margin: 0; -moz-border-radius:0px; -webkit-border-radius:0px; border-radius:0px; color:#278fc1 !important;}
		div#createcontaineraction input[type="button"]:hover, input[type="submit"]:hover{ border:0px !important;  margin: 0; -moz-border-radius:0px; -webkit-border-radius:0px; border-radius:0px; color:#278fc1 !important;}
		</style>
		<div id="createcontaineraction" style="padding:10px 20px 5px;">
				<input type="submit" id="save" name="save" value="Save" align="center" style="background:url('<?php echo img_path('save_button.png'); ?>') no-repeat !important; width:91px; height:39px; border: 0px solid #DDDDDD; color:#ffffff !important;" /> &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Cancel" class="close" style="background:url('<?php echo img_path('save_button.png'); ?>') no-repeat !important; width:91px; height:39px; color:#ffffff !important;"/>
		</div>
				
	    <div align="center" id="divsuccess_create" name="divsuccess_create" style="display: none; padding: 0px; color:#333333; width:300px;"><center><img src="<?php echo img_path('loading.gif'); ?>" ><?=lang('saving_container')?></center></div>
		
	  </div>
	  <div class="d-blank"></div>
	</div>
	</div>
	<!-- End of Login Dialog -->  
	
	<!-- Mask to cover the whole screen -->
	  <div id="mask"></div>
</div>
</form>
