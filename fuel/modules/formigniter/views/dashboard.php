<!--
<script type="text/javascript">
//<![CDATA[
	var html = '';
	<?php if ($this->fuel_auth->has_permission('tools/backup')) : ?>
	html = '<p class="blue ico ico_info"><?=lang('data_backup_dashboard')?><?php if (!empty($last_backup_date)) { ?>  (<?=lang('data_last_backup').' '.$last_backup_date?>)<?php } ?>.</p>';
	<?php endif; ?>
	
	// put it in the notification bar
	$('#notification').html(html);
//]]>
</script>

-->

<div id="main_top_panel">
	<h2 class="ico ico_storage"><a href="<?=fuel_url('inventory_adjustments')?>"><?=lang('inventory_adjustments')?></a> &gt; <?=lang('module_inventory_adjustments')?></h2>
</div>