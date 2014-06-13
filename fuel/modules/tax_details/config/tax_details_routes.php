<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'tax_details'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'tax_details/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'tax_details'] = 'tax_details';
$route[FUEL_ROUTE.'tax_details/dashboard'] = 'tax_details/dashboard';
$route[FUEL_ROUTE.'tax_details/SelectCoilName'] = 'tax_details/SelectCoilName';
$route[FUEL_ROUTE.'tax_details/savetaxdetails'] = 'tax_details/savetaxdetails';



$route[FUEL_ROUTE.'tax_details/coil'] = 'tax_details/coil';
$route[FUEL_ROUTE.'tax_details/updatetaxdetails'] = 'tax_details/updatetaxdetails';
$route[FUEL_ROUTE.'tax_details/deletetax'] = 'tax_details/deletetax';
$route[FUEL_ROUTE.'tax_details/listratelength'] = 'tax_details/listratelength';
$route[FUEL_ROUTE.'tax_details/listtaxdetails'] = 'tax_details/listtaxdetails';