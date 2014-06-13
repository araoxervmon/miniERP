<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'transfer_instruction'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'transfer_instruction/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'transfer_instruction'] = 'transfer_instruction';
$route[FUEL_ROUTE.'transfer_instruction/transfer_instruction'] = 'transfer_instruction/transfer_instruction'; 
$route[FUEL_ROUTE.'transfer_instruction/savedetails'] = 'transfer_instruction/savedetails';
$route[FUEL_ROUTE.'transfer_instruction/transfer'] = 'transfer_instruction/transfer';


