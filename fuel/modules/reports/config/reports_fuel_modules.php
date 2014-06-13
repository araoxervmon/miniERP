<?php
// included in the main config/MY_fuel_modules.php


$config['modules']['reports'] = array(
		'module_name' => 'REPORTS',
		'module_uri' => 'reports',
		'model_name' => 'reports_model',
		'model_location' => 'reports',
		'permission' => 'reports',
		'nav_selected' => 'reports',
		'instructions' => lang('module_instructions', 'reports'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create', 'others' => array('my_module/backup' => 'Backup')),
);	
		
