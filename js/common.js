function initApp(baseurl) {
		var Config = {};
		Config.url = {};
		Config.api = {};
		Config.api.edu = {};
		Config.api.exp = {};
		Config.api.ref = {};
		Config.api.ski = {};
		Config.api.social = {};
		Config.api.aboutme = {};
		Config.api.user = {};
        Config.api.user.account = {};
		Config.api.reference = {} ;
		
		Config.page = {};

		Config.url.base = (baseurl?baseurl:"/");
		
		Config.url.credmineUrl = Config.url.base + "credmine";
		Config.api.user.signup = Config.url.base + "user/signup";
		Config.api.user.signin = Config.url.base + "user/signin"; 
		Config.api.user.logincheck = Config.url.base + "user/validate/isLoggedIn";
		Config.api.user.idexists = Config.url.base + "user/validate/existsUserid";
		Config.api.user.emailexists = Config.url.base + "user/validate/existsEmail";
		Config.api.user.account.get = Config.url.base + "user/account/get";
		Config.api.user.account.save = Config.url.base + "user/update";

		Config.api.aboutme.get = Config.url.base + "user/aboutme/get";
		Config.api.aboutme.update = Config.url.base + "user/aboutme/update";

		Config.api.edu.get = Config.url.base + "user/education/get";
		Config.api.edu.insert = Config.url.base + "user/education/insert";
		Config.api.edu.remove = Config.url.base + "user/education/delete";
		Config.api.edu.save = Config.url.base + "user/education/save";

		Config.api.exp.get = Config.url.base + "user/experience/get";
		Config.api.exp.insert = Config.url.base + "user/experience/insert";
		Config.api.exp.remove = Config.url.base + "user/experience/delete";
		Config.api.exp.save = Config.url.base + "user/experience/save";
		
		Config.api.ref.get = Config.url.base + "user/reference/get";
		Config.api.ref.insert = Config.url.base + "user/reference/insert";
		Config.api.ref.remove = Config.url.base + "user/reference/delete";
		Config.api.ref.save = Config.url.base + "user/reference/save";

		Config.api.ski.get = Config.url.base + "user/skills/get";
		Config.api.ski.insert = Config.url.base + "user/skills/insert";
		Config.api.ski.remove = Config.url.base + "user/skills/delete";
		Config.api.ski.save = Config.url.base + "user/skills/save";
		
		Config.api.social.get = Config.url.base + "user/socialids/get";
		Config.api.social.insert = Config.url.base + "user/socialids/insert";
		Config.api.social.remove = Config.url.base + "user/socialids/delete";
		Config.api.social.save = Config.url.base + "user/socialids/save";
		
		Config.page.signin = Config.url.base + "home/signin";
		Config.page.signup = Config.url.base + "home/signup";
		//Config.page.signedup = Config.url.base + "home/signedup";
		Config.page.signedup = Config.url.base + "aboutyou";
		
		Config.page.profile = Config.url.base + "home/profile";
		Config.page.profile_edu = Config.url.base + "home/profile#education";
		Config.page.profile_exp = Config.url.base + "home/profile#experience";
		Config.page.profile_ski = Config.url.base + "home/profile#skills";
		Config.page.profile_ref = Config.url.base + "home/profile#reference";
		Config.page.profile_con = Config.url.base + "home/profile#contact";
		

		var config = function() {
			return Config;
		}
		
		return config;
}

function isEmpty( str ) { 
	if ( null == str || "" == str ) { 
		return true; 
	} 
	return false; 
}

function validateEmail(elementValue){ 
	if (isEmpty(elementValue)) return false;
	 
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
    return emailPattern.test(elementValue);  
}  

function protectedPage() {
	
	var postUrl = config.url.base + 'user/validate/isLoggedIn';

	$.ajax({
		type: "POST",
		url: postUrl,
		dataType: 'json',
		data:  {} ,
		success: function(response, status){
			if (response.error) {
				// error returned
				alert("Error checking user login : " + response.error.message);
			} else {
				if (response.data == false) {
					// not logged in, redirect user
					document.body.innerHTML = '<div class="redirector">You must be logged in to access this page. Redirecting to Sign In page...</div>';
					$.jGrowl("You must be logged in to access this page. Redirecting to Sign In page...");
					redirectToLogin();
				}		         
		    }
		},
		error: function(response) {
			alert("Error: " + response.message + " code : " + response.code);
		}
	});
}

function showLogin() {
	var emailfield = $("#loginform").find("#email");
	var cookemail = getCookie("email");
	if ( isEmpty(cookemail) ) {
		// email not present in the cookie. Cannot allow user to login here, redirect them to the login page
		redirectToLogin(window.location.href);
	} else {
		// set the email value and disable it and show the login form
		emailfield.val(cookemail);
		emailfield.attr("disabled", "disabled");
		
		$("#loginform").modal({
			close:false,
			overlayCss: {background:"#000"},
			containerCss: {background: "#fff", padding:"2px", border:"2px solid #00aeef"},
			onShow: function(dialog) {
				$("#loginerror").html("");
				$("#loginbutton").click(function() {
					performLogin();
					return false;
				});			
			}
		});
	}
}

