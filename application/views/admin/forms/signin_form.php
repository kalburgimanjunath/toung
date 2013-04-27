<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/credmine.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/signup.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/footer.css" />


	<script src="<?php echo base_url();?>lib/jquery-1.5.js"></script>
	<script src="<?php echo base_url();?>js/common.js"></script>

	<title>CredMine - Sign In</title>

    <title></title>
</head>

<script>
var config = initApp("<?php echo base_url(); ?>")();

</script>

<body>
<div id="mediumlogo">
</div>

    <div id="signin" class="formcontainer rounded">
        <form id="signin_form" class="signin" method="post" action="" name="signin_form">
            <fieldset>
            <table border="0" cellspacing="0" align="center">
			<tr>
				<th><label for="email">Email</label></th>
                <td><input id="email" size="25" minlength="3" maxlength="30" type="text" class="text_field" value="" name="email"/></td>
            </tr>
            <tr>
                <th></th><td><label class="error" id="emailerror"></label></td>
			</tr>
                
			<tr>
                <th><label for="password">Password</label></th>
                <td><input id="password" size="25" minlength="3" maxlength="25" type="password" class="text_field" value="" name="password" /></td>
            </tr>
            <tr>
                <th></th><td><label class="error" id="passworderror"></label></td>
			</tr>
                
			<tr>
                <th></th>
                <td><input id="rememberme" type="checkbox" value="1" name="rememberme"/>
            	<label id="rememberlabel" class="inline" for="rememberme" style="font-size:12px; color:#999999; ">Remember Me</label></td>
			</tr>
			             
			<tr>
             	<th></th><td><input id="login_submit" class="rounded" type="submit" class="btn_m" value="Log In" name="login"></td>
  			</tr>
  			<tr>
                <th></th><td><label class="error" id="loginerror"></label></td>
			</tr>
			</fieldset>
            </table>
        </form>
    </div>

    <div id="signup" class="formcontainer rounded">
        <form id="signup_form" class="signup rounded" method="post" action="" name="signup_form">
            <fieldset>
			<table border="0" cellspacing="0" align="center">
				<tr>
				<td>
                <label for="signup" style="">Don't have an account?</label> <!--a href="" id="signup_link" style="padding:0px" name="signup_link">Sign Up</a --> 
                <a href="<?php echo base_url();?>home/signup">Sign Up</a>
                </td>
                </tr>
            </table>
            </fieldset>
        </form>
    </div>

    
<script type="text/javascript">
	jQuery(function($){
        var loc = window.location.search.toString();
        var hash = window.location.hash.toString();
        
        //alert("Location = " + loc);
        var returnUrl = loc.slice(loc.indexOf("return_url=") + 11);
		if (!returnUrl || returnUrl === '' || returnUrl == undefined) {
            returnUrl = null;
    	}
    	if (returnUrl && hash) {
	    	config.page.returnUrl = returnUrl + hash;
	    } else {
	    	config.page.returnUrl = null;
	    }
	});

</script>
    
<script type="text/javascript">

$("#login_submit").click(function(event) {

    var data = getFormData();

    //validation
    if (validateform(data)) {
        // post here
        var postUrl = "<?php echo base_url()?>user/signin";
       
       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(data)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							$("#loginerror").html(response.error.message);
						} else {
	                         // goto account page
	                         if (config.page.returnUrl) {
	                           //alert("Redirecting to " + config.page.returnUrl);
	                           window.location.href = config.page.returnUrl;
	                         } else {
	                           window.location.href= config.page.profile;      
	                         }                                                                                    
	                    }
                 },
                 error: function(response) {
					alert("Error: " + response.message + " code : " + response.code);
                 }
         });
    } 

    return false;
    });   

    $("#signup_submit").click(function(event) {

    // take the user to sign up form
        var signupurl = "<?php echo base_url();?>home/signup";
    	window.location.href = config.page.signup;
    });


    function getFormData() {

	    var account = { 
	    	'account' : {
		        'email' : $("#email").val(),
		        'password' : $("#password").val(),
	    	    'rememberme': (typeof($("rememberme").val()) == 'undefined')?false:true
	    	    }
	    };
	
	    return account;
    }

    function validateform(data) {

	    var valid = true;
	
	    if (isEmpty(data.account.password)) {
	        $("#passworderror").html("Password is required");
	        $("#password").addClass("inputerror");
	        valid=false;
	    } else {
	        $("#passworderror").html("");
	    }
	
	    if (! validateEmail(data.account.email)) {
	        $("#emailerror").html("A valid email is required");
	        $("#email").addClass("inputerror");
	        valid=false;
	    } else {
	        $("#emailerror").html("");
	    }
	
	    return valid;   
    }
    
</script>

