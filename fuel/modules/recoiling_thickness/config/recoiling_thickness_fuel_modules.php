<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['recoiling_thickness'] = array(
		'module_name' => 'Recoiling Thickness',
		'module_uri' => 'recoiling_thickness',
		'model_name' => 'recoiling_thickness_model',
		'model_location' => 'recoiling_thickness',
		'permission' => 'recoiling_thickness',
		'nav_selected' => 'recoiling_thickness',
		'instructions' => lang('module_instructions', 'recoiling_thickness'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

