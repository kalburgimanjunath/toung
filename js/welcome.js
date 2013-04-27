$(document).ready(function(){
	$("#user_name").keyup(function (event) {
		$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
	});
		
	$("#user_name").blur(function () {
		$("#user_screename").val($("#user_name").val().replace(/ /g,"").toLowerCase());
	});
	
	$(".login_fade").click(function(event) {
		event.preventDefault();
		loginfade();
		return false;
	});
	
	loginfade();
	
	$("#login_submit").click(function(event) {
		event.preventDefault();
		submitLogin();
		return false;
	});

	$("#register_submit").click(function(event) {
		event.preventDefault();
		registerAccount();
		return false;
	});
});

function onLinkedInAuth() {
	popitup('linkedinstuff/linkedinpost');
}