function redirectToLogin(urltogo) {
	$.jGrowl("Your session has timed out. Please login to continue.");

	var return_url = window.location.href;
	if (urltogo) { 
		return_url = urltogo;
	}
	var login_url = config.page.signin + "?return_url=" + return_url;
	console.log("Redirecting to "  + login_url);
	window.location.href = login_url;
}

function emailExists(email) {
	var postUrl = config.api.user.emailexists; 

	var exists = false;

    var account = { 
    	'account' : {
	        'email' : email
		}
    };

	$.ajax({
		type: "POST",
		async: false,
		url: postUrl,
		dataType: 'json',
		data:  { request : JSON.stringify(account) } ,
		success: function(response, status){
			exists = response.data;
		},
		error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
		}
	});
	
	return exists;
}


function useridExists(userid) {
	var postUrl = config.api.user.idexists; 

	var exists = false;

    var account = { 
    	'account' : {
	        'userid' : userid
		}
    };

	$.ajax({
		type: "POST",
		async: false,
		url: postUrl,
		dataType: 'json',
		data:  { request : JSON.stringify(account) } ,
		success: function(response, status){
			exists = response.data;
		},
		error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
		}
	});
	
	return exists;
}


function passwordStrength(pwdId, strengthId) {
	$(pwdId).keyup(function(e) {
	     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
	     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
	     if (false == enoughRegex.test($(this).val())) {
	             $(strengthId).html('More Characters');
	     } else if (strongRegex.test($(this).val())) {
	             $(strengthId).className = 'ok';
	             $(strengthId).html('Strong!');
	     } else if (mediumRegex.test($(this).val())) {
	             $(strengthId).className = 'alert';
	             $(strengthId).html('Medium!');
	     } else {
	             $(strengthId).className = 'error';
	             $(strengthId).html('Weak!');
	     }
	     return true;
	});
}


function getYearOptions(year) {
	var currentYear = new Date().getFullYear();
	if (year <= 0) 
		year = currentYear;
		
	var oldestYear = currentYear - 40;
	var selectstr = ''; 
	for (var i=currentYear; i > oldestYear; i-- ) {
		selectstr += '<option value="' + i;
		selectstr += ((i==year)?'" selected':'"');
		selectstr += '>' + i + '</option>';
	}	
	return selectstr;
}

function getMonthOptions(month) {
	var selectstr = ''; 
	var currentMonth = new Date().getMonth() + 1;

	if (month <= 0 )
		month = currentMonth;
		
	for (var i=1; i<=12; i++) {
		if (i < 10) 
			monthstr = '0' + i;
		else 
			monthstr = '' + i;
		selectstr += '<option value="' + monthstr + (i==month?'" selected':'"') + '>' + getMonthName(i) + '</option>';
	}
	return selectstr;
}

function getMonthName(month) {
	var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	if (month < 0)
		month = 1;
	month--;
	return months[month];
}

function getRatingOptions (rating) {
	var selectstr = '';
	selectstr += '<option value=1' + (rating ==1? ' selected':'') + '>' + getRatingName(1) + '</option>';
	selectstr += '<option value=2' + (rating ==2? ' selected':'') + '>' + getRatingName(2) + '</option>';
	selectstr += '<option value=3' + (rating ==3? ' selected':'') + '>' + getRatingName(3) + '</option>';
	selectstr += '<option value=4' + (rating ==4? ' selected':'') + '>' + getRatingName(4) + '</option>';
	selectstr += '<option value=5' + (rating ==5? ' selected':'') + '>' + getRatingName(5) + '</option>';
	return selectstr;
}

function getSocialNetworkOptions(networkname) {
	var selectstr = '';
	selectstr += '<option value=Facebook' + (networkname == 'Facebook'? ' selected':'') + '>' + 'Facebook' + '</option>';
	selectstr += '<option value=LinkedIn' + (networkname == 'LinkedIn'? ' selected':'') + '>' + 'LinkedIn' + '</option>';
	selectstr += '<option value=MySpace' + (networkname == 'MySpace'? ' selected':'') + '>' + 'MySpace' + '</option>';
	return selectstr;
}

function getRatingName(rating) {
	if (rating == 1) return "Novice";
	if (rating == 2) return "Beginner";
	if (rating == 3) return "Intermediate";
	if (rating == 4) return "Advanced";
	if (rating == 5) return "Guru";
	return "Unrated";
}

function popitup(url) {
	newwindow=window.open(url,'Linkedin','height=330,width=600');
	if (window.focus) {newwindow.focus()}
	return false;
}


jQuery.fn.fadeToggle = function(speed, easing, callback) {
    return this.animate({opacity: 'toggle'}, speed, easing, callback);  
};


