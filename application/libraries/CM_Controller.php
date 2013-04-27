<?php
class CM_Controller extends Controller {
	
	var $cmsession;

	function CM_Controller()
	{
		parent::Controller();	
		$cmsession= new CMSession();
	}
	
	function index() {
		$response = new CMResponse();
		$errorcode = CMErrors::HTTP_FORBIDDEN;
		$response->setError($errorcode);
		$json = json_encode($response);
		
		log_message ('debug', 'CM_Controller->index: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
	
	function _checkAuth() {
		if ($this->_isLoggedIn($this) == false) {
			$response = new CMResponse();
			$response->setError(CMErrors::HTTP_UNAUTHORIZED);
			$json = json_encode($response);
		
			log_message ('debug', 'CM_Controller->index: response = ' . $json);

			print_r($json);
			return 	false;		
		} else {
			return true;
		}
	}

	function _isLoggedIn() {
		return $this->cmsession->isLoggedIn($this);
	}
	
	function _getCurrentUserid() {
		return $this->cmsession->getCurrentUserid($this);
	}
	
	function _checkAndLoad($view, $wrapHeaderFooter) {
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
		
		// checks if the user is logged in and loads the view. Else redirects to home page
		if ($this->cmsession->isLoggedIn($this) == false) {
			$this->index();
			return false;
		} else {
			if ($wrapHeaderFooter == true) {
				$this->load->view('includes/header');
				$this->load->view($view);		
				$this->load->view('includes/footer');
			} else {
				$this->load->view($view);		
			}
			return true;	
		}
		return false;
	}
	
	function _checkAndLoadAuthMenu($view,$wrapHeaderFooter) {
	$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
		
		// checks if the user is logged in and loads the view. Else redirects to home page
		if ($this->cmsession->isLoggedIn($this) == false) {
			$this->index();
			return false;
		} else {
			if ($wrapHeaderFooter == true) {
				$this->load->view('includes/authheader');
				$this->load->view($view);		
				$this->load->view('includes/footer');
			} else {
				$this->load->view($view);		
			}
			return true;	
		}
		return false;
	}
	function _loginpostLoad(){
		
	}
	
}

