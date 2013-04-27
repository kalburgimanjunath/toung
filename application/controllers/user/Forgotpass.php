<?php

class Forgotpass extends CM_Controller {

	function Forgotpass()
	{
		parent::Controller();	
	}
	
	function post()
	{			
		$response = new CMResponse();
			
			$request = $this->input->post ('request') ;
			
			
			log_message('debug', "Validate->existsEmail: Got request " . $request);

			$validate = json_decode($request);
		
			log_message('debug', 'Validate->existsEmail: json decode done ');						
			
			$this->load->model('account_model');
			if ($validate) {	
			
				log_message('debug', 'Validate->existsEmail: check if exists username ' . $validate->account->email);
		
				// check if userid already exists		
				$account = $this->account_model->getAccountForEmail($validate->account->email);
				$userId=$account->userid;
				if ($account) {
					// account exists
					$response->setData(true);
					$this->load->library('email');	
					
									
					$this->email->from($this->config->config['email_from']);
					$this->email->to($validate->account->email);
					$this->email->subject('Email my');
					$this->load->helper('string');
					$key = random_string('alnum', 16);
					$message = "Please click this url to change your password ". base_url()."reset_password/".$key ;
					$message .="<br/>Thank you very much";
					
					//echo $this->email->message($message);
					log_message('debug','Validate->existsEmail: Message sent:'.$message);
					if($this->email->send())
					{
						log_message('debug','Email sent to reset password');
					} else {
						log_message('debug','Error in sending email');
					}
					
					log_message('debug', 'Validate->existsEmail: send reset password link in an email ' . $validate->account->email);
					
					
					$this->load->model('message_model');
			
			
					$newmessage = $this->message_model->message_model();
					
					$newmessage->sender_id = $userId;
					$newmessage->subject = 'Forgot Password';
					$newmessage->message = $message;
					$newmessage->message_date=date('Y-m-d H:i:s') ;
					$newmessage->sender_status = 1;
					$newmessage->label_id = 1;
					$newmessage->thread_id = 0;
					log_message('debug', 'Message -> saved');
					
						
					$message = $this->message_model->addMessage($newmessage);
					
					
				} else {
					$response->setData(false);
				}
				log_message('debug', 'Validate->existsEmail: prepared response');
			} else {
				log_message('error', 'Validate->existsEmail: failed to decode request');
				throw new Exception ("Failed to decode request");
			}	
		
		$json = json_encode($response);		
		print $json;
		return $json;
		
	}
	
}
	