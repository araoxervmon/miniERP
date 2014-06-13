<div id="main_top_panel">
	<h2 class="ico ico_<?=url_title(str_replace('/', '_', $this->module_uri),'_', TRUE)?>"><a href="<?=fuel_url($this->module_uri)?>"><?=$this->module_name?></a> 
	</h2>
</div>
<div class="clear"></div>

<div style="padding:5px 0px 15px;"> <div id="main_top_panel_header"><?=lang('action_'.$action)?> <?php

if(!empty($data['name'])) {
	
	echo ': <span style="font: 14px bold;"><em>'.strip_tags($data['name']).'</em></span></div>';
}

else {
	if (!empty($data[$this->display_field])) {
		echo ': <span style="font: 14px bold;"><em>'.character_limiter(strip_tags($data[$this->display_field]), 50).'</em></span></div>';
	}
}
?>
</div>

<div id="action">

	<?=$actions?>

</div>

<div id="notification" class="notification">
	<?=$notifications?>
</div>
<div>
	<div id="notification_extra" class="notification">
		<?php if (!empty($data['published']) && !is_true_val($data['published'])) {?>
				<div class="warning ico ico_warn"><?=lang('warn_not_published')?></div>
		<?php } else if (!empty($data['active']) && !is_true_val($data['active'])) {?>
			<div class="warning ico ico_warn"><?=lang('warn_not_active', strtolower(substr($this->module_name, 0, -1)))?></div>
		<?php } ?>
	</div><br />
	
	<?php if (!empty($warning_window)) : ?>
		<div class="warning jqmWindow jqmWindowShow" id="warning_window">
			<p><?=$warning_window?></p>
		
			<div class="buttonbar" id="yes_no_modal">
				<ul>
					<li class="end"><a href="#" class="ico ico_no" id="no_modal"><?=lang('btn_no')?></a></li>
					<li class="end"><a href="#" class="ico ico_yes" id="yes_modal"><?=lang('btn_yes')?></a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	
	<?php endif; ?>

	<div id="main_content_inner">
		<p class="instructions"><?=$this->instructions?></p>

		<form method="post" action="<?=fuel_url($this->module_uri.'/'.$action.'/'.$id)?>" enctype="multipart/form-data" id="form">
		<?=$form?>
		</form>
	
	</div>
</div>