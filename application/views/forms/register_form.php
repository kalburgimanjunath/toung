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
  <table class="columns" cellspacing="0">
    <tbody>
      <tr>
        <td id="content"><div class="wrapper">
            <div class="content_header"> <span style=" text-align:right; font-size:24px; color:#0099FF;"><b>Your Resume Starts Here.</b></span> </div>
            <div id="signup_form">
              <form method="post" action="">
                <fieldset>
                <table>
                  <tbody>
                  
                    <tr class="full-name">
                      <th><label for="user_name">Full Name</label></th>
                      <td class="col-field" id="field"><input id="user_name" class="text_field" type="text" tabindex="1" size="20" name="user[name]" maxlength="20" />
                      </td>
                      <td class="col-space"></td>
                    </tr>
                    
                    <tr class="screen-name">
                      <th><label for="user_screen_name">Pick a username</label></th>
                      <td class="col-field" id="field"><input id="user_screen_name" class="text_field" type="text" tabindex="1" size="20" name="user[id]" maxlength="20" />
                      </td>
                      <td class="col-space"></td>
                    </tr>
                    
                    <tr class="email">
                      <th><label for="user_email">Email</label></th>
                      <td class="col-field"><input id="user_email" class="text_field" type="text" tabindex="1" size="20" name="user[email]" maxlength="20" />
                      </td>
                      <td class="col-space"></td>
                    </tr>

                    <tr class="password">
                      <th><label for="user_password">Password</label></th>
                      <td class="col-field"><input id="user_password" class="text_field" type="password" tabindex="1" size="20" name="user[password]" maxlength="20" />
                      </td>
                      <td class="col-space"></td>
                    </tr>
                    
                    <tr class="password">
                      <th><label for="user_password_conf">Confirm password</label></th>
                      <td class="col-field"><input id="user_password_conf" class="text_field" type="password" tabindex="1" size="20" name="user[passconf]" maxlength="20" />
                      </td>
                      <td class="col-space"></td>
                    </tr>

                    
                    <tr>
                      <th><label for="tos"></label></th>
                      <td class="col-field" colspan="2">
						<div class="agreeterms">By clicking on the button below, you are agreeing to the Terms of Service and our Privacy Policy.</div>
					  </td>
                    </tr>
                    
                    <tr><th></th>
                    <td>
                    <input id="register_submit" type="submit" class="btn_m" value="Create Account" name="register" />
                    </td>
                    <td></td>
                    </tr>
                  </tbody>
                </table>
                </fieldset>
              </form>
            </div>
          </div></td>
      </tr>
    </tbody>
  </table>
</div>

<script language="javascript" type="text/javascript">
	$(document).ready(function() {		
		$("#user_name, #user_screen_name, #user_password, #user_password_conf, #user_email ").focusin(
			function() {
			    $(this).css("border-color", "#000099");
		    }
		);

		$("#user_name, #user_screen_name, #user_password, #user_password_conf, #user_email ").focusout(
			function() {
			    $(this).css("border-color", "#CCCCCC");
			}
		);

		$("#user_name").inputTip({
            goodText: "Ok!",
            badText: "Can't leave this blank",
            tipText: "Enter your full name",
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

	$("#register_submit").click(function(event) {
		//alert ("Register");
	    var data = getFormData();

	    //validation
	    if (validateform(data)) {
	        // post here
	        var postUrl = "<?php echo base_url()?>user/signup";
	       
	       $.ajax({
	                 type: "POST",
	                 url: postUrl,
	                 dataType: 'json',
	                 data:  { request : JSON.stringify(data)  } ,
	                 success: function(response, status){
							if (response.error) {
								// error returned
								
								$("#signuperror").html(response.error.message);
							} else {
		                         alert("You are now signed up as username " + response.data.userid);
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

    function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	    var account = { 
	    	'account' : {
		        'email' : $("#user_email").val(),
		        'password' : $("#user_password").val(),
		        'passconf' : $("#user_password_conf").val(),
		        'fullname' : $("#user_name").val(),
		        'userid' : $("#user_screen_name").val()
		    }
	    };
	
	    return account;
    }

    function validateform(data) {

	    var valid = true;
	
//	    if (isEmpty(data.account.password)) {
//	        $("#passworderror").html("Password is required");
//	        $("#password").addClass("inputerror");
//	        valid=false;
//	    } else {
//	        $("#passworderror").html("");
//	    }
//	
//	    if (! validateEmail(data.account.email)) {
//	        $("#emailerror").html("A valid email is required");
//	        $("#email").addClass("inputerror");
//	        valid=false;
//	    } else {
//	        $("#emailerror").html("");
//	    }
//	
	    return valid;   
    }
	
	
</script>
