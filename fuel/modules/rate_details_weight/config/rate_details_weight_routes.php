<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_details_weight'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_details_weight/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_details_weight'] = 'rate_details_weight';
$route[FUEL_ROUTE.'rate_details_weight/dashboard'] = 'rate_details_weight/dashboard';
$route[FUEL_ROUTE.'rate_details_weight/SelectCoilName'] = 'rate_details_weight/SelectCoilName';
$route[FUEL_ROUTE.'rate_details_weight/saveratedetails'] = 'rate_details_weight/saveratedetails';
$route[FUEL_ROUTE.'rate_details_weight/formdisplay'] = 'rate_details_weight/formdisplay';
$route[FUEL_ROUTE.'rate_details_weight/deleterow'] = 'rate_details_weight/deleterow';
$route[FUEL_ROUTE.'rate_details_weight/coil'] = 'rate_details_weight/coil';
$route[FUEL_ROUTE.'rate_details_weight/updateratedetails'] = 'rate_details_weight/updateratedetails';
$route[FUEL_ROUTE.'rate_details_weight/tableweight'] = 'rate_details_weight/tableweight';
$route[FUEL_ROUTE.'rate_details_weight/listrateweight'] = 'rate_details_weight/listrateweight';
$route[FUEL_ROUTE.'rate_details_weight/deleterateweight_coil'] = 'rate_details_weight/deleterateweight_coil';
$route[FUEL_ROUTE.'rate_details_weight/checkweightexist'] = 'rate_details_weight/checkweightexist';
$route[FUEL_ROUTE.'rate_details_weight/minweightexist'] = 'rate_details_weight/minweightexist';
$route[FUEL_ROUTE.'rate_details_weight/maxweightexist'] = 'rate_details_weight/maxweightexist';