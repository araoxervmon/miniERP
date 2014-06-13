<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_details_thickness'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_details_thickness/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_details_thickness'] = 'rate_details_thickness';
$route[FUEL_ROUTE.'rate_details_thickness/dashboard'] = 'rate_details_thickness/dashboard';
$route[FUEL_ROUTE.'rate_details_thickness/SelectCoilName'] = 'rate_details_thickness/SelectCoilName';
$route[FUEL_ROUTE.'rate_details_thickness/saveratedetails'] = 'rate_details_thickness/saveratedetails';
$route[FUEL_ROUTE.'rate_details_thickness/formdisplay'] = 'rate_details_thickness/formdisplay';
$route[FUEL_ROUTE.'rate_details_thickness/deleterow'] = 'rate_details_thickness/deleterow';
$route[FUEL_ROUTE.'rate_details_thickness/coil'] = 'rate_details_thickness/coil';
$route[FUEL_ROUTE.'rate_details_thickness/updateratedetails'] = 'rate_details_thickness/updateratedetails';
$route[FUEL_ROUTE.'rate_details_thickness/tablethickness'] = 'rate_details_thickness/tablethickness';
$route[FUEL_ROUTE.'rate_details_thickness/listratethickness'] = 'rate_details_thickness/listratethickness';
$route[FUEL_ROUTE.'rate_details_thickness/deleteratethic_coil'] = 'rate_details_thickness/deleteratethic_coil';
$route[FUEL_ROUTE.'rate_details_thickness/checkthickness'] = 'rate_details_thickness/checkthickness';
$route[FUEL_ROUTE.'rate_details_thickness/minthickness'] = 'rate_details_thickness/minthickness';
$route[FUEL_ROUTE.'rate_details_thickness/maxthickness'] = 'rate_details_thickness/maxthickness';