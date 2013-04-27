<?php

class Logout extends Controller {

	function Logout()
	{
		parent::Controller();	
	}
	
	function index() {
		$this->session->sess_destroy();
		$response = new CMResponse();
		$data = array("loggedin", false);		
		$response->setData($data);		
		$json = json_encode($response);				
		log_message ('debug', 'Logout->index: response = ' . $json);
		$this->load->helper('url');
		redirect('home');
		//print_r($json);
		//return 	$json;	
	}

}
?>