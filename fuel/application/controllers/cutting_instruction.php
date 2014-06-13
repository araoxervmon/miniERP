<?php
require_once(FUEL_PATH.'/controllers/module.php');

class Cutting_instruction extends Module {
	
	function __construct()
	{
		parent::__construct();
	}
	function cuttinginstruction()
	{
		echo 'i am here';die();
	}
	function modifyUSPForm() {echo 'i am in modifyUSPForm';die();
		$CI =& get_instance();

		$this->load->library('form_builder');
	  	$CI->load->model('user_storage_providers_model');
		$CI->load->module_model(FUEL_FOLDER, 'users_model');
		$form_fields = $this->user_storage_providers_model->form_fields();
			switch($_POST['provider']) {
				//Amazon
				case 2: $form_fields['username']['label']  = 'API Key';
						$form_fields['secretkey']['label'] = 'Secret Key';
						$form_fields['tenant_id']['type'] = 'hidden';
						$form_fields['uri']['type'] = 'hidden';

		if($CI->fuel_auth->is_logged_in()) { 
			if(isset($_POST['provider'])) { 
			
				$this->load->library('form_builder');
			  	$CI->load->model('user_storage_providers_model');
				$CI->load->module_model(FUEL_FOLDER, 'users_model');
				$form_fields = $this->user_storage_providers_model->form_fields();
				switch($_POST['provider']) {
					//Amazon
					case 2: $form_fields['username']['label']  = 'API Key';
							$form_fields['secretkey']['label'] = 'Secret Key';
							$form_fields['tenant_id']['type'] = 'hidden';
							$form_fields['uri']['type'] = 'hidden';
					
					break;
					//Rackspace
					
					case 3: $form_fields['secretkey']['label'] = 'API Key';
							$form_fields['tenant_id']['type'] = 'hidden';
							$form_fields['uri']['type'] = 'hidden';
					
					break;
					
					case 4: $form_fields['username']['label']  = 'Account Name';
							$form_fields['tenant_id']['type'] = 'hidden';
							$form_fields['uri']['type'] = 'hidden';
						
					
					break;
					
					case 5: $form_fields['username']['label']  = 'API Key';
							$form_fields['secretkey']['label'] = 'Secret Key';
							$form_fields['tenant_id']['type'] = 'hidden';
							$form_fields['uri']['type'] = 'hidden'; 
					break;
				}

				
			$form_fields['storage_provider']['value'] = $_POST['provider'];
			
			$this->form_builder->set_fields($form_fields);
			$form = $this->form_builder->render($form_fields);
			
			echo $this->form->open(array('id' => 'form', 'method' => 'post', 'action' => fuel_url('user_storage_providers/create'), 'enctype' => 'multipart/form-data'));
			echo $form;
			} elseif(!isset($_POST['provider'])) {
				redirect(fuel_url('user_storage_providers'));
			}
		} else {
			redirect(fuel_url('register'));
		}
	}
	
	
}