<?php

class Settings extends CM_Controller {

	function Settings()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data['main_content'] = 'settings_view';
		$this->_checkAndLoad('includes/authheader', false);
		$this->load->view('includes/template', $data);		
	}
}

/* End of file welcome.php */

