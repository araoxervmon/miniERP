<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'inward_entry'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'inward_entry/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'inward_entry/dashboard'] = 'inward_entry/dashboard';
//$route[FUEL_ROUTE.'inward_entry'] = 'inward_entry';
$route[FUEL_ROUTE.'inward_entry/listitems'] = 'inward_entry/listitems';
$route[FUEL_ROUTE.'inward_entry/autosuggest'] = 'inward_entry/autosuggest';