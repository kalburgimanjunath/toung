<?php
class Myportfolio_model extends Model {
    var $userid;
	var $posnum;
	var $projectname;
	var $title;
	var $image;
	var $description;
    var $updated;
    
	function Myportfolio_model() {
		parent::Model();
	}
	
    function getMyportfolio($p_userid) {
    
        log_message('debug', 'Myportfolio_model->getMyportfolios: Got current userid = ' . $p_userid);
		
        $query = $this->db->get_where('myportfolio', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }
	}
	
	function delete($prefrec) {
        log_message('debug', 'Myportfolio_model->delete: Got current userid = ' . $prefrec->userid);
        $query = $this->db->delete('myportfolio', array('userid' => $prefrec->userid));
        return $prefrec;
	}
	
	function save($prefmodel) {
        log_message('debug', 'Myportfolio_model->save: Got userid = ' . $prefmodel->userid);        

		$this->db->where('userid', $prefmodel->userid);
		$this->db->update('myportfolio', $prefmodel);
		
		$edumodel->updated = date('Y-m-d H:i:s') ;

		return $edumodel;
	}
	
	function insert($prefmodel) {
        log_message('debug', 'Myportfolio_model->insert: Got current userid = ' . $prefmodel->userid);
        
        $query = $this->db->get_where('myportfolio', array('userid' => $prefmodel->userid));
		$this->db->set($prefmodel);
		$this->db->insert('myportfolio');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Myportfolio_model->insert: last inserted = ' .   $lastinsert);     
		$prefmodel->updated = date('Y-m-d H:i:s') ;
		$prefmodel->posnum = $lastinsert;
		$prefmodel->updated = date('Y-m-d H:i:s') ;
		//$edumodel->newrec = true;
		return $prefmodel;
		/*
		$query = $this->db->get_where('myeducation', array('userid' => $edumodel->userid, 'posnum' => $lastinsert));
				if ($query->num_rows() > 0) {
		    		return $query->result();
		        }
		*/
	}
	
	function updateMyportfolios( $myPref_data ) {
	
		$myPref_array = (array) $myPref_data;
	    log_message("debug",  "Myportfolio_model->updateAccount: Updating Myportfolio for " . $myPref_array["userid"]);
	    
	    $this->db->where('userid', $myPref_array['userid']);
	    $this->db->update ('myportfolio', $myPref_array);
	    
	    return true;
	}
	
	function imageUpload($prefmodel) {
        log_message('debug', 'Myportfolio_model->save image: Got userid = ' . $prefmodel->userid);        

		$this->db->where('userid', $prefmodel->userid);
		$this->db->update('myportfolio', $prefmodel);	

		return $prefmodel;
	}
	
	
}

