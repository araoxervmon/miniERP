<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'reports'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'reports/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'reports'] = 'reports';
$route[FUEL_ROUTE.'reports/workinprogress_list'] = 'reports/workinprogress_list';


