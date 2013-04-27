<?php
class Message_model extends Model {
    var $id;
    var $sender_id;
    var $subject;
    var $message;
    var $message_date;
    var $sender_status;
    var $label_id;
    var $thread_id;
    
	function Message_model() {
		parent::Model();
	}
	
	
	function getMessage($p_userid) {
		log_message("debug",  "Message_model->getMessage: Searching for user $p_userid<br/>");
		
		$query = $this->db->get_where('messages', array('sender_id' => $p_userid));
		
		if ($query->num_rows() > 0)
		{
			log_message("debug",  "Message_model->getMessage: Found Message for $p_userid<br/>");
			$row = $query->row(); 
			return $row;
		}
	}
	
	
	
	function getAllMessage() {
		$query = $this->db->get('messages');
		return $query->result();
	}
	
	
	
	
	function addMessage ( $message_data ) {
		log_message("debug",  "Message_model->addMessage: In Add Message...");
		//print_r ($account_data);
		
		log_message("debug",  "Message_model->addMessage: Adding Message for " . $message_data->sender_id);
		
		log_message("debug",  "Message_model->addMessage: Ready to insert messages");
		$message_data->message_date = date('Y-m-d H:i:s') ;		
		$this->db->insert ('messages', $message_data);
		log_message("debug",  "Message_model->addMessage: Created messages, getting record for " . $message_data->sender_id);
		
		$newmessage = $this->getMessage($message_data->sender_id);
		
		log_message("debug", "Message_model->addMessage: Got the newly created messages for " . $newmessage->sender_id);
		return $newmessage;		
	}
	
	function deleteMessage ( $sender_id ) {
		$this->db->where('sender_id', $sender_id);
		$this->db->delete('messages');
		
	}
	
	function getMessageCount($p_userid) {
		log_message("debug",  "Message_model->getMessageCount: Searching for user $p_userid<br/>");
		
		$query = $this->db->get_where('messages', array('sender_id' => $p_userid));
		
		if ($query->num_rows() > 0)
		{
			log_message("debug",  "Message_model->getMessageCount: Found Message for $p_userid<br/>");			
			return $query->num_rows();
		}
	}
	
}
