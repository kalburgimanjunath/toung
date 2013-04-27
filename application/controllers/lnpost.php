<?php 

class Lnpost extends controller { 

	function Lnpost(){
 
		parent::Controller();
 
		echo parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
		
		$this->load->helper('url');
		$this->load->library('session');
 
		$this->data['consumer_key'] = "hayxhh4ckhtv";
		$this->data['consumer_secret'] = "OmvveMqt41XUNKjr";
		$this->data['callback_url'] = $this->config->config['base_url'].'/lnpost';
 
	}
	function index(){
		session_start();
		
		$this->load->library('linkedin', $this->data);
		$request_token_response = $this->linkedin->retrieveTokenRequest('https://api.linkedin.com/uas/oauth/requestToken');
		
			if($request_token_response === FALSE) {
					echo "Error in fetching";
			} else {
					$request_token = $request_token_response;
			}
		
		$varifArr= explode('&',$_SERVER['REQUEST_URI']);
		$varifier_var =explode('=',$varifArr[1]);
		echo "<pre>";
		$token = $this->linkedin->retrieveTokenAccess("hayxhh4ckhtv",$this->data['consumer_secret'],$varifier_var[1]);
		print_r($token);
		exit;
		//$this->linkedin->setToken($arrToken);
		
		$res=$this->linkedin->retrieveTokenAccess("hayxhh4ckhtv","OmvveMqt41XUNKjr",$varifier_var);
		//print_r($res);
		
		$request_token_response = $this->linkedin->get_request_token('https://api.linkedin.com/uas/oauth/requestToken');
		
		$headers = array('Content-Type' => 'text/xml');
		$api_url = "http://api.linkedin.com/v1/people/~";
		$response = $this->linkedin->fetch($api_url,$lnrequestToken,$this->data,$headers);
		echo "<pre>";
		print_r($response);
		$response =$this->linkedin->checkResponse(200, $response); // just a sample of how you would get the response
		exit;
		
		
		$sess = new CMSession();	
		//print_r($this->linkedin->debug_info());
		
		$api_url = "https://api.linkedin.com/v1/people/~";
		
		
		
		$response = $this->linkedin->fetch($api_url,'OAUTH_HTTP_METHOD_POST',$this->data,$headers);
		
		
			
		$api_url = "https://api.linkedin.com/v1/people/~";
		$response = $this->linkedin->fetch('GET',$api_url,$this->data,array('x-li-format' => 'json'));
		$this->linkedin->request_token    =   unserialize($this->session->userdata['requestToken']);
		
		
		//$request = $this->input->get ('oauth_verifier') ;
		
	
        //$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        //$linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
		
		//$this->linkedin->debug_info();
		$request_token_response = $this->linkedin->get_request_token('https://api.linkedin.com/uas/oauth/requestToken');
		if($request_token_response === FALSE) {
			throw new Exception("Failed fetching request token, response was: " . $this->linkedin->getLastResponse());
		} else {
			$request_token = $request_token_response;
		}			
		$oauth_verifier = trim(fgets(fopen("cookie.txt", "r")));
		
		$shareUrl = "http://api.linkedin.com/v1/people/~";
		//$auth_header = $this->linkedin->to_header("https://api.linkedin.com");
		$response=$this->linkedin->httpRequest($shareUrl,$headers,'OAUTH_HTTP_METHOD_GET');
		
		$api_url = "http://api.linkedin.com/v1/people/~";
		
		//$response = $this->linkedin->httpRequest($api_url,'OAUTH_HTTP_METHOD_GET',);
		$response = $this->linkedin->fetch('OAUTH_HTTP_METHOD_GET',$api_url,$this->data,$headers);
		//$response = $this->linkedin->getLastResponse(); // just a sample of how you would get the response*/
		
		
		//$response = $this->linkedin->api->profile('~:(id,first-name,last-name,public-profile-url,picture-url,date-of-birth,phone-numbers,summary)');
		print_r($response);
 
	} 
 }
?>