<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['partywise_register'] = array(
		'module_name' => 'PARTYWISE REGISTER',
		'module_uri' => 'partywise_register',
		'model_name' => 'partywise_register_model',
		'model_location' => 'partywise_register',
		'permission' => 'partywise_register',
		'nav_selected' => 'partywise_register',
		'instructions' => lang('module_instructions', 'partywise_register'),
		/*'default_col' => 'date_added',
		'display_field' => 'id',
		'filters' => array('date_added' => array('default' => date('Y-m-d',time()), 'label' => 'Queue Day', 'type' => 'select')),
		*/
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create', 'others' => array('partywise_register/editCoil' => lang('edit_coil'),'partywise_register/cuttingInstruction' => lang('cutting_instruction')))	
	);
