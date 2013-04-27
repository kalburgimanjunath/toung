<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-type" content="text/html; charset=windows-1250">  
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/credmine.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/footer.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
	<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/register.js" type="text/javascript"></script>
</head>
<body>

<div class="container">
	<div class="row-fluid">
		
		<div class="span8">
			<div id="header_register"></div>
			<div class="content_header"> <span style=" text-align:right; font-size:24px; color:#0099FF;"><b>Your Resume Starts Here.</b></span> </div>
		
			
				<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
					<fieldset>
						<div class="hero-unit">
							<div class="control-group">
								<label class="control-label" for="user_name">Full Name</label>
									<div class="controls">
										<input type="text" class="input-xlarge" tabindex="1" size="20" id="user_name" name="user[name]" maxlength="50">								
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_email">Email</label>
									<div class="controls">								
										<input id="user_email" class="input-xlarge" type="text" tabindex="2" size="20" name="user[email]" maxlength="50"/>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="username">Profile </label>
									<div class="controls">								
										<input id="user_screename" class="username"  size="20" type="text" >
										<div class="url_hint" style="top:-27px;">credmine.com/</div>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_password">Password</label>
									<div class="controls">								
										<input id="user_password" class="input-xlarge" type="password" tabindex="3" size="20" name="user[password]" maxlength="50"/>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_password_conf">Confirm password</label>
									<div class="controls">
										
										<input id="user_password_conf" class="input-xlarge" type="password" tabindex="4" size="20" name="user[passconf]"/>
										<p class="help-block"></p>
									</div>
							</div>
														
						</div> 		
						<input class="btn btn-primary" type="submit" id="user_next" value="Next">	
					</fieldset>
					
				 <form>
			
		</div>
		
		
	</div>
</div>


<script language="javascript" type="text/javascript">
	
	$(document).ready(function() {	
		$("#user_name").keyup(function (event) {
			$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
		});
			
		$("#user_name").blur(function () {
			$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
		});


		$("#user_name").focusin(
			function() {
			    $(this).css("border-color", "#000099");
		    }
		);

		$("#user_name").focusout(
			function() {
			    $(this).css("border-color", "#CCCCCC");
			}
		);
		
		$("#user_name").inputTip({
            goodText: "Ok!",
            badText: "Can't leave this blank",
            tipText: "Enter your location name",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });	
		$("#user_screen_name").inputTip({
            goodText: "Ok!",
            badText: "Use only letters, no spaces",
            tipText: "Pick a unique username",
            validateText: function(inputValue, callback) {
				var userRegexp = /^([a-zA-Z])+$/;
				if (userRegexp.test(inputValue)) callback(1);
				else callback(0);
            },
            validateInRealTime: false
        });

		$("#user_password").inputTip({
            goodText: "Ok!",
            badText: "At least 8 characters",
            tipText: "Pick a unique password",
            validateText: function(inputValue, callback) {
                if (inputValue.length >= 8) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		 $("#user_password_conf").inputTip({
            goodText: "Ok!",
            badText: "At least 8 characters",
            tipText: "Must match password entered above",
            validateText: function(inputValue, callback) {
                if (inputValue.length >= 8) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });

        $("#user_email").inputTip({
            goodText: "Ok!",
            badText: "Please enter a valid email",
            tipText: "Enter your email address",
            validateText: function(inputValue, callback) {
                var emailRegexp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (emailRegexp.test(inputValue)) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		
    });

	$("#user_next").click(function(event) {
		//alert ("Register");
	    var data = getFormData();
		event.preventDefault(); 
	    //validation
	    if (validateform(data)) {
	        // post here
			
	        var postUrl = "<?php echo base_url()?>linkedinstuff/save";
			
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
		                         var signinurl = "<?php echo base_url();?>aboutyou";
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
	//$("#user_location").val(geoplugin_city()+", "+geoplugin_countryName());
    function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	    var account = { 
	    	'account' : {
		        'fullname' : $("#user_name").val(),
				'email' : $("#user_email").val(),		        
		        'password' : $("#user_password").val(),
				'passconf' : $("#user_password_conf").val(),
		    }
	    };
		
	    return account;
    }

    function validateform(data) {

	    var valid = true;	
	    return valid;   
    }
	
	
</script>