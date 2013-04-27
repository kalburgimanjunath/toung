<?php
	$this->load->model('experience_model');
	$result=$this->experience_model->getMyExperience($account->userid);
	$expObj = $result[0];
	$vardesignation ='';
	if(!empty($expObj->position)){
		$vardesignation = $expObj->position;
		$vardesignation .=' at ';
	}
	if(!empty($expObj->company)){
		$vardesignation .= $expObj->company;
	}
	$address="";
	$address .= (!empty($account->city))?$account->city:'';
	$address .= ', ';
	$address .= (!empty($account->country))?$account->country:'';	
?>

<!--
<div class="span6">
	<p><h1><?php echo $account->fullname;?></h1></p>
	<p><?php echo $vardesignation;?></p>
	<p><div><a href="#" >toung.com/<?php echo $account->userid;?></a></div></p>
	<p><i><?php echo $address;?></i></p>
</div>	
<!--
<div class="span6">	
	<?php $this->load->view('widgets/righttab',$profile); ?>
</div>	
-->
<!--
<div id="fb-root"></div>
<script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $this->config->config['facebook_api_key']?>', status: true, cookie: true, xfbml: true,oauth: true});
 
                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response

                    login();					
					document.location.href = "<?php echo base_url(); ?>dashboard";
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
			
			function sendRequestViaMultiFriendSelector() {
			  FB.ui({method: 'apprequests',
				message: 'My Great Request',
			  }, requestCallback);
			}
			
			function requestCallback(response) {
				// Handle callback here
			  }
           
        </script>	
-->

	