<?php

class Experience extends CM_Controller {

	function Experience()
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
			
			log_message('debug', "Experience->get: Got request " . $request);
				
			$experiencelist = $this->_getCurrentExperience();
			$this->_computeMonthsYears($experiencelist);
				
			log_message('debug', 'Experience->get: returned from _getCurrentExperience  = ' . $experiencelist);
					
			$response->setData($experiencelist);
			log_message('debug', 'Experience->get: prepared response');
	
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Experience->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function _computeMonthsYears($experiencelist) {
		log_message('debug', 'Get->_computeMonthsYears: computing months');

		for($i = 0; $i < sizeof($experiencelist); ++$i) {
			log_message('debug', 'Get->_computeMonthsYears: start date ' . $experiencelist[$i]->startdate);

			$experiencelist[$i]->startmonth = substr($experiencelist[$i]->startdate, 5, 2);
			$experiencelist[$i]->startyear = substr($experiencelist[$i]->startdate, 0, 4);
			$experiencelist[$i]->endmonth = substr($experiencelist[$i]->enddate, 5, 2);;
			$experiencelist[$i]->endyear = substr($experiencelist[$i]->enddate, 0, 4);
			$experiencelist[$i]->updatedago = CMUtils::relativeTime($experiencelist[$i]->updated);

			log_message('debug', 'Get->_computeMonthsYears: start month ' . $experiencelist[$i]->startmonth);
			log_message('debug', 'Get->_computeMonthsYears: start year ' . $experiencelist[$i]->startyear);

		}
	}

	function _computeMonthsYearsForRecord($record){
			$record->startmonth = substr($record->startdate, 5, 2);
			$record->startyear = substr($record->startdate, 0, 4);
			$record->endmonth = substr($record->enddate, 5, 2);;
			$record->endyear = substr($record->enddate, 0, 4);
			$record->updatedago = CMUtils::relativeTime($record->updated);
	}

	function _getCurrentExperience() {	
				
		log_message('debug', 'Get->_getCurrentExperience: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Get->_getCurrentExperience: Got current userid = ' . $curruserid);
		
		if ($curruserid) {
					
			$experiencelist = $this->experience_model->getMyExperience($curruserid);
			
			log_message('debug', 'Get->_getCurrentAccount: Got Experience List = ' . $experiencelist);
			
			return $experiencelist;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
	function insert() {
		try {
			log_message("debug", "experience->insert: Inserting new Experience record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Experience->insert: Got request " . $request);
			$exprecord = json_decode($request);

			$exprec = $exprecord->experience;
			$exprec->posnum = 0;
			
			$exprec->userid = $this->_getCurrentUserid();
			
			log_message("debug", "Experience->insert: Got userid " . $exprec->userid);
						
			$result = $this->experience_model->insert($exprec);
			
			$this->_computeMonthsYearsForRecord($result);

			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Experience->insert: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function save() {
		try {
			log_message("debug", "experience->save: Saving Experience record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Experience->save: Got request " . $request);
			
			$exprecord = json_decode($request);
			
			$exprec = $exprecord->experience; 
			$exprec->userid = $this->_getCurrentUserid();

			$result = $this->experience_model->save($exprec);
			$response->setData($result);
			
		} catch (Exception $e) {
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Experience ->save: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function delete() {
		try {
			log_message("debug", "experience->delete: Deleting Experience record... ");

			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "experience->delete: Got request " . $request);
			
			$experience = json_decode($request);
	
			$exprec = $this->experience_model->experience_model();
			$exprec->userid = $this->_getCurrentUserid();
			$exprec->posnum = $experience->experience->posnum;
	
			$result = $this->experience_model->delete($exprec);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Experience->delete: response = ' . $json);

		print_r($json);
		return 	$json;				
	}	
	
}
