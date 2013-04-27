<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<title>Credmine:Admin Panel</title>
</head>

<body>	
	
	<div id="container">
		<h5>Admin Sitemap</h5>
		
		<div>
		<!--
			<p>Signup <br/>				
				<a href="<?php echo base_url();?>admin/signup">CredMine Signup </a>
			</p>
			<p<br/>		
				<a href="<?php echo base_url();?>admin/signin">Sign In </a>| 
				<a href="<?php echo base_url();?>admin/forgotpass">Forgot password </a>| 
				<a href="<?php echo base_url();?>admin/about">Reset password </a>			
			</p>
		//-->	
			<p>Account Details<br/>
				<a href="<?php echo base_url();?>admin/account/list">Member Profiles List</a>
			</p>
			<p>Messages<br/>
				<a href="<?php echo base_url();?>admin/account/list">Inbox</a>|
				<a href="<?php echo base_url();?>admin/account/list">Sent</a>|
				<a href="<?php echo base_url();?>admin/account/list">Draft</a>
			</p>	
		<!--	
			<p>Search<br/>
				<a href="<?php echo base_url();?>admin/account/search_user">Search People</a>| 
				<a href="#">Search Jobs</a>
			</p>
			<hr>
		</div>
		<h5>Institution Sitemap</h5>
		<div>
			<p>Institutional Signup<br/>
				<a href="<?php echo base_url();?>admin/signin">Credmin Signup </a>
			</p>
			<p>Static Pages <br/>
				<a href="<?php echo base_url();?>admin/signin">Config </a>		
			</p>
		</div>-->
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
