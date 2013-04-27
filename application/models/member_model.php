<?php
class Member_model extends Model {
    var $userid;
    var $username;
    var $email;
    var $password;
    var $verifystring;
    var $lostkey;
    var $active;
    var $updated;
    
	function Member_model() {
		parent::Model();
	}
	/**/
	function save($edumodel) {
        log_message('debug', 'Education_model->save: Got userid = ' . $edumodel->userid);
        log_message('debug', 'Education_model->save: Got posnum = ' . $edumodel->posnum);

		$this->db->where('userid', $edumodel->userid);
		$this->db->where('posnum', $edumodel->posnum);
		$this->db->update('myeducation', $edumodel);
		
		$edumodel->updated = date('Y-m-d H:i:s') ;

		return $edumodel;
	}
	
	function insert($membermodel) {
        log_message('debug', 'Member_model->insert: Got current id = ' . $membermodel->userid);
        
        $query = $this->db->get_where('member', array('id' => $membermodel->userid));
		$this->db->set($membermodel);
		$this->db->insert('member');
		
		log_message('debug', 'Member_model->insert: last inserted = ' .   $lastinsert);     
		
		$membermodel->username = $username;
		$membermodel->email = $email;
		$membermodel->password = $password;
		$membermodel->verifystring = $verifystring;
		$membermodel->lostkey = $lostkey;
		$membermodel->active = $active;
		return $membermodel;
	}
	
}

