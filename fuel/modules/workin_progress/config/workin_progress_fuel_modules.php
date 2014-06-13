<?php
// included in the main config/MY_fuel_modules.php


$config['modules']['workin_progress'] = array(
		'module_name' => 'Workin Progress',
		'module_uri' => 'workin_progress',
		'model_name' => 'workin_progress_model',
		'model_location' => 'workin_progress',
		'permission' => 'workin_progress',
		'nav_selected' => 'workin_progress',
		'instructions' => lang('module_instructions', 'workin_progress'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create', 'others' => array('my_module/backup' => 'Backup')),
);	
		
