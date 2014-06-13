<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['cutting_instruction'] = array(
		'module_name' => 'CUTTING INSTRUCTION',
		'module_uri' => 'cutting_instruction',
		'model_name' => 'cutting_instruction_model',
		'model_location' => 'cutting_instruction',
		'permission' => 'cutting_instruction',
		'nav_selected' => 'cutting_instruction',
		'instructions' => lang('module_instructions', 'cutting_instruction'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
