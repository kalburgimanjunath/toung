<?php 
class Linkedinstuff extends CM_Controller {
 
 
	
	function Linkedinstuff(){
 
		parent::Controller();
		
		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
		$this->load->helper('url');
		$this->load->library('session');
 
		
 
	}
 
	function index()
	{
			//$linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
			
			session_start();
			$this->data['linkedin_access'] = "hayxhh4ckhtv";
			$this->data['linkedin_secret'] = "OmvveMqt41XUNKjr";
			$this->data['callback_url'] = $this->config->config['base_url'].'/lnpost';
			
			$this->load->library('linkedin', $this->data);
			
			$linkedin = new LinkedIn($this->data['linkedin_access'],$this->data['linkedin_secret'], $this->data['callback_url'] );
			
			$linkedin->getRequestToken();
			
			if (isset($_REQUEST['oauth_verifier'])){
				$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

				$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
				$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
				$linkedin->getAccessToken($_REQUEST['oauth_verifier']);

				$_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
				header("Location: " . $config['callback_url']);
				exit;
		   }
		   else{
				$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
				$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
				$linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
		   }
		   
			exit;
			$request_token_response = $this->linkedin->getRequestToken();
			print_r($request_token_response );
			exit;
			if($request_token_response === FALSE) {
					echo "Error in fetching";
			} else {
					$request_token = $request_token_response;
			}
			
			$varifArr= explode('&',$_SERVER['REQUEST_URI']);
			
			$varifier_var =explode('=',$varifArr[1]);
			
			header("Location: " . "https://api.linkedin.com/uas/oauth/authorize?oauth_token=$request_token->key");
			//header("Location: " . $this->linkedin->get_authorize_URL($request_token));
			
			/*
			$accepted = false;
			while(!$accepted) {
					print "Have you authorized me? (y/n) ";
					$accepted = !!stristr(fgetc(fopen("php://stdin", "r")), "y");
			}
			 
			$valid_pin = false;
			while(!$valid_pin) {
					print "What is the PIN? ";
					$oauth_verifier = trim(fgets(fopen("php://stdin", "r")));
					$valid_pin = is_numeric($oauth_verifier);
			}*/
			$this->load->helper('url');
			
			/*
			$oauth_verifier = trim(fgets(fopen("cookie.txt", "w")));
			
			$this->linkedin->setToken($request_token->key, $request_token->secret);
			$access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
			$access_token_response = $this->linkedin->get_access_token($oauth_verifier);
			*/
			//exit;
			
			# First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
				 
			# Now we retrieve a request token. It will be set as $linkedin->request_token
			$token = $this->linkedin->get_request_token();
			
			$sess = new CMSession();
						
			//$_SESSION['requestToken'] = serialize($this->linkedin->get_request_token());
			
			
			$lnrequestToken = serialize($this->linkedin->get_request_token());
			
			$lnaccount = array('requestToken'=>$lnrequestToken);
			
			
			$sess->oauth($this,$lnaccount);
			
			
			
			# With a request token in hand, we can generate an authorization URL, which we'll direct the user to
			//echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
			
			header("Location: " . $this->linkedin->get_authorize_URL($token));
			//print_r($token);
			//redirect($this->linkedin->get_authorize_URL($token));
 
 
	}
 
 
	function linkedin(){
 
		session_start();
		$this->load->library('linkedin', $this->data);
		$token = $this->linkedin->get_request_token();
 
		$_SESSION['oauth_request_token'] = $token['oauth_token'];
		$_SESSION['oauth_request_token_secret'] =   $token['oauth_token_secret'];
 
		$request_link = $this->linkedin->get_authorize_URL($token);
 
		$data['link'] = $request_link;
 
 
		header("Location: " . $request_link);
	}
 
 
	function linkedin_submit(){
	
		$this->load->library('linkedin', $this->data);
		
				
		$this->data['oauth_token'] = $_SESSION['oauth_request_token'];
		$this->data['oauth_token_secret'] = $_SESSION['oauth_request_token_secret'];	
		
		//
		//laod the library with the variables defined in the constructor
		//
		$this->load->library('linkedin', $this->data);
		//echo $_REQUEST['oauth_verifier'];
 
		if (isset($_REQUEST['oauth_verifier'])){
			$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

			$this->linkedin->request_token    =   unserialize($_SESSION['requestToken']);
			$this->linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
			$this->linkedin->getAccessToken($_REQUEST['oauth_verifier']);

			$_SESSION['oauth_access_token'] = serialize($this->linkedin->access_token);
			header("Location: " . $config['callback_url']);
			exit;
	   }
	   else{
			$this->linkedin->request_token    =   unserialize($_SESSION['requestToken']);
			$this->linkedin->oauth_verifier   =   $_SESSION['oauth_verifier']; // ERROR: Undefined index: oauth_verifier
			$this->linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
	   }

 
		/* Request access tokens from linkedin */
		$tokens = $this->linkedin->get_access_token($_SESSION['oauth_verifier']);
		
		/*Save the access tokens.*/
		/*Normally these would be saved in a database for future use. */
		$_SESSION['oauth_access_token'] = $tokens['oauth_token'];
 
		$_SESSION['oauth_access_token_secret'] = $tokens['oauth_token_secret'];
 
 
 
		//store your user info
		//if your going to store the tokens you will need to serialise in and out of the db
		//
		// you will need to write your own models- simple storage- serialization done here in the controller
 
		$this->load->model('muser');
		$data_id = array('linked_in' => serialize($this->linkedin->token),'id' => $user_id,'oauth_secret' => $_REQUEST['oauth_verifier']);
 
		//i used this to store the link_in tokens in the db
 
		if(!$this->muser->store_id($data_id)){
 
			//error
 
		}
 
 
	}
 
