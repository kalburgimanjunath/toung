<?php

class Signin extends CM_Controller {

	function Signin()
	{
		parent::Controller();	
	}
	
	function index() {
		session_start();
		try {
			$response = new CMResponse();
			
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Signin->index: Got request " . $request);

			$signin = json_decode($request);
			
			log_message('debug', 'Signin->index: json decode done ');						
			
			if ($signin) {
				log_message('debug', 'Signin->index: calling process signin');

				$success = $this->_processSignin($signin);	
				log_message('debug', 'Signin->index: returned from process signin');

				$data = array("loggedin", $success);		
				
				$response->setData($data);			
				
				/*
				log_message('debug', 'Signin->index: check user profile for missing data');
				
				$sess = new CMSession();
				$username = $sess->getCurrentUserid($this);
				
				
				if($this->education_model->getMyEducationCount($username) === 0){
					log_message("debug",  "Signin->index: Empty Education details");
					header("location:../aboutyou/Credential");
				}else if($this->experience_model->getMyExperienceCount($username) === 0){
					log_message("debug",  "Signin->index: Empty Experience details");
					header("location:../aboutyou/Credential");
				}*/
				
				log_message('debug', 'Signin->index: prepared response');
			} else {
				log_message('error', 'Signin->index: failed to decode request');
				throw new Exception ("Failed to decode request");
			}
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("loggedin", FALSE));
			$response->setErrorMessage(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Signin->index: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
	
	function _processSignin($signin) {	
				
		// check if passwords match		
		log_message('debug', 'Signin->index: Getting account for email');

		
		// check if userid already exists		
		$account = $this->account_model->getAccountForEmail($signin->account->email);
		
		log_message('debug', 'Signin->_processSignin: Got account for email');
		
		if (!$account) {
			//echo "No account exists for email";
			log_message('debug', 'Signin->_processSignin: No account exists for email');

			throw new Exception ("No account exists for email " . $signin->account->email);
		}
		
		if (strcmp($account->email, $signin->account->email) != 0) {
			//echo "No account exists for email 2";
			log_message('debug', 'Signin->_processSignin: No such user exists for email');

			throw new Exception ("No such user exists for email " . $signin->account->email);
		}
		
		if ( strcmp ($account->password, $signin->account->password) == 0) {
			// password matched! add information to the session
			log_message('debug', 'Signin->_processSignin: Matched password');
			
			$sess = new CMSession();
			$sess->signin($this, $account);	
			log_message('debug', 'Signin->_processSignin: Created Session');
	
			return TRUE;
		} else {
			// password mismatch
			log_message('debug', 'Signin->_processSignin: Invalid credentials');
			throw new Exception("Invalid credentials for " . $signin->account->email);
		} 
		
		// not sure what happened, should never reach here...
		return FALSE;
	}
}
