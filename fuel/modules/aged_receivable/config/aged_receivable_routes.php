<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'aged_receivable'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'aged_receivable/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'aged_receivable'] = 'aged_receivable';
$route[FUEL_ROUTE.'aged_receivable/dashboard'] = 'aged_receivable/dashboard';
$route[FUEL_ROUTE.'aged_receivable/cutting_instruction'] = 'aged_receivable/cutting_instruction';
$route[FUEL_ROUTE.'aged_receivable/list_coil'] = 'aged_receivable/list_coil';
$route[FUEL_ROUTE.'aged_receivable/list_party'] = 'aged_receivable/list_party';
$route[FUEL_ROUTE.'aged_receivable/listChilds'] = 'aged_receivable/listChilds';
$route[FUEL_ROUTE.'aged_receivable/delete_coil'] = 'aged_receivable/delete_coil';
$route[FUEL_ROUTE.'aged_receivable/print_partywise'] = 'aged_receivable/print_partywise';
//$route[FUEL_ROUTE.'aged_receivable/list_child_coil/(.*)'] = 'aged_receivable/list_child_coil/$1';
$route[FUEL_ROUTE.'aged_receivable/totalb_weight'] = 'aged_receivable/totalb_weight';
$route[FUEL_ROUTE.'aged_receivable/totalweight_check'] = 'aged_receivable/totalweight_check';

//link the controller to the nav link

$route[FUEL_ROUTE.'aged_receivable'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'aged_receivable/(.*)'] = FUEL_FOLDER.'/module/$1';

$route[FUEL_ROUTE.'aged_receivable'] = 'aged_receivable';
$route[FUEL_ROUTE.'aged_receivable/dashboard'] = 'aged_receivable/dashboard';
$route[FUEL_ROUTE.'aged_receivable/list_coil'] = 'aged_receivable/list_coil';
$route[FUEL_ROUTE.'aged_receivable/list_party'] = 'aged_receivable/list_party';
$route[FUEL_ROUTE.'aged_receivable/print_partywise'] = 'aged_receivable/print_partywise';
$route[FUEL_ROUTE.'aged_receivable/totalweight_check'] = 'aged_receivable/totalweight_check';
$route[FUEL_ROUTE.'aged_receivable/billing_pdf'] = 'aged_receivable/billing_pdf';
