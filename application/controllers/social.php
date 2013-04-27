<?php
    class Social extends Controller {
        //define variable for linkedin config data
        //this can be done in config.php as well
        var $linkedinData;
 
        function Social() {
            parent::Controller();
            //linkedin returns url to our site with some query strings appended to it
            //so to get rid of codeigniter's query string problem, use following
            //at least worked for me
            //load in the linkedin config parameters
            $this->linkedinData['consumer_key'] = "ol6aq2kjbq7k";
            $this->linkedinData['consumer_secret'] = "2krGmZmqN2s5jbIm";
            //your callback url for linkedin
            //in some cases codeigniter refusess to get to correct function if index.php is not appended in base_url, so i've added it
            //might not be necessary in some cases
            $this->linkedinData['callback_url'] = base_url()."/social/linkedin_view";
			
            //load some model for getting and saving linkedin credentials (token and secret)
            //$this->load->model('account', 'users');
        }
 
        /*
            function that displays linkedin profile data or redirects to linkedin for authentication, depending on variables
            this function first checks if we have linkedin credentials (token and secret from linkedin) stored in our database
            if it's stored then gets profile using that token else redirects to linkedin site for authentication
        */
        function linkedin() {
            //get the loggedin user if from session, may be like
            $userId = $this->session->userdata("user_id");
 
            //check if we have the linkedin token and secret stored in our database for this user
            //get_credentials_by_user_id() function is to be defined in users_model that returns stored linkedin credentials
            $linkedinCreds = $this->users->get_credentials_by_user_id($userId);
            if(!empty($linkedinCreds)) {
                $this->linkedinData['oauth_token'] = $linkedinCreds['token'];
                $this->linkedinData['oauth_token_secret'] = $linkedinCreds['oauth_secret'];
                //now using above token and secret we can get users profile
                //load the linkedin library
                $this->load->library('linkedin', $this->linkedinData);
                //the library the gets access token in $this->linkedin->token, so we use it
                $profileResponse = $this->linkedin->getProfile($this->linkedin->token);
                //we have the profile details in xml format, which can be used easily for display purpose, converting it into appropriate format
                //you can pass this respomse to you view now
                echo "<pre>";
                print_r($profileResponse);
            }
            else {
                //so we dont have tokens stored in database, then
                //load the linkedin library
                $this->load->library('linkedin', $this->linkedinData);
                //get the access token'
                $token = $this->linkedin->get_request_token();
 
                //store the tokens in session
                $_SESSION['oauth_request_token'] = $token['oauth_token'];
                $_SESSION['oauth_request_token_secret'] =   $token['oauth_token_secret'];
 
                //get the authorize url
                $request_link = $this->linkedin->get_authorize_URL($token);
 
                //redirect to linked for authorization
                redirect($request_link);
            }
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
		function index() {
		
			$this->load->view('social');
		}
		
    }
?>