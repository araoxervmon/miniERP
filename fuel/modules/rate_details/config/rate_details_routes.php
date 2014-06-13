<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_details'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_details/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_details'] = 'rate_details';
$route[FUEL_ROUTE.'rate_details/dashboard'] = 'rate_details/dashboard';
$route[FUEL_ROUTE.'rate_details/SelectCoilName'] = 'rate_details/SelectCoilName';
$route[FUEL_ROUTE.'rate_details/saveratedetails'] = 'rate_details/saveratedetails';
$route[FUEL_ROUTE.'rate_details/formdisplay'] = 'rate_details/formdisplay';
$route[FUEL_ROUTE.'rate_details/deleterow'] = 'rate_details/deleterow';
$route[FUEL_ROUTE.'rate_details/CoilName'] = 'rate_details/CoilName';
$route[FUEL_ROUTE.'rate_details/updateratedetails'] = 'rate_details/updateratedetails';
$route[FUEL_ROUTE.'rate_details/tablewidth'] = 'rate_details/tablewidth';