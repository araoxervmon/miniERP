<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
//$config['nav']['inventory']['customers'] = lang('module_customers');
//$config['nav']['inventory']['customers/create'] =  lang('module_create_customers');
$config['modules']['customers'] = array(
	'module_name' => 'Customers',
	'module_uri' => 'customers',
	'permission' => 'customers',
	'nav_selected' => 'customers'
);