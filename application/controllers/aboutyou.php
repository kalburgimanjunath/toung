<?php
 
class Aboutyou extends CM_Controller {
	
	
	function Aboutyou()
	{
		parent::CM_Controller();	
		$this->load->helper(array('form','url','file','html'));
	}
	
	function index() {	 
	
		log_message("debug", "About You ->loginpost: Session started");		
		if ($this->_checkAuth() == false) {
			return;
		}
		$sess = new CMSession();
		$username = $sess->getCurrentUserid($this);	
		
		$abtrec = $this->socialids_model->socialids_model();
		$socialmediaurl = $this->socialids_model->getMySocialIds($username);
		if(count($socialmediaurl)>0){
			$data['social'] = $socialmediaurl[0]->identity;
		}
	
		$data['alert'] = 1;		
		
		$this->load->view('forms/aboutyou_form',$data);
		
	}
	
	function credential() {
		session_start();
		if ($this->_checkAuth() == false) {
			return;
		}
		$response = new CMResponse();
		log_message("debug", "CM_Controller->index: profile()");
		
		$sess = new CMSession();
		$username = $sess->getCurrentUserid($this);		
		$data = array('alert' => 1);	
		$this->load->view('forms/credential_view',$data);	
		
	}
	function save() {    
		try {
			log_message("debug", "aboutyou->save: Saving About you  records... ");
			
			if ($this->_checkAuth() == false) {
				return;
			}
						
			$response = new CMResponse();
			
			$userId = $this->_getCurrentUserid();
			
			// decode the JSON request
			$request = $this->input->post ('request') ;
			
			log_message("debug", "aboutyou->save: Got request " . $request);
		
			$abtrecord = json_decode($request);			
			
			$abtrec = $this->account_model->account_model();
			$abtrec->userid = $userId;
			
			$arrLocation = explode(',',$abtrecord->account->location);		
			
			$abtrec->streetaddress1 =$arrLocation[0];
			$abtrec->state =$arrLocation[1];
			$abtrec->postalcode =$arrLocation[2];
			$abtrec->city =$arrLocation[3];
			$abtrec->aboutme =$abtrecord->account->bio;
			$abtrec->headline =$abtrecord->account->headline;
			
			$result = $this->account_model->updateAccount($abtrec);	
			
			$myprefsrec = $this->load->model('myprefs_model');
			$imageUpload->userid = $userId;
			//$imageUpload->avatar = $abtrecord->account->userfile;
			
			$myprefsrec = $this->myprefs_model->insert($imageUpload);
			
			
			log_message("debug", "About You->save Tags: Got request " . $request);
			
			$config1['allowed_types'] = 'jpeg';
			$config1['max_size']	= '10002647';
			$config1['max_width']  = '*';
			$config1['max_height']  = '*';
			
			$this->load->library('upload', $config1);
			
			log_message("debug", "About You->upload " . $abtrecord->account->userfile);
			
			$this->upload->set_allowed_types('jpg|jpeg|gif|png'); 			
		
		
			if (!empty($_FILES['userfile']['name']))
			{
				log_message ('debug', 'About You->do_upload: File selected');
				
				
				if(!file_exists('uploads/profile_photo/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					mkdir('uploads/profile_photo/' . $this->_getCurrentUserid(), 0777);
				}
				
				$config1['upload_path'] = 'uploads/profile_photo/'. $this->_getCurrentUserid();
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';
					 
				$config1['file_name'] = 'profile';
				
				
				$this->upload->initialize($config1);
				
				log_message ('debug', 'About You-> File upload started'.$config1);
				log_message ('debug', 'About You->picture = '.$this->upload->file_name);
				
				if(!file_exists('uploads/profile_photo/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					if ($this->upload->do_upload('userfile'))
					{				
						
						$data = $this->upload->data();				
						
						log_message("debug", "aboutyou->do_upload save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myprefs_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->avatar = $this->upload->file_name;				
							
						$result = $this->myprefs_model->updateMyprefs($mypref);		
						$response->setData($result);
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "aboutyou->save: Got error in saving image" . $error);
						print_r($error);
						exit;
					}
				}else{
					delete_files('uploads/profile_photo/'. $this->_getCurrentUserid());
					
					if ($this->upload->do_upload('userfile'))
					{				
						$data = $this->upload->data();				
						
						log_message("debug", "aboutyou->save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myprefs_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->avatar = $this->upload->file_name;				
											
						$result = $this->myprefs_model->updateMyprefs($mypref);				
						
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "aboutyou->save: Got error in saving image" . $error);
					}
				}					
			}			
			
			$this->load->model('tags_model');
			
			$tagsrec = $this->tags_model->tags_model();
			$tagsrec->tag = $abtrecord->account->tags;
			$tagsrec->tagtype = 'user';
			
			$tagsrec->taggeditemid = $userId;
			$result = $this->tags_model->insert($tagsrec);
			
			$response->setData($result);
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		$json = json_encode($response);

		log_message ('debug', 'About You->index: response = ' . $json);

		print_r($json);
		return 	$json;	
	}
	
	
	function do_upload()
	{	
		try {
			
			$response = new CMResponse();		
		
			$request = $this->input->post ('request') ;
		
			$accountrec = json_decode($request);
				
			$config1['allowed_types'] = 'jpeg';
			$config1['max_size']	= '10002647';
			$config1['max_width']  = '*';
			$config1['max_height']  = '*';
			
			$this->load->library('upload', $config1);
			
			log_message ('debug', 'About You->do_upload: Upload library initiated');
			
			$this->upload->set_allowed_types('jpg|jpeg|gif|png');  
			
			if (!empty($_FILES['userfile']['name']))
			{
				log_message ('debug', 'About You->do_upload: File selected');
				
				
				if(!file_exists('uploads/profile_photo/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					mkdir('uploads/profile_photo/' . $this->_getCurrentUserid(), 0777);
				}
				
				$config1['upload_path'] = 'uploads/profile_photo/'. $this->_getCurrentUserid();
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';
					 
				$config1['file_name'] = 'profile';
				
				
				$this->upload->initialize($config1);
				
				log_message ('debug', 'About You->do_upload: File upload started');
				
				if(!file_exists('uploads/profile_photo/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					log_message ('debug', 'About You->do_upload: File not empty ');
					if ($this->upload->do_upload('userfile'))
					{										
						$data = $this->upload->data();				
						
						log_message("debug", "aboutyou->do_upload save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myprefs_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->avatar = $this->upload->file_name;				
							
						$result = $this->myprefs_model->updateMyprefs($mypref);		
						$response->setData($result);
					}
					else
					{						
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "aboutyou->save: Got error in saving image" . $error);
					}
				}else{
					log_message ('debug', 'About You->do_upload: File empty ');
					
					delete_files('uploads/profile_photo/'. $this->_getCurrentUserid());
					
					if ($this->upload->do_upload('userfile'))
					{				
						$data = $this->upload->data();				
						
						log_message("debug", "aboutyou->save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myprefs_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->avatar = $this->upload->file_name;				
											
						$result = $this->myprefs_model->updateMyprefs($mypref);
					
						$response->setData($result);
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "aboutyou->save: Got error in saving image" . $error);
					}
				}		
				
			}
		}catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			log_message ('debug', 'About You->do_upload: File not selected');
			
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		$json = json_encode($response);

		log_message ('debug', 'About You->do_upload: response = ' . $json);

		//print_r($json);
		redirect("profile/editprofile");
		
	}
	
	function credentials_save()
	{
		try {
			log_message("debug", "Credential->save: Saving Credential records... ");
			
			if ($this->_checkAuth() == false) {
				return;
			}
						
			$response = new CMResponse();
			
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);

		log_message ('debug', 'Credential ->index: response = ' . $json);

		print_r($json);
		return 	$json;	
	}
	
	function services(){
			
		$response = new CMResponse();		
		log_message("debug", "CM_Controller->index: services()");	
		
		$sess = new CMSession();
		$username = $sess->getCurrentUserid($this);
		$data['userdata'] = $this->session->userdata;
		
		$response->setData($data);
		
		$data = array('alert' => 1);	
		$this->load->view('forms/services_form',$data);	
		
		$json = json_encode($response);
		return $json;
		
	}
	function finishpost(){
		//$this->load->helper('html');
		$response = new CMResponse();
		log_message("debug", "CM_Controller->index: Finish");
		
		
		try {
			log_message("debug", "Credential->save: Saving Credential records... ");
			
			if ($this->_checkAuth() == false) {
				return;
			}
						
			$response = new CMResponse();
			$request = $this->input->post ('request') ;
			
			$acctrecord = json_decode($request);
			
			$sess = new CMSession();
			$username = $sess->getCurrentUserid($this);
			
			$socialrec = $this->load->model('socialids_model');
						
			$socialrec->userid = $username;
			$socialrec->socnetwork = $acctrecord->account->socialtype;			
			$socialrec->socid = $acctrecord->account->socnetwork;
			$socialrec->weburl = $acctrecord->account->soc_name;
			$socialrec->identity = $username;
			$myprefsrec = $this->socialids_model->insert($socialrec);	
			$data = array('alert' => 1);	
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);

		log_message ('debug', 'Credential ->Finish index: response = ' . $json);
		
		print_r($json);
		return $json;
		//$data['main_content'] = 'dashboard';
		//$this->_checkAndLoad('dashboard', true);
	}
	function edit(){
		$response = new CMResponse();
		log_message("debug", "CM_Controller->index: Edit");
		
		
		try {
			log_message("debug", "About ->edit: Saving About records... ");
			
			if ($this->_checkAuth() == false) {
				return;
			}
						
			$response = new CMResponse();
			$request = $this->input->post ('request') ;
			
			$acctrecord = json_decode($request);
			
			
			log_message("debug", "About ->edit: records... ");
			
			$sess = new CMSession();
			$username = $sess->getCurrentUserid($this);
			
			$abtrec = $this->load->model('account_model');
						
			$abtrec->userid = $username;
			$arrLocation = explode(',',$acctrecord->account->location);		
			
			$abtrec->streetaddress1 =$arrLocation[0];
			$abtrec->state =$arrLocation[1];
			$abtrec->postalcode =$arrLocation[2];
			$abtrec->city =$arrLocation[3];
			
			//$abtrec->location = $acctrecord->account->location;			
			$abtrec->headline = $acctrecord->account->headline;
			$abtrec->aboutme = $acctrecord->account->bio;
			$abtrec = $this->account_model->updateAccount($abtrec);	
			
			$tagsrec = $this->load->model('tags_model');
			$tagsrec->taggeditemid = $username;
			$this->tags_model->delete($tagsrec);
			log_message ('debug', 'About ->Edit index: tags deleted');
			
			$tagsrec->tag = $acctrecord->account->tags;
			$tagsrec->tagtype = 'user';
			
			$tagsrec->taggeditemid = $username;
			$result = $this->tags_model->insert($tagsrec);
			
			
			$data['alert'] = 1;					
			
		} catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		
		$json = json_encode($response);

		log_message ('debug', 'About ->Edit index: response = ' . $json);
		
		print_r($json);
		return $json;
	}
	function uploadphoto()
	{
		$config2['upload_path'] = './uploads/';
		$config2['allowed_types'] = 'gif|jpg|png|zip|avi';
		/*$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';*/
		
		log_message ('debug', 'About ->Edit index: upload = ');
		$this->load->library('upload', $config2);

		if ( ! $this->upload->do_upload())
		{			
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo '<div id="status">success</div>';
			//then output your message (optional)
			echo '<div id="message">'. $data['upload_data']['file_name'] .' Successfully uploaded.</div>';
			//pass the data to js
			echo '<div id="upload_data">'. json_encode($data) . '</div>';
			
		}
	}
}
?>