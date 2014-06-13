<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'billing_instruction'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'billing_instruction/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'billing_instruction'] = 'billing_instruction';
$route[FUEL_ROUTE.'billing_instruction/billingtable_cntrlr'] = 'billing_instruction/billingtable_cntrlr';
$route[FUEL_ROUTE.'billing_instruction/listbilldetails'] = 'billing_instruction/listbilldetails';
$route[FUEL_ROUTE.'billing_instruction/delete_bundle'] = 'billing_instruction/delete_bundle';
$route[FUEL_ROUTE.'billing_instruction/processchk'] = 'billing_instruction/processchk';
$route[FUEL_ROUTE.'billing_instruction/loadfolderlistslit'] = 'billing_instruction/loadfolderlistslit';
$route[FUEL_ROUTE.'billing_instruction/loadfolderlistrecoil'] = 'billing_instruction/loadfolderlistrecoil';
