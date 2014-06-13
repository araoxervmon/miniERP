<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'slitting_instruction'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'slitting_instruction/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'slitting_instruction'] = 'slitting_instruction';
$route[FUEL_ROUTE.'slitting_instruction/slitting_instruction_party'] = 'slitting_instruction/slitting_instruction_party';
$route[FUEL_ROUTE.'slitting_instruction/BundleName'] = 'slitting_instruction/BundleName';
$route[FUEL_ROUTE.'slitting_instruction/savebundleslit'] = 'slitting_instruction/savebundleslit';
$route[FUEL_ROUTE.'slitting_instruction/deleterow'] = 'slitting_instruction/deleterow';
$route[FUEL_ROUTE.'slitting_instruction/listslittingdetails'] = 'slitting_instruction/listslittingdetails';
$route[FUEL_ROUTE.'slitting_instruction/delete_coil'] = 'slitting_instruction/delete_coil';
$route[FUEL_ROUTE.'slitting_instruction/editbundle'] = 'slitting_instruction/editbundle';
$route[FUEL_ROUTE.'slitting_instruction/save_button'] = 'slitting_instruction/save_button';
$route[FUEL_ROUTE.'slitting_instruction/delete_slit'] = 'slitting_instruction/delete_slit';
$route[FUEL_ROUTE.'slitting_instruction/totalwidth'] = 'slitting_instruction/totalwidth';