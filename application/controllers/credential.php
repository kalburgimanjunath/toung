<?php
 
class Credential extends CM_Controller {
	public $fbconfig = array(
		'appId'  => '343256292407899',
		'secret' => '9a7f3cdc6dce643381c76beea297a8f8',
	);
	function Credential()
		{
			parent::Controller();	
		}
	
	
	function index() {	   
		
		$response = new CMResponse();
		$userId = $this->_getCurrentUserid();
		print_r($_SESSION);
		$data = array("loggedin", True);
		$sess = new CMSession();
		$json = json_encode($response);
		print_r($json);
		return 	$json;		
		//$this->load->view('forms/credential_form');
	}
	
	function save() {  
		
		$userId = $this->_getCurrentUserid();
		
		$response = new CMResponse();
		try {
			log_message("debug", "aboutyou->save: Saving About you  records... ");
			/*if ($this->_checkAuth() == false) {
				return;
			}*/
			
			
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			
			log_message("debug", "aboutyou->save: Got request " . $request);
		
			$abtrecord = json_decode($request);
			
			
			//$abtrec = $abtrecord->account; 
			$abtrec = $this->account_model->account_model();
			$abtrec->userid = $userId;
			$abtrec->city =$abtrecord->account->city;
			$abtrec->aboutme =$abtrecord->account->bio;
			$abtrec->headline =$abtrecord->account->headline;
			
			$result = $this->account_model->updateAccount($abtrec);		
			//$this->upload->do_upload($abtrec->picture);
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		$json = json_encode($response);
		
		log_message ('debug', 'aboutyou->save: Got request = ' . $json);
		
		$data = array("loggedin", True);
		
		$response->setData($data);
		
		//$this->_checkAndLoad('profile', true);
		redirect('aboutyou/credentials');
		
		//$this->view($userId);
		//return 	$json;
		
		
		
	}
	
	
	function view($userid)
	{		
	 	//echo "loading for $userid <br/>";
		//$data = $this->_loadAccount($userid);
		
		$sessiondata = array('userid' => $userid, 'loggedin' => TRUE);
		$this->session->set_userdata($sessiondata);		
		
		//$this->load->view('home', $data);
	}
	
}
?>