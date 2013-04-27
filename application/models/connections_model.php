<?php
class Connections_model extends Model {
    var $userid;
    var $frndid;
    var $fname;
    var $mname;
    var $headline;
    var $picture_url;
	var $profile_url;

	function Connections_model() {
		parent::Model();
	}
	
	function getMyConnections($p_userid) {
    
        log_message('debug', 'connections_model->getMyConnections: Got current userid = ' . $p_userid);

		
        $query = $this->db->get_where('connections', array('userid' => $p_userid));
		$this->db->order_by("fname", "asc");
		if ($query->num_rows() > 0) {
    		return $query->result();
        }        
	}

	function delete($skirec) {
        log_message('debug', 'connections_model->delete: Got current userid = ' . $skirec->userid);
        $query = $this->db->delete('connections', array('userid' => $skirec->userid));
        return $skirec;
	}
	
	function save($skimodel) {
        log_message('debug', 'connections_model->save: Got userid = ' . $skimodel->userid);
       // log_message('debug', 'connections_model->save: Got posnum = ' . $skimodel->posnum);

		$this->db->where('userid', $skimodel->userid);
		$this->db->update('connections', $skimodel);
		
		return $skimodel;
	}
	
	function insert($skimodel) {
        log_message('debug', 'connections_model->insert: Got current userid = ' . $skimodel->userid);
        
        $query = $this->db->get_where('connections', array('userid' => $skimodel->userid));
		$this->db->set($skimodel);
		$this->db->insert('connections');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'connections_model->insert: last inserted = ' .   $lastinsert);     

		//$skimodel->updated = date('Y-m-d H:i:s') ;
		//$skimodel->posnum = $lastinsert;
		//$skimodel->newrec = true;
		return $skimodel;
	}

}

