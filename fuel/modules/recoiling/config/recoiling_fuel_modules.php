<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['recoiling'] = array(
		'module_name' => 'RECOILING',
		'module_uri' => 'recoiling',
		'model_name' => 'recoiling_model',
		'model_location' => 'recoiling',
		'permission' => 'recoiling',
		'nav_selected' => 'recoiling',
		'instructions' => lang('module_instructions', 'recoiling'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
