<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['inward'] = array(
		'module_name' => 'CREATE INWARD ENTRY',
		'module_uri' => 'inward',
		'model_name' => 'inward_model',
		'model_location' => 'inward',
		'permission' => 'inward',
		'nav_selected' => 'inward',
		'instructions' => lang('module_instructions', 'inward'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
	);
