<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['average_party'] = array(
		'module_name' => 'Customer Billing Report',
		'module_uri' => 'average_party',
		'model_name' => 'average_party_model',
		'model_location' => 'average_party',
		'permission' => 'average_party',
		'nav_selected' => 'average_party',
		'instructions' => lang('module_instructions', 'average_party'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('average_party/editCoil' => lang('edit_coil'),'average_party/cuttingInstruction' => lang('cutting_instruction')))	
	);
