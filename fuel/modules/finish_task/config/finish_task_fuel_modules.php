<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['finish_task'] = array(
		'module_name' => 'Finish Task', //our module name
		'module_uri' => 'finish_task', //sometimes we use uri to display it in views tht time we give this fuel "uri"
		'model_name' => 'finish_task_model', //model name inside the finish_task folder-->model-->finish_task_model
		'model_location' => 'finish_task',
		'permission' => 'finish_task', //sometimes permission will be asssigned to the users
		'nav_selected' => 'finish_task', //mentioned in the finish_task.php under config file
		'instructions' => lang('module_instructions', 'finish_task'),
		'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create') 
		//these are for the buttons that display on the toolbar	
	);
