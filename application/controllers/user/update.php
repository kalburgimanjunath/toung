<?php

class Update extends CM_Controller {

	function Update()
	{
		parent::CM_Controller();	
	}
	
	function index() {
	
		try {
		
			if ($this->_checkAuth() == false) {
				return;
			}

			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			
			log_message('debug', 'Update->index: Got request = ' . $request);
			
			$data = json_decode($request);
			$account = $data->account;
			
			if ($account) {
				$success = $this->_saveMyInfo($account);	
				$data = array("success", $success);		
				$response->setData($data);
			} else {
				throw new Exception ("Failed to decode request");
			}
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		print_r($json);
		return 	$json;		
	}
	
	function _saveMyInfo($account) {	
				
		log_message('debug', 'Update->_saveAboutMe: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Update->_saveAboutMe: Got current userid = ' . $curruserid);
		
		$account->userid = $curruserid;
		
		log_message('debug', 'Update->_saveAboutMe: Saving info for userid ' . $account->userid);
		
		$success = $this->account_model->updateAccount($account);
		
		log_message('debug', 'Update->_saveAboutMe: Got success = ' . $success);
		
		return $success;	
	}
}
