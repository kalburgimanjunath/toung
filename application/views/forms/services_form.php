<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-type" content="text/html; charset=windows-1250">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/credmine.css">
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">

<script src="<?php echo base_url();?>lib/jquery-1.5.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/widget.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/register.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script>

<script>
	var Config = initApp("<?php echo base_url(); ?>")();
</script>
<title>Services Add!</title>
</head>
<body>
<div class="container">
	<div class="span12">&nbsp;</div>
	<div class="row-fluid">
		<div class="span4">		
			<?php echo img('images/logos/small.png');?>		
			<?php echo img('images/extras/aboutyou-off.png');?>
			<?php echo img('images/extras/credential-off.png');?>
			<?php echo img('images/extras/finish-on.png');?>
		</div>
		
		
		<div class="span8">
			<div class="span12">&nbsp;</div>
			
			<p><strong>Almost Done ! </strong></p>
		
			<p>Tie your resume with your other social networks</p>
			<?php if(!empty($alert)){?>
					<div class="alert alert-success">						
						<?php 
							if($alert === 1){
								$altmessage ="Your Credentials stored successfully";
							}
							echo $altmessage;
						?>
					</div>
			<?php }?>
			<form method="post" action="" class="form-horizontal">
                <fieldset>
					<div class="hero-unit">
						<div class="control-group">
							<label class="control-label" for="socnetwork">Social </label>
							<div class="controls">
								<span id="socpic"></span>
								<input id="socnetwork" class="input-xlarge" type="text" tabindex="1" size="30" name="user[socnetwork]" maxlength="30" />
								<label class="error" id="socnetworkerror"></label>
								<p class="help-block"></p>						
								
							</div>
						</div>
						<div class="control-group">
							
							<div class="controls">
								<div class="socialid">
									<ul id="social">
									
										<li><a href="#" class="twitter"><?php echo img('images/signup-graphics/twitter-bird2.png');?></a></li>
										<li><a href="#" class="facebook2"><?php echo img('images/signup-graphics/facebook2.png');?></a></li>
										<li><a href="#" class="linkedin"><?php echo img('images/signup-graphics/linkedin.png');?></a></li>
										<li><a href="#" class="skype"><?php echo img('images/signup-graphics/skype.png');?></a></li>
										<li><a href="#" class="wordpress2"><?php echo img('images/signup-graphics/wordpress2.png');?></a></li>
										<li><a href="#" class="gplus3"><?php echo img('images/signup-graphics/gplus3.png');?></a></li>
										<li><a href="#" class="tumblr2"><?php echo img('images/signup-graphics/tumblr2.png');?></a></li>								
										<li><a href="#" class="forrst2"><?php echo img('images/signup-graphics/forrst2.png');?></a></li>
										<li><a href="#" class="blogger2"><?php echo img('images/signup-graphics/blogger2.png');?></a></li>
										<li><a href="#" class="flickr2"><?php echo img('images/signup-graphics/flickr2.png');?></a></li>
										<li><a href="#" class="git2"><?php echo img('images/signup-graphics/git2.png');?></a></li>
										<li><a href="#" class="youtube"><?php echo img('images/signup-graphics/youtube.png');?></a></li>
										<li><a href="#" class="vimeo2"><?php echo img('images/signup-graphics/vimeo2.png');?></a></li>
										<li><a href="#" class="pinterest2"><?php echo img('images/signup-graphics/pinterest2.png');?></a></li>
									</ul>
									

										<input type="hidden" name="socialtype" value="" id="socialtype">									
										<label class="error" id="socialtypeerror"></label>
									</ul>									
								</div>
							</div>
						</div>	
						<div class="control-group">
							<label class="control-label" for="soc_name">Website </label>
							<div class="controls">								
								<input id="soc_name" type="text" tabindex="1" class="input-xlarge" size="20" name="soc_name" maxlength="20"/>
								<label class="error" id="soc_nameerror"></label>
							</div>
						</div>
					</div>               
					<input class="btn btn-primary" type="submit" id="user_next" value="View Profile">		
				</fieldset>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>js/finish_form.js"></script>
