<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['customers'] = array(
		'module_name' => 'Customers',
		'module_uri' => 'customers',
		'model_name' => 'customers_model',
		'model_location' => 'customers',
		'permission' => 'customers',
		'nav_selected' => 'customers',
		'instructions' => lang('module_instructions', 'customers'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
);	
		

