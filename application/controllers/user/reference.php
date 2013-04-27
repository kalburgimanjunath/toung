<?php

class Reference extends CM_Controller {

	function Reference()
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
			
			log_message('debug', "Reference->get: Got request " . $request);
				
			$referencelist = $this->_getCurrentReference();
				
			log_message('debug', 'Reference->get: returned from _getCurrentReference  = ' . $referencelist);
					
			$response->setData($referencelist);
			log_message('debug', 'Reference->get: prepared response');
	
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Reference->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function _getCurrentReference() {	
				
		log_message('debug', 'Get->_getCurrentReference: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		if (! $curruserid) $curruserid="jim";
		log_message('debug', 'Get->_getCurrentReference: Got current userid = ' . $curruserid);
		

		if ($curruserid) {
					
			$referencelist = $this->reference_model->getMyReference($curruserid);
			$this->_computeUpdated($referencelist);
			
			log_message('debug', 'Get->_getCurrentAccount: Got Reference List = ' . $referencelist);
			
			return $referencelist;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
	function insert() {
		try {
			log_message("debug", "reference->insert: Inserting new reference record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "reference->insert: Got request " . $request);
			$refrecord = json_decode($request);

			$refrec = $refrecord->reference;
			$refrec->posnum = 0;
			
			$refrec->userid = $this->_getCurrentUserid();
			
			log_message("debug", "reference->insert: Got userid " . $refrec->userid);
						
			$result = $this->reference_model->insert($refrec);
			
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'reference->insert: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function save() {
		try {
			log_message("debug", "reference->save: Saving Skill record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "reference->save: Got request " . $request);
			
			$refrecord = json_decode($request);
			
			$refrec = $refrecord->reference; 
			$refrec->userid = $this->_getCurrentUserid();

			$result = $this->reference_model->save($refrec);
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'reference->save: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function delete() {
		try {
			log_message("debug", "reference->delete: Deleting Skill record... ");

			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "reference->delete: Got request " . $request);
			
			$refrecord = json_decode($request);
	
			$refrec = $this->reference_model->reference_model();
			$refrec->userid = $this->_getCurrentUserid();
			$refrec->posnum = $refrecord->reference->posnum;
	
			$result = $this->reference_model->delete($refrec);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'reference->delete: response = ' . $json);

		print_r($json);
		return 	$json;				
	}
	
	function _computeUpdated($list) {
		log_message('debug', 'reference->_computeUpdated: computing updated ago');

		for($i = 0; $i < sizeof($list); ++$i) {
			log_message('debug', 'reference->_computeUpdated: last updated ' . $list[$i]->updated);
			$list[$i]->updatedago = CMUtils::relativeTime($list[$i]->updated);
		}
	}

}
