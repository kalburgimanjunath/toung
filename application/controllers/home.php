<?php
 
class Home extends CM_Controller {
	
	function Home()
	{
		parent::CM_Controller();
		$this->load->helper(array('form','url','file'));		
	}
	
	function index()
	{
		log_message("debug", "CM_Controller->index: Inside home index");
		$this->load->helper('html');
		
		$this->load->view('welcome');		
	
	}
	
	function myinfo() {
		log_message("debug", "CM_Controller->index: myinfo()");

		$this->_checkAndLoad('forms/myinfo', true);
	}
	
	function welcome() {
		log_message("debug", "CM_Controller->index: welcome()");
		echo "hi";
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

		$this->load->view('forms/register_form');		
		$this->load->view('includes/footer');		
	}
	
	function signedup() {
		log_message("debug", "CM_Controller->index: signedup()");

		if ($this->_isLoggedIn()) {
			
			$this->welcome();
		} else {
			$this->load->view('signup_welcome');		
			$this->load->view('includes/footer');		
		}
	}
	
	function signin() {
		log_message("debug", "CM_Controller->index: signin()");
		$this->load->view('forms/signin_form');	
		$this->load->view('includes/footer');		
	
	}
	
	function logout() {
		log_message("debug", "CM_Controller->index: logout()");

		$this->session->sess_destroy();
		$this->load->view('welcome');		
	}
	
	function profile() {
		log_message("debug", "CM_Controller->index: profile()");
		session_start();
		
		$response = new CMResponse();
		
		if ($this->_checkAuth() == false) {
			return;
		}
		
		$sess = new CMSession();
		$username = $sess->getCurrentUserid($this);
		
			
				
		
		//$data = $this->_loadProfile($username);
		$data['main_content'] = 'dashboard';
		redirect('../dashboard');
		//$data = $this->_loadProfile($this->_getCurrentUserid());
		//$response->setData($data);
		//$this->load->view('dashboard',true);
		//$this->load->view('includes/template', $data);
		//$this->_checkAndLoad('profile', true);
	}
	
	function settings() {
		log_message("debug", "CM_Controller->index: settings()");

		$this->_checkAndLoad('settings_view', true);
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
	function _loadProfile($username) {
		if (! $username) {
			echo "No username specified, defaulting to test user $username <br/>";
			$username = 'test';
		}
		
		$data = array();
		$this->load->model('account_model');
		if ($query = $this->account_model->getAccount($username)) {
			
			$data['account'] = $query;
		}
		$this->load->model('Myprefs_model');
		if ($query = $this->Myprefs_model->getMyprefs($username)) {
			
			$data['profile'] = $query;
		}
		
		return $data;
	}
}

/* End of file welcome.php */
