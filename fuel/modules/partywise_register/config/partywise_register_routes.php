<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'partywise_register'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'partywise_register/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'partywise_register'] = 'partywise_register';
$route[FUEL_ROUTE.'partywise_register/dashboard'] = 'partywise_register/dashboard';
$route[FUEL_ROUTE.'partywise_register/cutting_instruction'] = 'partywise_register/cutting_instruction';
$route[FUEL_ROUTE.'partywise_register/list_coil'] = 'partywise_register/list_coil';
$route[FUEL_ROUTE.'partywise_register/list_party'] = 'partywise_register/list_party';
$route[FUEL_ROUTE.'partywise_register/listChilds'] = 'partywise_register/listChilds';
$route[FUEL_ROUTE.'partywise_register/delete_coil'] = 'partywise_register/delete_coil';
$route[FUEL_ROUTE.'partywise_register/print_partywise'] = 'partywise_register/print_partywise';
//$route[FUEL_ROUTE.'partywise_register/list_child_coil/(.*)'] = 'partywise_register/list_child_coil/$1';
$route[FUEL_ROUTE.'partywise_register/totalb_weight'] = 'partywise_register/totalb_weight';
$route[FUEL_ROUTE.'partywise_register/totalweight_check'] = 'partywise_register/totalweight_check';
$route[FUEL_ROUTE.'partywise_register/list_individualparty'] = 'partywise_register/list_individualparty';
$route[FUEL_ROUTE.'partywise_register/listindividualChilds'] = 'partywise_register/listindividualChilds';