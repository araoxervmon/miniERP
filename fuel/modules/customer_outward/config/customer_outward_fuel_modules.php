<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['customer_outward'] = array(
		'module_name' => 'Customer Outward Report',
		'module_uri' => 'customer_outward',
		'model_name' => 'customer_outward_model',
		'model_location' => 'customer_outward',
		'permission' => 'customer_outward',
		'nav_selected' => 'customer_outward',
		'instructions' => lang('module_instructions', 'customer_outward'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('billing_statement/editCoil' => lang('edit_coil'),'billing_statement/cuttingInstruction' => lang('cutting_instruction')))	
	);
