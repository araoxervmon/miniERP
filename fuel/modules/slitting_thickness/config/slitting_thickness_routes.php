<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'slitting_thickness'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'slitting_thickness/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'slitting_thickness'] = 'slitting_thickness';
$route[FUEL_ROUTE.'slitting_thickness/dashboard'] = 'slitting_thickness/dashboard';
$route[FUEL_ROUTE.'slitting_thickness/SelectCoilName'] = 'slitting_thickness/SelectCoilName';
$route[FUEL_ROUTE.'slitting_thickness/saveratedetails'] = 'slitting_thickness/saveratedetails';
$route[FUEL_ROUTE.'slitting_thickness/formdisplay'] = 'slitting_thickness/formdisplay';
$route[FUEL_ROUTE.'slitting_thickness/deleterow'] = 'slitting_thickness/deleterow';
$route[FUEL_ROUTE.'slitting_thickness/coil'] = 'slitting_thickness/coil';
$route[FUEL_ROUTE.'slitting_thickness/updateratedetails'] = 'slitting_thickness/updateratedetails';
$route[FUEL_ROUTE.'slitting_thickness/tablethickness'] = 'slitting_thickness/tablethickness';
$route[FUEL_ROUTE.'slitting_thickness/listratethickness'] = 'slitting_thickness/listratethickness';
$route[FUEL_ROUTE.'slitting_thickness/deleteratethic_coil'] = 'slitting_thickness/deleteratethic_coil';
$route[FUEL_ROUTE.'slitting_thickness/checkthickness'] = 'slitting_thickness/checkthickness';
$route[FUEL_ROUTE.'slitting_thickness/minthickness'] = 'slitting_thickness/minthickness';
$route[FUEL_ROUTE.'slitting_thickness/maxthickness'] = 'slitting_thickness/maxthickness';