<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/


// This will directly place the finish task under the models and not under aspen category
$config['modules']['finish_task'] = array(
	'module_name' => 'Finish Task',
	'module_uri' => 'finish_task',
	'permission' => 'finish_task',
	'nav_selected' => 'finish_task'
);
