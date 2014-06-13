<?php 
//link the controller to the nav link

$route[FUEL_ROUTE.'cutting_instruction'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'cutting_instruction/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'cutting_instruction'] = 'cutting_instruction';
$route[FUEL_ROUTE.'cutting_instruction/formdisplay'] = 'cutting_instruction/formdisplay';
$route[FUEL_ROUTE.'cutting_instruction/BundleName'] = 'cutting_instruction/BundleName';
$route[FUEL_ROUTE.'cutting_instruction/savebundledetails'] = 'cutting_instruction/savebundledetails';
$route[FUEL_ROUTE.'cutting_instruction/deleterow'] = 'cutting_instruction/deleterow';
$route[FUEL_ROUTE.'cutting_instruction/save_button'] = 'cutting_instruction/save_button';
$route[FUEL_ROUTE.'cutting_instruction/calculate_weightcntrlr'] = 'cutting_instruction/calculate_weightcntrlr';
$route[FUEL_ROUTE.'cutting_instruction/weightcheck'] = 'cutting_instruction/weightcheck';
$route[FUEL_ROUTE.'cutting_instruction/listcoildetails'] = 'cutting_instruction/listcoildetails';
$route[FUEL_ROUTE.'cutting_instruction/delete_bundle'] = 'cutting_instruction/delete_bundle';
$route[FUEL_ROUTE.'cutting_instruction/editbundle'] = 'cutting_instruction/editbundle';
$route[FUEL_ROUTE.'cutting_instruction/cancelcoils'] = 'cutting_instruction/cancelcoils';
$route[FUEL_ROUTE.'cutting_instruction/totalweight_check'] = 'cutting_instruction/totalweight_check';



