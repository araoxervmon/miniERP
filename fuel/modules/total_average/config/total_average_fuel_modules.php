<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['total_average'] = array(
		'module_name' => 'Customer Billing Report',
		'module_uri' => 'total_average',
		'model_name' => 'total_average_model',
		'model_location' => 'total_average',
		'permission' => 'total_average',
		'nav_selected' => 'total_average',
		'instructions' => lang('module_instructions', 'total_average'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('total_average/editCoil' => lang('edit_coil'),'total_average/cuttingInstruction' => lang('cutting_instruction')))	
	);
