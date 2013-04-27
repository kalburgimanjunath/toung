<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Toung</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home2.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">
<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->
<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.tools.min.js"></script>
<script>

$(function() {
	$("ul.anav").tabs("div.aboutcontent > div", 
	   {
	       effect: "fade",
	   });
	});

</script>
</head>
<body>
<a class="home_link" href="<?php echo base_url();?>home"></a>
<div id="container">
<div class="abouthead"></div>
<div class="aboutnav">
	<ul class="anav">
		<li><a href="#what">What We Do</a></li>
		<li><a href="#who">Behind The Scenes</a></li>
	</ul>
</div>
<div class="aboutcontent">
	<div id="what">
		<h1>What We Do</h1>	
		<div class="content">
			<p>We here at Toung, sought out to create an all inclusive tool to create a resume online. We started out with a simple user friendly platform to help you, the user, create a beautiful online resume to display the credentials that you worked so hard for!</p>
			<p>With simplicity in mind, we came up with a sleek and professional resume, which you can mold and shape to reflect your personality and creativity, allowing you to stand out without sacrificing the emphasis you want to add on the elements that make up your credentials.</p>
			<p>Instead of handing your future employer a sheet of paper, refer them to your Toung profile. With Toung's elegant resume interface, your resume will be easy for anyone to navigate and absorb. Your portfolio and experiences is well detailed and not scrunched up into a few sentences. Refer your resume viewers to reccommendations that can be verified online. With our tools, you can build a detailed resume that showcases your talents, abilities, and experiences, and save paper too! </p>
			<p>Customize the look and feel with gorgeous themes, or edit the options yourself! We feel that having a profile that you can customize, not only help you stand out, but also help you display your personality. Who says you have to sacrifice style for professionalism? In a lot of ways they tie together.</p>
			<p>Today, building your credibility online is important. We designed Toung to be social friendly and easily sharable. Toung can be shared across your social networks with just one click. Don't be shy! You've put in a lot of work to make that resume shine, we're here to help you show that to the world.</p>
			<p>It's simple. It's free. It's resume made simple. Get started today!</p>
		<div style="margin-left:300px; margin-top:30px;">
	  		<a href="<?php echo base_url();?>home/signup" class="signup"></a>
		</div>
		</div>
	</div>
	<div id="who">
	<h1>Why Toung?</h1>
		<div class="content">
			<p>Toung was born out of my personal pain of having to create my own resume. I could not find a way, or understand why I needed to fit all of my work on a piece of paper that not only defined my credentials and credibility, but also had the ability to stand out from the others. I believe that the traditional resume will soon become obsolete, and today, online credibility is becoming increasingly important. I wanted to create a tool and service that anyone could use to create a professional and elegant resume online.
			 </p>
		</div>
	<h1>The Team</h1>
		<div class="content">
			<p align="center"><b>Tim Thimmaiah</b>-<i>CEO/Founder, Lead Developer</i></p>
			<hr style="margin-top:130px;">
			<p align="center">See our <a href="">Blog</a> for recent updates, news, and information.</p>
			<p align="center">Follow Toung on <a href="http://twitter.com/toung">Twitter</a></p>
		</div>
	</div>

</div>
</div>

<div id="footer">
	<<div class="footercontent">
		<ul class="footernav">
			<li><a href="<?php echo base_url();?>home/about">About</a></li>
			<li><a href="">Blog</a></li>
			<li><a href="<?php echo base_url();?>home/privacy">Privacy</a></a></li>
			<li><a href="">Contact</a></li>
		</ul>
	</div>

</div>

</body>

</html>