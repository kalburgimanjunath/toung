<?php
class SocialIds extends CM_Controller {

	function SocialIds()
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
			
			log_message('debug', "SocialIds->get: Got request " . $request);
				
			$socialidslist = $this->_getCurrentSocialIds();
				
			log_message('debug', 'SocialIds->get: returned from _getCurrentSocialIds  = ' . $socialidslist);
					
			$response->setData($socialidslist);
			log_message('debug', 'SocialIds->get: prepared response');
	
		} catch (SocialIds $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'SocialIds->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function _getCurrentSocialIds() {	
				
		log_message('debug', 'Get->_getCurrentSocialIds: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		if (! $curruserid) $curruserid="jim";
		log_message('debug', 'Get->_getCurrentSocialIds: Got current userid = ' . $curruserid);
		

		if ($curruserid) {
					
			$socialidslist = $this->socialids_model->getMySocialIds($curruserid);
			$this->_computeUpdated($socialidslist);
			
			log_message('debug', 'Get->_getCurrentAccount: Got SocialIds List = ' . $socialidslist);
			
			return $socialidslist;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
	function insert() {
		try {
			log_message("debug", "socialids->insert: Inserting new SocialId record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "socialids->insert: Got request " . $request);
			$socrecord = json_decode($request);

			$socrec = $socrecord->socialid;
			$socrec->posnum = 0;
			
			$socrec->userid = $this->_getCurrentUserid();
			
			log_message("debug", "socialids->insert: Got userid " . $socrec->userid);
						
			$result = $this->socialids_model->insert($socrec);
			
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'socialids->insert: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function save() {
		try {
			log_message("debug", "socialids->save: Saving SocialId record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "socialids->save: Got request " . $request);
			
			$socrecord = json_decode($request);
			
			$socrec = $socrecord->socialid; 
			$socrec->userid = $this->_getCurrentUserid();

			$result = $this->socialids_model->save($socrec);
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'socialids->save: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function delete() {
		try {
			log_message("debug", "socialids->delete: Deleting SocialId record... ");

			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "socialids->delete: Got request " . $request);
			
			$socrecord = json_decode($request);
	
			$socrec = $this->socialids_model->socialids_model();
			$socrec->userid = $this->_getCurrentUserid();
			$socrec->posnum = $socrecord->socialid->posnum;
	
			$result = $this->socialids_model->delete($socrec);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'socialids->delete: response = ' . $json);

		print_r($json);
		return 	$json;				
	}	
	
	function _computeUpdated($soclist) {
		log_message('debug', 'socialids->_computeUpdated: computing updated ago');

		for($i = 0; $i < sizeof($soclist); ++$i) {
			log_message('debug', 'socialids->_computeUpdated: last updated ' . $soclist[$i]->updated);
			$soclist[$i]->updatedago = CMUtils::relativeTime($soclist[$i]->updated);
		}
	}


}
