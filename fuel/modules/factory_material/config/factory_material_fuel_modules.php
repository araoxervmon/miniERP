<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['factory_material'] = array(
		'module_name' => 'Factory Material',
		'module_uri' => 'factory_material',
		'model_name' => 'factory_material_model',
		'model_location' => 'factory_material',
		'permission' => 'factory_material',
		'nav_selected' => 'factory_material',
		'instructions' => lang('module_instructions', 'factory_material'),
		'item_actions' => array('create','save', 'view', 'delete'),
		'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'create'),
);	
	

