<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['formigniter'] = array(
		'module_name' => 'App Builders',
		'module_uri' => 'formigniter',
		'model_name' => 'formigniter_model',
		'model_location' => 'formigniter',
		'permission' => 'formigniter',
		'nav_selected' => 'formigniter',
		'instructions' => lang('module_instructions', 'formigniter'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')	
);	
		

