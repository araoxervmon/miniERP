<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['billing'] = array(
		'module_name' => 'BILLING',
		'module_uri' => 'billing',
		'model_name' => 'billing_model',
		'model_location' => 'billing',
		'permission' => 'billing',
		'nav_selected' => 'billing',
		'instructions' => lang('module_instructions', 'billing'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
