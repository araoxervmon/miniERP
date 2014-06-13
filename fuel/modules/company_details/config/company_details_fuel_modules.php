<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['company_details'] = array(
		'module_name' => 'Company Details',
		'module_uri' => 'company_details',
		'model_name' => 'company_details_model',
		'model_location' => 'company_details',
		'permission' => 'company_details',
		'nav_selected' => 'company_details',
		'instructions' => lang('module_instructions', 'company_details'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

