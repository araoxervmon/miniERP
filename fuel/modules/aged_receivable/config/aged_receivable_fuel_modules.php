<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['aged_receivable'] = array(
		'module_name' => 'Aged Receivable',
		'module_uri' => 'aged_receivable',
		'model_name' => 'aged_receivable_model',
		'model_location' => 'aged_receivable',
		'permission' => 'aged_receivable',
		'nav_selected' => 'aged_receivable',
		'instructions' => lang('module_instructions', 'aged_receivable'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('aged_receivable/editCoil' => lang('edit_coil'),'aged_receivable/cuttingInstruction' => lang('cutting_instruction')))	
	);
