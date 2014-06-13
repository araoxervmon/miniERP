<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_details_width'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_details_width/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_details_width'] = 'rate_details_width';
$route[FUEL_ROUTE.'rate_details_width/dashboard'] = 'rate_details_width/dashboard';
$route[FUEL_ROUTE.'rate_details_width/SelectCoilName'] = 'rate_details_width/SelectCoilName';
$route[FUEL_ROUTE.'rate_details_width/saveratedetails'] = 'rate_details_width/saveratedetails';
$route[FUEL_ROUTE.'rate_details_width/formdisplay'] = 'rate_details_width/formdisplay';
$route[FUEL_ROUTE.'rate_details_width/deleterow'] = 'rate_details_width/deleterow';
$route[FUEL_ROUTE.'rate_details_width/coil'] = 'rate_details_width/coil';
$route[FUEL_ROUTE.'rate_details_width/updateratedetails'] = 'rate_details_width/updateratedetails';
$route[FUEL_ROUTE.'rate_details_width/tablewidth'] = 'rate_details_width/tablewidth';
$route[FUEL_ROUTE.'rate_details_width/listratewidth'] = 'rate_details_width/listratewidth';
$route[FUEL_ROUTE.'rate_details_width/deleteratewidth_coil'] = 'rate_details_width/deleteratewidth_coil';
$route[FUEL_ROUTE.'rate_details_width/checkwidthexist'] = 'rate_details_width/checkwidthexist';
$route[FUEL_ROUTE.'rate_details_width/minwidthexist'] = 'rate_details_width/minwidthexist';
$route[FUEL_ROUTE.'rate_details_width/maxwidthexist'] = 'rate_details_width/maxwidthexist';