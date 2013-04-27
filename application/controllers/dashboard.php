<?php

class Dashboard extends CM_Controller {

	function Dashboard()
	{
		parent::Controller();	
	}
	
	function _loadProfile($username) {
		session_start();
		if (! $username) {
			echo "No username specified, defaulting to test user $username <br/>";
			$username = 'test';
		}
		$data = array();
		$this->load->helper('html');
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
		log_message("debug", "CM_Controller->index: dashboard()");
		
		$response = new CMResponse();
		
		if ($this->_checkAuth() == false) {
			return;
		}
		
		//load profile
		$sess = new CMSession();
		$username = $sess->getCurrentUserid($this);
		
		$data = $this->_loadProfile($username);
	
		$response->setData($data);
		
		$this->avatar=$username;
		$this->profile=$data;
		//$this->load->view('includes/authheader', $data);	
		$startCount = 0;
		$endCount = 15;
		/*
		if(isset($_SESSION['oauth_token']) || isset($_SESSION['oauth_token_secret'])){
			$connection = $this->loadLinkedinConnectionData($startCount,$endCount);
			
		}
		
		$activity = $this->loadLinkedinActivity($startCount,$endCount);
		*/
		$data['main_content'] = 'dashboard';
		$this->_checkAndLoad('includes/authheader', false);	
		$arrCommunity = $this->account_model->isExistsCummunity($username);
		
		if(!empty($arrCommunity->communityid)){
			$data['community_id'] = true;
			$data['social'] = $this->socialids_model->getMySocialIds($username);
		}else{
			$data['community_id'] = false;
		}		
		
		$this->load->view('includes/template', $data);
		
				
		//$this->_checkAndLoad('includes/authheader', false);
		//$this->load->view('search_user',$data);	
		//$this->_checkAndLoad('dashboard', true);
		
		//$this->_checkAndLoad('search_user',false);
		//$this->load->view('search_user');
		//$this->load->view('widgets/linkedin');
		//load body
		//load footer
		
	}
	function setcommunityFacebook() {
		$sess = new CMSession();
		$userId = $sess->getCurrentUserid($this);
		$this->load->model('account_model');	
		$results = $this->account_model->setCommunity($userId,1);	
		redirect("dashboard");
	}
	
	function setcommunityLinkedin() {
		$sess = new CMSession();
		$userId = $sess->getCurrentUserid($this);
		$this->load->model('account_model');	
		$results = $this->account_model->setCommunity($userId,2);	
		redirect("dashboard");
	}
	
	function loadLinkedinConnectionData($startCount,$endCount) {
		require_once("OAuth.php");
		
		$endpoint = "https://api.linkedin.com/v1/people/~/connections?count=10";
		
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
		
		$xmlarray = array(); // this will hold the flattened data
		$xml = $this->xml2array($output);
		print_r($xml);
exit;		
				
				$useraccount=$xml['connections']['person'];
				//echo "id=".$useraccount[$i]['id'];
				
					//to store the all connection information
					for($i=0;$i<$endCount;$i++){
					//foreach($useraccount as $account){
						$arraccount = $this->load->model("connections_model");
						$arraccount->userid = $this->_getCurrentUserid();
						$arraccount->frndid = $useraccount[$i]['id'];
						$arraccount->fname = $useraccount[$i]['first-name'];
						$arraccount->lname = $useraccount[$i]['last-name'];
						$arraccount->headline = $useraccount[$i]['headline'];
						if(!empty($useraccount[$i]['picture-url']))
						{
							$arraccount->picture_url = $useraccount[$i]['picture-url'];
						}
						$arraccount->profile_url = $useraccount[$i]['site-standard-profile-request']['url'];
						//$results = $this->connections_model->insert($arraccount);					
					}
		return $arraccount;		
		//return $this->XMLToArrayFlat($xml, $xmlarray, '', true); 	
		
	}
	
	function loadLinkedinActivity($startCount,$endCount) {
		require_once("OAuth.php");
		
		$endpoint = " 	http://api.linkedin.com/v1/people/~/network/updates?type=STAT&type=PICT&count=$endCount&start=$startCount";
		
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
		
		$xmlarray = array(); // this will hold the flattened data
		$xml = $this->xml2array($output);
		print_r($xml);
		exit;
				
		//return $this->XMLToArrayFlat($xml, $xmlarray, '', true); 	
		
	}
	
