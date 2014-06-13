<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'stock_report'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'stock_report/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'stock_report'] = 'stock_report';
$route[FUEL_ROUTE.'stock_report/dashboard'] = 'stock_report/dashboard';
$route[FUEL_ROUTE.'stock_report/cutting_instruction'] = 'stock_report/cutting_instruction';
$route[FUEL_ROUTE.'stock_report/list_coil'] = 'stock_report/list_coil';
$route[FUEL_ROUTE.'stock_report/list_party'] = 'stock_report/list_party';
$route[FUEL_ROUTE.'stock_report/listChilds'] = 'stock_report/listChilds';
$route[FUEL_ROUTE.'stock_report/delete_coil'] = 'stock_report/delete_coil';
$route[FUEL_ROUTE.'stock_report/print_partywise'] = 'stock_report/print_partywise';
//$route[FUEL_ROUTE.'partywise_register/list_child_coil/(.*)'] = 'partywise_register/list_child_coil/$1';
$route[FUEL_ROUTE.'stock_report/totalb_weight'] = 'stock_report/totalb_weight';
$route[FUEL_ROUTE.'stock_report/totalweight_check'] = 'stock_report/totalweight_check'; 
$route[FUEL_ROUTE.'stock_report/billing_pdf'] = 'stock_report/billing_pdf'; 