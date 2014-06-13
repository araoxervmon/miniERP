<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['slitting_instruction'] = array(
		'module_name' => 'SLITTING INSTRUCTION',
		'module_uri' => 'slitting_instruction',
		'model_name' => 'slitting_instruction_model',
		'model_location' => 'slitting_instruction',
		'permission' => 'slitting_instruction',
		'nav_selected' => 'slitting_instruction',
		'instructions' => lang('module_instructions', 'slitting_instruction'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
