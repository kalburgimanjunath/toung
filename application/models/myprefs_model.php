<?php
class Myprefs_model extends Model {
    var $userid;
    var $avatar;
    var $locale;
    var $timezone;
    var $showAvatar;
    var $showMyTweets;
    var $showContactInfo;
	var $showProfessions;
	var $showHobbies;
	var $showExperience;
	var $showPortfolio;
	var $showEducation;
	var $showReferences;
	var $showSocialIds;
	var $showSkills;
    var $updated;
    
	function Myprefs_model() {
		parent::Model();
	}
	
    function getMyprefs($p_userid) {
    
        log_message('debug', 'Myprefs_model->getMyprefs: Got current userid = ' . $p_userid);
		
        $query = $this->db->get_where('Myprefs', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }
	}
	
	function delete($prefrec) {
        log_message('debug', 'Myprefs_model->delete: Got current userid = ' . $prefrec->userid);
        $query = $this->db->delete('myprefs', array('userid' => $prefrec->userid));
        return $prefrec;
	}
	
	function save($prefmodel) {
        log_message('debug', 'Myprefs_model->save: Got userid = ' . $prefmodel->userid);        

		$this->db->where('userid', $prefmodel->userid);
		$this->db->update('myprefs', $prefmodel);
		
		$edumodel->updated = date('Y-m-d H:i:s') ;

		return $edumodel;
	}
	
	function insert($prefmodel) {
        log_message('debug', 'Myprefs_model->insert: Got current userid = ' . $prefmodel->userid);
        
        $query = $this->db->get_where('myprefs', array('userid' => $prefmodel->userid));
		$this->db->set($prefmodel);
		$this->db->insert('myprefs');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Myprefs_model->insert: last inserted = ' .   $lastinsert);     
		$prefmodel->updated = date('Y-m-d H:i:s') ;
		//$prefmodel->posnum = $lastinsert;
		//$edumodel->newrec = true;
		return $prefmodel;
		/*
		$query = $this->db->get_where('myeducation', array('userid' => $edumodel->userid, 'posnum' => $lastinsert));
				if ($query->num_rows() > 0) {
		    		return $query->result();
		        }
		*/
	}
	
	function updateMyprefs( $myPref_data ) {
	
		$myPref_array = (array) $myPref_data;
	    log_message("debug",  "Account_model->updateAccount: Updating profile for " . $myPref_array["userid"]);
	    
	    $this->db->where('userid', $myPref_array['userid']);
	    $this->db->update ('myprefs', $myPref_array);
	    
	    return true;
	}
	
	function imageUpload($prefmodel) {
        log_message('debug', 'Myprefs_model->save avatar: Got userid = ' . $prefmodel->userid);        

		$this->db->where('userid', $prefmodel->userid);
		$this->db->update('myprefs', $prefmodel);	

		return $prefmodel;
	}
	
	function getMyprefAvatar($p_userid) {
		$acct = $this->getMyprefs($p_userid);
		return $acct->avatar;
	}
	
}

