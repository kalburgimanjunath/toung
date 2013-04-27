<!DOCTYPE html>
<html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Toung</title>
	<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">
	<!--[if IE]>
		<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<script src="<?php echo base_url();?>lib/jquery-1.5.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script>
	
	<script>
		var config = initApp("<?php echo base_url(); ?>")();
		
	</script>
</head>

<body>

<div class="row-fluid">
	<?php
	
	/*
	<!-- header space -->
	<div class="span12">&nbsp;</div>
	<div class="span6"></div>
	<div class="span4" >
		
			<form id="signin_form" method="post" class="signin_form" name="signin_form">		
				
						<fieldset>						
							<input id="email" class="text" type="email" placeholder="Email">	
							<span class="btn btn-primary">
							<a href="https://www.facebook.com/login.php?api_key=<?php echo $this->config->config['facebook_api_key'];?>&cancel_url=<?php echo base_url();?>&display=page&fbconnect=1&next=<?php echo base_url();?>fblogin/loginpost&return_session=1&session_version=3&v=1.0&req_perms=publish_actions%2Cemail%2Cuser_photos%2Coffline_access"><?php echo img('images/extras/fb.png');?></a>
							<a href="https://www.linkedin.com/uas/oauth/authorize?oauth_token=4da04f60-f764-46b3-bab5-02450384352b"><?php echo img('images/extras/linkedin.png');?></a>
							</span>
						</fieldset>	
						<fieldset>						
							<input id="password" style="vertical-align:bottom;" class="text" type="password" placeholder="Password">
							<input type="submit" id="login_submit" value="Sign In" href="" name="login" class="btn btn-primary">
						</fieldset>
										
								
						
			</form>
			
		
	</div>
	*/?>
	<div class="span12">
		
	</div>
	<div class="span12">
		<div class="span2"></div>	
		<div class="span4">
			<?php echo img('images/logos/small.png');?>				
		</div>
		<div class="span4">
			<?php echo img('images/logos/top-nav.png');?>			
		</div>
	</div>
	<div class="span12">
		<div class="span2"></div>	
		
		<div class="span4">
			<span style="font-family:'Showcard Gothic';font-size:30px;">WHAT DO YOU WANT TO DO?</span>
			<input type="submit" class="btn btn-primary"  value="Login"/>
		</div>
		
		
	</div>
	<div class="span12"></div>
	<div class="span12"></div>
	<div class="span12">
			
		<div class="span4">
			<fieldset>	
				<div class="span12">
					<div class="span6">
					</div>
					<div class="span6">
						<span style="font-family:'Showcard Gothic';font-size:20px;">CREATE RESUMES</span>
					</div>
					
				</div>
			</fieldset>	
			<div class="span12"></div>
			<div class="span12"></div>
			<fieldset>	
				<div class="span12">
					<div class="span8">
					</div>
					<div class="span4">
						<span style="font-family:'Showcard Gothic';font-size:20px;">PERSONALIZE</span>
					</div>
					
				</div>
			</fieldset>
			<div class="span12"></div>
			<div class="span12"></div>
			<fieldset>		
				<div class="span12">
					<div class="span5">
						
					</div>
					<div class="span5"><span style="font-family:'Showcard Gothic';font-size:20px;">SHARE ANYWHERE</span>
					</div>
					<div class="span12"></div>
				</div>
			</fieldset>	
			<div class="span12"></div>
			
			
			<fieldset>		
				<div class="span12">
					<div class="span6">
						
					</div>
					<div class="span6">
						<span style="font-family:'Showcard Gothic';font-size:20px;">WORK ON PROJECTS</span>
					</div>
					
				</div>
			</fieldset>		
			
		</div>
		<div class="span3">
			
			<div class="span12">
				<form id="signup_form" method="post" class="registration_form" name="signup_form">
					<fieldset>						
						<input id="user_name" type="text" placeholder="Full Name">						
					</fieldset>	
					<fieldset>						
						<input id="user_email" type="email" placeholder="Email">							
					</fieldset>
					<fieldset>						
						<input id="user_screename" class="username" type="text" >
						<div class="url_hint">toung.com/</div>
					</fieldset>
					<fieldset>						
						<input id="user_password" type="password" placeholder="Password">
					</fieldset>					
					<fieldset>						
						<input type="submit" id="register_submit" class="btn btn-primary" value="Resume me " href="" name="login">						
					</fieldset>										
				</form>		
				
			</div>	
		</div>
		<div class="span4">
			
			<fieldset>	
				<div class="span12">					
						<span style="font-family:'Showcard Gothic';font-size:20px;">DEVELOP SKILLS</span>					
				</div>
			</fieldset>	
			<div class="span12"></div>
			<div class="span12"></div>
			<fieldset>	
				<div class="span12">
					<div class="span2">
					</div>
					<div class="span8">
						<span style="font-family:'Showcard Gothic';font-size:20px;">WORK FROM HOME</span>
					</div>
					
				</div>
			</fieldset>
			<div class="span12"></div>
			<div class="span12"></div>
			<fieldset>		
				<div class="span12">
					<div class="span8">
						<span style="font-family:'Showcard Gothic';font-size:20px;">GET THE TRAINING</span>
					</div>
					<div class="span2">
					</div>
				</div>
			</fieldset>	
			<div class="span12"></div>
			<div class="span12"></div>
			<fieldset>		
				<div class="span2">
					</div>
				<div class="span8">
					<span style="font-family:'Showcard Gothic';font-size:20px;">E-SHOP FOR ALL</span>
				</div>
			</fieldset>		
			
		</div>
	</div>
	<div class="span12">
		<div class="span4"></div>
		<div class="span4">
				<div class="span5">			
					<a class="btn btn-primary" onlogin="login();" size="medium" perms="email,offline_access,user_birthday,status_update,publish_stream" href="https://www.facebook.com/login.php?api_key=<?php echo $this->config->config['facebook_api_key'];?>&cancel_url=<?php echo base_url();?>&display=page&fbconnect=1&next=<?php echo base_url();?>fblogin/loginpost&return_session=1&session_version=3&v=1.0&req_perms=publish_actions%2Cemail%2Cuser_photos%2Coffline_access"><?php echo img('images/extras/fb.png');?>Facebook SignUp </a>
				</div>
				<div class="span5">
				<a class="btn btn-primary" onclick="onLinkedInAuth();" href="javascript:void(0);" ><?php echo img('images/extras/linkedin.png');?> Linkedin SignUp </a>
				</div>
		</div>
		<div class="span4"></div>
	</div>
	<div class="span12"></div>
	
	<div class="span12">
		<div class="span4"></div>
		<div class="span4">
			<fieldset>		
				<div class="span12">
					<span style="font-family:'Showcard Gothic';font-size:20px;">WORK AS A FREELANCER</span>
				</div>
			</fieldset>	
		</div>
	</div>
	<div class="span12">
		<div class="span2"></div>
			
			
	</div>
	<div class="span12">
		<div class="span2"></div>
		<div class="span7">
			<div class="page-header">
				<h4>I am an Employer / Organization</h4>
			</div>
		</div>
			
		
	</div>
	
	<div class="span12">&nbsp;</div>	
	<div class="span12">&nbsp;</div>	
	<div class="span2"></div>
	<div class="span3"><?php echo img('images/extras/twitter.png');?></div>
	<!--
	<form id="signin_form" method="post" class="signin_form" name="signin_form">		
				
						<fieldset>						
							<input id="email" class="text" type="email" placeholder="Email">	
							<span class="btn btn-primary">
							<a href="https://www.facebook.com/login.php?api_key=<?php echo $this->config->config['facebook_api_key'];?>&cancel_url=<?php echo base_url();?>&display=page&fbconnect=1&next=<?php echo base_url();?>fblogin/loginpost&return_session=1&session_version=3&v=1.0&req_perms=publish_actions%2Cemail%2Cuser_photos%2Coffline_access"><?php echo img('images/extras/fb.png');?></a>
							<a href="https://www.linkedin.com/uas/oauth/authorize?oauth_token=4da04f60-f764-46b3-bab5-02450384352b"><?php echo img('images/extras/linkedin.png');?></a>
							</span>
						</fieldset>	
						<fieldset>						
							<input id="password" style="vertical-align:bottom;" class="text" type="password" placeholder="Password">
							<input type="submit" id="login_submit" value="Sign In" href="" name="login" class="btn btn-primary">
						</fieldset>
										
								
						
			</form>
	-->
	<div class="span5 offset">
		<ul class="footernav">
			<li><a href="<?php echo base_url();?>home/about">Home</a></li>
			<li><a href="<?php echo base_url();?>home/about">About</a></li>
			<li><a href="<?php echo base_url();?>home/about">Contact</a></li>
			<li><a href="">Blog</a></li>
			<li><a href="<?php echo base_url();?>home/about">Tems</a></li>
			<li><a href="<?php echo base_url();?>home/privacy">Privacy</a></li>
		</ul>
	</div>
		
	<div>
</div>
<div id="displayProfiles"></div>
<script src="<?php echo base_url();?>js/welcome.js"></script>
<script src="<?php echo base_url();?>js/login.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/widget.js" type="text/javascript"></script>
</body> 
</html>
