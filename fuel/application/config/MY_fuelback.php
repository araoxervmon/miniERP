<?php
// IMPORTANT: for a complete list of fuel configurations, go to the modules/fuel/config/fuel.php file

// path to the fuel admin from the web base directory... MUST HAVE TRAILING SLASH!
$config['fuel_path'] = 'fuel/';

// the name to be displayed on the top left of the admin
$config['site_name'] = 'HOODUKU ERP';

// options are cms, views, and auto. cms pulls views and variables from the database,
// views mode pulls views from the views folder and variables from the _variables folder.
// the auto option will first check the database for a page and if it doesn't exist or is not published, it will then check for a corresponding view file.
$config['fuel_mode'] = 'AUTO';

// used for system emails.
$config['domain'] = '';

// default password to alert against
$config['default_pwd'] = 'admin';

// specifies which modules are allowed to be used in the fuel admin
$config['modules_allowed'] = array(
	//'user_guide',
	//'blog',
	'backup',
	'inward_entry',
	'inward',
	'inward_entry_create',
	'partywise_register',
	'group_access',
	'workin_progress',
	'reports',
	'finish_task',
	'billing_instruction',
	'billing_inventory',
	'billing',
	'cutting_instruction',
	//'rate_details',
	'partyname_details',
	'coil_details', 
	'cronjobs',
	'slitting_instruction',
	'transfer_instruction',
	'recoiling',
	'rate_details_width',
	'rate_details_length',
	'rate_details_weight',
	'rate_details_thickness',
	'tax_details',
	/*'household',
	'household_survey',
	'information_child',
	'customers',
	'vendors',
	'inventory_lists',
	'current_details',
	'inventory_transfers',
	'birth_details',
	'inventory_adjustments',
	'immunization_child',
	'protection_child',
	'education_child',
	'welfare_child',
	'mother_data',*/
	);
//Configuration ASPEN PANEL
$config['nav']['Aspen Steel']=array( 
	//'inward_entry/create' => 'Create Inward Entry',
//	'inward_entry' => lang('module_inward_entry'),
//	'workin_progress' => lang('workin_progress'),
//	'reports' => lang('reports'),
	);							

$config['nav']['modules'] = array();
/*$config['nav']['Aspen_Operation'] = array(//'finish_task' => 'Finish Task',
									//	'billing_instruction' => 'Billing Instruction',
									//	'slitting_instruction' => 'Slitting Instruction',
									//	'cutting_instruction' => 'Cutting Instructions',
									//	'billing' => 'Billing Preview',
									//	'rate_details' => 'Rate Details',
									//	'coil_details' => 'Coil Details',
									//	'material_description' => 'Material Description',
									//	'recoiling' => 'Recoiling',
										//'inward' => 'Inward',
									//	'partyname_details' => 'Party Name Details',
);*/

$config['nav']['Master'] = array('rate_details_width' => 'Rate Details Width',
										'rate_details_length' => 'Rate Details Length',
										'rate_details_weight' => 'Rate Details Weight',
										'rate_details_thickness' => 'Rate Details Thickness',
										'partyname_details' => 'Party Name Details',
										'material_description' => 'Material Description',
										'tax_details' => 'Tax Details',
									
);
/*
$config['nav']['manage_data'] = array('countries' => 'Country List', 
									'state_list' => 'State List',
									'brands' => 'Brands',
									);


$config['nav']['inventory'] = array(
          'customers' => 'Customers',
          'vendors' => 'Vendors',
          'inventory_lists' => 'Inventory Lists',
          'inventory_adjustments' => 'Inventory Adjustments',
          'inventory_transfers' => 'Inventory Transfers',
          'billing_inventory' => 'Billing Inventory');


$config['nav']['admin_hr'] = array('departments' => 'Department',
									'department_events' => 'Department Events',
									'jobtitles' => 'Jobtitles',
									'employee_categories' => 'Employee Categories',
									'employee_types' => 'Employee Types',
									'paygrades' => 'Pay Grades',
									'deduction_types' => 'Deduction Types',
									
									);
$config['nav']['Manage_C-Task'] =  array('project_task_status' => 'Collaboration Status',);
$config['nav']['collaboration'] =  array('projects' => 'Projects','project_tasks' => 'Project Tasks','timesheets' => 'Timesheets');
$config['nav']['manage_hr'] = array('employees' => 'Employee Details',
'bank_details' => 'Bank Details',
'sickdays' => 'Sick Days',
);	*/
// whether the admin backend is enabled
$config['admin_enabled'] = TRUE;

// will auto search view files. 
// If the URI is about/history and the about/history view does not exist but about does, it will render the about page
$config['auto_search_views'] = TRUE;

// max upload files size for assets
$config['assets_upload_max_size']	= 5000;

// max width for asset image uploads
$config['assets_upload_max_width']  = 1024;

// max height for asset image uploads
$config['assets_upload_max_height']  = 768;

$config['assets_excluded_dirs'] = array(
	'js',
	'css',
	'cache', 
	'swf', 
	);

// text editor settings  (options are markitup or ckeditor)
$config['text_editor'] = 'markitup';

// ck editor specific settings
$config['ck_editor_settings'] = array(
	'toolbar' => array(
			//array('Source'),
			array('Bold','Italic','Strike'),
			array('Format'),
			array('Image','HorizontalRule'),
			array('NumberedList','BulletedList'),
			array('Link','Unlink'),
			array('Undo','Redo','RemoveFormat'),
			array('Preview'),
			array('Maximize'),
		),
	'contentsCss' => WEB_PATH.'assets/css/main.css',
	'htmlEncodeOutput' => FALSE,
	'entities' => FALSE,
	'bodyClass' => 'ckeditor',
	'toolbarCanCollapse' => FALSE,
);


$config['fuel_javascript'] = array(
	'jquery/plugins/date',
	'jquery/plugins/jquery.datePicker',
	'jquery/plugins/jquery.fillin',
	'jquery/plugins/jquery.easing',
	'jquery/plugins/jquery.bgiframe',
	'jquery/plugins/jquery.tooltip',
	'jquery/plugins/jquery.scrollTo-min',
	'jquery/plugins/jqModal',
	'jquery/plugins/jquery.checksave',
	'jquery/plugins/jquery.form',
	'jquery/plugins/jquery.treeview.min',
	'jquery/plugins/jquery.hotkeys',
	'jquery/plugins/jquery.cookie',
	'jquery/plugins/jquery.fillin',
	'jquery/plugins/jquery.selso',
	'jquery/plugins/jquery-ui-1.8.4.custom.min',
	'jquery/plugins/jquery.disable.text.select.pack',
	'jquery/plugins/jquery.supercomboselect',
	'jquery/plugins/jquery.MultiFile',
	'jquery/plugins/jquery.tablednd.js',
	'editors/markitup/jquery.markitup.pack',
	'editors/markitup/jquery.markitup.set',
	'editors/ckeditor/ckeditor.js',
	'fuel/linked_field_formatters.js',
	'custom/custom.js',
);

//Configuration ISPAT PANEL
/*
$config['nav']['ISPAT']=array( 
	'inward_entry_ispat' => lang('inward_entry_ispat'),
	'outward_entry_ispat' => lang('outward_entry_ispat'),
	'delivery_ispat' => lang('delivery_ispat'),
	'reports_ispat' => lang('reports_ispat'),
	'edit_details' => lang('edit_details'),
	);*/
/* End of file MY_fuel.php */
/* Location: ./application/config/MY_fuel.php */