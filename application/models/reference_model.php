<?php
class Reference_model extends Model {
    var $userid;
    var $name;
    var $position;
    var $company;
    var $testimonial;

	function Reference_model() {
		parent::Model();
	}
	
    function getMyReference($p_userid) {
    
        log_message('debug', 'Reference_model->getMyReference: Got current userid = ' . $p_userid);

        $query = $this->db->get_where('myreference', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }
	}
	
	function delete($refrec) {
        log_message('debug', 'reference_model->delete: Got current userid = ' . $refrec->userid);
        $query = $this->db->delete('myreference', array('userid' => $refrec->userid, 'posnum' => $refrec->posnum));
        return $refrec;
	}
	
	function save($refmodel) {
        log_message('debug', 'reference_model->save: Got userid = ' . $refmodel->userid);
        log_message('debug', 'reference_model->save: Got posnum = ' . $refmodel->posnum);

		$this->db->where('userid', $refmodel->userid);
		$this->db->where('posnum', $refmodel->posnum);
		$this->db->update('myreference', $refmodel);
		
		return $refmodel;
	}
	
	function insert($refmodel) {
        log_message('debug', 'reference_model->insert: Got current userid = ' . $refmodel->userid);
        
        $query = $this->db->get_where('myreference', array('userid' => $refmodel->userid));
		$this->db->set($refmodel);
		$this->db->insert('myreference');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'reference_model->insert: last inserted = ' .   $lastinsert);     

		$refmodel->updated = date('Y-m-d H:i:s') ;
		$refmodel->posnum = $lastinsert;
		$refmodel->newrec = true;
		return $refmodel;
	}
	
}

