<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['tax_details'] = array(
		'module_name' => 'Tax Details',
		'module_uri' => 'tax_details',
		'model_name' => 'tax_details_model',
		'model_location' => 'tax_details',
		'permission' => 'tax_details',
		'nav_selected' => 'tax_details',
		'instructions' => lang('module_instructions', 'tax_details'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

