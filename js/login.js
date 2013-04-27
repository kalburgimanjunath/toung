function loginfade() {
		$("#login_hover").css({"display":"none"});
		$("#login").fadeIn("slow");
}

function submitLogin() {
    var data = getLoginFormData();
	
    //validation
    if (validateLoginFormData(data)) {
    
    	// set cookies
    	setCookie("email", data.account.email);
    	setCookie("rememberme", data.account.rememberme);
    	
        // post here
       var postUrl = config.api.user.signin;
       var profileurl = config.page.profile;
       var signinurl = config.page.signin;
       
       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(data)  },
                 success: function(response, status){
						if (response.error) {
							// error returned
							$("#loginerror").html(response.error.message);
							$.jGrowl(response.error.message);
						} else {
	                         // goto account page
	                         if (config.page.returnUrl) {
	                           window.location.href = config.page.returnUrl;
	                         } else {
	                           window.location.href= profileurl;      
	                         }                                                                                    
	                    }
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
					$.jGrowl("Status: " + xhr.status + " error : " + thrownError);
                 }
         });
    } 

    return false;
}   

// getCookie and setCookie from http://www.w3schools.com/JS/js_cookies.asp
function setCookie(c_name,value)
{
	var exdays = 14;
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
	    {
	    return unescape(y);
	    }
	  }
}

function getLoginFormData() {

    var account = { 
    	'account' : {
	        'email' : $("#email").val(),
	        'password' : $("#password").val(),
    	    'rememberme': (typeof($("rememberme").val()) == 'undefined')?false:true
    	    }
    };

    return account;
}

function validateLoginFormData(data) {

    if (! validateEmail(data.account.email)) {
        $.jGrowl("A valid email is required");
        return false;
    }

    if (isEmpty(data.account.password)) {
        $.jGrowl ("Password is required");
        return false;
    }
    
    return true;
}
	
	
function registerAccount() {

    var data = getRegisterFormData();

    //validation
    if (validateRegisterFormData(data)) {
        // post here
        var postUrl = config.api.user.signup; 
       
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
                           $.jGrowl("Your signup was successful. Please sign in to get started with your resume.");
                           window.location.href= config.page.signedup;      
	                    }
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
					$.jGrowl("Status: " + xhr.status + " error : " + thrownError);
                 }
         });
    } 

    return false;
}   

function getRegisterFormData() {

    var account = { 
    	'account' : {
	        'email' : $('#user_email').val(),
	        'password' : $('#user_password').val(),
	        'passconf' : $('#user_password').val(),
	        'userid' : $('#user_screename').val(),
	        'fullname' : $('#user_name').val(),
    	    }
    };

    return account;
}

function validateRegisterFormData(data) {
	var error = "";
	
    if (! validateEmail(data.account.email)) {
        error += "A valid email is required. <br/>";
    } else {
    	if (useridExists(data.account.userid)) {
        	error += "A user with this email is already registered. <br/>"
        }
    }

    if (isEmpty(data.account.userid)) {
        error += "A unique Toung.com URL name is required. <br/>";        
	} else {	
        if (useridExists(data.account.userid)) {
        	error += "A user with this Toung.com URL already exists. <br/>"
        }
	}

    if (isEmpty(data.account.fullname)) {
        error += "Your name is required. <br/>";
	}
	
    if (isEmpty(data.account.password)) {
        error += "A password is required. <br/>";
    }
    
    if (! isEmpty(error)) {
    	$.jGrowl("Errors during registration. Please correct before proceeding. <br/>" + error, { header: "Registration Errors", sticky: true });
    	return false;
    }
    
    return true;
}


/* Following functions are used by the login popup form. Also see common.js for redirectLogin().
** This is done using SimpleModal plugin */
function performLogin() {
    var data = { 
    	'account' : {
	        'email' : $("#email").val(),
	        'password' : $("#password").val(),
    	    'rememberme': (typeof($("rememberme").val()) == 'undefined')?false:true
    	    }
    };

    //validation
    if (validateLogin(data)) {
        // post here
       var postUrl = config.api.user.signin;
       var profileurl = config.page.profile;
       var signinurl = config.page.signin;
       
       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(data)  },
                 success: function(response, status){
						if (response.error) {
							// error returned
							$("#loginerror").html(response.error.message);
						} else {
							$("#loginerror").html("");
							$("#loginform").hide();
							$.jGrowl("Sign in successful. Carry on...");
							$.modal.close();
	                    }
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
					$.jGrowl("Status: " + xhr.status + " error : " + thrownError);
                 }
         });
    } 

    return false;
}   

function validateLogin(data) {

    if (! validateEmail(data.account.email)) {
        $("#loginerror").html("A valid email is required");
        return false;
    }

    if (isEmpty(data.account.password)) {
        $("#loginerror").html("Password is required");
        return false;
    }
    
    return true;
}
