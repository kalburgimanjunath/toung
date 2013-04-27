<?php

class Education extends CM_Controller {

	function Education()
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
			
			log_message('debug', "Education->get: Got request " . $request);
				
			$educationlist = $this->_getCurrentEducation();
			$this->_computeMonthsYears($educationlist);
				
			log_message('debug', 'Education->get: returned from _getCurrentEducation  = ' . $educationlist);
					
			$response->setData($educationlist);
			log_message('debug', 'Education->get: prepared response');
	
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Education->get: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function _computeMonthsYears($educationList) {
		log_message('debug', 'Get->_computeMonthsYears: computing months');

		for($i = 0; $i < sizeof($educationList); ++$i) {
			log_message('debug', 'Get->_computeMonthsYears: start date ' . $educationList[$i]->startdate);

			$educationList[$i]->startmonth = substr($educationList[$i]->startdate, 5, 2);
			$educationList[$i]->startyear = substr($educationList[$i]->startdate, 0, 4);
			$educationList[$i]->endmonth = substr($educationList[$i]->enddate, 5, 2);;
			$educationList[$i]->endyear = substr($educationList[$i]->enddate, 0, 4);
			$educationList[$i]->updatedago = CMUtils::relativeTime($educationList[$i]->updated);
			log_message('debug', 'Get->_computeMonthsYears: start month ' . $educationList[$i]->startmonth);
			log_message('debug', 'Get->_computeMonthsYears: start year ' . $educationList[$i]->startyear);

		}
	}

	function _computeMonthsYearsForRecord($record){
			$record->startmonth = substr($record->startdate, 5, 2);
			$record->startyear = substr($record->startdate, 0, 4);
			$record->endmonth = substr($record->enddate, 5, 2);;
			$record->endyear = substr($record->enddate, 0, 4);
			$record->updatedago = CMUtils::relativeTime($record->updated);
	}
	
	function _getCurrentEducation() {	
				
		log_message('debug', 'Get->_getCurrentEducation: Getting current userid');
				
		// get current user id
		$curruserid = $this->_getCurrentUserid();
		
		log_message('debug', 'Get->_getCurrentEducation: Got current userid = ' . $curruserid);

		if ($curruserid) {
					
			$educationlist = $this->education_model->getMyEducation($curruserid);
			
			log_message('debug', 'Get->_getCurrentAccount: Got Education List = ' . $educationlist);
			
			return $educationlist;
		} else {
			throw new Exception("Cannot get account. User currently not signed in");
		}
	}
	
	function insert() {
		try {
			log_message("debug", "education->insert: Inserting new Education record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Education->insert: Got request " . $request);
			$edurecord = json_decode($request);

			$edurec = $edurecord->education;
			$edurec->posnum = 0;
			
			$edurec->userid = $this->_getCurrentUserid();
			
			log_message("debug", "Education->insert: Got userid " . $edurec->userid);
			
			$result = $this->education_model->insert($edurec);
			
			$this->_computeMonthsYearsForRecord($result);
			
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Education->insert: response = ' . $json);

		print_r($json);
		return 	$json;		

	}
	
	function save() {
		try {
			log_message("debug", "education->save: Saving Education record... ");
			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Education->save: Got request " . $request);
			
			$edurecord = json_decode($request);
			
			$edurec = $edurecord->education; //$this->education_model->education_model();
			$edurec->userid = $this->_getCurrentUserid();
				
			$result = $this->education_model->save($edurec);
			$this->_computeMonthsYearsForRecord($result);

			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);
		
		log_message ('debug', 'Education->save: response = ' . $json);

		print_r($json);
		return 	$json;		

	}

	function delete() {
		try {
			log_message("debug", "education->delete: Deleting Education record... ");

			if ($this->_checkAuth() == false) {
				return;
			}
			
			$response = new CMResponse();
	
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Signup->index: Got request " . $request);
			
			$education = json_decode($request);
	
			$edurec = $this->education_model->education_model();
			$edurec->userid = $this->_getCurrentUserid();
			$edurec->posnum = $education->education->posnum;
	
			$result = $this->education_model->delete($edurec);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
				$json = json_encode($response);
		
		log_message ('debug', 'Education->delete: response = ' . $json);

		print_r($json);
		return 	$json;				
	}

}
