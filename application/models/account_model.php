<?php
class Account_model extends Model {
    var $userid;
    var $fullname;
    var $firstname;
    var $lastname;
    var $password;
    var $email;
    var $phone;
    var $mobile;
    var $status;
    var $started;
    var $suspended;
    var $usertype;
    var $company;
    var $streetaddress1;
    var $streetaddress2;
    var $city;
    var $state;
    var $postalcode;
    var $country;
	var $communityid;
    var $aboutme;
    var $updated;
    var $headline;
    
	function account_model() {
		parent::Model();
	}
	
	function getAboutMe($p_userid) {
		$acct = $this->getAccount($p_userid);
		return $acct->aboutme;
	}
	
	function setAboutMe($p_userid, $p_aboutme) {
		if (($p_userid == null) || ($p_userid == ''))
			return false;
		
		$data = array('aboutme' => $p_aboutme);
		
		$this->db->where('userid', $p_userid);
		$this->db->update('account', $data); 
		
		return true;
	}
	
	function setHeadline($p_userid, $p_headline) {
		if (($p_userid == null) || ($p_userid == ''))
			return false;
			
		$data = array('headline' => $p_headline);
		
		$this->db->where('userid', $p_userid);
		$this->db->update('account', $data); 
		
		return true;
	}
	
	function getAccount($p_userid) {
		log_message("debug",  "Account_model->getAccount: Searching for user $p_userid<br/>");
		
		$query = $this->db->get_where('account', array('userid' => $p_userid));
		
		if ($query->num_rows() > 0)
		{
			log_message("debug",  "Account_model->getAccount: Found Account for $p_userid<br/>");
			$row = $query->row(); 
			return $row;
		}
	}
	
	function getAccountForEmail($p_email) {
		$query = $this->db->get_where('account', array('email' => $p_email));
		
		if ($query->num_rows() > 0)
		{
			log_message("debug",  "Account_model->getAccountForEmail: Found Account for $p_email<br/>");
			$row = $query->row(); 
			return $row;
		}
		
	}
	
	function getAccountForEmailOrUserid($p_email, $p_userid) {

		log_message("debug",  "Account_model->getAccountForEmailOrUserid: Email = " . $p_email . " User Id = " . $p_userid);
		
		$this->db->where('email = ', $p_email);
		$this->db->or_where('userid = ', $p_userid); 
		$query = $this->db->get('account');
		
		if ($query->num_rows() > 0)
		{
			log_message("debug", "Account_model->getAccountForEmailOrUserid: Found Account for $p_email or $p_userid");
			$row = $query->row(); 
			//print_r($row);
			return $row;
		}
		log_message("debug",  "Account_model->getAccountForEmailOrUserid: No match found");
	}
	
	function getAllAccounts() {
		$query = $this->db->get('account');
		return $query->result();
	}
	
	function getAccounts($startRow, $numItems) {

		if (!isset($startRow)) {
			$startRow = 0;
		}
		if (!isset($numItems)) {
			$numItems = 0;
		}

		$query = $this->db->get('account', $startRow, $numItems);
		return $query->result();
	}
		
	function updateAccount( $account_data ) {
	
		$account_array = (array) $account_data;
	    log_message("debug",  "Account_model->updateAccount: Updating profile for " . $account_array["userid"]);
	    
	    $this->db->where('userid', $account_data->userid);
	    $this->db->update ('account', $account_data);
	    
	    return true;
	}
	
	function addAccount ( $account_data ) {
		log_message("debug",  "Account_model->addAccount: In Add Account...");
		//print_r ($account_data);
		
		log_message("debug",  "Account_model->addAccount: Adding account for " . $account_data->userid);
		log_message("debug",  "Account_model->addAccount: Adding account for " . $account_data->email);

		$account_data->username = $account_data->userid;
				
		$valid = $this->validateSignup($account_data->email, $account_data->userid);
				
		log_message("error",  "Valid " . $valid);
		
		if ( $valid == true ) {
			log_message("debug",  "Account_model->addAccount: Ready to insert Account");
			
			$this->db->insert ('account', $account_data);
			log_message("debug",  "Account_model->addAccount: Created account, getting record for " . $account_data->userid);
			
			$newaccount = $this->getAccount($account_data->userid);
			
			log_message("debug", "Account_model->addAccount: Got the newly created account for " . $newaccount->userid);
			return $newaccount;
		}	
		
	}
	
	function deleteAccount ( $userid ) {
		$this->db->where('userid', $userid);
		$this->db->delete('account');
		
	}

    function suspendAccount ($userid ) {
		$this->db->where ('userid', $userid);
		$data = array (
			
		);

		$this->db->update('account', data);
 	}
 	
 	function validateSignup($email, $userid) {
 		 		 		
 		log_message("debug",  "Account_model->validateSignup: Validating account for username= " . $userid . " email = " . $email);
 		
 		$account = $this->getAccountForEmailOrUserid( $email , $userid);
 		
 		//print_r ($account);
 		
 		if ($account) {
			log_message( "debug", "Account_model->validateSignup: Found account for email or userid");
 			
	 		if (strcmp($account->email, $email) == 0) {
 				log_message("debug", "Account_model->validateSignup: An account with this email is already registered");
 				throw new Exception ("An account with this email is already registered");
 			}
 			
 			if (strcmp($account->userid, $userid) == 0) {
 				log_message ("debug", "Account_model->validateSignup: An account with this username is already registered");
 				throw new Exception ("An account with this username is already registered");
 			}
 		}
 		
 		return true; // no account exists, signup is ok
 		
 	}
	
	function isAccountExists($p_userid) {

		log_message("debug",  "Account_model->isAccountExists: User Id = " . $p_userid);
		
		$this->db->where('username = ', $p_userid);
		
		$query = $this->db->get('account');
		
		if ($query->num_rows() > 0)
		{
			log_message("debug", "Account_model->isAccountExists: Found Account for $p_userid");
			$row = $query->row(); 
			return $row;
		}
		log_message("debug",  "Account_model->isAccountExists: No match found");
	}
	
	function search_account($username) {		
		
		$sql = "SELECT * FROM account WHERE username = ?";
		
		// Execute it, replacing the ? with the last name from the form
		$query = $this->db->query($sql, array($username));
		$data = $query->result();
		// Show results		
		return $data;
	}
	
	
	function isExistsCummunity($p_userid) {    

		log_message("debug",  "Account_model->isCommunityExists: User Id = " . $p_userid);
		
		$this->db->where('username = ', $p_userid);
		
		$query = $this->db->get('account');
	
		
		if ($query->num_rows() > 0)
		{
			log_message("debug", "Account_model->isAccountExists: Found Account for $p_userid");
			$row = $query->row(); 
			return $row;
		}
		else{
			log_message("debug",  "Account_model->isAccountExists: No match found");
			return false;
		}
		
	}
	
	function setCommunity($p_userid, $p_communityid) {
		if (($p_userid == null) || ($p_userid == ''))
			return false;
			
		$data = array('communityid' => $p_communityid);
		
		$this->db->where('userid', $p_userid);
		$this->db->update('account', $data); 
		
		return true;
	}

}