<script>
$(document).ready(function() {		
		
	$("input#socnetwork").attr('placeholder','Select a service to add below');
	
	$("#socnetwork, #soc_name, #soc_password, #soc_url, #soc_identity ").focusin(
		function() {
		    $(this).css("border-color", "#000099");
	    }
	);
		
	$("#socnetwork, #soc_name, #soc_password, #soc_url, #soc_identity ").focusout(
		function() {
		    $(this).css("border-color", "#CCCCCC");
		}
	);
		
		
	$("#social li a img").click(function () {
        $("#social li a img").removeClass('socialicon');
        $(this).addClass('socialicon');
    });
		//twitter,facebook2,linkedin,skype,wordpress2,gplus3,tumblr2,forrst2,blogger2,flickr2,git2,youtube,vimeo2,pinterest2
	$("a.twitter").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter twitter username');
		$("#socialtype").val("1");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/twitter-bird2.png' width=20 height=20/>");			
	}); 
		
	$("a.pinterest2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter pinterest username');
		$("#socialtype").val("2");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/pinterest2.png' width=20 height=20/>");
			
	});
		
	$("a.vimeo2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter vimeo username');
		$("#socialtype").val("3");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/vimeo2.png' width=20 height=20/>");
	});
		
	$("a.youtube").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter youtube username');
		$("#socialtype").val("4");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/youtube.png' width=20 height=20/>");
	});
		
	$("a.git2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter git username');
		$("#socialtype").val("5");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/git2.png' width=20 height=20/>");
	});
	
	$("a.blogger2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter blogger username');
		$("#socialtype").val("6");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/blogger2.png' width=20 height=20/>");
	});

	$("a.flickr2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter flickr username');
		$("#socialtype").val("7");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/flickr2.png' width=20 height=20/>");
	});
		
	$("a.forrst2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter forrst username');
		$("#socialtype").val("8");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/forrst2.png' width=20 height=20/>");
	});
		
	$("a.tumblr2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter tumblr username');
		$("#socialtype").val("9");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/tumblr2.png' width=20 height=20/>");
	}); 
		
	$("a.facebook2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter facebook username');
		$("#socialtype").val("10");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/facebook2.png' width=20 height=20/>");
	}); 
		
	$("a.linkedin").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter linkedin username');
		$("#socialtype").val("11");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/linkedin.png' width=20 height=20/>");
	}); 
		
	$("a.wordpress2").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter wordpress username');
		$("#socialtype").val("12");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/wordpress2.png' width=20 height=20/>");
	}); 
	
	$("a.skype").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter skype username');
		$("#socialtype").val("13");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/skype.png' width=20 height=20/>");
	}); 

	$("a.gplus3").click(function(event){
		$("input#socnetwork").attr('placeholder','Enter google plus username');
		$("#socialtype").val("14");
		$("#socpic").html("<img src='<?php echo base_url();?>images/signup-graphics/gplus3.png' width=20 height=20/>");
	}); 
		
	$("#socnetwork").inputTip({
	    goodText: "Ok!",
	    badText: "Can't leave this blank",
	    tipText: "Enter Social network name",
	    validateText: function(inputValue, callback) {
			if (inputValue.length > 0) callback(1);
			else callback(0);
		},
		validateInRealTime: false
	});
			
		
	$("#soc_name").inputTip({
	    goodText: "Ok!",
		badText: "Valid (http://credmine.com)",
	    tipText: "Enter Network URL address",
	    validateText: function(inputValue, callback) {
		var urlRegexp = /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
		if (urlRegexp.test(inputValue)) callback(1);
		else callback(0);
	    },
	    validateInRealTime: false
	});
	
});


$("#user_next").click(function(event) {
    var data = getFormData();

    //validation
    if (validateform(data)) {
    // post here
		var postUrl = "<?php echo base_url()?>aboutyou/finishpost";
	       
	    $.ajax({
	        type: "POST",
	        url: postUrl,
	        dataType: 'json',
	        data:  { request : JSON.stringify(data)  } ,
	        success: function(response, status){
			 
				if (response.error) {
					// error returned
									
					//$("#signuperror").html(response.error.message);
				} else {
				// alert("You are now signed up as username " + response.data.userid);
					var signinurl = "<?php echo base_url();?>dashboard";
					window.location.href = signinurl;
				}
			},
			error: function(response) {
				//alert("Error: " + response.message + " code : " + response.code);
	        }
	    });
	} 

	return false;
			
});

function getFormData() {

    	//user_name, #soc_name, #user_password, #user_email
    var account = { 
    	'account' : {
			'socnetwork' : $("#socnetwork").val(),
			'soc_name' : $("#soc_name").val(),
			'socialtype' : $("#socialtype").val()
		}
	};
	
	return account;
}

function validateform(data) {
    var valid = true;
    if (isEmpty(data.account.socnetwork)) {
		$("#socnetworkerror").html("Enter social network username");
	    $("#socnetwork").addClass("inputerror");
	    valid=false;
	} else {
	    $("#socnetworkerror").html("");
	}
		
	if (isEmpty(data.account.socialtype)) {
		$("#socialtypeerror").html("Select social network icon");
	    $("#socialtype").addClass("inputerror");
	    valid=false;
	} else {
	    $("#socialtypeerror").html("");
	}
		
	if (isEmpty(data.account.soc_name)) {
	    $("#soc_nameerror").html("Enter website url ");
	    $("#soc_name").addClass("inputerror");
	    valid=false;
	} else {
	    $("#socnetworkerror").html("");
	}
		
	return valid;   
}
</script>