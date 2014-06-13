<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'factory_material'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'factory_material/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'factory_material'] = 'factory_material';
$route[FUEL_ROUTE.'factory_material/dashboard'] = 'factory_material/dashboard';
$route[FUEL_ROUTE.'factory_material/SelectCoilName'] = 'factory_material/SelectCoilName';
$route[FUEL_ROUTE.'factory_material/saveratedetails'] = 'factory_material/saveratedetails';
$route[FUEL_ROUTE.'factory_material/formdisplay'] = 'factory_material/formdisplay';
$route[FUEL_ROUTE.'factory_material/deleterow'] = 'factory_material/deleterow';

$route[FUEL_ROUTE.'factory_material/coil'] = 'factory_material/coil';
$route[FUEL_ROUTE.'factory_material/billing_pdf'] = 'factory_material/billing_pdf';
$route[FUEL_ROUTE.'factory_material/tablewidth'] = 'factory_material/tablewidth';
$route[FUEL_ROUTE.'factory_material/listratelength'] = 'factory_material/listratelength';
$route[FUEL_ROUTE.'factory_material/deleteratelength_coil'] = 'factory_material/deleteratelength_coil';
$route[FUEL_ROUTE.'factory_material/checklengthexist'] = 'factory_material/checklengthexist';
$route[FUEL_ROUTE.'factory_material/minlengthexist'] = 'factory_material/minlengthexist';
$route[FUEL_ROUTE.'factory_material/maxlengthexist'] = 'factory_material/maxlengthexist';
$route[FUEL_ROUTE.'factory_material/export_party'] = 'factory_material/export_party';