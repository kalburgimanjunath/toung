<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-alert.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/docs.css" type="text/CSS"></script>
<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll" >
<?php
	//$this->load->model('connections_model');
				
	//$connections = $this->connections_model->getMyConnections($account->userid);	
	//if(empty($connections)){
	//	echo "<div class='alert fade in'>Empty Connections</div>";
	//}else{
	//foreach($connections as $connection){
?>

<div class="span12">
	<div class="span12"></div>		
		<div class="span8">
			<div class="fb-shared-activity" data-width="600" data-height="300"></div>
		</div>
		<!--
		<div class="span6">
			<div class="span12"><b><?php //echo $connection->fname.$connection->lname;?></b><br/>
			<i><?php //echo $connection->headline;?></i><br/>
			<b><a href="<?php //echo $connection->profile_url;?>" target="blank">View Profile</a></b></div>
		</div>
		<div class="span2">
			    <div class="btn-group">
				<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
				Message
				<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
				
					<li><a>Invite</a></li>
					<li><a>View Connections</a></li>
					<li><a>Share Profile</a></li>
					
				</ul>
				</div>
		</div>
		//-->
    
	</div>
</div>
<?php		//}
		//}
?>
</div>
<script>
$('#navbar').scrollspy()
</script>