	function XMLToArrayFlat($xml, &$return, $path='', $root=false)
	{
		$children = array();
		if ($xml instanceof SimpleXMLElement) {
			$children = $xml->children();
			if ($root){ // we're at root
				$path .= '/'.$xml->getName();
			}
		}
		if ( count($children) == 0 ){
			$return[$path] = (string)$xml;
			return;
		}
		$seen=array();
		
		foreach ($children as $child => $value) {
			$childname = ($child instanceof SimpleXMLElement)?$child->getName():$child;
			if ( !isset($seen[$childname])){
				$seen[$childname]=0;
			}
			$seen[$childname]++;
			//XMLToArrayFlat($value, $return, $path.'/'.$child.'['.$seen[$childname].']');
			$this->XMLToArrayFlat($value, $return, $child);
		}
	} 
	
	
		function xml2array($contents, $get_attributes=1, $priority = 'tag') { 
			if(!$contents) return array(); 

			if(!function_exists('xml_parser_create')) { 
				//print "'xml_parser_create()' function not found!"; 
				return array(); 
			} 

			//Get the XML parser of PHP - PHP must have this module for the parser to work 
			$parser = xml_parser_create(''); 
			xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
			xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
			xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
			xml_parse_into_struct($parser, trim($contents), $xml_values); 
			xml_parser_free($parser); 

			if(!$xml_values) return;//Hmm... 

			//Initializations 
			$xml_array = array(); 
			$parents = array(); 
			$opened_tags = array(); 
			$arr = array(); 

			$current = &$xml_array; //Refference 

			//Go through the tags. 
			$repeated_tag_index = array();//Multiple tags with same name will be turned into an array 
			foreach($xml_values as $data) { 
				unset($attributes,$value);//Remove existing values, or there will be trouble 

				//This command will extract these variables into the foreach scope 
				// tag(string), type(string), level(int), attributes(array). 
				extract($data);//We could use the array by itself, but this cooler. 

				$result = array(); 
				$attributes_data = array(); 
				 
				if(isset($value)) { 
					if($priority == 'tag') $result = $value; 
					else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode 
				} 

				//Set the attributes too. 
				if(isset($attributes) and $get_attributes) { 
					foreach($attributes as $attr => $val) { 
						if($priority == 'tag') $attributes_data[$attr] = $val; 
						else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr' 
					} 
				} 

				//See tag status and do the needed. 
				if($type == "open") {//The starting of the tag '<tag>' 
					$parent[$level-1] = &$current; 
					if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag 
						$current[$tag] = $result; 
						if($attributes_data) $current[$tag. '_attr'] = $attributes_data; 
						$repeated_tag_index[$tag.'_'.$level] = 1; 

						$current = &$current[$tag]; 

					} else { //There was another element with the same tag name 

						if(isset($current[$tag][0])) {//If there is a 0th element it is already an array 
							$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
							$repeated_tag_index[$tag.'_'.$level]++; 
						} else {//This section will make the value an array if multiple tags with the same name appear together
							$current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
							$repeated_tag_index[$tag.'_'.$level] = 2; 
							 
							if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
								$current[$tag]['0_attr'] = $current[$tag.'_attr']; 
								unset($current[$tag.'_attr']); 
							} 

						} 
						$last_item_index = $repeated_tag_index[$tag.'_'.$level]-1; 
						$current = &$current[$tag][$last_item_index]; 
					} 

				} elseif($type == "complete") { //Tags that ends in 1 line '<tag />' 
					//See if the key is already taken. 
					if(!isset($current[$tag])) { //New Key 
						$current[$tag] = $result; 
						$repeated_tag_index[$tag.'_'.$level] = 1; 
						if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data; 

					} else { //If taken, put all things inside a list(array) 
						if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array... 

							// ...push the new element into that array. 
							$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
							 
							if($priority == 'tag' and $get_attributes and $attributes_data) { 
								$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
							} 
							$repeated_tag_index[$tag.'_'.$level]++; 

						} else { //If it is not an array... 
							$current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
							$repeated_tag_index[$tag.'_'.$level] = 1; 
							if($priority == 'tag' and $get_attributes) { 
								if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
									 
									$current[$tag]['0_attr'] = $current[$tag.'_attr']; 
									unset($current[$tag.'_attr']); 
								} 
								 
								if($attributes_data) { 
									$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
								} 
							} 
							$repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken 
						} 
					} 

				} elseif($type == 'close') { //End of tag '</tag>' 
					$current = &$parent[$level-1]; 
				} 
			} 
			 
			return($xml_array); 
		} 
}
