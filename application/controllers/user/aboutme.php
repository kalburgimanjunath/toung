<?php

class Aboutme extends CM_Controller {

	function Aboutme()
	{
		parent::CM_Controller();	
	}
		
	function get() {
		try {
			$response = new CMResponse();
			
			if ($this->_checkAuth() == false) {
				return;
			}
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Aboutme->index: Got request " . $request);
				
			$aboutme = $this->_getAboutMe();
				
			log_message('debug', 'Aboutme->index: returned from _getAboutMe aboutme = ' . $aboutme);

			$data = $aboutme;		
				
			$response->setData($data);
			log_message('debug', 'Aboutme->index: prepared response');

		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("loggedin", FALSE));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Signin->index: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	
	function update() {
	
		try {
			$response = new CMResponse();

			if ($this->_checkAuth() == false) {
				return;
			}
				
			$request = $this->input->post ('request') ;
			
			log_message('debug', "Aboutme->index: Got request " . $request);

			$aboutme = json_decode($request);
			
			log_message('debug', 'Aboutme->index: json decode done ');			
			
			if ($aboutme) {
				log_message('debug', 'Aboutme->index: data exists');

				$success = $this->_saveAboutMe($aboutme);	
				log_message('debug', 'Aboutme->index: returned from _saveAboutMe');

				$data = array("success", $success);		
				
				$response->setData($data);
				log_message('debug', 'Aboutme->index: prepared response');

			} else {
				log_message('error', 'Aboutme->index: failed to decode request');
				throw new Exception ("Failed to decode request");
			}
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Signin->index: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
	
	function _saveAboutMe($aboutme) {	
				
		log_message('debug', 'Aboutme->_saveAboutMe: Getting current user id');
		
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Aboutme->_saveAboutMe: Got current userid = ' . $curruserid);
		
		$about = $aboutme->account->aboutme;
		
		log_message('debug', 'Aboutme->_saveAboutMe: Got aboutme = ' . $about);
		
		$success = $this->account_model->setAboutMe($curruserid, $about);
		
		log_message('debug', 'Aboutme->_saveAboutMe: Got success = ' . $success);
		
		return $success;	
	}
	
	
	function _getAboutMe() {	
				
		log_message('debug', 'Aboutme->_getAboutMe: Getting current user id');
		
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Aboutme->_getAboutMe: Got current userid = ' . $curruserid);
				
		$about = $this->account_model->getAboutMe($curruserid);
		
		log_message('debug', 'Aboutme->_getAboutMe: Got aboutme = ' . $about);
		
		return $about;	
	}

}
