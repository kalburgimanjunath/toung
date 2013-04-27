<?php
class Experience_model extends Model {
    var $userid;
    var $posnum;
    var $startdate;
    var $enddate;
    var $company;
    var $position;
    var $description;
    var $updated;

	function Experience_model() {
		parent::Model();
	}
	
    function getMyExperience($p_userid) {
    
        log_message('debug', 'Experience_model->getMyExperience: Got current userid = ' . $p_userid);

		$this->db->order_by("startdate", "asc");
        $query = $this->db->get_where('myexperience', array('userid' => $p_userid));
		
		if ($query->num_rows() > 0) {
    		return $query->result();
        }
        
	}
		
	function delete($exprec) {
        log_message('debug', 'Experience_model->delete: Got current userid = ' . $exprec->userid);
        $query = $this->db->delete('myexperience', array('userid' => $exprec->userid, 'posnum' => $exprec->posnum));
        return $exprec;
	}
	
	function deleteAll($exprec) {
        log_message('debug', 'Experience_model->delete: Got current userid = ' . $exprec->userid);
        $query = $this->db->delete('myexperience', array('userid' => $exprec->userid));
        return $exprec;
	}
	
	function save($expmodel) {
        log_message('debug', 'Experience_model->save: Got userid = ' . $expmodel->userid);
        log_message('debug', 'Experience_model->save: Got posnum = ' . $expmodel->posnum);

		$this->db->where('userid', $expmodel->userid);
		$this->db->where('posnum', $expmodel->posnum);
		$this->db->update('myexperience', $expmodel);
		
		return $expmodel;
	}
	
	function insert($expmodel) {
        log_message('debug', 'Experience_model->insert: Got current userid = ' . $expmodel->userid);
        
        $query = $this->db->get_where('myexperience', array('userid' => $expmodel->userid));
		$this->db->set($expmodel);
		$this->db->insert('myexperience');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Experience_model->insert: last inserted = ' .   $lastinsert);     

		$expmodel->updated = date('Y-m-d H:i:s') ;
		$expmodel->posnum = $lastinsert;
		//$expmodel->newrec = true;
		return $expmodel;
	}
	
	function getMyExperienceCount($p_userid) {
    
        log_message('debug', 'Experience_model->getMyExperience: Got current userid = ' . $p_userid);

		$this->db->order_by("startdate", "asc");
        $query = $this->db->get_where('myexperience', array('userid' => $p_userid));
    	return $query->num_rows();        
	}
}

