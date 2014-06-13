<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_details_width'] = array(
		'module_name' => 'Rate Details Width',
		'module_uri' => 'rate_details_width',
		'model_name' => 'rate_details_width_model',
		'model_location' => 'rate_details_width',
		'permission' => 'rate_details_width',
		'nav_selected' => 'rate_details_width',
		'instructions' => lang('module_instructions', 'rate_details_width'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

