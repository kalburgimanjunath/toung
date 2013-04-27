<?php
class LinkedinSignup extends Controller {
	//define variable for linkedin config data
	
    //this can be done in config.php as well
    var $linkedinData;
	
	public function index()
	{			
		$this->load->view('linkedinSignup');
	}
	
	function Linkedin() {				          
			parent::Controller();
			//linkedin returns url to our site with some query strings appended to it
            //so to get rid of codeigniter's query string problem, use following
            //at least worked for me
            parse_str($_SERVER['QUERY_STRING'],$_GET);			
            //load in the linkedin config parameters
            $this->linkedinData['consumer_key'] = $this->li_key;
            $this->linkedinData['consumer_secret'] = $this->li_secret;
            //your callback url for linkedin
            //in some cases codeigniter refusess to get to correct function if index.php is not appended in base_url, so i've added it
            //might not be necessary in some cases
            $this->linkedinData['callback_url'] = base_url()."index.php/linkedin/linkedin_view";
			/*
			$OBJ_linkedin = new LinkedIn(array($this->li_key,$this->li_secret));
			$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
			*/
			
			//$response = $this->statistics();
			
            //load some model for getting and saving linkedin credentials (token and secret)
           // $this->load->model('User_model', 'users');
    }
	
	function linkedin_view() {
			
            $userId = $this->session->userdata("user_id");
			
            //get request tokens from session
            $this->linkedinData['oauth_token'] = $_SESSION['oauth_request_token'];
            $this->linkedinData['oauth_token_secret'] = $_SESSION['oauth_request_token_secret'];
 
            $this->load->library('linkedin', $this->linkedinData);
            $_SESSION['oauth_verifier']     =  $_REQUEST['oauth_verifier'];
 
            //now request access token from linkedin
            $tokens = $this->linkedin->get_access_token($_SESSION['oauth_verifier']);
            //save the tokens in database
            $linkedinData = array(
                'user_id'       =>   $userId,
                'token'         =>   $tokens['oauth_token'],
                'oauth_secret'  =>   $tokens['oauth_token_secret']
            );
            $insertLinkedinData = $this->users->save_linkedin_auth($linkedinData, $userId);
            //now redirect to linkedin function
            redirect(base_url() . "social/linkedin");
    }
	
}
?>