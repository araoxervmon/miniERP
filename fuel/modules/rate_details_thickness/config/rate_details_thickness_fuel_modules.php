<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_details_thickness'] = array(
		'module_name' => 'Rate Details Thickness',
		'module_uri' => 'rate_details_thickness',
		'model_name' => 'rate_details_thickness_model',
		'model_location' => 'rate_details_thickness',
		'permission' => 'rate_details_thickness',
		'nav_selected' => 'rate_details_thickness',
		'instructions' => lang('module_instructions', 'rate_details_thickness'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

