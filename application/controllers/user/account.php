<?php

class Account extends CM_Controller {

	function Account()
	{
		parent::CM_Controller();	
	}
	
	function index() {
	}
	
	function get() {
		
		try {

			if ($this->_checkAuth() == false) {
				return;
			}
			$response = new CMResponse();
				
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Account->get: Got request " . $request);
				
			$account = $this->_getCurrentAccount();
				
			log_message('debug', 'Account->get: returned from _getCurrentAccount account = ' . $account->fullname);
					
			$response->setData($account);
			log_message('debug', 'Account->get: prepared response');
	
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Account->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function _getCurrentAccount() {	
				
		log_message('debug', 'Get->_getCurrentAccount: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Get->_getCurrentAccount: Got current userid = ' . $curruserid);

		if ($curruserid) {
			
					
			$account = $this->account_model->getAccount($curruserid);
			$account->password = "******";
			
			log_message('debug', 'Get->_getCurrentAccount: Got account = ' . $account->fullname);
			
			return $account;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
}
