<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'aged_payable'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'aged_payable/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'aged_payable'] = 'aged_payable';
$route[FUEL_ROUTE.'aged_payable/dashboard'] = 'aged_payable/dashboard';
$route[FUEL_ROUTE.'aged_payable/cutting_instruction'] = 'aged_payable/cutting_instruction';
$route[FUEL_ROUTE.'aged_payable/list_coil'] = 'aged_payable/list_coil';
$route[FUEL_ROUTE.'aged_payable/list_party'] = 'aged_payable/list_party';
$route[FUEL_ROUTE.'aged_payable/listChilds'] = 'aged_payable/listChilds';
$route[FUEL_ROUTE.'aged_payable/delete_coil'] = 'aged_payable/delete_coil';
$route[FUEL_ROUTE.'aged_payable/print_partywise'] = 'aged_payable/print_partywise';
//$route[FUEL_ROUTE.'aged_payable/list_child_coil/(.*)'] = 'aged_payable/list_child_coil/$1';
$route[FUEL_ROUTE.'aged_payable/totalb_weight'] = 'aged_payable/totalb_weight';
$route[FUEL_ROUTE.'aged_payable/totalweight_check'] = 'aged_payable/totalweight_check';

//link the controller to the nav link

$route[FUEL_ROUTE.'aged_payable'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'aged_payable/(.*)'] = FUEL_FOLDER.'/module/$1';

$route[FUEL_ROUTE.'aged_payable'] = 'aged_payable';
$route[FUEL_ROUTE.'aged_payable/dashboard'] = 'aged_payable/dashboard';
$route[FUEL_ROUTE.'aged_payable/list_coil'] = 'aged_payable/list_coil';
$route[FUEL_ROUTE.'aged_payable/list_party'] = 'aged_payable/list_party';
$route[FUEL_ROUTE.'aged_payable/print_partywise'] = 'aged_payable/print_partywise';
$route[FUEL_ROUTE.'aged_payable/totalweight_check'] = 'aged_payable/totalweight_check';
$route[FUEL_ROUTE.'aged_payable/billing_pdf'] = 'aged_payable/billing_pdf';
