<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['slitting_thickness'] = array(
		'module_name' => 'Slitting Thickness',
		'module_uri' => 'slitting_thickness',
		'model_name' => 'slitting_thickness_model',
		'model_location' => 'slitting_thickness',
		'permission' => 'slitting_thickness',
		'nav_selected' => 'slitting_thickness',
		'instructions' => lang('module_instructions', 'slitting_thickness'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

