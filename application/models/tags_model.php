<?php
class Tags_model extends Model {
    var $tag;
    var $tagtype;
    var $taggeditemid;

	function Tags_model() {
		parent::Model();
	}
	
    function getMyTags($p_userid) {
    
        log_message('debug', 'Tags_model->getMyTags: Got current taggeditemid = ' . $p_userid);

        $query = $this->db->get_where('tags', array('taggeditemid' => $p_userid));

		if ($query->num_rows() > 0) {
    		return $query->result();
        }
        
	}
		
	function delete($tagrec) {
        log_message('debug', 'Tags_model->delete: Got current taggeditemid = ' . $tagrec->taggeditemid);
        $query = $this->db->delete('tags', array('taggeditemid' => $tagrec->taggeditemid));
        return $tagrec;
	}
	
	function save($tagmodel) {
        log_message('debug', 'Tags_model->save: Got taggeditemid = ' . $tagmodel->taggeditemid);

		$this->db->where('taggeditemid', $tagmodel->taggeditemid);
		$this->db->update('tags', $tagmodel);
		
		return $tagmodel;
	}
	
	function insert($tagmodel) {
		
        log_message('debug', 'Tags_model->insert: Got current taggeditem' . $tagmodel->taggeditemid);
        
        $query = $this->db->get_where('tags', array('taggeditemid' => $tagmodel->taggeditemid));
		$this->db->set($tagmodel);
		$this->db->insert('tags');
		
		$lastinsert = $this->db->insert_id();
		log_message('debug', 'Tags_model->insert: last inserted = ' .   $lastinsert);     

		return $tagmodel;
	}
	
}

