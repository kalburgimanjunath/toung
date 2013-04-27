<?php
class Index extends CM_Controller {
	public function _remap($username = null) {
		$this->load->view('profile');
	}
}
?>