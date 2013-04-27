<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-alert.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/docs.css" type="text/CSS"></script>
<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll" >
<style>

#comments { 
width: 100%; 
float: left; 
font-family: Arial, Helvetica, sans-serif; 
color: #ff6600; 
}
.postToProfile{
	display:none;
}
#comments a { color: #ff6600; }

#comments .wallkit_form { 
padding: 0 0 15px 0; 
margin: 0 0 10px 0; 
border-bottom: 1px solid #ff6600; 
}
#comments .wallkit_form .composer { padding: 0; }
#comments .pas { padding: 0; }
#comments .uiBoxGray { 
background: none; 
border:0; 
}
#comments .toggleform { 
margin: 0; 
padding: 0; 
}
#comments .toggleform a { 
display: block; 
font-size: 14px;
color: #fff; 
font-weight: bold; 
text-transform: uppercase;
background: #fff; 
padding: 10px 0; 
}

#comments .wallkit_form div.text_spacer { padding-left: 60px; }
#comments .wallkit_form textarea { 
display: block; 
height: 42px; 
color: #ff6600; 
margin: 0; 
border: 1px solid #ff6600; 
}
#comments div.connected input { margin: 5px; }
#comments div.connected label { 
font-size: 11px; 
color: #ff6600; 
vertical-align: text-top; 
}

#comments .uiButton, 
#comments .uiButtonSuppressed:active, 
#comments .uiButtonSuppressed:focus, 
#comments .uiButtonSuppressed:hover { 
background: none; 
padding: 4px 10px; 
}
#comments .uiButtonConfirm{ 
background: #ff6600 !important; 
border: 0; 
}
#comments .uiButton .uiButtonText, 
#comments .uiButton input { 
text-transform: uppercase; 
padding:1px 0 2px 2px; 
}
#comments .wallkit_frame .inputsubmit-disabled { 
background: none; 
border: 0; 
color: #ff6600; 
}

#comments .wallkit_post { 
border-bottom: 1px solid #ff6600; 
margin: 10px 0 5px; 
}
#comments .wallkit_post .wallkit_postcontent h4 .wall_time { 
color: #ff6600; 
}

#comments .wallkit_subtitle { padding: 3px 0; }
#comments .wallkit_subtitle .post_counter { margin: 0 0 0 5px; }
#comments .wallkit_subtitle .pager { padding-left: 5px; }
#comments .pagerpro .current .pagerpro_a { border-bottom: 2px solid #ff6600; }
#comments .pagerpro .pagerpro_a:hover { 
background: #ff6600; 
border-bottom: 1px solid #ff6600; 
text-decoration: none !important; 
}

#comments .wallkit_subtitle { padding: 3px 0; }
#comments .wallkit_subtitle .post_counter { margin: 0 0 0 5px; }
#comments .wallkit_subtitle .pager { padding-left: 5px; }
#comments .pagerpro .current .pagerpro_a { 
color: #ff6600;
border-bottom: 2px solid #ff6600; 
}
#comments .pagerpro .pagerpro_a:hover { 
background: #ff6600; 
border-bottom: 1px solid #ff6600; 
text-decoration: none !important; 
}


</style>
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
    <div class="row-fluid">
	

		<div class="span2">		
			<?php 					
					$image_properties = array(
					  'src' =>'',
					  'alt' => '',
					  'class' => '',
					  'width' => '100',
					  'height' => '100',
					  'title' => 'Profile Picture'
					);
					//echo img($image_properties);	
				
			?>
			
		</div>
		
		<div id="comments">
		
		<fb:comments xid="143389245671476" num_posts="1"  href="<?php echo base_url();?>dashboard" ></fb:comments>
		</div>
		<!--
		<fb:fan name="platform" stream="1" connections="8" width="600" border="0"></fb:fan>
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