	function linkedin_post(){
 
		$id = $this->input->get('id');	
 
		//
		//this is the get from db
		//
		//you will have to make your own models
		//
 
 
		$row = $this->muser->get_by_id($id);
 
		$linked_in = $row['linked_in'];
 
 
		//
		//setup the post info
		//
 
		$comment = "message";
		$title = "story title";
		$targetUrl = "http://link";
		$imgUrl = "image title";
 
		//
		//
		//load the library for linkedin with the variables defined in the constructor 
		//
 
		$this->load->library('linkedin', $this->data);
 
 
		$apiCallStatus    =   $this->linkedin->share($comment, $title, $targetUrl, $imgUrl,unserialize($linked_in));
 
	}
	function linkauth(){
				
		session_start();
		unset($_SESSION['FACEBOOK_USER']);

		set_time_limit(999); 

		require_once("OAuth.php");
		$domain = "https://api.linkedin.com/uas/oauth";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];


		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$callback = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/linkedinstuff/linkedinpost?action=getaccesstoken";

		if (!isset($_GET['action'])) {
				
				$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "POST", $domain . "/requestToken");
				$req_req->set_parameter("oauth_callback", $callback); 
				$req_req->sign_request($sig_method, $test_consumer, NULL);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
				$req_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/requestToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				curl_close($ch);

				parse_str($output, $oauth);

