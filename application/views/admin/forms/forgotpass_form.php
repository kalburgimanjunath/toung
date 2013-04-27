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

<title>Cred Mine | Forgot Password</title>
</head>
<body>
<div id="container" class="formcontainer rounded">
  <div id="header_register"></div>
  <table class="columns" cellspacing="0">
    <tbody>
      <tr>
        <td id="content"><div class="wrapper">
            <div class="content_header"> <span style=" text-align:right; font-size:24px; color:#0099FF;"><b>To recover your password enter your email address.</b></span> </div>
            <div id="signup_form">
              <form method="post" action="">
                <fieldset>
                <table>
                  <tbody>                  
                    
                    <tr class="email">
                      <th><label for="user_email">Email</label></th>
                      <td class="col-field"><input id="user_email" class="text_field" type="text" tabindex="1" size="30" name="user[email]" maxlength="30" />
                      </td>
                      <td class="col-space"></td>
                    </tr>                    
                    <tr><th></th>
                    <td>
                    <input id="register_submit" type="submit" class="btn_m" value="Recover Password" name="register" />
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
	        var postUrl = "<?php echo base_url()?>user/forgotpass/post";
		
	       $.ajax({
	                 type: "POST",
	                 url: postUrl,
	                 dataType: 'json',
					 
	                 data:  { request : JSON.stringify(data)  } ,
	                 success: function(response, status){
							if (response.error) {
								// error returned							
								$("#forgoterror").html(response.error.message);
							} else {								
		                         alert("Thank you.. please check your email to reset your Password");
		                         var signinurl = "<?php echo base_url();?>home/signin";
		                     	 window.location.href = signinurl;
		                    }
	                 },
	                 error: function(response) {	
						$.each(response, function(i, val) {
						 //alert(i + " : " + val + "<br/>");
						  //alert("Error: " + response);
						});
						
	                 }
	         });
	    } 

	    return false;
			
	});

    function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	   
		var account = { 
	    	'account' : {
		       'email' : $("#user_email").val()
		    }
	    };
	    return account;
    }
	

    function validateform(data) {

	    var valid = true;		 
	    return valid;   
    }
	
	
</script>
