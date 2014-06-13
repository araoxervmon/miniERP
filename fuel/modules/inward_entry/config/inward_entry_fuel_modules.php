<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['inward_entry'] = array(
		'module_name' => 'Inward Entry',
		'module_uri' => 'inward_entry',
		'model_name' => 'inward_entry_model',
		'model_location' => 'inward_entry',
		'nav_selected' => 'inward_entry',
		'instructions' => lang('module_instructions', 'inward_entry'),
		'item_actions' => array('save', 'view', 'delete'),
);	
		

