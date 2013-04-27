<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/credmine.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/footer.css" />

<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->
<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/register.js" type="text/javascript"></script>

<title>Sign Up!</title>
</head>
<body>
<div id="container" class="formcontainer rounded">
  <div id="header_register"></div>
  <div class="content rounded" style="text-align:center">
	  <h2>Congrats!</h2>
		<p>Your CredMine account is now active.</p>
		<p>To get started with your resume...</p>
		<div id="signinbutton"><?php echo anchor('home/signin', 'sign in');?></div>
  </div>
