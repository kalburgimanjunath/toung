<?php

class Drawing extends Controller {

	function Drawing()
	{
		parent::Controller();	
	}
	
	
	function index() {
	    echo "In index";
		$this->load->view('widgets/drawing');
	}
	
}
