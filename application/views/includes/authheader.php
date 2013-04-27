<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta http-equiv="content-type" content="text/html; charset=windows-1250">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toung - Your Resume</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/profile.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/theme.css" />


<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">
<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>js/common.js"></script>
<script src="<?php echo base_url();?>js/login.js"></script>
<script src="<?php echo base_url();?>lib/jquery.tmpl.js"></script>
<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>
<!--
<script src="<?php echo base_url();?>lib/jquery.jeditable.js"type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.simplemodal/jquery.simplemodal-1.4.1.js"type="text/javascript"></script>
-->
<script src="<?php echo base_url();?>lib/jquery-validate/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>lib/scripts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.scrollTo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/user_management.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:700,700italic|Cantarell:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<!-- bootstrap twitter starts -->
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/docs.css">

<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-dropdown.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-tab.js" type="text/javascript"></script>

<!-- bootstrap twitter ends -->
</head>
<body>

<script>
	var config = initApp("<?php echo base_url(); ?>")();
</script>
<div class="container">			
		<div class="span12">
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						
						<ul class="nav"  id="menu3">
							<li><a class="brand" href="<?php echo base_url();?>dashboard">Toung<!--<img src="<?php echo base_url();?>images/logos/tiny.png"/>--></a></li>
							<li class="dropdown" id="menu1">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#menu1">Dashboard<b class="caret"></b></a>
								
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>settings">Customize</a></li>	
									<li><a href="<?php echo base_url();?>profile/index">View Profile</a></li>									
									<li><a href="<?php echo base_url();?>messages/inbox">Messages</a></li>
									<li><a href="<?php echo base_url();?>user/logout">Log Out</a></li>		
									
								</ul>
							</li>				
							
						</ul>
					</div>
				</div>				
			</div>
			
		</div>	
		<div class="span12">&nbsp;</div>
		<div class="span12">&nbsp;</div>
		<div class="span12">&nbsp;</div>
		<div class="subnav subnav-fixed">
			<ul class="nav nav-pills">
			  <li class="active"><a href="<?php echo base_url();?>dashboard">Home</a></li>
			  <li class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle">Profile <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li class=""><a href="<?php echo base_url();?>profile/index">View Profile</a></li>
				  <li class=""><a href="<?php echo base_url();?>profile/editprofile">Edit Profile</a></li>
				</ul>
			  </li>
			  <li class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle">My Network <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li class=""><a href="<?php echo base_url();?>">Mates</a></li>
				  <li class=""><a href="<?php echo base_url();?>">Add Mates</a></li>
				</ul>
			  </li>
			  <li><a href="#labels">Activity</a></li>
			  <li><a href="#badges">Projects</a></li>
			  <li><a href="#typography">Traning MATS</a></li>
			  <li><a href="#thumbnails">E-Shop</a></li>
			  <li><a href="#alerts">Alerts</a></li>
			  <li><a href="#misc">Miscellaneous</a></li>
			</ul>
		  </div>
			<!--	
			<div id="header" class="shadow">
				<div class="headercontent">
					<div id="username" class="name">ASKF KGDSV</div>
					<div id="headline" class="headline-top">Design & Development + Thought for the Future.</div>
					<div class="social">
						<ul class="socialdock">
							<li><a class="linkedin"></a></li>
							<li><a class="twitter"></a></li>
							<li><a class="facebook"></a></li>
							<li><a class="blogger"></a></li>
						</ul>
					</div>
				</div>
						
			</div>	
			-->
		
	
