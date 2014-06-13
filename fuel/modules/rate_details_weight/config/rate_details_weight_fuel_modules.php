<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_details_weight'] = array(
		'module_name' => 'Rate Details Weight',
		'module_uri' => 'rate_details_weight',
		'model_name' => 'rate_details_weight_model',
		'model_location' => 'rate_details_weight',
		'permission' => 'rate_details_weight',
		'nav_selected' => 'rate_details_weight',
		'instructions' => lang('module_instructions', 'rate_details_weight'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

