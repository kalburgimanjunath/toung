<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CredMine</title>

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
	<div id="login">
		<form id="signin_form" method="post" class="login" name="signin_form">
			<ul>
				<li><label class="description" for="email" name="email">Email</label></li>
				<li><input id="email" style="vertical-align:bottom;" class="text" type="email"></li>
				<li><label class="description" for="password" name="password">Password</label></li>
				<li><input id="password" style="vertical-align:bottom;" class="text" type="password"></li>
				<li style="vertical-align:middle;"><input id="rememberme" type="checkbox" name="rememberme"><label for="remember" style="text-align:right; padding-left:5px;" class="description">Remember?</label></li>
				<li style="padding-top:2px;"><input type="submit" id="login_submit" value="Sign In" class="submit" href="" name="login"></li>
			</ul>
		</form>
	</div>
	<div id="login_hover"><span style="vertical-align:middle; margin-right:10px;">Already a member?</span><a class="login_fade">Sign In</a></div>
	</div>
	
	<div id="container">
		<h5>Sitemap</h5>
		
		<div>
		
			<p>Job Seeker <br/>
				<a href="<?php echo base_url();?>home/signin">Sign In </a>| 
				<a href="<?php echo base_url();?>home/signup">CredMine Signup </a>| 
				<a href="<?php echo base_url();?>facebookLogin">Facebook Signup </a>|
				<a href="<?php echo base_url();?>linkedin">LinkedIn Signup </a>| 
				<a href="<?php echo base_url();?>home/forgotpass">Forgot password </a>| 
				<a href="<?php echo base_url();?>home/about">Reset password </a>
			</p>
			<p>Profile<br/>
				<a href="<?php echo base_url();?>home/profile">Profie View </a>|
				<a href="<?php echo base_url();?>home/profile">Edit Profie</a>
			</p>
			<p>Import from social <br/>
				<a href="<?php echo base_url();?>home/signin">Add Services </a>| 
				<a href="<?php echo base_url();?>home/privacy">Import from Facebook </a>|	
				<a href="<?php echo base_url();?>home/privacy">Import from Linkedin </a>	
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
