<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['stock_report'] = array(
		'module_name' => 'STOCK REPORT',
		'module_uri' => 'stock_report',
		'model_name' => 'stock_report_model',
		'model_location' => 'stock_report',
		'permission' => 'stock_report',
		'nav_selected' => 'stock_report',
		'instructions' => lang('module_instructions', 'stock_report'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('stock_report/editCoil' => lang('edit_coil'),'stock_report/cuttingInstruction' => lang('cutting_instruction')))	
	);
