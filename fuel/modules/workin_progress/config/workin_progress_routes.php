<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'workin_progress'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'workin_progress/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'workin_progress'] = 'workin_progress';
//$route[FUEL_ROUTE.'backup/dashboard'] = 'backup/dashboard';
$route[FUEL_ROUTE.'workin_progress/finishtask'] = 'workin_progress/finishtask';
$route[FUEL_ROUTE.'workin_progress/workinprogress_list'] = 'workin_progress/workinprogress_list';
$route[FUEL_ROUTE.'workin_progress/totalb_weight'] = 'workin_progress/totalb_weight';
$route[FUEL_ROUTE.'workin_progress/generate_cuttingslip'] = 'workin_progress/generate_cuttingslip';
