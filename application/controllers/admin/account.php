<?php

class Account extends Controller {

	function Account()
	{
		parent::Controller();	
	}
	function list(){
			
	}
	function _loadAccount($userid) {
		if (! $userid) {
			echo "No username specified, defaulting to test user $userid <br/>";
			$userid = 'test';
		}
		
		$data = array();
		$this->load->model('account_model');
		if ($query = $this->account_model->getAccount($userid)) {
			echo "Got profile for $userid";
			$data['account'] = $query;
		}		
		return $data;
	}
	
	function index() {
	    echo "In index";
		$this->load->view('admin/signup_form');
	}
	
	function view($userid)
	{
	 	echo "loading for $userid <br/>";
		$data = $this->_loadAccount($userid);
		$this->load->view('account_view', $data);
	}
	
	
	function get($userid) {
		$this->view($userid);
	}
	
	function json($userid) {
		$data = $this->_loadAccount($userid);
		$this->load->view('account_view_json', $data);
	}
	
	function signup() {
	
		$this->load->model('account_model');

		$data = array(
			'userid' => $this->input->post('email'),
			'email' => $this->input->post('email'),
			'name' => $this->input->post('firstname'),
			'password' => $this->input->post('password')
		);	
		
		$this->account_model->addAccount($data);
		
		$this->view($data["userid"]);
	}
	
	function signin() {
	
		$this->load->model("account_model");
		
		$userid = $this->input->post('userid');
		$password = $this->input->post('password');
		
		if (!isset($userid))
			return "error signing in - userid is not supplied";
		 	
		$data = $this->_loadAccount($userid);
		
		if (strcmp($data->password, $password) == 0) {
			echo "Password matched";			
			$sessiondata = array('userid' => $userid, 'loggedin' => TRUE);
			$this->session->set_userdata($sessiondata);
		} else {
			$sessiondata = array('userid' => 'guest', 'loggedin' => FALSE);
			$this->session->set_userdata($sessiondata);

			echo "Invalid credentials";
		}
	}
	function search_post() {		
		$username = $this->input->post('username');
		$results = $this->account_model->search_account($username);
		$this->results=$results;
		// Show results		
		if(!empty($results)){
		  $this->load->view('search_user', $results);	
		}	
	}
	
	function search_user() {
		$this->load->view('search_user', $data);		
	}
}
