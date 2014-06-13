<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['transfer_instruction'] = array(
		'module_name' => 'TRANSFER INSTRUCTION',
		'module_uri' => 'transfer_instruction',
		'model_name' => 'transfer_instruction_model',
		'model_location' => 'transfer_instruction',
		'permission' => 'transfer_instruction',
		'nav_selected' => 'transfer_instruction',
		'instructions' => lang('module_instructions', 'transfer_instruction'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
