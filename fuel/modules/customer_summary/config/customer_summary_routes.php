<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'customer_summary'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'customer_summary/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'customer_summary'] = 'customer_summary';
$route[FUEL_ROUTE.'customer_summary/dashboard'] = 'customer_summary/dashboard';
$route[FUEL_ROUTE.'customer_summary/cutting_instruction'] = 'customer_summary/cutting_instruction';
$route[FUEL_ROUTE.'customer_summary/list_coil'] = 'customer_summary/list_coil';
$route[FUEL_ROUTE.'customer_summary/list_party'] = 'customer_summary/list_party';
$route[FUEL_ROUTE.'customer_summary/listChilds'] = 'customer_summary/listChilds';
$route[FUEL_ROUTE.'customer_summary/delete_coil'] = 'customer_summary/delete_coil';
$route[FUEL_ROUTE.'customer_summary/print_partywise'] = 'customer_summary/print_partywise';
//$route[FUEL_ROUTE.'customer_summary/list_child_coil/(.*)'] = 'customer_summary/list_child_coil/$1';
//$route[FUEL_ROUTE.'customer_summary/totalb_weight'] = 'customer_summary/totalb_weight';
//$route[FUEL_ROUTE.'customer_summary/totalweight_check'] = 'customer_summary/totalweight_check';

$route[FUEL_ROUTE.'customer_summary/totalbasic_check'] = 'customer_summary/totalbasic_check';
$route[FUEL_ROUTE.'customer_summary/totalb_weight'] = 'customer_summary/totalb_weight';
$route[FUEL_ROUTE.'customer_summary/totalweight_check'] = 'customer_summary/totalweight_check';
$route[FUEL_ROUTE.'customer_summary/totaltax_check'] = 'customer_summary/totaltax_check';  
$route[FUEL_ROUTE.'customer_summary/totalbill_check'] = 'customer_summary/totalbill_check'; 

//link the controller to the nav link

$route[FUEL_ROUTE.'customer_summary'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'customer_summary/(.*)'] = FUEL_FOLDER.'/module/$1';

$route[FUEL_ROUTE.'customer_summary'] = 'customer_summary';
$route[FUEL_ROUTE.'customer_summary/dashboard'] = 'customer_summary/dashboard';
$route[FUEL_ROUTE.'customer_summary/list_coil'] = 'customer_summary/list_coil';
$route[FUEL_ROUTE.'customer_summary/list_party'] = 'customer_summary/list_party';
$route[FUEL_ROUTE.'customer_summary/print_partywise'] = 'customer_summary/print_partywise';
$route[FUEL_ROUTE.'customer_summary/totalweight_check'] = 'customer_summary/totalweight_check';
$route[FUEL_ROUTE.'customer_summary/billing_pdf'] = 'customer_summary/billing_pdf';
