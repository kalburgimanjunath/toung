<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CredMine - Your Resume</title>
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
<script src="<?php echo base_url();?>lib/jquery.jeditable.js"type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.simplemodal/jquery.simplemodal-1.4.1.js"type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery-validate/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>lib/scripts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.scrollTo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/user_management.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:700,700italic|Cantarell:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">


</head>
<body>

<script>
	var config = initApp("<?php echo base_url(); ?>")();
</script>

<div id="header" class="shadow">
	<div class="navbar">
    <div class="navbar-inner">
    <div class="container">
    ...
    </div>
    </div>
    </div>
	<div class="headercontent">
		<div id="username" class="name">ASKF KGDSV</div>
		<div id="headline" class="headline">Design & Development + Thought for the Future.</div>
		<div class="social">
			<ul class="socialdock">
				<li><a class="linkedin"></a></li>
				<li><a class="twitter"></a></li>
				<li><a class="facebook"></a></li>
				<li><a class="blogger"></a></li>
			</ul>
		</div>
	</div>
	<div id="navigation" class="menu">
		<ul id="navi" class="nav">
					<li><a href="#bio">ME</a></li>
					<li><a href="#education">EDUCATION</a></li>
					<li><a href="#experience">EXPERIENCE</a></li>
	                <li><a href="#skills">SKILLS</a></li>
	         </ul>
	</div>
</div>
	

<script>     
function loadAll() {
	loadAndShowBio($("#bio"));
	loadAndShowEdu($("#education"));
	loadAndShowExp($("#experience"));
	loadAndShowSkills($("#skills"));
        loadAndShowReference($("#reference"));
	loadAndShowSocialIds($("#socialids"));
	loadAndShowContact($("#contact"));
}


$(document).ready(function(){
	        loadAll();
	}
);	

$(document).ready(function() {
	$('#navigation').localScroll({
		target:'#container'
	});
	
	/*Adjusts menu width dynamically*/
	var width = 50;
	$('#navi li').each(function() {
    	width += $(this).outerWidth( true );
	});
	$('#navi').css('width', width + 0);

	});
</script>
