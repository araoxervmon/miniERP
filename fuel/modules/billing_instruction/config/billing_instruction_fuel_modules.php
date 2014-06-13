<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['billing_instruction'] = array(
		'module_name' => 'BILLING INSTRUCTION',
		'module_uri' => 'billing_instruction',
		'model_name' => 'billing_instruction_model',
		'model_location' => 'billing_instruction',
		'permission' => 'billing_instruction',
		'nav_selected' => 'billing_instruction',
		'instructions' => lang('module_instructions', 'billing_instruction'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
