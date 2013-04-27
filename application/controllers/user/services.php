<?php

class Services extends CM_Controller {

	function Services()
	{
		parent::Controller();	
	}
	
	function index() {
		log_message("debug", "CM_Controller->index: signup()");
		
		$this->load->view('forms/services_form');		
			
	}
}
?>