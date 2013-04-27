<?php
class Socialids_model extends Model {
    var $userid;
    var $posnum;
    var $socnetwork;
    var $socid;
    var $password;
    var $weburl;
    var $apiurl;
    var $identity;
    var $updated;

	function Socialids_model() {
		parent::Model();
	}
	
	function getMySocialIds($p_userid) {
    
        log_message('debug', 'Socialids_model->getmysocialids: Got current userid = ' . $p_userid);

		$this->db->order_by("socnetwork", "desc");
        $query = $this->db->get_where('mysocialids', array('userid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }        
	}

	function delete($socrec) {
        log_message('debug', 'Socialids_model->delete: Got current userid = ' . $socrec->userid);
        $query = $this->db->delete('mysocialids', array('userid' => $socrec->userid, 'posnum' => $socrec->posnum));
        return $socrec;
	}
	
	function save($socmodel) {
        log_message('debug', 'Socialids_model->save: Got userid = ' . $socmodel->userid);
        log_message('debug', 'Socialids_model->save: Got posnum = ' . $socmodel->posnum);

		$this->db->where('userid', $socmodel->userid);
		$this->db->where('posnum', $socmodel->posnum);
		$this->db->update('mysocialids', $socmodel);
		
		return $socmodel;
	}
	
	function insert($socmodel) {
        log_message('debug', 'Socialids_model->insert: Got current userid = ' . $socmodel->userid);
        
        $query = $this->db->get_where('mysocialids', array('userid' => $socmodel->userid));
		$this->db->set($socmodel);
		$this->db->insert('mysocialids');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Socialids_model->insert: last inserted = ' .   $lastinsert);     

		$socmodel->updated = date('Y-m-d H:i:s') ;
		$socmodel->posnum = $lastinsert;
		$socmodel->newrec = true;
		return $socmodel;
	}

}

