<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_details_length'] = array(
		'module_name' => 'Rate Details Length',
		'module_uri' => 'rate_details_length',
		'model_name' => 'rate_details_length_model',
		'model_location' => 'rate_details_length',
		'permission' => 'rate_details_length',
		'nav_selected' => 'rate_details_length',
		'instructions' => lang('module_instructions', 'rate_details_length'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

