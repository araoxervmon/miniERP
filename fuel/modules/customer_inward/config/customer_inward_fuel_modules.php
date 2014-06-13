<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['customer_inward'] = array(
		'module_name' => 'Customer Inward Report',
		'module_uri' => 'customer_inward',
		'model_name' => 'customer_inward_model',
		'model_location' => 'customer_inward',
		'permission' => 'customer_inward',
		'nav_selected' => 'customer_inward',
		'instructions' => lang('module_instructions', 'customer_inward'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('customer_inward/editCoil' => lang('edit_coil'),'customer_inward/cuttingInstruction' => lang('cutting_instruction')))	
	);
