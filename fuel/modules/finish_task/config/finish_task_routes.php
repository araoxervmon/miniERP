<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'finish_task'] = FUEL_FOLDER.'/module';
$route[FUEL_ROUTE.'finish_task/(.*)'] = FUEL_FOLDER.'/module/$1';
$route[FUEL_ROUTE.'finish_task'] = 'finish_task';   //This is need for the controller to under which module is
$route[FUEL_ROUTE.'finish_task/dashboard'] = 'finish_task/dashboard'; 
//here if we are calling any specific functions under controller, those functions have to be specified here. for eg. See the dashboard written in the last line.
$route[FUEL_ROUTE.'finish_task/formdisplay'] = 'finish_task/formdisplay';
$route[FUEL_ROUTE.'finish_task/CoilName'] = 'finish_task/CoilName';
$route[FUEL_ROUTE.'finish_task/Date'] = 'finish_task/Date';
$route[FUEL_ROUTE.'finish_task/FinishName'] = 'finish_task/FinishName';
$route[FUEL_ROUTE.'finish_task/finishwp'] = 'finish_task/finishwp';
$route[FUEL_ROUTE.'finish_task/saveweightdetails'] = 'finish_task/saveweightdetails'; 
$route[FUEL_ROUTE.'finish_task/finish_slit'] = 'finish_task/finish_slit';
$route[FUEL_ROUTE.'finish_task/finish_taskcit'] = 'finish_task/finish_taskcit';
$route[FUEL_ROUTE.'finish_task/statuschange'] = 'finish_task/statuschange';
$route[FUEL_ROUTE.'finish_task/statuschangerecoil'] = 'finish_task/statuschangerecoil';
$route[FUEL_ROUTE.'finish_task/listfinishdetails'] = 'finish_task/listfinishdetails';
$route[FUEL_ROUTE.'finish_task/totalweightcountcalculate'] = 'finish_task/totalweightcountcalculate';
$route[FUEL_ROUTE.'finish_task/statuschangeslit'] = 'finish_task/statuschangeslit';