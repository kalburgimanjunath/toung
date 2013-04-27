<?php

class Profile extends CM_Controller {

	function Profile()
	{
		parent::CM_Controller();
		$this->load->helper(array('form','url','file','html'));
	}
	
	function _loadProfile($username) {
		if (! $username) {
			echo "No username specified, defaulting to test user $username <br/>";
			$username = 'test';			
		}
		if ($this->_checkAuth() == false) {
			return;
		}
		
		$data = array();
		
		$this->load->model('account_model');
		if ($query = $this->account_model->getAccount($username)) {
			
			$data['account'] = $query;
		}
		
		$this->load->model('Myprefs_model');
		if ($query = $this->Myprefs_model->getMyprefs($username)) {
			
			$data['profile'] = $query;
		}
		
		return $data;
	}
	
	function index()
	{		
		$sess = new CMSession();
		
		$response = new CMResponse();
		
		$username = $sess->getCurrentUserid($this);
		
		$data = $this->_loadProfile($username);
		
		$data['main_content'] = 'profile';
		
		
		$response->setData($data);
		$this->_checkAndLoad('includes/authheader', false);
		$this->load->view('includes/template', $data);
		
		//$this->load->view('profile_view', $data);

	}
	
	function get($username) {
		$this->index($username);
	}
	
	function json($username) {
		$data = $this->_loadProfile();
		$this->load->view('profile_view_json', $data);
	}
	
	function editprofile() {
		session_start();
		$sess = new CMSession();
		
		$response = new CMResponse();
		
		$username = $sess->getCurrentUserid($this);
		
		$data = $this->_loadProfile($username);
		
		$data['main_content'] = 'profile_edit';
		
		$this->load->model('tags_model');
		if ($query = $this->tags_model->getMyTags($username)) {
			
			$data['tags'] = $query;
		}

		$response->setData($data);
		$this->_checkAndLoad('includes/authheader', false);
		$this->load->view('includes/template', $data);
	}
	
	function preview($theme) {
		$sess = new CMSession();
		
		$response = new CMResponse();
			
		$username = $sess->getCurrentUserid($this);
		
		$data = $this->_loadProfile($username);
		$this->load->model('education_model');
		if ($query = $this->education_model->getMyEducation($username)) {
			
			$data['education'] = $query;
		}
		
		if ($query = $this->experience_model->getMyExperience($username)) {
			
			$data['experience'] = $query;
		}		
		
		if($theme==1){			
			$this->load->view('themes/theme1', $data);			
		}else if($theme==2){						
			$this->load->view('themes/theme2', $data);
		}else if($theme==3){						
			$this->load->view('themes/theme3', $data);
		}
		
	}
	function editaboutsave(){
		//$this->load->view('messages/compose');
		if ($this->_checkAuth() == false) {
			return;
		}
		
		$sess = new CMSession();
		$userId = $this->_getCurrentUserid();
		
		$this->load->model('account_model');
		
		$response = new CMResponse();
		$request = $this->input->post ('request') ;
		
		$actrecord = json_decode($request);	
	
		$accrec = $this->account_model->account_model();		
		
		
		//$myprefsrec = $this->message_model->addMessage($msgrec);
	}

}
