<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'recoiling_thickness'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'recoiling_thickness/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'recoiling_thickness'] = 'recoiling_thickness';
$route[FUEL_ROUTE.'recoiling_thickness/dashboard'] = 'recoiling_thickness/dashboard';
$route[FUEL_ROUTE.'recoiling_thickness/SelectCoilName'] = 'recoiling_thickness/SelectCoilName';
$route[FUEL_ROUTE.'recoiling_thickness/saveratedetails'] = 'recoiling_thickness/saveratedetails';
$route[FUEL_ROUTE.'recoiling_thickness/formdisplay'] = 'recoiling_thickness/formdisplay';
$route[FUEL_ROUTE.'recoiling_thickness/deleterow'] = 'recoiling_thickness/deleterow';
$route[FUEL_ROUTE.'recoiling_thickness/coil'] = 'recoiling_thickness/coil';
$route[FUEL_ROUTE.'recoiling_thickness/updateratedetails'] = 'recoiling_thickness/updateratedetails';
$route[FUEL_ROUTE.'recoiling_thickness/tablethickness'] = 'recoiling_thickness/tablethickness';
$route[FUEL_ROUTE.'recoiling_thickness/listratethickness'] = 'recoiling_thickness/listratethickness';
$route[FUEL_ROUTE.'recoiling_thickness/deleteratethic_coil'] = 'recoiling_thickness/deleteratethic_coil';
$route[FUEL_ROUTE.'recoiling_thickness/checkthickness'] = 'recoiling_thickness/checkthickness';
$route[FUEL_ROUTE.'recoiling_thickness/minthickness'] = 'recoiling_thickness/minthickness';
$route[FUEL_ROUTE.'recoiling_thickness/maxthickness'] = 'recoiling_thickness/maxthickness';