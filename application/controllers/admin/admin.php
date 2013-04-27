<?php
class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
	}
	
	function index()
	{		
		$this->load->view('admin');
	}
	
	function account()
	{		
		$this->load->view('admin/account');
	}
	
	function signin() {
		log_message("debug", "CM_Controller->index: signin()");
		$this->load->view('admin/forms/signin_form');	
		$this->load->view('admin/includes/footer');		
	
	}
	function signup() {
		log_message("debug", "CM_Controller->index: signup()");

		$this->load->view('admin/forms/register_form');		
		$this->load->view('admin/includes/footer');		
	}
}

?>