				# pop these in the session for now - there's probably a more secure way of doing this! We'll need them when the callback is called.

				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];

				# Redirect the user to the authentication/authorisation page. This will authorise the token in LinkedIn
				Header('Location: ' . $domain . '/authorize?oauth_token=' . $oauth['oauth_token']);

		}else {
			
				$req_token = new OAuthConsumer($_REQUEST['oauth_token'], $_SESSION['oauth_token_secret'], 1);
				$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "POST", $domain . '/accessToken');
				$acc_req->set_parameter("oauth_verifier", $_REQUEST['oauth_verifier']);  # need the verifier too!
				$acc_req->sign_request($sig_method, $test_consumer, $req_token);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
						$acc_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/accessToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				if(curl_errno($ch)){
					echo 'Curl error 1: ' . curl_error($ch);
				}
				curl_close($ch);
				parse_str($output, $oauth);


				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];
				# Now you have a session token and secret. Store these for future use. When the token fails, repeat the above process.
				//$endpoint = "http://in.linkedin.com/in/intercom"; # need a + symbol here.

				$endpoint = "http://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,distance,industry,educations,summary,specialties,network,connections,interests,positions,skills,public-profile-url)";
				
				$req_token = new OAuthConsumer($oauth['oauth_token'],$oauth['oauth_token_secret'], 1);
				//$profile_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $endpoint, array("name" => "intercom")); # but no + symbol here!
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
				$this->XMLToArrayFlat($xml, $xmlarray, '', true); 
				
				$member_id = trim($xmlarray['id']);
				echo $member_id;
				if(!empty($member_id)){
					
					#check if the linkedin member id has registered.
					//$email = getUserByLinkinID($member_id);
					
					if(!empty($email)){
					
						$mainframe = new mosMainFrame( $database, $option, '.' );
						$mainframe->autoLogin($email,0); 
					?>
					<script>
					var path = "<?php echo base_url(); ?>";
					window.opener.location.href = path;
					self.close();
					</script>
					<?
					}else{
					$_SESSION['LINKEDIN_USER'] = serialize($xmlarray);
					?>
					<script>
					window.opener.location.href="<?php echo base_url(); ?>/add-your-profile.html";
					self.close();
					</script>
					<?

					}
				}else{ 
				?>
				
				<script>
					window.opener.location.href="<?php echo base_url(); ?>/add-your-profile.html";
					self.close();
				</script>
				<noscript>
				<?
				header("location:base_url();/add-your-profile.html");
				?>
				</noscript>
				<?
				}
			
				
		
		}
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

		
	function linkedinpost(){
		session_start();
		require_once("OAuth.php");
		unset($_SESSION['FACEBOOK_USER']);

		set_time_limit(999); 

		require_once("OAuth.php");
		$domain = "https://api.linkedin.com/uas/oauth";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];


		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$callback = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/linkedinstuff/linkedinpost?action=getaccesstoken";

		if (!isset($_GET['action'])) {
				
				$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "POST", $domain . "/requestToken");
				$req_req->set_parameter("oauth_callback", $callback); 
				$req_req->sign_request($sig_method, $test_consumer, NULL);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
				$req_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/requestToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				curl_close($ch);

				parse_str($output, $oauth);

				# pop these in the session for now - there's probably a more secure way of doing this! We'll need them when the callback is called.

				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];

				# Redirect the user to the authentication/authorisation page. This will authorise the token in LinkedIn
				Header('Location: ' . $domain . '/authorize?oauth_token=' . $oauth['oauth_token']);

		}else {
		
			$req_token = new OAuthConsumer($_REQUEST['oauth_token'], $_SESSION['oauth_token_secret'], 1);
			$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "POST", $domain . '/accessToken');
			$acc_req->set_parameter("oauth_verifier", $_REQUEST['oauth_verifier']);  # need the verifier too!
			$acc_req->sign_request($sig_method, $test_consumer, $req_token);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array (
					$acc_req->to_header()
			));
			curl_setopt($ch, CURLOPT_URL, $domain . "/accessToken");
			curl_setopt($ch, CURLOPT_POST, 1);
			$output = curl_exec($ch);
			if(curl_errno($ch)){
				echo 'Curl error 1: ' . curl_error($ch);
			}
			curl_close($ch);
			parse_str($output, $oauth);


			$_SESSION['oauth_token'] = $oauth['oauth_token'];
			$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];
			# Now you have a session token and secret. Store these for future use. When the token fails, repeat the above process.
			//$endpoint = "http://in.linkedin.com/in/intercom"; # need a + symbol here.

			$endpoint = "http://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,distance,location,industry,educations,summary,specialties,interests,positions,skills,public-profile-url,picture-url)";
			
			$req_token = new OAuthConsumer($oauth['oauth_token'],$oauth['oauth_token_secret'], 1);
			//$profile_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $endpoint, array("name" => "intercom")); # but no + symbol here!
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
			//$this->XMLToArrayFlat($xml, $xmlarray, '', true); 
			$xml = $this->xml2array($output);
			
			$useraccount=$xml['person'];
			
			
			log_message("debug",  "Linkedin Signup->index: Imported basic details from Linkedin");
								
			$this->load->model('account_model');					
			$newaccount = $this->account_model->account_model();
			$newaccount->userid = $useraccount['first-name'];
			$newaccount->username  = $useraccount['first-name'];
			$newaccount->fullname  = $useraccount['first-name'].'.'.$useraccount['last-name'];
			$newaccount->firstname  = $useraccount['first-name'];
			$newaccount->lastname   = $useraccount['last-name'];
			$newaccount->email   = 'test@email.com ';
			
			
			log_message("debug",  "Linkedin Signup->index: Imported basic details from Linkedin");
			
			$this->account_model->account_model();
			$account = $this->account_model->addAccount($newaccount);
			
			$socialrec = $this->load->model('socialids_model');
						
			$socialrec->userid = $useraccount['first-name'];
			$socialrec->socnetwork = 'linkedin';			
			$socialrec->socid = $useraccount['id'];
			$socialrec->weburl = $useraccount['public-profile-url'];
			$socialrec->apiurl = 'http://api.linkedin.com';
			//$socialrec->identity = $useraccount['first-name'];
			$socialrec->identity = $useraccount['picture-url'];
			$myprefsrec = $this->socialids_model->insert($socialrec);	
			
			$member_id = trim($useraccount['id']);
			
			if(!empty($member_id)){
				
				#check if the linkedin member id has registered.
				//$email = getUserByLinkinID($member_id);
				
				if(!empty($email)){
				
					$mainframe = new mosMainFrame( $database, $option, '.' );
					$mainframe->autoLogin($email,0); 
				?>
				<script>
				var path = "<?php echo base_url(); ?>/aboutyou";
				window.opener.location.href = path;
				self.close();
				</script>
				<?
				}else{
					$LINKEDIN_USER = serialize($xmlarray);
					
					$sess = new CMSession();
					$sess->signin($this, $newaccount);						
					$data = array("loggedin", True);
				?>
				<script>
				window.opener.location.href="<?php echo base_url(); ?>linkedinstuff/lnsignup";
				self.close();
				</script>
				<?

				}
			}else{ 
			?>
			
			<script>
				window.opener.location.href="<?php echo base_url(); ?>/add-your-profile.html";
				self.close();
			</script>
			<noscript>
			<?
			header("location:<?=$mosConfig_live_site;?>/add-your-profile.html");
			?>
			</noscript>
			<?
			}
		
			exit;
		
		}
	}
	
	function linkedinimportprofile(){
		session_start();
		require_once("OAuth.php");
		unset($_SESSION['FACEBOOK_USER']);

		set_time_limit(999); 

		$domain = "https://api.linkedin.com/uas/oauth";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];


		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$callback = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/linkedinstuff/linkedinimportprofile?action=getaccesstoken";

		if (!isset($_GET['action'])) {
				
				$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "POST", $domain . "/requestToken");
				$req_req->set_parameter("oauth_callback", $callback); 
				$req_req->sign_request($sig_method, $test_consumer, NULL);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
				$req_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/requestToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				curl_close($ch);

				parse_str($output, $oauth);

				# pop these in the session for now - there's probably a more secure way of doing this! We'll need them when the callback is called.

				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];

				# Redirect the user to the authentication/authorisation page. This will authorise the token in LinkedIn
				Header('Location: ' . $domain . '/authorize?oauth_token=' . $oauth['oauth_token']);

		}else {
			
				$req_token = new OAuthConsumer($_REQUEST['oauth_token'], $_SESSION['oauth_token_secret'], 1);
				$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "POST", $domain . '/accessToken');
				$acc_req->set_parameter("oauth_verifier", $_REQUEST['oauth_verifier']);  # need the verifier too!
				$acc_req->sign_request($sig_method, $test_consumer, $req_token);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
						$acc_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/accessToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				if(curl_errno($ch)){
					echo 'Curl error 1: ' . curl_error($ch);
				}
				curl_close($ch);
				parse_str($output, $oauth);


				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];
				# Now you have a session token and secret. Store these for future use. When the token fails, repeat the above process.
				//$endpoint = "http://in.linkedin.com/in/intercom"; # need a + symbol here.

				$endpoint = "http://api.linkedin.com/v1/people/~:(id,industry,educations,summary,specialties,interests,positions,skills,public-profile-url)";
				
				$req_token = new OAuthConsumer($oauth['oauth_token'],$oauth['oauth_token_secret'], 1);
				//$profile_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $endpoint, array("name" => "intercom")); # but no + symbol here!
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
				//$this->XMLToArrayFlat($xml, $xmlarray, '', true); 
				$xml = $this->xml2array($output);
				
				$useraccount=$xml['person'];
				
				$education = array();
				$education = $useraccount['educations']['education'];
				
				log_message("debug",  "Linkedin Signup->index: Imported education details from Linkedin");
									
				$edurec->posnum = 0;					
				$edurec->userid = $this->_getCurrentUserid();
				$edurec->startdate = $education['start-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';	
				$edurec->enddate = $education['end-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';				
										
				$edurec->institution = $education['school-name'];
				$edurec->fieldofstudy = $useraccount['industry'];			
				//$edurec->activities = $useraccount['activities'];
				log_message("debug", "Education->insert: Got userid " . $edurec->userid);
				$this->education_model->deleteAll($edurec);
				$result = $this->education_model->insert($edurec);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported experience details from Linkedin");
				$experienceArr = array();
				$experienceArr = $useraccount['positions']['position'];
				$exprec = $this->experience_model->experience_model();
				
				$exprec->userid = $this->_getCurrentUserid();
				
				$this->experience_model->deleteAll($exprec);
				foreach($experienceArr as $experience){
					
					$exprec->posnum = 0;								
					$exprec->company  = $experience['company']['name'];
					$exprec->position = $experience['title'];
					if($experience['start-date']['year']==''){		
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->startdate  = $experience['start-date']['year'].'-'. $experience['start-date']['month'].'-'.date('d').':00:00:00';
					}
					if(empty($experience['end-date']) || $experience['end-date']['year']==''){	
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->enddate   = $experience['end-date']['year'].'-'. $experience['end-date']['month'].'-'.date('d').':00:00:00';										
					}
					
					$exprec->description  = (!empty($experienceArr['summary'])) ? $experienceArr['summary'] : '';	
					
					$result = $this->experience_model->insert($exprec);
				}
					
				log_message("debug", "Experience->insert: Got userid " .$exprec->userid);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported skills details from Linkedin");
				$skillsArr = array();
				$skillsArr = $useraccount['skills']['skill'];
				$skirec = $this->skills_model->skills_model();
				
				//$this->skills_model->deleteAll($skirec);
				
				foreach($skillsArr as $skill){
					$skirec->userid = $this->_getCurrentUserid();
					$skirec->posnum = 0;								
					$skirec->skillname   = (!empty($skill['skill']['name'])) ? $skill['skill']['name'] : '';
					$skirec->selfrating = 3;//default 3
					$skirec->communityrating = 3;//default 3
					$result = $this->skills_model->insert($skirec);
					log_message("debug", "Education->insert: Got userid " .$skirec->userid);
				}			
				
				$importposturl = base_url().'aboutyou/credential';
				header("location:$importposturl");				
				
			
		}
	}
	
	function importfromeditprofile(){
		session_start();
		require_once("OAuth.php");
		unset($_SESSION['FACEBOOK_USER']);

		set_time_limit(999); 

		$domain = "https://api.linkedin.com/uas/oauth";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];


		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$callback = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/linkedinstuff/importfromeditprofile?action=getaccesstoken";

		if (!isset($_GET['action'])) {
				
				$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "POST", $domain . "/requestToken");
				$req_req->set_parameter("oauth_callback", $callback); 
				$req_req->sign_request($sig_method, $test_consumer, NULL);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
				$req_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/requestToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				curl_close($ch);

				parse_str($output, $oauth);

				# pop these in the session for now - there's probably a more secure way of doing this! We'll need them when the callback is called.

				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];

				# Redirect the user to the authentication/authorisation page. This will authorise the token in LinkedIn
				Header('Location: ' . $domain . '/authorize?oauth_token=' . $oauth['oauth_token']);

		}else {
			
				$req_token = new OAuthConsumer($_REQUEST['oauth_token'], $_SESSION['oauth_token_secret'], 1);
				$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "POST", $domain . '/accessToken');
				$acc_req->set_parameter("oauth_verifier", $_REQUEST['oauth_verifier']);  # need the verifier too!
				$acc_req->sign_request($sig_method, $test_consumer, $req_token);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
						$acc_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/accessToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				if(curl_errno($ch)){
					echo 'Curl error 1: ' . curl_error($ch);
				}
				curl_close($ch);
				parse_str($output, $oauth);


				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];
				# Now you have a session token and secret. Store these for future use. When the token fails, repeat the above process.
				//$endpoint = "http://in.linkedin.com/in/intercom"; # need a + symbol here.

				$endpoint = "http://api.linkedin.com/v1/people/~:(id,industry,educations,summary,specialties,interests,positions,skills,public-profile-url)";
				
				$req_token = new OAuthConsumer($oauth['oauth_token'],$oauth['oauth_token_secret'], 1);
				//$profile_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $endpoint, array("name" => "intercom")); # but no + symbol here!
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
				//$this->XMLToArrayFlat($xml, $xmlarray, '', true); 
				$xml = $this->xml2array($output);
				
				$useraccount=$xml['person'];
				
				$education = array();
				$education = $useraccount['educations']['education'];
				
				log_message("debug",  "Linkedin Signup->index: Imported education details from Linkedin");
									
				$edurec->posnum = 0;					
				$edurec->userid = $this->_getCurrentUserid();
				$edurec->startdate = $education['start-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';	
				$edurec->enddate = $education['end-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';				
										
				$edurec->institution = $education['school-name'];
				$edurec->fieldofstudy = $useraccount['industry'];			
				//$edurec->activities = $useraccount['activities'];
				log_message("debug", "Education->insert: Got userid " . $edurec->userid);
				$this->education_model->deleteAll($edurec);
				$result = $this->education_model->insert($edurec);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported experience details from Linkedin");
				$experienceArr = array();
				$experienceArr = $useraccount['positions']['position'];
				$exprec = $this->experience_model->experience_model();
				
				$exprec->userid = $this->_getCurrentUserid();
				
				$this->experience_model->deleteAll($exprec);
				foreach($experienceArr as $experience){
					
					$exprec->posnum = 0;								
					$exprec->company  = $experience['company']['name'];
					$exprec->position = $experience['title'];
					if($experience['start-date']['year']==''){		
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->startdate  = $experience['start-date']['year'].'-'. $experience['start-date']['month'].'-'.date('d').':00:00:00';
					}
					if(empty($experience['end-date']) || $experience['end-date']['year']==''){	
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->enddate   = $experience['end-date']['year'].'-'. $experience['end-date']['month'].'-'.date('d').':00:00:00';										
					}
					
					$exprec->description  = (!empty($experienceArr['summary'])) ? $experienceArr['summary'] : '';	
					
					$result = $this->experience_model->insert($exprec);
				}
					
				log_message("debug", "Experience->insert: Got userid " .$exprec->userid);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported skills details from Linkedin");
				$skillsArr = array();
				$skillsArr = $useraccount['skills']['skill'];
				$skirec = $this->skills_model->skills_model();
				
				//$this->skills_model->deleteAll($skirec);
				
				foreach($skillsArr as $skill){
					$skirec->userid = $this->_getCurrentUserid();
					$skirec->posnum = 0;								
					$skirec->skillname   = (!empty($skill['skill']['name'])) ? $skill['skill']['name'] : '';
					$skirec->selfrating = 3;//default 3
					$skirec->communityrating = 3;//default 3
					$result = $this->skills_model->insert($skirec);
					log_message("debug", "Education->insert: Got userid " .$skirec->userid);
				}			
				
				$importposturl = base_url().'profile/editprofile';
				header("location:$importposturl");				
				
			
		}
	}
	
	function displayConnections(){
		session_start();
		require_once("OAuth.php");
		unset($_SESSION['FACEBOOK_USER']);

		set_time_limit(999); 

		$domain = "https://api.linkedin.com/uas/oauth";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1();

		$ConsumerKey = $this->config->config['appKey'];
		$SecrateKey  =  $this->config->config['appSecret'];


		$test_consumer = new OAuthConsumer($ConsumerKey, $SecrateKey, NULL);
		$callback = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/linkedinstuff/displayConnections?action=getaccesstoken";

		if (!isset($_GET['action'])) {
				
				$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "POST", $domain . "/requestToken");
				$req_req->set_parameter("oauth_callback", $callback); 
				$req_req->sign_request($sig_method, $test_consumer, NULL);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
				$req_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/requestToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				curl_close($ch);

				parse_str($output, $oauth);

				# pop these in the session for now - there's probably a more secure way of doing this! We'll need them when the callback is called.

				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];

				# Redirect the user to the authentication/authorisation page. This will authorise the token in LinkedIn
				Header('Location: ' . $domain . '/authorize?oauth_token=' . $oauth['oauth_token']);

		}else {
			
				$req_token = new OAuthConsumer($_REQUEST['oauth_token'], $_SESSION['oauth_token_secret'], 1);
				$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "POST", $domain . '/accessToken');
				$acc_req->set_parameter("oauth_verifier", $_REQUEST['oauth_verifier']);  # need the verifier too!
				$acc_req->sign_request($sig_method, $test_consumer, $req_token);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POSTFIELDS, ''); //New Line
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
						$acc_req->to_header()
				));
				curl_setopt($ch, CURLOPT_URL, $domain . "/accessToken");
				curl_setopt($ch, CURLOPT_POST, 1);
				$output = curl_exec($ch);
				if(curl_errno($ch)){
					echo 'Curl error 1: ' . curl_error($ch);
				}
				curl_close($ch);
				parse_str($output, $oauth);


				$_SESSION['oauth_token'] = $oauth['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oauth['oauth_token_secret'];
				# Now you have a session token and secret. Store these for future use. When the token fails, repeat the above process.
				//$endpoint = "http://in.linkedin.com/in/intercom"; # need a + symbol here.

				$endpoint = "https://api.linkedin.com/v1/people/~/connections";
				
				$req_token = new OAuthConsumer($oauth['oauth_token'],$oauth['oauth_token_secret'], 1);
				//$profile_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $endpoint, array("name" => "intercom")); # but no + symbol here!
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
				//$this->XMLToArrayFlat($xml, $xmlarray, '', true); 
				$xml = $this->xml2array($output);
				
				
				$useraccount=$xml['connections']['person'];
				//echo "id=".$useraccount[$i]['id'];
				
					//to store the all connection information
					for($i=0;$i<30;$i++){
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
						$results = $this->connections_model->insert($arraccount);					
					}
				exit;
				$education = array();
				$education = $useraccount['educations']['education'];
				
				log_message("debug",  "Linkedin Signup->index: Imported education details from Linkedin");
									
				$edurec->posnum = 0;					
				$edurec->userid = $this->_getCurrentUserid();
				$edurec->startdate = $education['start-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';	
				$edurec->enddate = $education['end-date']['year'].'-'.date('m').'-'.date('d').':00:00:00';				
										
				$edurec->institution = $education['school-name'];
				$edurec->fieldofstudy = $useraccount['industry'];			
				//$edurec->activities = $useraccount['activities'];
				log_message("debug", "Education->insert: Got userid " . $edurec->userid);
				$this->education_model->deleteAll($edurec);
				$result = $this->education_model->insert($edurec);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported experience details from Linkedin");
				$experienceArr = array();
				$experienceArr = $useraccount['positions']['position'];
				$exprec = $this->experience_model->experience_model();
				
				$exprec->userid = $this->_getCurrentUserid();
				
				$this->experience_model->deleteAll($exprec);
				foreach($experienceArr as $experience){
					
					$exprec->posnum = 0;								
					$exprec->company  = $experience['company']['name'];
					$exprec->position = $experience['title'];
					if($experience['start-date']['year']==''){		
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->startdate  = $experience['start-date']['year'].'-'. $experience['start-date']['month'].'-'.date('d').':00:00:00';
					}
					if(empty($experience['end-date']) || $experience['end-date']['year']==''){	
						$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';							
					}else{
						$exprec->enddate   = $experience['end-date']['year'].'-'. $experience['end-date']['month'].'-'.date('d').':00:00:00';										
					}
					
					$exprec->description  = (!empty($experienceArr['summary'])) ? $experienceArr['summary'] : '';	
					
					$result = $this->experience_model->insert($exprec);
				}
					
				log_message("debug", "Experience->insert: Got userid " .$exprec->userid);
				
				
				log_message("debug",  "Linkedin Signup->index: Imported skills details from Linkedin");
				$skillsArr = array();
				$skillsArr = $useraccount['skills']['skill'];
				$skirec = $this->skills_model->skills_model();
				
				//$this->skills_model->deleteAll($skirec);
				
				foreach($skillsArr as $skill){
					$skirec->userid = $this->_getCurrentUserid();
					$skirec->posnum = 0;								
					$skirec->skillname   = (!empty($skill['skill']['name'])) ? $skill['skill']['name'] : '';
					$skirec->selfrating = 3;//default 3
					$skirec->communityrating = 3;//default 3
					$result = $this->skills_model->insert($skirec);
					log_message("debug", "Education->insert: Got userid " .$skirec->userid);
				}			
				
						
				
			
		}
		exit;
	}
	function lnsignup(){
		log_message("debug", "CM_Controller->index: signup()");

		$this->load->view('forms/lnsignup_form');		
		//$this->load->view('includes/footer');	
	}
	function save(){
		log_message("debug", "CM_Controller->Linkedin: signup()");
		$response = new CMResponse();
		try {
			$sess = new CMSession();
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Signup->index: Got request " . $request);

			$signup = json_decode($request);
			if ($signup) {
				if (strcmp($signup->account->password, $signup->account->passconf) != 0) {
					// error mismatched passwords
					log_message("debug", "Signup->_processSignup: Password mismatched... ");
					
					throw new Exception("Mismatched Passwords");
				}
				
				log_message("debug", "Signup->_processSignup: Adding account... ");
				
				$newaccount = $this->account_model->account_model();
				$newaccount->userid = $sess->getCurrentUserid($this);
				$newaccount->fullname = $signup->account->fullname;
				$newaccount->password = $signup->account->password;
				$newaccount->email = $signup->account->email;				
				$account = $this->account_model->updateAccount($newaccount);
				
			}
			else {
				log_message("error", "Signup->index: Failed to decode request...");
				
				throw new Exception ("Failed to decode request");
			}
		} catch (Exception $e) {
			log_message("error", "Signup->index: Caught exception " . $e->getMessage());
			
			$response->setData(array("loggedin", FALSE));			
			//$response->setErrorMessage(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);

		log_message ('debug', 'Signup->index: response = ' . $json);

		print_r($json);
		return 	$json;		
	}
 }
?>