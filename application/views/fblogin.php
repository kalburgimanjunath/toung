<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CredMine</title>
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
<script src="<?php echo base_url();?>lib/facebook.js" type="text/javascript"></script>

	
</head>

<body>
<form method="post">

<script>
    var config = initApp("<?php echo base_url(); ?>")();
</script>
<div id="fb-root"></div>
<script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $this->config->config['facebook_api_key']?>', status: true, cookie: true, xfbml: true,oauth: true});
 
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
            function showStream(){
                FB.api('/me', function(response) {
                    //console.log(response.id);
                    streamPublish(response.name, 'credmine.com contains geeky stuff', 'hrefTitle', '<?php echo base_url(); ?>facebook1', "Share redmine.com");
                });
            }
 
            function share(){
                var share = {
                    method: 'stream.share',
                    u: 'http://credmine.com/'
                };
 
                FB.ui(share, function(response) { console.log(response); });
            }
 
            function graphStreamPublish(){
                var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial';
                FB.api('/me/feed', 'post', { message: body }, function(response) {
                    if (!response || response.error) {
                        alert('Error occured');
                    } else {
                        alert('Post ID: ' + response.id);
                    }
                });
            }
 
            function fqlQuery(){
                FB.api('/me', function(response) {
                     var query = FB.Data.query('select name, hometown_location, sex, pic_square from user where uid={0}', response.id);
                     query.wait(function(rows) {
 
                       document.getElementById('name').innerHTML =
                         'Your name: ' + rows[0].name + "<br />" +
                         '<img src="' + rows[0].pic_square + '" alt="" />' + "<br />";
                     });
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
		       
 
        <p><fb:login-button autologoutlink="true" perms="email,user_birthday,status_update,publish_stream">Signup Using Facebook</fb:login-button></p>

        <p>
            <a href="#" onclick="showStream(); return false;">Publish Wall Post</a> |
            <a href="#" onclick="share(); return false;">Share With Your Friends</a> |
            <a href="#" onclick="graphStreamPublish(); return false;">Publish Stream Using Graph API</a> 
            <!--<a href="#" onclick="fqlQuery(); return false;">FQL Query Example</a>-->
        </p>

        <textarea id="status" cols="50" rows="5">Write your status here and click 'Status Set Using Legacy Api Call'</textarea>
		<a href="#" onclick="setStatus(); return false;">Set Status</a> 
        <br />
       
       

        <br /><br /><br />
        <div id="login" style ="display:none"></div>
        <div id="name"></div>
 </form>
 
</body> 
</html>
