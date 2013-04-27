<?php
class Skills extends CM_Controller {

	function Skills()
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
			
			log_message('debug', "Skills->get: Got request " . $request);
				
			$skillslist = $this->_getCurrentSkills();
				
			log_message('debug', 'Skills->get: returned from _getCurrentSkills  = ' . $skillslist);
					
			$response->setData($skillslist);
			log_message('debug', 'Skills->get: prepared response');
	
		} catch (Skills $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Skills->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function _getCurrentSkills() {	
				
		log_message('debug', 'Get->_getCurrentSkills: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		if (! $curruserid) $curruserid="jim";
		log_message('debug', 'Get->_getCurrentSkills: Got current userid = ' . $curruserid);
		

		if ($curruserid) {
					
			$skillslist = $this->skills_model->getMySkills($curruserid);
			$this->_computeUpdated($skillslist);
			
			log_message('debug', 'Get->_getCurrentAccount: Got Skills List = ' . $skillslist);
			
			return $skillslist;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
	function insert() {
		try {
			log_message("debug", "skills->insert: Inserting new Skill record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "skills->insert: Got request " . $request);
			$skirecord = json_decode($request);

			$skirec = $skirecord->skill;
			$skirec->posnum = 0;
			
			$skirec->userid = $this->_getCurrentUserid();
			
			log_message("debug", "skills->insert: Got userid " . $skirec->userid);
						
			$result = $this->skills_model->insert($skirec);
			
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'skills->insert: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function save() {
		try {
			log_message("debug", "skills->save: Saving Skill record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "skills->save: Got request " . $request);
			
			$skirecord = json_decode($request);
			
			$skirec = $skirecord->skill; 
			$skirec->userid = $this->_getCurrentUserid();

			$result = $this->skills_model->save($skirec);
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'skills->save: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function delete() {
		try {
			log_message("debug", "skills->delete: Deleting Skill record... ");

			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "skills->delete: Got request " . $request);
			
			$skirecord = json_decode($request);
	
			$skirec = $this->skills_model->skills_model();
			$skirec->userid = $this->_getCurrentUserid();
			$skirec->posnum = $skirecord->skill->posnum;
	
			$result = $this->skills_model->delete($skirec);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'skills->delete: response = ' . $json);

		print_r($json);
		return 	$json;				
	}	
	
	function _computeUpdated($skilist) {
		log_message('debug', 'skills->_computeUpdated: computing updated ago');

		for($i = 0; $i < sizeof($skilist); ++$i) {
			log_message('debug', 'skills->_computeUpdated: last updated ' . $skilist[$i]->updated);
			$skilist[$i]->updatedago = CMUtils::relativeTime($skilist[$i]->updated);
		}
	}


}
