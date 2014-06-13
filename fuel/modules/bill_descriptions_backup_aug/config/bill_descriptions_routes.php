<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'bill_descriptions'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'bill_descriptions/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'bill_descriptions'] = 'bill_descriptions';
$route[FUEL_ROUTE.'bill_descriptions/dashboard'] = 'bill_descriptions/dashboard';
$route[FUEL_ROUTE.'bill_descriptions/list_nsno'] = 'bill_descriptions/list_nsno';
$route[FUEL_ROUTE.'bill_descriptions/list_coil'] = 'bill_descriptions/list_coil';
$route[FUEL_ROUTE.'bill_descriptions/list_party'] = 'bill_descriptions/list_party';
$route[FUEL_ROUTE.'bill_descriptions/listChilds'] = 'bill_descriptions/listChilds';
$route[FUEL_ROUTE.'bill_descriptions/delete_coil'] = 'bill_descriptions/delete_coil';
$route[FUEL_ROUTE.'bill_descriptions/getnsno'] = 'bill_descriptions/getnsno';
//$route[FUEL_ROUTE.'bill_descriptions/list_child_coil/(.*)'] = 'bill_descriptions/list_child_coil/$1';
$route[FUEL_ROUTE.'bill_descriptions/totalb_weight'] = 'bill_descriptions/totalb_weight';
$route[FUEL_ROUTE.'bill_descriptions/totalweight_check'] = 'bill_descriptions/totalweight_check';
$route[FUEL_ROUTE.'bill_descriptions/list_individualparty'] = 'bill_descriptions/list_individualparty';
$route[FUEL_ROUTE.'bill_descriptions/bill_list'] = 'bill_descriptions/bill_list';
$route[FUEL_ROUTE.'bill_descriptions/shownsno'] = 'bill_descriptions/shownsno';