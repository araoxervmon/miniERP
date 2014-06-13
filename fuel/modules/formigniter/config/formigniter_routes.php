<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'formigniter'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'formigniter/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'formigniter'] = 'formigniter';
$route[FUEL_ROUTE.'formigniter/dashboard'] = 'formigniter/dashboard';