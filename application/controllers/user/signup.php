<?php

class Signup extends CM_Controller {

	function Signup()
	{
		parent::Controller();	
	}
	
	function index() {
	
		$response = new CMResponse();
		try {
		
			// decode the JSON request
			$request = $this->input->post ('request') ;
			log_message("debug", "Signup->index: Got request " . $request);

			$signup = json_decode($request);			

			if ($signup) {
				log_message("debug",  "Signup->index: Verifying account signup...");
				
				$newaccount = $this->_processSignup($signup);
			
				log_message("debug",  "Signup->index: Created new account...");

				if ($newaccount) {
					log_message("debug",  "Signup->index: Created new account...");
					//$data = array("account", $newaccount);
					
					$response->setData($newaccount);
				} 
				log_message("debug",  "Signup->index: Created new account...");
				
				
				$message = "User Account Created Successfully ";
				$message .="<br/>Thank you very much";
				
						
				
				//echo $this->email->message($message);
				log_message('debug','Validate->existsEmail: Message sent:'.$message);
				
				$this->load->model('message_model');
			
			
				$newmessage = $this->message_model->message_model();
				
				$newmessage->sender_id =$newaccount->userid;
				$newmessage->subject = 'Welcome to Credmine';
				$newmessage->message = $message;
				$newmessage->message_date=date('Y-m-d H:i:s') ;
				$newmessage->sender_status = 1;
				$newmessage->label_id = 1;
				$newmessage->thread_id = 0;
				log_message('debug', 'Message -> saved');
				$message = $this->message_model->addMessage($newmessage);
				log_message("error", "Signup->index: Failed to decode request...");
				/*	
				$this->load->library('email');
				$this->email->from($this->config->config['email_from']);
				$this->email->to($signup->account->email);
				$this->email->subject('Email my');		
				
				if($this->email->send())
				{
					log_message('debug','Email sent to reset password');
				} else {
					log_message('debug','Error in sending email');
				}*/
				
			} else {
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
	
	function _processSignup($signup) {
		// check if passwords match
		if (strcmp($signup->account->password, $signup->account->passconf) != 0) {
			// error mismatched passwords
			log_message("debug", "Signup->_processSignup: Password mismatched... ");
			
			throw new Exception("Mismatched Passwords");
		}
		
		log_message("debug", "Signup->_processSignup: Adding account... ");
		
		$newaccount = $this->account_model->account_model();
		$newaccount->userid = $signup->account->userid;
		$newaccount->fullname = $signup->account->fullname;
		$newaccount->password = $signup->account->password;
		$newaccount->email = $signup->account->email;
		
		//print_r ($newaccount);
		
		$account = $this->account_model->addAccount($newaccount);
		log_message("debug", "Signup->saves user session... ");
		$sess = new CMSession();
		$sess->signin($this, $newaccount);	
		
		return $account;
	}
	
}
