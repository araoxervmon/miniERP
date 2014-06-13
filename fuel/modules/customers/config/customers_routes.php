<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'customers'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'customers/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'customers/dashboard'] = 'customers/dashboard';
//$route[FUEL_ROUTE.'inward_entry'] = 'inward_entry';
$route[FUEL_ROUTE.'customers/listitems'] = 'customers/listitems';
$route[FUEL_ROUTE.'customers/autosuggest'] = 'customers/autosuggest';