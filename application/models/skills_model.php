<?php
class Skills_model extends Model {
    var $userid;
    var $posnum;
    var $skillname;
    var $selfrating;
    var $communityrating;
    var $updated;

	function Skills_model() {
		parent::Model();
	}
	
	function getMySkills($p_userid) {
    
        log_message('debug', 'skills_model->getMySkills: Got current userid = ' . $p_userid);

		$this->db->order_by("selfrating", "desc");
        $query = $this->db->get_where('myskills', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }        
	}

	function delete($skirec) {
        log_message('debug', 'skills_model->delete: Got current userid = ' . $skirec->userid);
        $query = $this->db->delete('myskills', array('userid' => $skirec->userid, 'posnum' => $skirec->posnum));
        return $skirec;
	}
	
	function save($skimodel) {
        log_message('debug', 'skills_model->save: Got userid = ' . $skimodel->userid);
        log_message('debug', 'skills_model->save: Got posnum = ' . $skimodel->posnum);

		$this->db->where('userid', $skimodel->userid);
		$this->db->where('posnum', $skimodel->posnum);
		$this->db->update('myskills', $skimodel);
		
		return $skimodel;
	}
	
	function insert($skimodel) {
        log_message('debug', 'skills_model->insert: Got current userid = ' . $skimodel->userid);
        
        $query = $this->db->get_where('myskills', array('userid' => $skimodel->userid));
		$this->db->set($skimodel);
		$this->db->insert('myskills');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'skills_model->insert: last inserted = ' .   $lastinsert);     

		$skimodel->updated = date('Y-m-d H:i:s') ;
		$skimodel->posnum = $lastinsert;
		//$skimodel->newrec = true;
		return $skimodel;
	}

}

