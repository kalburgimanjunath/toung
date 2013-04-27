<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSession {
	
	function CMSession()
	{
	}
	
	function isLoggedIn($controller) {
		$loggedin = $controller->session->userdata("loggedin");
		log_message("debug", "CMSession->isLoggedIn: Logged in is = " . $loggedin);
		if ($loggedin == true) 
			return true;
			
		return false;
	}
	
	function signin ($controller, $account) {
		$data = array(
				'currentuserid' => $account->userid,
			    'currentemail' => $account->email,
				'loggedin' => true
		);
		
		$controller->session->set_userdata($data);
		return true;
	}
	
	function getCurrentUserid($controller) {
		return $controller->session->userdata('currentuserid');
	}
	
	function signout($controller) {
		$controller->session->sess_destroy();
		return true;
	}
	
	function oauth($controller, $account){	
		$controller->session->set_userdata($account);
		return true;
	}
	
}

?>