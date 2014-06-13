<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_details_length'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_details_length/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_details_length'] = 'rate_details_length';
$route[FUEL_ROUTE.'rate_details_length/dashboard'] = 'rate_details_length/dashboard';
$route[FUEL_ROUTE.'rate_details_length/SelectCoilName'] = 'rate_details_length/SelectCoilName';
$route[FUEL_ROUTE.'rate_details_length/saveratedetails'] = 'rate_details_length/saveratedetails';
$route[FUEL_ROUTE.'rate_details_length/formdisplay'] = 'rate_details_length/formdisplay';
$route[FUEL_ROUTE.'rate_details_length/deleterow'] = 'rate_details_length/deleterow';

$route[FUEL_ROUTE.'rate_details_length/coil'] = 'rate_details_length/coil';
$route[FUEL_ROUTE.'rate_details_length/updateratedetails'] = 'rate_details_length/updateratedetails';
$route[FUEL_ROUTE.'rate_details_length/tablewidth'] = 'rate_details_length/tablewidth';
$route[FUEL_ROUTE.'rate_details_length/listratelength'] = 'rate_details_length/listratelength';
$route[FUEL_ROUTE.'rate_details_length/deleteratelength_coil'] = 'rate_details_length/deleteratelength_coil';
$route[FUEL_ROUTE.'rate_details_length/checklengthexist'] = 'rate_details_length/checklengthexist';
$route[FUEL_ROUTE.'rate_details_length/minlengthexist'] = 'rate_details_length/minlengthexist';
$route[FUEL_ROUTE.'rate_details_length/maxlengthexist'] = 'rate_details_length/maxlengthexist';