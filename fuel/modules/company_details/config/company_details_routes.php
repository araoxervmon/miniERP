<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'company_details'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'company_details/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'company_details'] = 'company_details';
$route[FUEL_ROUTE.'company_details/dashboard'] = 'company_details/dashboard';
$route[FUEL_ROUTE.'company_details/SelectCoilName'] = 'company_details/SelectCoilName';
$route[FUEL_ROUTE.'company_details/savedetails'] = 'company_details/savedetails';
$route[FUEL_ROUTE.'company_details/formdisplay'] = 'company_details/formdisplay';
$route[FUEL_ROUTE.'company_details/deleterow'] = 'company_details/deleterow';

$route[FUEL_ROUTE.'company_details/coil'] = 'company_details/coil';
$route[FUEL_ROUTE.'company_details/updateratedetails'] = 'company_details/updateratedetails';
$route[FUEL_ROUTE.'company_details/tablewidth'] = 'company_details/tablewidth';
$route[FUEL_ROUTE.'company_details/listratelength'] = 'company_details/listratelength';
$route[FUEL_ROUTE.'company_details/deleteratelength_coil'] = 'company_details/deleteratelength_coil';
$route[FUEL_ROUTE.'company_details/checklengthexist'] = 'company_details/checklengthexist';
$route[FUEL_ROUTE.'company_details/minlengthexist'] = 'company_details/minlengthexist';
$route[FUEL_ROUTE.'company_details/maxlengthexist'] = 'company_details/maxlengthexist';