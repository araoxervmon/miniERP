<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['customer_summary'] = array(
		'module_name' => 'Customer Summary Report',
		'module_uri' => 'customer_summary',
		'model_name' => 'customer_summary_model',
		'model_location' => 'customer_summary',
		'permission' => 'customer_summary',
		'nav_selected' => 'customer_summary',
		'instructions' => lang('module_instructions', 'customer_summary'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('billing_statement/editCoil' => lang('edit_coil'),'billing_statement/cuttingInstruction' => lang('cutting_instruction')))	
	);
