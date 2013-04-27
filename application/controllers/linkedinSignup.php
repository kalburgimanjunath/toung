<?php
session_start();		

define('DEMO_GROUP', '4010474');
define('DEMO_GROUP_NAME', 'Simple LI Demo');
define('PORT_HTTP', '80');
define('PORT_HTTP_SSL', '443');

class LinkedinSignup extends Controller {
	//define variable for linkedin config data
	
    //this can be done in config.php as well
    
	public $linkedinData = array(
		'consumer_key'  => 'hayxhh4ckhtv',
		'consumer_secret' => 'OmvveMqt41XUNKjr',
		'callback_url' => 'http://localhost/trunk/lnpost'
	);
	
	
	public function index()
	{	
		log_message("debug",  "Linkedin Signup->index: Imported basic details from linkedin");
		
		log_message("debug",  "Linkedin Signup->index: Load library");
		
		
		$this->load->library('linkedin', $this->linkedinData);
		// set index
		$request_token_response = $this->linkedin->getRequestToken('https://api.linkedin.com/uas/oauth/requestToken');
 
		$_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
		
		switch($_REQUEST[LINKEDIN::_GET_TYPE]) {		  
		case 'initiate':
		
		log_message("debug",  "Linkedin Signup->index: Initial call");
		log_message("debug",  "Linkedin Signup->index: Handle user initiated LinkedIn connection, create the LinkedIn object");
		
      // check for the correct http protocol (i.e. is this script being served via http or https)
      if($_SERVER['HTTPS'] == 'on') {	  
        $protocol = 'https';
		log_message("debug",  "Linkedin Signup->index: Https on");
      } else {
        $protocol = 'http';
		log_message("debug",  "Linkedin Signup->index: Https off");
      }
      
      // set the callback url
      $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
      //
	  //$OBJ_linkedin = $this->load->library('linkedin', $API_CONFIG);
	  $OBJ_linkedin = new LinkedIn($API_CONFIG);
      
      // check for response from LinkedIn
      $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
      if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
        // LinkedIn hasn't sent us a response, the user is initiating the connection
        
        // send a request for a LinkedIn access token
        $response = $OBJ_linkedin->retrieveTokenRequest();
        if($response['success'] === TRUE) {
          // store the request token
          $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
          
          // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
          header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
        } else {
          // bad token request
          echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      } else {
        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
        $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
        if($response['success'] === TRUE) {
          // the request went through without an error, gather user's 'access' tokens
          $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
          
          // set the user as authorized for future quick reference
          $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
            
          // redirect the user back to the demo page
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // bad token access
          echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      }
      break;

    case 'revoke':
	
      /**
       * Handle authorization revocation.
       */
                    
      // check the session
      if(!oauth_session_exists()) {
        throw new LinkedInException('This script requires session support, which doesn\'t appear to be working correctly.');
      }
      
      $OBJ_linkedin = $this->load->library('linkedin', $API_CONFIG);
      $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
      $response = $OBJ_linkedin->revoke();
      if($response['success'] === TRUE) {
        // revocation successful, clear session
        session_unset();
        $_SESSION = array();
        if(session_destroy()) {
          // session destroyed
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // session not destroyed
          echo "Error clearing user's session";
        }
      } else {
        // revocation failed
        echo "Error revoking user's token:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
      }
      break;
    default:
	if($_SERVER['HTTPS'] == 'on') {	  
        $protocol = 'https';
		log_message("debug",  "Linkedin Signup->index: Https on");
      } else {
        $protocol = 'http';
		log_message("debug",  "Linkedin Signup->index: Https off");
      }
      
      // set the callback url
      $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
      //
	  //$OBJ_linkedin = $this->load->library('linkedin', $API_CONFIG);
	  $OBJ_linkedin = new LinkedIn($API_CONFIG);
      
      // check for response from LinkedIn
      $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
      if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
        // LinkedIn hasn't sent us a response, the user is initiating the connection
        
        // send a request for a LinkedIn access token
        $response = $OBJ_linkedin->retrieveTokenRequest();
        if($response['success'] === TRUE) {
          // store the request token
          $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
          
          // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
          header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
        } else {
          // bad token request
          echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      } else {
        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
        $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
        if($response['success'] === TRUE) {
          // the request went through without an error, gather user's 'access' tokens
          $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
          
          // set the user as authorized for future quick reference
          $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
            
          // redirect the user back to the demo page
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // bad token access
          echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      }
      // nothing being passed back, display demo page
      echo "default";
      // check PHP version
      if(version_compare(PHP_VERSION, '5.0.0', '<')) {	
        throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.'); 
      } 
      
      // check for cURL
      if(extension_loaded('curl')) {
        $curl_version = curl_version();
        $curl_version = $curl_version['version'];
      } else {
        throw new LinkedInException('You must load the cURL extension to use this library.'); 
      }
      ?>
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <title>Simple-LinkedIn Demo</title>
          
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width" />
          <meta name="description" content="A demonstration page for the Simple-LinkedIn PHP class." />
          <meta name="keywords" content="simple-linkedin,php,linkedin,api,class,library" />
          
          <style>
            body {font-family: Courier, monospace; font-size: 0.8em;}
            footer {margin-top: 2em; text-align: center;}
            pre {font-family: Courier, monospace; font-size: 0.8em;}
          </style>
        </head>
        <body>
          <h1><a href="<?php echo $_SERVER['PHP_SELF'];?>">Simple-LinkedIn Demo</a></h1>
          
          <p>Copyright 2010 - 2011, Paul Mennega, fiftyMission Inc. &lt;paul@fiftymission.net&gt;</p>
          
          <p>Released under the MIT License - http://www.opensource.org/licenses/mit-license.php</p>
          
          <p>Full source code for both the Simple-LinkedIn class and this demo script can be found at:</p>
          
          <ul>
            <li><a href="http://code.google.com/p/simple-linkedinphp/">http://code.google.com/p/simple-linkedinphp/</a></li>
          </ul>          

          <hr />
          
          <p style="font-weight: bold;">Demo using: Simple-LinkedIn v<?php echo LINKEDIN::_VERSION;?>, cURL v<?php echo $curl_version;?>, PHP v<?php echo phpversion();?></p>
          
          <ul>
            <li>Please note: The Simple-LinkedIn class requires PHP 5+</li>
          </ul>
          
          <hr />
          
          <?php
		  print_r($_SESSION['oauth']['linkedin']);
          $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
            $OBJ_linkedin = new LinkedIn($this->linkedinData);
            $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
          	$OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
            ?>
            <ul>
              <li><a href="#manage">Manage LinkedIn Authorization</a></li>
              <li><a href="#application">Application Information</a></li>
              <li><a href="#profile">Your Profile</a></li>
              <li><a href="demo/network.php">Your Network</a>
                <ul>
                  <li><a href="demo/network.php#networkStats">Stats</a></li>
                  <li><a href="demo/network.php#networkConnections">Your Connections</a></li>
                  <li><a href="demo/network.php#networkInvite">Invite Others to Join your LinkedIn Network</a></li>
                  <li><a href="demo/network.php#networkUpdates">Recent Connection Updates</a></li>
              	  <li><a href="demo/network.php#peopleSearch">People Search</a></li>
                </ul>
              </li>
              <li><a href="demo/company.php">Company API</a>
                <ul>
                  <li><a href="demo/company.php#companySpecific">Specific Company</a></li>
                  <li><a href="demo/company.php#companyFollowed">Followed Companies</a></li>
                  <li><a href="demo/company.php#companySuggested">Suggested Companies</a></li>
                  <li><a href="demo/company.php#companySearch">Company Search</a></li>
                </ul>
              </li>
              <li><a href="demo/jobs.php">Jobs API</a>
                <ul>
                  <li><a href="demo/jobs.php#jobsBookmarked">Bookmarked Jobs</a></li>
                  <li><a href="demo/jobs.php#jobsSuggested">Suggested Jobs</a></li>
                  <li><a href="demo/jobs.php#jobsSearch">Jobs Search</a></li>
                </ul>
              </li>
              <li><a href="demo/content.php">Creating / Sharing Content</a>
                <ul>
                  <li><a href="demo/content.php#contentUpdate">Post Network Update</a></li>
                  <li><a href="demo/content.php#contentShare">Post Share</a></li>
                </ul>
              </li>
              <?php
            	
            	// check if the viewer is a member of the test group
            	$response = $OBJ_linkedin->group(DEMO_GROUP, ':(relation-to-viewer:(membership-state))');
              if($response['success'] === TRUE) {
          		  $result         = new SimpleXMLElement($response['linkedin']);
          		  $membership     = $result->{'relation-to-viewer'}->{'membership-state'}->code;
          		  $in_demo_group  = (($membership == 'non-member') || ($membership == 'blocked')) ? FALSE : TRUE;
	              ?>
	            	<li><a href="demo/groups.php">Groups API</a>
	                <ul>
	                  <li><a href="demo/groups.php#groupsSuggested">Suggested Groups</a></li>
	                  <li><a href="demo/groups.php#groupMemberships">Group Memberships</a></li>
	                  <li><a href="demo/groups.php#manageGroup">Manage '<?php echo DEMO_GROUP_NAME;?>' Group Membership</a></li>
	                  <?php 
	                  if($in_demo_group) {
	                    ?>
		                  <li><a href="demo/groups.php#groupSettings">Group Settings</a></li>
		                  <li><a href="demo/groups.php#groupPosts">Group Posts</a></li>
		                  <li><a href="demo/groups.php#createPost">Create a Group Post</a></li>
			                <?php 
		                }
		                ?>
		              </ul>
		            </li>
		            <?php 
			  		  } else {
			  		    // request failed
          			echo "Error retrieving group membership information: <br /><br />RESPONSE:<br /><br /><pre>" . print_r ($response, TRUE) . "</pre>";
			  		  }
		          ?>
            </ul>
            <?php
          } else {
            ?>
            <ul>
              <li><a href="#manage">Manage LinkedIn Authorization</a></li>
            </ul>
            <?php
          }
          ?>
          
          <hr />
          
          <h2 id="manage">Manage LinkedIn Authorization:</h2>
          <?php
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
            // user is already connected
            ?>
            <form id="linkedin_revoke_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
              <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="revoke" />
              <input type="submit" value="Revoke Authorization" />
            </form>
            
            <hr />
          
            <h2 id="application">Application Information:</h2>
            
            <ul>
              <li>Application Key: 
                <ul>
                  <li><?php echo $OBJ_linkedin->getApplicationKey();?></li>
                </ul>
              </li>
            </ul>
            
            <hr />
            
            <h2 id="profile">Your Profile:</h2>
            
            <?php
            $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
            if($response['success'] === TRUE) {
              $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
              echo "<pre>" . print_r($response['linkedin'], TRUE) . "</pre>";
            } else {
              // request failed
              echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
            } 
          } else {
            // user isn't connected
            ?>
            <form id="linkedin_connect_form" action="<?php echo base_url();?>/linkedinSignup" method="get">
              <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
              <input type="submit" value="Connect to LinkedIn" />
            </form>
            <?php
          }
          ?>
          <footer>
            <div>Copyright 2010 - 2011, fiftyMission Inc. (Paul Mennega &lt;<a href="mailto:paul@fiftymission.net">paul@fiftymission.net</a>&gt;)</div>
            <div>Released under the MIT License - <a href="http://www.opensource.org/licenses/mit-license.php">http://www.opensource.org/licenses/mit-license.php</a></div>
          </footer>
        </body>
      </html>
      <?php
      break;
	}
	}
	function Linkedin() {
			
            parent::Controller();
			$this->load->library('linkedin', $this->linkedinData);
			echo "<pre>";
			$token = $this->linkedin->get_request_token();			 
			$request_link = $this->linkedin->get_authorize_URL($token);	 
			$this->linkedin->getProfile($token);
			
           // $this->load->model('User_model', 'users');
    }
	function post(){
		
		$response = new CMResponse();
		$json = json_encode($response);
		return 	$json;	
	}
}
?>