<?php

class Portfolio extends CM_Controller {

	
	function Myportfolio()
	{
		parent::CM_Controller();	
		$this->load->helper(array('form','url','file','html'));
	}
	function index() {
	   
		$this->load->view('widgets/freelance');
	}
	function view() {
		$response = new CMResponse();	
	    $userid = $this->_getCurrentUserid();
		$response->setData($userid);
		$this->load->view('widgets/freelance_view');
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
			
			log_message ('debug', 'Myportfolio ->do_upload: Upload library initiated');
			
			$this->upload->set_allowed_types('jpg|jpeg|gif|png');  
			
			if (!empty($_FILES['userfile']['name']))
			{
				log_message ('debug', 'Myportfolio->do_upload: File selected');
				
				
				if(!file_exists('uploads/myportfolio/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					mkdir('uploads/myportfolio/' . $this->_getCurrentUserid(), 0777);
				}
				
				$config1['upload_path'] = 'uploads/myportfolio/'. $this->_getCurrentUserid();
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';
					 
				$config1['file_name'] = 'project';
				
				
				$this->upload->initialize($config1);
				
				log_message ('debug', 'Myportfolio->do_upload: File upload started');
				
				if(!file_exists('uploads/myportfolio/'. $this->_getCurrentUserid().'/'.$this->upload->file_name)){
					log_message ('debug', 'Myportfolio->do_upload: File not empty ');
					if ($this->upload->do_upload('userfile'))
					{										
						$data = $this->upload->data();				
						
						log_message("debug", "Myportfolio->do_upload save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myportfolio_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->image = $this->upload->file_name;				
							
						$result = $this->myportfolio_model->insert($mypref);		
						$response->setData($result);
					}
					else
					{						
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "aboutyou->save: Got error in saving image" . $error);
					}
				}else{
					log_message ('debug', 'About You->do_upload: File empty ');
					
					delete_files('uploads/myportfolio/'. $this->_getCurrentUserid());
					
					if ($this->upload->do_upload('userfile'))
					{				
						$data = $this->upload->data();				
						
						log_message("debug", "myportfolio->save: Got request image saved successfully" . $request);
						
						$mypref = $this->load->model('myportfolio_model');
						
						$mypref->userid = $this->_getCurrentUserid();
						$mypref->image = $this->upload->file_name;				
											
						$result = $this->myportfolio_model->insert($mypref);
					
						$response->setData($result);
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
						log_message("debug", "myportfolio->save: Got error in saving image" . $error);
					}
				}		
				
			}
		}catch (Exception $e) {
			//echo "Caught exception " . $e->getMessage();
			log_message ('debug', 'myportfolio->do_upload: File not selected');
			
			$response->setData(array("success", false));
			$response->setError(CMErrors::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
		}
		$json = json_encode($response);

		log_message ('debug', 'About You->do_upload: response = ' . $json);

		//print_r($json);
		redirect("dashboard#freelance");
		
	}
}