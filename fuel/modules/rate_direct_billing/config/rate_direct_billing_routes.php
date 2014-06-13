<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'rate_direct_billing'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'rate_direct_billing/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'rate_direct_billing'] = 'rate_direct_billing';
$route[FUEL_ROUTE.'rate_direct_billing/dashboard'] = 'rate_direct_billing/dashboard';
$route[FUEL_ROUTE.'rate_direct_billing/SelectCoilName'] = 'rate_direct_billing/SelectCoilName';
$route[FUEL_ROUTE.'rate_direct_billing/saveratedetails'] = 'rate_direct_billing/saveratedetails';
$route[FUEL_ROUTE.'rate_direct_billing/formdisplay'] = 'rate_direct_billing/formdisplay';
$route[FUEL_ROUTE.'rate_direct_billing/deleterow'] = 'rate_direct_billing/deleterow';
$route[FUEL_ROUTE.'rate_direct_billing/coil'] = 'rate_direct_billing/coil';
$route[FUEL_ROUTE.'rate_direct_billing/updateratedetails'] = 'rate_direct_billing/updateratedetails';
$route[FUEL_ROUTE.'rate_direct_billing/tablethickness'] = 'rate_direct_billing/tablethickness';
$route[FUEL_ROUTE.'rate_direct_billing/listratethickness'] = 'rate_direct_billing/listratethickness';
$route[FUEL_ROUTE.'rate_direct_billing/deleteratethic_coil'] = 'rate_direct_billing/deleteratethic_coil';
$route[FUEL_ROUTE.'rate_direct_billing/checkthickness'] = 'rate_direct_billing/checkthickness';
$route[FUEL_ROUTE.'rate_direct_billing/minthickness'] = 'rate_direct_billing/minthickness';
$route[FUEL_ROUTE.'rate_direct_billing/maxthickness'] = 'rate_direct_billing/maxthickness';