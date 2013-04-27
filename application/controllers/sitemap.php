<?php
class Sitemap extends Controller {
	function Sitemap()
	{
		parent::Controller();	
	}
	
	function index() 
	{	
		$this->load->view('sitemap');
	}
}
?>