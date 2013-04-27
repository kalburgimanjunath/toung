<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMResponse {

	public $data = '';
	public $error = '';
	
	function CMResponse()
	{
	}
	
	function setError($code) {
		$this->error->code = $code;
		$this->error->message = CMErrors::getMessage($code);
	}
	
	function setErrorMessage($code, $message) {
		$this->error->code = $code;
		$this->error->message = $message;
	}
	
	function setData ( $data ) {
		$this->data = $data;
	}
}

?>