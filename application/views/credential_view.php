<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CredMine - Your Resume</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/profile.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/theme.css" />


<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">
<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:700,700italic|Cantarell:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>

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


<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<!-- bootstrap twitter starts -->
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">

<script>
	var config = initApp("<?php echo base_url(); ?>")();
</script>
<script>
	protectedPage();
</script>

<div class="container">
	<div class="row-fluid">
		<div class="span4">
		<!--Sidebar content-->
			<?php echo img('images/logos/small.png');?>
		
		
			<?php echo img('images/extras/aboutyou-off.png');?>
			<?php echo img('images/extras/credential-on.png');?>
			<?php echo img('images/extras/finish-off.png');?>
		</div>
		<div class="span8">
		<!--Body content-->
			<strong>Now for the Good Stuff</strong>
			<?php echo $alert;?>
			<p>Lets show off your education and experience</p>
			<?php if(!empty($alert)){?>
					<div class="alert alert-success">
						<button class="close" data-dismiss="alert" type="button">&times;</button>
						<?php 
							if($alert === 1){
								$altmessage ="Basic Registration information stored successfully";
							}
							echo $altmessage;
						?>
					</div>
			<?php }?>
			
			<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll">
			<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>
					<div class="hero-unit">
						<div class="control-group">
							<div class="span2">You Can</div>
							<div class="span10">								
									<a class="btn btn-primary" href="<?php echo base_url();?>fblogin/importprofile"><?php echo img('images/extras/fb.png');?>Import from Facebook</a> or 
									<a class="btn btn-primary" href="#"><?php echo img('images/extras/linkedin.png');?>Import from Linkedin</a> 
							</div>
						</div>					
					</div>
						<div id="profile" class="defaulttheme rounded">
						
							<div id="education" class="hero-unit">
										<h2 class="rounded">Education</h2>
										<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div> 
										<a href="" class="btn btn-primary">Add Education</a>
							</div>
												
							<div id="experience"  class="hero-unit">
										<h2 class="rounded">Experience</h2>
										<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
										<a href="" class="btn btn-primary">Add Experience</a>
							</div>
							
							<div id="skills"  class="hero-unit">
										<h2 class="rounded">Skills</h2>
										<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
										<a href="" class="btn btn-primary">Add Skills</a>
							</div>				
							<!-- <div class="form-actions">-->
								
								
							<!-- </div> -->
						</div>				
						<input class="btn btn-primary" type="submit" id="user_next" value="Next">
					
                </fieldset>
             <form>				
			 </div>			  
		</div>		
	</div>	
</div>



<script>	
	$(document).ready(function(){	
		loadAll();
		$("#user_next").click(function(event) {
			//alert ("Register");
			var data = getFormData();

			//validation
			if (validateform(data)) {
				// post here
				
				var postUrl = "<?php echo base_url()?>aboutyou/credentials_save";
				
			   $.ajax({
						 type: "POST",
						 url: postUrl,
						 dataType: 'json',
						 data:  { request : JSON.stringify(data)  } ,
						 
						 success: function(response, status){
							 

								if (response.error) {
									// error returned
									
									$("#credentialerror").html(response.error.message);
								} else {		                        
									 var signinurl = "<?php echo base_url();?>aboutyou/services";
									 window.location.href = signinurl;
								}
						 },
						 error: function(response) {
							alert("Error: " + response.message + " code : " + response.code);
						 }
				 });
			} 

			return false;
				
		});
	});
    function getFormData() {
		return;
    }
	function validateform(data) {

	    var valid = true;
	    return valid;   
    }
</script>
<script>     
	$('#navbar').scrollspy()
	function loadAll() {
		//loadAndShowBio($("#bio"));
		loadAndShowEdu($("#education"));
		loadAndShowExp($("#experience"));
		loadAndShowSkills($("#skills"));
		//loadAndShowReference($("#reference"));
		//loadAndShowContact($("#contact"));
	}
</script>
<script src="<?php echo base_url();?>js/bio.js"></script>
<script src="<?php echo base_url();?>js/education.js"></script>
<script src="<?php echo base_url();?>js/experience.js"></script>
<script src="<?php echo base_url();?>js/skills.js"></script>
<script src="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.js"></script>
<script src="<?php echo base_url();?>lib/allrating/js/jquery.allRating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/allrating/css/allrating.css" />
<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />
