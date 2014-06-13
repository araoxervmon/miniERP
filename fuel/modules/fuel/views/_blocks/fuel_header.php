<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="<?php echo img_path();?>favicon.ico" type="image/x-icon"/>
 	<title><?=$page_title?></title>

	<?=css('picker, theme.blue, bootstrap-select,bootstrap-select.min,  jqmodal, markitup, jquery.tooltip,jquery-ui, print,style,jquery.supercomboselect, jquery.treeview,easyui,icon, fuel, flexcrollstyles, minierp, jdash, json_table, autosuggest, jquery.datepick, jquery.autocom,bootstrap.min ', 'fuel')?>

	<?php foreach($css as $c) : echo css($c); endforeach; ?>
	
	<!-- SpalshScreen -->
<!--	<div id="splashscreen" class="overlay">
		<div class="table-cell">
			<img src="<?=img_path() ?>ajax-loader.gif" alt="Loading" />
			<br/>
			<p style="color:#3383AA;"><b>Loading stuff. Please wait...</b></p>
			
			<img src="<?=img_path() ?>xervmon_logo.png" alt="Hooduku ERP"/>
		</div>
	</div>-->
	
	<script type="text/javascript">
		<?=$this->load->module_view(FUEL_FOLDER, '_blocks/fuel_header_jqx', array(), TRUE)?>
	</script>
	<?=js('jquery/jquery', 'fuel')?>
	<?=js('jquery/addrow', 'fuel')?>
	<?=js('jquery/jquery.datepick', 'fuel')?>
	<?=js('jquery/addrowit', 'fuel')?>
	<?=js('jquery/addrowhouse', 'fuel')?>
	<?=js('jquery/jquery-ui.min', 'fuel')?>
	<?=js('jquery/example', 'fuel')?>
	<?=js('jquery/json.htmTable', 'fuel')?>
	<?=js('jquery/plugins/jdash', 'fuel')?>
	<?=js('jquery/plugins/jquery.autocomplete', 'fuel')?>
	<?=js('jqx/jqx', 'fuel')?>
	<?=js('jquery/jquery-1.3.1.min', 'fuel')?>
	<?=js($this->config->item('fuel_javascript', 'fuel'), 'fuel')?>
	<?php foreach($js as $m => $j) : echo js(array($m => $j)); endforeach; ?>

	
	<?php if (!empty($this->js_controller)) : ?> 
	<script type="text/javascript">
		<?php if ($this->js_controller != 'BaseFuelController') : ?>
		jqx.addPreload('fuel.controller.BaseFuelController');
		<?php endif; ?>
		jqx.init('<?=$this->js_controller?>', <?=json_encode($this->js_controller_params)?>, '<?=$this->js_controller_path?>');
	</script>
	
	
	<script type="text/javascript">
	/*	$(window).load(function(){
			setTimeout(function(){$("#splashscreen").fadeOut("fast");}, 0);
		});*/
	</script>

	<?php endif; ?>
<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
  
  
  function sidebarHide(object)
{var status = document.getElementById(object).style.display;
 //alert(document.getElementById(object).style.display);
 if(status == "inline")

 { 
  status = "none";
	}
 else
 {
 status = "inline";
	}

}  
  
  
  
</script>	
	<script type='text/javascript' src="http://www.hesido.com/flexcroll/variations-howto's/always_display/flexcroll.js"></script>
</head>
<body>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
$("#nPartyName").change(function() {
      var nPartyName = $("#nPartyName").val();
    var value = $("#nPartyName").val().replace('&','And');
   document.getElementById('nPartyName').value=value;
    $('#vCusrate').hide();
    });
  });
  
  $(document).ready(function() {
$("#quantity_on_hand").change(function() {
    var quantityonhand = $("#quantity_on_hand").val();
   document.getElementById('quantity_on_order').value=quantityonhand;
    });
  });
  $(document).ready(function() {
 $("#quantity_on_hand").attr('readonly','readonly');
 $("#quantity_on_order").attr('readonly','readonly');
  });

  $(window).load(function() {
    $('#loading_content').hide();
	
	/* Calculating height for left nav By Gaurav*/
	var heighttdsecond = $("div#tdsecond").height();
	//alert(heighttdsecond);
	var heighttdone = heighttdsecond - "70";
	var heightone = heighttdone + "px";
	$("#vewscroller").css( "height", heightone);
	$("#vewscroller").css( "width", "210px");
	$("#vewscroller").css( "overflow", "auto");
  });
</script>
<div id="fuel_header">
	<div id="login_logout">
		<div style="padding:0px;">
			<div style="float:left; width:140px;">
				<center>&nbsp; <?=lang('logged_in_as')?>
			<a style="color:#3383AA !important;"><?=$user['user_name']?></a></center>
			</div>
			<div style="float:right; width:106px; padding-top:6px;">
				<a href="<?=fuel_url('logout')?>"><div align="center" class="logoutbtn"><?=lang('logout')?></div></a>
			</div>
		</div>
	</div>
</div>

<div id="fuel_body"  style="z-index: 2">
<div class="row-fluid">

	<div align="left" valign="top" class="span10" id="mainPanelDisplay" style="margin-left:0px;display:inline-block;">

	
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="left" valign="top" width="20px" style="background:url('<?php echo img_path('layout/div_topleft_norepeat.png'); ?>') no-repeat; height:50px; min-width:20px;">&nbsp;</td>
		<td align="left" valign="top" style="background:url('<?php echo img_path('layout/div_topcenter_repeatx.png'); ?>') repeat-x; height:50px;">
	      <?php include_once('topnav.php');?>
			<div style="background:url('<?php echo img_path('layout/div_toph.png'); ?>') no-repeat; width:275px; height:50px;">&nbsp;</div>
		</td>
		<td align="left" valign="top" width="24px" style="background:url('<?php echo img_path('layout/div_topright_norepeat.png'); ?>') no-repeat; height:50px;">&nbsp;</td>
	</tr>
	<tr>
		<td width="20px" align="left" valign="top" style="background:url('<?php echo img_path('layout/div_middleleft_repeaty.png'); ?>') repeat-y; min-width:20px;">&nbsp;</td>
		<td align="left" valign="top" style="background:#ffffff !important;">
			<div id="tdsecond" align="left" style="min-height:840px;">