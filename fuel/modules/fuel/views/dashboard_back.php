<?php if ($change_pwd){ ?>
<div class="jqmWindow jqmWindowShow warning" id="change_pwd_notification">
	<p><?=lang('warn_change_default_pwd', $this->config->item('default_pwd', 'fuel'))?></p>

	<div class="buttonbar" id="yes_no_modal" style="width: 400px;">
		<ul>
			<li class="end"><a href="#" class="ico ico_no jqmClose" id="change_pwd_cancel"><?=lang('dashboard_change_pwd_later')?></a></li>
			<li class="end"><a href="<?=fuel_url('my_profile/edit/')?>" class="ico ico_yes" id="change_pwd_go"><?=lang('dashboard_change_pwd')?></a></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<?php } ?>

<div id="main_top_panel">
	<h2 class="ico ico_tools_dashboard"><?=lang('section_dashboard')?></h2>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  $(document).ready(function() {
      	  $("#jDash").jDashboard({ columns: 2 });
          
      });
</script>
<div align="center">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td rowspan="2">&nbsp;</td>
<td align="center">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="15px">&nbsp;</td>
<td align="left" id="action-newsannouncement" style="width:901px !important;">
<div id="notification" class="notification">
</div>
</td>
<td width="15px">&nbsp;</td>
</tr>
</table>
</td>

<td rowspan="2">&nbsp;</td>
</tr>
<tr>
<td width="910px" align="center">
<div id="jDash">
	
	<div class="jdash-item" style="width:910px !important;">
		<h1 class="jdash-head">Latest Activities</h1>
		<div class="jdash-body">
			<?php foreach($dashboards as $dashboard) : ?>
			<div id="dashboard_<?=$dashboard?>" class="dashboard_module">
				<div class="loader"></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
						
</div>

</td>
</tr>
</table>
</div>
<!-- Code Added By Gaurav - 25th April 2012 -->