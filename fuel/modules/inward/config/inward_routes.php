<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'inward'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'inward/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'inward'] = 'inward';
$route[FUEL_ROUTE.'inward/recoiling_party'] = 'inward/recoiling_party';
$route[FUEL_ROUTE.'inward/BundleName'] = 'inward/BundleName';
$route[FUEL_ROUTE.'inward/savebundleslit'] = 'inward/savebundleslit';
$route[FUEL_ROUTE.'inward/example'] = 'inward/example';
$route[FUEL_ROUTE.'inward/recoiling_no'] = 'inward/recoiling_no';
$route[FUEL_ROUTE.'inward/saverecoildetails'] = 'inward/saverecoildetails';
$route[FUEL_ROUTE.'inward/RecoilName'] = 'inward/RecoilName';
$route[FUEL_ROUTE.'inward/deleterow'] = 'inward/deleterow';
$route[FUEL_ROUTE.'inward/listrecoildetails'] = 'inward/listrecoildetails';
$route[FUEL_ROUTE.'inward/autosuggest'] = 'inward/autosuggest';
$route[FUEL_ROUTE.'inward/matdesc'] = 'inward/matdesc';
$route[FUEL_ROUTE.'inward/savedetails'] = 'inward/savedetails';
$route[FUEL_ROUTE.'inward/checkcoilno'] = 'inward/checkcoilno';

