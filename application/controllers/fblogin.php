<?php

class Fblogin extends CM_Controller {
	public $user_profile;
	public $code;
	
	function Fblogin()
	{
		parent::CM_Controller();	
	}
	function index() {     
		//$this->load->view('fblogin');
	}  
	function _loadProfile($username) {
		if (! $username) {
			echo "No username specified, defaulting to test user $username <br/>";
			$username = 'test';
		}
		
		$data = array();
		$this->load->model('profile_model');
		if ($query = $this->profile_model->getProfile($username)) {
			echo "Got profile for $username";
			$data['profile'] = $query;
		}
		
		return $data;
	}
	
	function loginpost() { 		
		log_message("debug", "Fblogin->loginpost: Entered");
		session_start();
		
		log_message("debug", "Fblogin->loginpost: Session started");
		try {
			
			$response = new CMResponse();
			log_message("debug", "Fblogin->loginpost: got response");

			$facebook = array(
			  'appId'  => $this->config->config['facebook_api_key'],
			  'secret' => $this->config->config['facebook_secret_key']			  
			);
			
			log_message("debug", "Fblogin->loginpost: facebook_api_key =  " . $this->config->config['facebook_api_key'] );
			log_message("debug", "Fblogin->loginpost: facebook_secret_key =  " . $this->config->config['facebook_secret_key'] );

			//Create our Application instance
			
			$this->load->library('facebook', $facebook);		
			log_message("debug", "Fblogin->loginpost: loaded facebook library");

			// Get User ID
			$userId = $this->facebook->getUser();
			log_message("debug", "Fblogin->loginpost: got user = " . $userId);
							
			// Proceed knowing you have a logged in user who's authenticated.
			try{  
				$userId = $this->facebook->getUser();  
				$user = $this->facebook->api('/me');  
			} catch (Exception $e){
				log_message("debug",  "Facebook Signup->index: Error in connecting facebook API".$e);
			} 
			
			
			
			if (!empty($user)) {
				
				$access_token = $this->facebook->getAccessToken();
				
				$this->facebook->setAccessToken($access_token);
				
				try {					
					$user_info = $this->facebook->api('/me', 'GET');
					$sess = new CMSession();
					
					if(!empty($user_info)){
						log_message("debug",  "Facebook Signup->index: not logged in");
						$loginUrl   = $this->facebook->getLoginUrl(
							array(
								'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
							)
						);
					
					log_message("debug",  "Facebook Signup->index: Imported basic details from facebook");
					
					$this->load->model('account_model');
					$this->account_model->account_model();
						if(count($user_info)>0){
							$isExists = $this->account_model->isAccountExists($user_info['username']);
							if(count($isExists)>0){
								log_message('debug', 'Facebook Signin->index: returned from process signin');								
								$sess = new CMSession();
								
								$sess->signin($this, $isExists);									
								$data = array("loggedin", True);
								
								$accData = $this->account_model->getAccount($user_info['username']);
								
								
								if($this->education_model->getMyEducationCount($user_info['username']) === 0){
									log_message("debug",  "Facebook Signup->index: Empty Education details");
									
									header("location:../aboutyou/Credential");
								}else if($this->experience_model->getMyExperienceCount($user_info['username']) === 0){
									log_message("debug",  "Facebook Signup->index: Empty Experience details");
									
									header("location:../aboutyou/Credential");
								}else{									
									header("location:../dashboard");								
								}							
								
							}else{					
								log_message("debug",  "Facebook Signup->index: Imported basic details from facebook");
								
								$this->load->model('account_model');					
								$newaccount = $this->account_model->account_model();
								
								$newaccount->userid = $user_info['username'];
								$newaccount->fullname = $user_info['name'];
								$newaccount->firstname = $user_info['first_name'];
								$newaccount->lastname = $user_info['last_name'];
								$newaccount->password = '';
								$newaccount->email = $user_info['email'];	
								
								if ($newaccount) {
									log_message("debug",  "Facebook Signup->index: Created new account...");
									$data = array("account", $newaccount);
									$response->setData($newaccount);
								} 
									
								$account = $this->account_model->addAccount($newaccount);			
								$sess = new CMSession();
								$sess->signin($this, $account);						
								$data = array("loggedin", True);					
								$response->setData($data);
								$this->load->helper('html');
								
								log_message('debug', 'Facebook Signup ->index: Store facebook data in session...');	
							
													
								$fql = 'select pic_small from user where uid = ' . $user_info['id'];
								
								$pic_obj = $this->facebook->api(array('method' => 'fql.query','query' => $fql));
								
								log_message ('debug', 'Facebook Signup-> returns captured facebook picture');
								
								log_message('debug', 'Signin->index: prepared response');	
								
								log_message("debug", "SocialId->insert: Inserting new SocialId record... ");
				
								$socrec->posnum = 0;
								$socrec->userid = $this->_getCurrentUserid();
								$socrec->socnetwork = 'facebook';
								$socrec->socid = $user_info['id'];
								$socrec->weburl = 'http://facebook.com/'.$user_info['id'];
								$socrec->apiurl = 'http://api.facebook.com';							
								$socrec->identity = 'https://graph.facebook.com/'.$user_info['id'].'/picture';
								
								$this->socialids_model->delete($socrec);
								$result = $this->socialids_model->insert($socrec);
								log_message("debug", "Socialids->insert: Got userid " .$this->_getCurrentUserid());	
								
								
								$response->setData($data);
								//$this->load->view('forms/aboutyou_form', $data);	
								//$this->load->view('../linkedinstuff/lnsignup', $data);								
								redirect('../linkedinstuff/lnsignup');
								log_message('debug', 'Signin->index: prepared response');							
								
								log_message ('debug', 'Facebook Signup->Redirects to about you page to get the location step 2');
							}
						
						}		
					}

				} catch (FacebookApiException $e) {
					
					log_message("debug",  "Facebook Signup->index: Error in connecting facebook API".$e);
				}	
			}
			else{
			
				$loginUrl   = $this->facebook->getLoginUrl(
					array(
						'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
					)
				);	
				
				  
				//header("location:#loginUrl");			
				header("location:../");
			
				log_message("debug",  "Facebook Signup->index: Error in connecting facebook API");  
			}
			
		}
		catch (Exception $e) {
			log_message("error", "Facebook Signup->index: Caught exception " . $e->getMessage());
			
			$response->setData(array("loggedin", FALSE));			
			$response->setErrorMessage(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}	
		
		//$json = json_encode($response);
		//log_message ('debug', 'Facebook Signup->index: response = ' . $json);			
		
	}
	
	function importprofile() { 
		
		session_start();
		$this->load->helper('html');
		$siteurl=$this->config->config['base_url'];
		try {			
			$response = new CMResponse();
			log_message("debug", "CM_Controller->index: profile()");

			//$this->_checkAndLoad('profile', true);
			$facebook = array(
			  'appId'  => $this->config->config['facebook_api_key'],
			  'secret' => $this->config->config['facebook_secret_key'],
			  'fileUpload' => true, 
			  'cookie' => true		 
			);
			
			$this->load->library('facebook', $facebook);	
			
			$userId = $this->facebook->getUser();
			log_message("debug", "CM_Controller->import profile from Facebook: profile()");
			log_message("debug", "Check for User Login to Facebook");
			$user = $this->facebook->getUser();
			if ($user) {
			  $logoutUrl = $this->facebook->getLogoutUrl();
			  log_message("debug", "User Logged In to Facebook");
			} else {
				$url = $siteurl.'/fblogin/importprofile';
				$loginUrl   = $this->facebook->getLoginUrl(
					array(
						'scope' => ' ',
						'callback'   => $url
					)
					
				);
				log_message("debug", "User Not Logged In to Facebook");
				redirect($loginUrl);		
			}
			
			$access_token = $this->facebook->getAccessToken();
			
			$this->facebook->setAccessToken($access_token);
			
				$param  =   array(
					'method'     => 'users.getinfo',
					'uids'       => $userId,
					'fields'     => 'uid,username,first_name,middle_name,last_name,name,pic_small,pic_big,pic_square,education,
									pic,affiliations,profile_update_time,timezone,religion,birthday,birthday_date,sex,hometown_location,
									meeting_sex,meeting_for,relationship_status,significant_other_id,political,current_location,activities,interests,
									is_app_user,music,tv,movies,books,quotes,about_me,hs_info,education_history,work_history,notes_count,wall_count,
									status,has_added_app,online_presence,locale,proxied_email,profile_url,email_hashes,
									pic_small_with_logo,pic_big_with_logo,pic_square_with_logo,pic_with_logo,allowed_restrictions,verified,
									profile_blurb,family,website,is_blocked,contact_email,email,third_party_id,
									name_format,video_upload_limits,games,work,sports,favorite_athletes,favorite_teams,
									inspirational_people,likes_count,can_post,
									locale,timezone,pic_big_with_logo
					',
					'callback'   => ''
				);
		 
				try{
					$user_info           =   $this->facebook->api($param);
					log_message("debug",  "Signup->index: Created new account... Imported basic details");
				}
				catch(Exception $o){
					log_message("debug",  "Signup->index: Error in connecting facebook API");
					$loginUrl   = $this->facebook->getLoginUrl(
						array(
							'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,locale,timezone,pic_big_with_logo,hometown_location',
							'callback'   => $this->config->config['base_url'].'/fblogin/importprofile'
						)
					
					);					
					header("location:$loginUrl");
					
				}
			
				log_message("debug",  "Signup->index: Created new account... Imported basic details");
				
			$this->load->model('account_model');
			
			$this->account_model->account_model();
			
			if(count($user_info)>0){
				
				$activitiesArr  =   $user_info[0]['activities'];			
							
				$workInfo       =   $user_info[0]['work_history'];
				$education      =   $this->getEducationAsString($user_info[0]);
				
				//getting general profile settings
				
				$myprefsArr		=	array(				
					'avatar'   => $user_info[0]['pic_big_with_logo'],
					'locale'   => $user_info[0]['locale'],
					'timezone' => $user_info[0]['timezone']				
				);			
			
				if(!empty($education['year'])>0){
					foreach($education['year'] as $eduKey =>$edu){
						
						
						$edurec->posnum = 0;					
						$edurec->userid = $this->_getCurrentUserid();
						if($education['year'][$eduKey]==''){		
							$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							$edurec->enddate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							
						}else{	
							$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							$edurec->enddate = $education['year'][$eduKey].'-'.date('m').'-'.date('d').':00:00:00';				
						}
						
						$edurec->institution = $education['school'][$eduKey];
						$edurec->activities = $activitiesArr;
						log_message("debug", "Education->insert: Got userid " . $edurec->userid);
						$this->education_model->deleteAll($edurec);
						$result = $this->education_model->insert($edurec);
						
					}
				}
			
				if(!empty($workInfo)){
					foreach($workInfo as $workInfoKey =>$work){
						
						log_message("debug", "experience->insert: Inserting new Experience record... ");				
						
						$company 	= (!empty($work['company_name'])) ? $work['company_name'] : '';
						$position 	= (!empty($work['position'])) ? $work['position'] : '';
						$startDate	 =(!empty($work['start_date'])) ? $work['start_date'].':00:00:00' : date('Y').'-'.date('m').'-'.date('d').':00:00:00';
						$endDate	 =(!empty($work['end_date']) || isset($work['end_date'])) ? $work['end_date'].'-00:00:00:00' : date('Y').'-'.date('m').'-'.date('d').':00:00:00';
						$description =(!empty($work['description'])) ? $work['description'] : '';
						
						$exprec->userid = $this->_getCurrentUserid();
						$exprec->posnum = 0;				
						
						//$sdate=$work['start_date'].':00:00:00';						
						//$edate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';
						
						$exprecord=(object)array('userid'=>$this->_getCurrentUserid(),'company'=>$company,'position'=>$position,'startdate'=>$startDate,'enddate'=>$endDate,'description'=>$description);
						$exprecord->updated=date('Y-m-d H:i:s') ;
						
						$exprec = $exprecord;				
						
						
						log_message("debug", "Education->insert: Got userid " .$this->_getCurrentUserid());
						$this->experience_model->deleteAll($exprec);
						$result = $this->experience_model->insert($exprec);
						
					}	
				}
							
			}
		}
		catch (Exception $e) {
			log_message("error", "Facebook Signup->index: Caught exception " . $e->getMessage());
			
			$response->setData(array("loggedin", FALSE));			
			$response->setErrorMessage(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
			$json = json_encode($response);
			
			log_message ('debug', 'Signin->index: response = ' . $json);
			
			$data = array("loggedin", True);
			$response->setData($data);
			redirect("aboutyou/credential");	
			//$this->load->view('includes/template', $data);	
			//$this->_checkAndLoad('credential_view', true);
			
			
			return $json;
			
			//$this->view($userId);
		
	}
	
	function importfromeditprofile() { 
		
		session_start();
		$this->load->helper('html');
		try {			
			$response = new CMResponse();
			log_message("debug", "CM_Controller->index: profile()");

			//$this->_checkAndLoad('profile', true);
			$facebook = array(
			  'appId'  => $this->config->config['facebook_api_key'],
			  'secret' => $this->config->config['facebook_secret_key'],
			  'fileUpload' => true, 
			  'cookie' => true		 
			);
			
			$this->load->library('facebook', $facebook);	
			
			
			log_message("debug", "CM_Controller->import profile from Facebook: profile()");
			log_message("debug", "Check for User Login to Facebook");
			$userId = $this->facebook->getUser();
			if ($userId) {
			  $logoutUrl = $this->facebook->getLogoutUrl();
			  log_message("debug", "User Logged In to Facebook");
			} else {
				$loginUrl   = $this->facebook->getLoginUrl(
					array(
						'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,locale,timezone,pic_big_with_logo,hometown_location',
					)
					);
				log_message("debug", "User Not Logged In to Facebook");
			}
			
			$access_token = $this->facebook->getAccessToken();
			
			$this->facebook->setAccessToken($access_token);
			
				$param  =   array(
					'method'     => 'users.getinfo',
					'uids'       => $userId,
					'fields'     => 'uid,username,first_name,middle_name,last_name,name,pic_small,pic_big,pic_square,education,
									pic,affiliations,profile_update_time,timezone,religion,birthday,birthday_date,sex,hometown_location,
									meeting_sex,meeting_for,relationship_status,significant_other_id,political,current_location,activities,interests,
									is_app_user,music,tv,movies,books,quotes,about_me,hs_info,education_history,work_history,notes_count,wall_count,
									status,has_added_app,online_presence,locale,proxied_email,profile_url,email_hashes,
									pic_small_with_logo,pic_big_with_logo,pic_square_with_logo,pic_with_logo,allowed_restrictions,verified,
									profile_blurb,family,website,is_blocked,contact_email,email,third_party_id,
									name_format,video_upload_limits,games,work,sports,favorite_athletes,favorite_teams,
									inspirational_people,likes_count,can_post,
									locale,timezone,pic_big_with_logo
					',
					'callback'   => ''
				);
		 
				try{
					$user_info           =   $this->facebook->api($param);
					log_message("debug",  "Signup->index: Created new account... Imported basic details");
				}
				catch(Exception $o){
					log_message("debug",  "Signup->index: Error in connecting facebook API");
					
				}
			
				log_message("debug",  "Signup->index: Created new account... Imported basic details");
				
			$this->load->model('account_model');
			
			$this->account_model->account_model();
			
			if(count($user_info)>0){
				
				$activitiesArr  =   $user_info[0]['activities'];			
							
				$workInfo       =   $user_info[0]['work_history'];
				$education      =   $this->getEducationAsString($user_info[0]);
				
				//getting general profile settings
				
				$myprefsArr		=	array(				
					'avatar'   => $user_info[0]['pic_big_with_logo'],
					'locale'   => $user_info[0]['locale'],
					'timezone' => $user_info[0]['timezone']				
				);			
				
				if(count($education['year'])>0){
					foreach($education['year'] as $eduKey =>$edu){
						
						
						$edurec->posnum = 0;					
						$edurec->userid = $this->_getCurrentUserid();
						if($education['year'][$eduKey]==''){		
							$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							$edurec->enddate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							
						}else{	
							$edurec->startdate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';	
							$edurec->enddate = $education['year'][$eduKey].'-'.date('m').'-'.date('d').':00:00:00';				
						}
						
						$edurec->institution = $education['school'][$eduKey];
						$edurec->activities = $activitiesArr;
						log_message("debug", "Education->insert: Got userid " . $edurec->userid);
						$this->education_model->deleteAll($edurec);
						$result = $this->education_model->insert($edurec);
						
					}
				}
				
				if(!empty($workInfo)){
					foreach($workInfo as $workInfoKey =>$work){
						
						log_message("debug", "experience->insert: Inserting new Experience record... ");				
						
						$company 	= (!empty($work['company_name'])) ? $work['company_name'] : '';
						$position 	= (!empty($work['position'])) ? $work['position'] : '';
						$startDate	 =(!empty($work['start_date'])) ? $work['start_date'].'-'.date('d').' 00:00:00' : date('Y').'-'.date('m').'-'.date('d').' 00:00:00';
						$endDate	 =(!empty($work['end_date'])) ? $work['end_date'].'-'.date('d').' 00:00:00' : date('Y').'-'.date('m').'-'.date('d').' 00:00:00';
						
						$description =(!empty($work['description'])) ? $work['description'] : '';
						
						$exprec->userid = $this->_getCurrentUserid();
						$exprec->posnum = 0;				
						
						//$sdate=$work['start_date'].':00:00:00';						
						//$edate = date('Y').'-'.date('m').'-'.date('d').':00:00:00';
						
						$exprecord=(object)array('userid'=>$this->_getCurrentUserid(),'company'=>$company,'position'=>$position,'startdate'=>$startDate,'enddate'=>$endDate,'description'=>$description);
						$exprecord->updated=date('Y-m-d H:i:s') ;
						
						$exprec = $exprecord;				
						
						
						log_message("debug", "Education->insert: Got userid " .$this->_getCurrentUserid());
						$this->experience_model->deleteAll($exprec);
						$result = $this->experience_model->insert($exprec);
						
					}	
				}
				log_message("debug", "SocialId->insert: Inserting new SocialId record... ");
				
				$socrec->posnum = 0;
				$socrec->userid = $this->_getCurrentUserid();
				$socrec->socnetwork = 'facebook';
				$socrec->socid = $user_info[0]['uid'];
				$socrec->weburl = $user_info[0]['profile_url'];
				$socrec->apiurl = 'http://api.facebook.com';							
				$socrec->identity = $this->_getCurrentUserid();
				$this->socialids_model->delete($socrec);
				$result = $this->socialids_model->insert($socrec);
				log_message("debug", "Socialids->insert: Got userid " .$this->_getCurrentUserid());				
			}
		}
		catch (Exception $e) {
			log_message("error", "Facebook Signup->index: Caught exception " . $e->getMessage());
			
			$response->setData(array("loggedin", FALSE));			
			$response->setErrorMessage(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
			$json = json_encode($response);
			
			log_message ('debug', 'Signin->index: response = ' . $json);
			
			$data = array("loggedin", True);
			$response->setData($data);			
			redirect("profile/editprofile");
			return 	$json;		
	}
	
    function getEducationAsString($user_info){
       
        if (empty($user_info['education'])) return '';
 
        foreach($user_info['education'] as $item){   
           
            $info['year'][] = (isset($item['year']['name'])   ? $item['year']['name']   : '');
			$info['school'][] = (isset($item['school']['name']) ? $item['school']['name'] : '' );						
        }
        return $info;
    }
}
