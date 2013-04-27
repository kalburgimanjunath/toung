<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CredMine</title>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home2.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.css"/>
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico.png">
<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script src="<?php echo base_url();?>lib/jquery-1.5.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/common.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/login.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/widget.js" type="text/javascript"></script>

<script>
    var config = initApp("<?php echo base_url(); ?>")();
</script>


<div id="fb-root"></div>
<script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $this->fbconfig['appId'];?>', status: true, cookie: true, xfbml: true,oauth: true});
 
                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response

                    login();					
					document.location.href = "<?php echo base_url(); ?>facebook/fblogin/loginpost";
                });
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });
 
                FB.getLoginStatus(function(response) {
                    if (response.session) {
                        // logged in and connected user, someone you know
                        login();
                    }
                });
            };
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());
 
            function login(){
                FB.api('/me', function(response) {
					
                    document.getElementById('login').style.display = "block";
                   
                    //document.getElementById('login').innerHTML = response.name + " succsessfully logged in!";
                });
            }
            function logout(){
                document.getElementById('login').style.display = "none";
            }
 
            //stream publish method
            function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
                FB.ui(
                {
                    method: 'stream.publish',
                    message: '',
                    attachment: {
                        name: name,
                        caption: '',
                        description: (description),
                        href: hrefLink
                    },
                    action_links: [
                        { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) {
 
                });
 
            }
            
 
            function setStatus(){
                status1 = document.getElementById('status').value;
                FB.api(
                  {
                    method: 'status.set',
                    status: status1
                  },
                  function(response) {
                    if (response == 0){
                        alert('Your facebook status not updated. Give Status Update Permission.');
                    }
                    else{
                        alert('Your facebook status updated');
                    }
                  }
                );
           
            }
           
        </script>	
		
</head>

<body>	
<div class="row-fluid">
	<div class="span2"></div>
	<div class="span4"></div>
	<div class="span4">
		<form id="signin_form" method="post" class="signin_form" name="signin_form">		
					<fieldset>						
						<input id="email" style="vertical-align:bottom;" class="text" type="email" placeholder="Email">							
						<?php echo img('images/extras/fb.png');?>
						<?php echo img('images/extras/linkedin.png');?>
					</fieldset>	
					<fieldset>						
						<input id="password" style="vertical-align:bottom;" class="text" type="password" placeholder="Password">
						<input type="submit" id="login_submit" value="Sign In" class="btn btn-primary" href="" name="login">
					</fieldset>
					
		</form>
	</div>
	<div class="span12"></div>
	<div class="span2"></div>
	
	<div class="span4">
		<?php echo img('images/logos/small.png');?>
		<?php echo img('images/signup-graphics/home.png');?>		
	</div>
	<div class="span4">
		<strong>Build the perfect resume today<strong>
	</div>
	<div class="span4">
		<form id="signup_form" method="post" class="registration_form" name="signup_form">
					<fieldset>						
						<input id="user_name" type="text" placeholder="Full Name">						
					</fieldset>	
					<fieldset>						
						<input id="user_email" type="email" placeholder="Email">						
					</fieldset>
					<fieldset>						
						<input id="user_screename" class="username" type="text" >
						<div class="url_hint">credmine.com/</div>
					</fieldset>
					<fieldset>						
						<input id="user_password" type="password" placeholder="Password">
					</fieldset>					
					<fieldset>						
						<input type="submit" id="register_submit" class="btn btn-primary" value="Resume me " href="" name="login">						
					</fieldset>
									
		</form>
	</div>	
	<div class="span12"></div>
	
	<div class="span2"></div>
	<div class="span4">Wait I am an Organization / Employer</div>
	<div class="span4">
		<fieldset>					
			<fb:login-button autologoutlink="true" class="btn btn-primary" scope="email,user_birthday,status_update,publish_stream">Sign Up With Facebook</fb:login-button>					
		</fieldset>	
		<fieldset>	
			<script type="IN/Login"></script>
			
			<script type="text/javascript" src="http://platform.linkedin.com/in.js">
			  api_key: h44vvpbkitnq
			  authorize: true
			</script>

			<script type="text/javascript">
			function onLinkedInAuth() {
			  IN.API.Profile("me")
				.result( function(me) {
				  var id = me.values[0].id;
				 
				  // AJAX call to pass back id to your server
				});
			}
			</script>
		
		</fieldset>
	
	
	</div>
	<div class="span12"></div>
	<div class="span6"></div>
	
	<div class="span12"></div>
	
	<div class="span2"></div>
	<div class="span2"><?php echo img('images/extras/twitter.png');?></div>
	
	<div class="span6">
		<ul class="footernav">
			<li><a href="<?php echo base_url();?>home/about">Home</a></li>
			<li><a href="<?php echo base_url();?>home/about">About</a></li>
			<li><a href="<?php echo base_url();?>home/about">Contact</a></li>
			<li><a href="">Blog</a></li>
			<li><a href="<?php echo base_url();?>home/about">Tems</a></li>
			<li><a href="<?php echo base_url();?>home/privacy">Privacy</a></li>
		</ul>
	</div>
		
	<div>
</div>


<script>
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
</script>

</body> 
</html>
