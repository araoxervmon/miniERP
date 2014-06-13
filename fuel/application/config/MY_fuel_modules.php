<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/

$config['modules']['coil_details'] = array(
	'module_name' => 'Coil Details',
	'module_uri' => 'coil_details',
	'permission' => 'coil_details',
	'nav_selected' => 'coil_details'
);

$config['modules']['tax_details_billing'] = array(
	'module_name' => 'Tax Details',
	'module_uri' => 'tax_details_billing',
	'permission' => 'tax_details_billing',
	'nav_selected' => 'tax_details_billing'
);

/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** EXAMPLE ***********************************/

$config['modules']['material_description'] = array(
 'module_name' => 'Material Description',
 'module_uri' => 'material_description',
 'permission' => 'material_description',
 'nav_selected' => 'material_description'
);


$config['modules']['village'] = array(
 'module_name' => 'List of Villages',
 'module_uri' => 'village',
 'permission' => 'village',
 'nav_selected' => 'village'
);

$config['modules']['partyname_details'] = array(
	'module_name' => 'Party Name Details',
	'module_uri' => 'partyname_details',
	'permission' => 'partyname_details',
	'nav_selected' => 'partyname_details'
);

//Inventory

$config['modules']['brands'] = array(
 'module_name' => 'Brands',
 'module_uri' => 'brands',
 'permission' => 'brands',
 'nav_selected' => 'brands'
);

$config['modules']['item_stock'] = array(
 'module_name' => 'Item Stock Management',
 'module_uri' => 'item_stock',
 'permission' => 'item_stock',
 'nav_selected' => 'item_stock'
);

$config['modules']['countries'] = array(
 'module_name' => 'Country List',
 'module_uri' => 'countries',
 'permission' => 'countries',
 'nav_selected' => 'countries'
);

$config['modules']['company_details_entry'] = array(
 'module_name' => 'Company Details',
 'module_uri' => 'company_details_entry',
 'permission' => 'company_details_entry',
 'nav_selected' => 'company_details_entry',
 //'item_actions' => array('delete, delete_multiple'),
 //'table_actions' => array('edit','delete'),
);

$config['modules']['inventory_items'] = array(
 'module_name' => 'Inventory Items',
 'module_uri' => 'inventory_items',
 'permission' => 'inventory_items',
 'nav_selected' => 'inventory_items'
);

$config['modules']['item_suppliers'] = array(
	'module_name' => 'Item Suppliers',
	'module_uri' => 'item_suppliers',
	'permission' => 'item_suppliers',
	'nav_selected' => 'item_suppliers'
);

$config['modules']['ref_item_categories'] = array(
	'module_name' => 'Ref Item Categories',
	'module_uri' => 'ref_item_categories',
	'permission' => 'ref_item_categories',
	'nav_selected' => 'ref_item_categories'
);


$config['modules']['state_list'] = array(
	'module_name' => 'State List',
	'module_uri' => 'state_list',
	'permission' => 'state_list',
	'nav_selected' => 'state_list'
);

$config['modules']['suppliers'] = array(
	'module_name' => 'Suppliers',
	'module_uri' => 'suppliers',
	'permission' => 'suppliers',
	'nav_selected' => 'suppliers'
);

//Employees
$config['modules']['departments'] = array(
	'module_name' => 'Departments',
	'module_uri' => 'departments',
	'permission' => 'departments',
	'nav_selected' => 'departments'
);
$config['modules']['department_events'] = array(
	'module_name' => 'Department Events',
	'module_uri' => 'department_events',
	'permission' => 'department_events',
	'nav_selected' => 'department_events'
);
$config['modules']['employee_categories'] = array(
	'module_name' => 'Employee Categories',
	'module_uri' => 'employee_categories',
	'permission' => 'employee_categories',
	'nav_selected' => 'employee_categories'
);
$config['modules']['employee_types'] = array(
	'module_name' => 'Employee Types',
	'module_uri' => 'employee_types',
	'permission' => 'employee_types',
	'nav_selected' => 'employee_types'
);
$config['modules']['jobtitles'] = array(
	'module_name' => 'Job Titles',
	'module_uri' => 'jobtitles',
	'permission' => 'jobtitles',
	'nav_selected' => 'jobtitles'
);
$config['modules']['deduction_types'] = array(
	'module_name' => 'Deduction Types',
	'module_uri' => 'deduction_types',
	'permission' => 'deduction_types',
	'nav_selected' => 'deduction_types'
);

$config['modules']['paygrades'] = array(
	'module_name' => 'Paygrades',
	'module_uri' => 'paygrades',
	'permission' => 'paygrades',
	'nav_selected' => 'paygrades'
);
$config['modules']['project_task_status'] = array(
	'module_name' => 'Collaboration Status',
	'module_uri' => 'project_task_status',
	'permission' => 'project_task_status',
	'nav_selected' => 'project_task_status'
);
$config['modules']['employees'] = array(
	'module_name' => 'Employees',
	'module_uri' => 'employees',
	'permission' => 'employees',
	'nav_selected' => 'employees'
);
$config['modules']['bankdetails'] = array(
	'module_name' => 'Bank Details',
	'module_uri' => 'bankdetails',
	'permission' => 'bankdetails',
	'nav_selected' => 'bankdetails'
);
$config['modules']['sickdays'] = array(
	'module_name' => 'Sick Days',
	'module_uri' => 'sickdays',
	'permission' => 'sickdays',
	'nav_selected' => 'sickdays'
);
$config['modules']['projects'] = array(
	'module_name' => 'Projects',
	'module_uri' => 'projects',
	'permission' => 'projects',
	'nav_selected' => 'projects'
);
$config['modules']['project_tasks'] = array(
	'module_name' => 'Projects',
	'module_uri' => 'project_tasks',
	'permission' => 'project_tasks',
	'nav_selected' => 'project_tasks'
);
$config['modules']['timesheets'] = array(
	'module_name' => 'Timesheets',
	'module_uri' => 'timesheets',
	'permission' => 'timesheets',
	'nav_selected' => 'timesheets'
);
$config['modules']['inventory_adjustments'] = array(
 'module_name' => 'Inventory Adjustments',
 'module_uri' => 'inventory_adjustments',
 'permission' => 'inventory_adjustments',
 'nav_selected' => 'inventory_adjustments'
);
$config['modules']['inventory_transfers'] = array(
 'module_name' => 'Inventory Transfer',
 'module_uri' => 'inventory_transfers',
 'permission' => 'inventory_transfers',
 'nav_selected' => 'inventory_transfers'
);
$config['modules']['inventory_billing'] = array(
 'module_name' => 'Inventory Billing',
 'module_uri' => 'inventory_billing',
 'permission' => 'inventory_billing',
 'nav_selected' => 'inventory_billing'
);
//aspen_tblpartydetails_model.php