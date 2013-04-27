<?php
class Education_model extends Model {
    var $userid;
    var $startdate;
    var $enddate;
    var $institution;
    var $credential;
    var $fieldofstudy;
    var $activities;
    var $updated;
    
	function Education_model() {
		parent::Model();
	}
	
    function getMyEducation($p_userid) {
    
        log_message('debug', 'Education_model->getMyEducation: Got current userid = ' . $p_userid);

		$this->db->order_by("startdate", "asc");
        $query = $this->db->get_where('myeducation', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }
	}
	
	function delete($edurec) {
        log_message('debug', 'Education_model->delete: Got current userid = ' . $edurec->userid);
        $query = $this->db->delete('myeducation', array('userid' => $edurec->userid, 'posnum' => $edurec->posnum));
        return $edurec;
	}
	
	function deleteAll($edurec) {
        log_message('debug', 'Education_model->delete: Got current userid = ' . $edurec->userid);
        $query = $this->db->delete('myeducation', array('userid' => $edurec->userid));
        return $edurec;
	}
	
	function save($edumodel) {
        log_message('debug', 'Education_model->save: Got userid = ' . $edumodel->userid);
        log_message('debug', 'Education_model->save: Got posnum = ' . $edumodel->posnum);

		$this->db->where('userid', $edumodel->userid);
		$this->db->where('posnum', $edumodel->posnum);
		$this->db->update('myeducation', $edumodel);
		
		$edumodel->updated = date('Y-m-d H:i:s') ;

		return $edumodel;
	}
	
	function insert($edumodel) {
        log_message('debug', 'Education_model->insert: Got current userid = ' . $edumodel->userid);
        
        $query = $this->db->get_where('myeducation', array('userid' => $edumodel->userid));
		$this->db->set($edumodel);
		$this->db->insert('myeducation');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Education_model->insert: last inserted = ' .   $lastinsert);     
		$edumodel->updated = date('Y-m-d H:i:s') ;
		$edumodel->posnum = $lastinsert;
		//$edumodel->newrec = true;
		return $edumodel;
		/*
		$query = $this->db->get_where('myeducation', array('userid' => $edumodel->userid, 'posnum' => $lastinsert));
				if ($query->num_rows() > 0) {
		    		return $query->result();
		        }
		*/
	}
	
	function getMyEducationCount($p_userid) {
    
        log_message('debug', 'Education_model->getMyEducation: Got current userid = ' . $p_userid);

		$this->db->order_by("startdate", "asc");
        $query = $this->db->get_where('myeducation', array('userid' => $p_userid));		
    	return $query->num_rows();
	}
	
}

