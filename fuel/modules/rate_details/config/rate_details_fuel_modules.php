<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_details'] = array(
		'module_name' => 'Rate Details',
		'module_uri' => 'rate_details',
		'model_name' => 'rate_details_model',
		'model_location' => 'rate_details',
		'permission' => 'rate_details',
		'nav_selected' => 'rate_details',
		'instructions' => lang('module_instructions', 'rate_details'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

