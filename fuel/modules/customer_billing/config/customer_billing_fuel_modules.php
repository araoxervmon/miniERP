<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['customer_billing'] = array(
		'module_name' => 'Customer Billing Report',
		'module_uri' => 'customer_billing',
		'model_name' => 'customer_billing_model',
		'model_location' => 'customer_billing',
		'permission' => 'customer_billing',
		'nav_selected' => 'customer_billing',
		'instructions' => lang('module_instructions', 'customer_billing'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('billing_statement/editCoil' => lang('edit_coil'),'billing_statement/cuttingInstruction' => lang('cutting_instruction')))	
	);
