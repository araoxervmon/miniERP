<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['rate_direct_billing'] = array(
		'module_name' => 'Rate Details Thickness',
		'module_uri' => 'rate_direct_billing',
		'model_name' => 'rate_direct_billing_model',
		'model_location' => 'rate_direct_billing',
		'permission' => 'rate_direct_billing',
		'nav_selected' => 'rate_direct_billing',
		'instructions' => lang('module_instructions', 'rate_direct_billing'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

