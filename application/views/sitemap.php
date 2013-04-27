<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Toung</title>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home2.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">


<script src="<?php echo base_url();?>lib/jquery-1.5.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/login.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/widget.js" type="text/javascript"></script>


</head>

<body>
	
	
	<div id="container">
		<h5>User Sitemap</h5>
		
		<div>
		
			<p>Signup <br/>				
				<a href="<?php echo base_url();?>home/signup">CredMine Signup </a>| 				
				<a href="<?php echo base_url();?>linkedinstuff/linkauth">LinkedIn Signup </a>
				<!--<a href="<?php echo base_url();?>linkedinSignup">OpenID Signup</a>-->
			</p>
			<p<br/>		
				<a href="<?php echo base_url();?>home/signin">Sign In </a>| 
				<a href="<?php echo base_url();?>home/forgotpass">Forgot password </a>| 
				<!--<a href="<?php echo base_url();?>home/about">Reset password </a>-->
			</p>
			
			<p>Profile<br/>
				<a href="<?php echo base_url();?>home/profile">Profie View </a>|
				<a href="<?php echo base_url();?>profile/editprofile">Edit Profile</a>|
				<a href="<?php echo base_url();?>dashboard">Dashboard</a>
				
			</p>	
				
			<p>Message box<br/>
				<a href="<?php echo base_url();?>messages/inbox">Messages </a>
			</p>
			
			<p>Import from social<br/>
				<a href="<?php echo base_url();?>user/services">Add Services </a>| 
				<a href="<?php echo base_url();?>facebook/fblogin/importprofile">Import Profile from Facebook </a>|	
				<a href="<?php echo base_url();?>linkedinstuff/linkedinimportprofile">Import Profile from Linkedin </a>	
			</p>
			
			<p>Theme Preview<br/>
				<a href="<?php echo base_url();?>profile/preview/1">Theme1 </a>| 
				<a href="<?php echo base_url();?>profile/preview/2">Theme 2 </a>|	
				<a href="<?php echo base_url();?>profile/preview/3">Theme 3 </a>	
			</p>
			<p>Search<br/>
				<a href="<?php echo base_url();?>account/search_user">Search People</a>|
				<a href="<?php echo base_url();?>account/search_user">Search Jobs</a>
			</p>
			
			<p>Connections<br/>
				<a href="<?php echo base_url();?>account/search_user">Display Connections-fb</a>| 
				<a href="<?php echo base_url();?>linkedinstuff/displayConnections">Display Connections-ln</a> 
			</p>
			
			<p>Settings<br/>
				<a href="<?php echo base_url();?>settings">Settings</a>
			</p>
			
			<p>Project<br/>
				<a href="<?php echo base_url();?>portfolio">Upload</a>|
				<a href="<?php echo base_url();?>portfolio/view">View</a>
			</p>
			
			<p>Drawing<br/>
				<a href="<?php echo base_url();?>drawing">draw</a>
			</p>
			
			<!--
			<p>Search<br/>
				<a href="<?php echo base_url();?>account/search_user">Search People</a>| 
				<a href="#">Search Jobs</a>
			</p>
			-->
			<hr>
		</div>
		<h5>Institution Sitemap</h5>
		<div>
			<p>Institutional Signup<br/>
				<a href="<?php echo base_url();?>home/signin">Credmin Signup </a>| 
				<a href="#">Facebook Signup</a>|	
				<a href="#">Linkedin Signup</a>	
			</p>
			<p>Static Pages <br/>
				<a href="<?php echo base_url();?>home/signin">About </a>| 
				<a href="<?php echo base_url();?>home/privacy">Privacy </a>		
			</p>
		</div>
	</div>
	
<script>
$(document).ready(function(){
	$("#user_name").keyup(function (event) {
		$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
	});
		
	$("#user_name").blur(function () {
		$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
	});
	
	$(".login_fade").click(function(event) {
		event.preventDefault();
		loginfade();
		return false;
	});
	
	loginfade();
	
	$("#login_submit").click(function(event) {
		event.preventDefault();
		submitLogin();
		return false;
	});

	$("#register_submit").click(function(event) {
		event.preventDefault();
		registerAccount();
		return false;
	});
});
</script>
</body>
</html>
