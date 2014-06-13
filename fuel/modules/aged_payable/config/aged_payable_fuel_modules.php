<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['aged_payable'] = array(
		'module_name' => 'Aged Payable',
		'module_uri' => 'aged_payable',
		'model_name' => 'aged_payable_model',
		'model_location' => 'aged_payable',
		'permission' => 'aged_payable',
		'nav_selected' => 'aged_payable',
		'instructions' => lang('module_instructions', 'aged_payable'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('aged_payable/editCoil' => lang('edit_coil'),'aged_payable/cuttingInstruction' => lang('cutting_instruction')))	
	);
