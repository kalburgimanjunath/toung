<?php	
	if(count($messages)>0){
?>
    <table class="table table-bordered">
		<?php 
			foreach($messages as $message){
				echo "<tr>
						<td><input type='checkbox' name='messagedel[]'/></td>
						<td>$message->sender_id</td>
						<td><b>$message->subject - $message->message </b></td>
						<td>$message->message_date</td>
					</tr>";
			}
		?>
    </table>


<?php
	}
?>
