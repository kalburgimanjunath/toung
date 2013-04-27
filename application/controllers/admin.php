<?php
class Admin extends Controller {
	public $data;
	function Admin()
	{
		parent::Controller();	
	}
	
	function index()
	{		
		$this->load->view('admin/sitemap');
	}
	
	function account()
	{				
		$this->load->model("account_model");
		$data=$this->account_model->getAllAccounts();
		$this->data=$data;
		if (count($data) < 1) {
			echo 'No results found. Please try your search again, or try <a href="another-search">another search</a>.';
		}else {
			$this->load->view('admin/widgets/listaccount',$data);	
		}
	}
	function viewAccount($userId)
	{	
		$this->load->model("account_model");
		$userId=$this->uri->segment(4);
		log_message("debug", "CM_Controller->index: signup()".$userId);
		$data=$this->account_model->getAccount($userId);	
		$this->data=$data;
		$this->load->view('admin/viewAccount',$data);	
		
	}
	function signin() {
		log_message("debug", "CM_Controller->index: signin()");
		$this->load->view('admin/forms/signin_form');	
		$this->load->view('admin/includes/footer');		
	
	}
	function signup() {
		log_message("debug", "CM_Controller->index: signup()");

		$this->load->view('admin/forms/register_form');		
		$this->load->view('admin/includes/footer');		
	}
	function messageInbox() {
		$this->load->view('admin/messageInbox');
	}
}

?>