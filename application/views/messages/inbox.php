	<?php
		$this->load->model('message_model');
		$msgrec = $this->message_model->message_model();
		
		$data = array();
		if ($query = $this->message_model->getAllMessage()) {
			//echo "Got all messages for $userid";
			$messages = $query;
		}
		
	?>
	
	<?php	
		if(count($messages)>0){
	?>
		<table class="table table-bordered">
		<?php foreach($messages as $message){ ?>
				<tr>
					<td><input type='checkbox' name='messagedel[]'/></td>
					<td><?php echo $message->sender_id?></td>
					
					<td><b><?php echo $message->subject.'-'.$message->message;?></b></td>
					
					<td><?php echo $message->message_date;?></td>
				</tr>
		<?php 
				
				}
			?>
		</table>
	<?php
		}
	?>