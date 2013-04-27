<?php
require_once("OAuth.php");

class LinkedIn {
	function _loadLinkedinData(){
		
		$endpoint = "https://api.linkedin.com/v1/people/~/connections";
		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];
		
		$req_token = new OAuthConsumer($_SESSION['oauth_token'],$_SESSION['oauth_token_secret'], 1);
		
		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$profile_req = OAuthRequest::from_consumer_and_token($test_consumer,$req_token, "GET", $endpoint, array());
		$profile_req->sign_request($sig_method, $test_consumer, $req_token);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array (
			$profile_req->to_header()
		));
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		$output = curl_exec($ch);

		if(curl_errno($ch)){
			echo 'Curl error 2: ' . curl_error($ch);
		}
		curl_close($ch);
		$xml = simplexml_load_string($output); 
		print_r($xml);
	}
}
?>