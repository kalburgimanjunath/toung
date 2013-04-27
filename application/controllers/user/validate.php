<?php

class Validate extends Controller {

	function Validate()
	{
		parent::Controller();	
	}
	
	function isLoggedIn() {
		
		$sess = new CMSession();
		
		$loggedin = $sess->isLoggedIn($this);	
		
		$response = new CMResponse();
		$response->setData($loggedin);
		
		$json = json_encode($response);
		
		log_message ('debug', 'Validate->index: isLoggedIn response = ' . $json);

		print_r($json);
		return 	$json;		
		
	}
	
	function existsUserid() {
	
		try {
			$response = new CMResponse();
			
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Validate->existsUserid: Got request " . $request);

			$validate = json_decode($request);
			
			log_message('debug', 'Validate->existsUserid: json decode done ');						
			
			
			if ($validate) {
				
				log_message('debug', 'Validate->existsUserid: check if exists username ' . $validate->account->userid);
		
				// check if userid already exists		
				$account = $this->account_model->getAccount($validate->account->userid);
				
				if ($account) {
					// account exists
					$response->setData(true);
				} else {
					$response->setData(false);
				}
				log_message('debug', 'Validate->existsUserid: prepared response');
			} else {
				log_message('error', 'Validate->existsUserid: failed to decode request');
				throw new Exception ("Failed to decode request");
			}
		} catch (Exception $e) {
			log_message('error', 'Validate->existsUserid: Caught exception ' . $e->getMessage());
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Validate->existsUserid: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
	
	function existsEmail() {
	
		try {
			$response = new CMResponse();
			
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Validate->existsEmail: Got request " . $request);

			$validate = json_decode($request);
			
			log_message('debug', 'Validate->existsEmail: json decode done ');						
			
			
			if ($validate) {				
				log_message('debug', 'Validate->existsEmail: check if exists username ' . $validate->account->email);
		
				// check if userid already exists		
				$account = $this->account_model->getAccountForEmail($validate->account->email);
				
				if ($account) {
					// account exists
					$response->setData(true);
				} else {
					$response->setData(false);
				}
				log_message('debug', 'Validate->existsEmail: prepared response');
			} else {
				log_message('error', 'Validate->existsEmail: failed to decode request');
				throw new Exception ("Failed to decode request");
			}
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			log_message('error', 'Validate->existsEmail: Caught exception ' . $e->getMessage());
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Validate->existsEmail: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
}
