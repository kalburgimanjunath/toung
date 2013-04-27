<?php 
class Home extends CM_Controller {
	
	function Home()
	{
		parent::CM_Controller();	
	}
	
	function index()
	{
		log_message("debug", "CM_Controller->index: Inside home index");
		//$this->load->helper('html');

		$this->load->view('admin/welcome');		
	
	}
	
	function myinfo() {
		log_message("debug", "CM_Controller->index: myinfo()");

		$this->_checkAndLoad('forms/myinfo', true);
	}
	
	function welcome() {
		log_message("debug", "CM_Controller->index: welcome()");

		$this->index();
	}
	
	
	function test() {
		log_message("debug", "CM_Controller->index: test()");

		$this->load->view('includes/header');	
		$this->load->view('forms/test');		
		$this->load->view('includes/footer');		
	}
	
	function about() {
		$this->load->view('about');
	}

	function exp() {
		$this->load->view('includes/header');	
		$this->load->view('exp');		
		$this->load->view('includes/footer');		
	}

	function edu() {
		$this->load->view('includes/header');	
		$this->load->view('edu');		
		$this->load->view('includes/footer');		
	}


	function privacy() {
		$this->load->view('privacy');
	}
	
	function signup() {
		log_message("debug", "CM_Controller->index: signup()");

		$this->load->view('admin/forms/register_form');		
		$this->load->view('admin/includes/footer');		
	}
	
	function signedup() {
		log_message("debug", "CM_Controller->index: signedup()");

		if ($this->_isLoggedIn()) {
			$this->welcome();
		} else {
			$this->load->view('admin/signup_welcome');		
			$this->load->view('admin/includes/footer');		
		}
	}
	
	function signin() {
		log_message("debug", "CM_Controller->index: signin()");
		$this->load->view('admin/forms/signin_form');	
		$this->load->view('admin/includes/footer');		
	
	}
	
	function logout() {
		log_message("debug", "CM_Controller->index: logout()");

		$this->session->sess_destroy();
		$this->load->view('admin/welcome');		
	}
	
	function profile() {
		log_message("debug", "CM_Controller->index: profile()");

		$this->_checkAndLoad('admin/profile', true);
	}
	
	function settings() {
		log_message("debug", "CM_Controller->index: settings()");

		$this->_checkAndLoad('admin/settings_view', true);
	}

	function testold() {
		print_r( $_POST);
	}
	function login() {		
		$provider_name = $_GET['provider'];
		print_r($provider_name);
	}
	function forgotpass() {		
		$this->load->view('forms/forgotpass_form');	
	}
}

/* End of file welcome.php */
