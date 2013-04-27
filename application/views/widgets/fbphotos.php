<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-alert.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/docs.css" type="text/CSS"></script>
<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll" >
<?php
	//$this->load->model('connections_model');
				
	//$connections = $this->connections_model->getMyConnections($account->userid);	
	//if(empty($connections)){
	//	echo "<div class='alert fade in'>Empty Connections</div>";
	//}else{
	//foreach($connections as $connection){
?>


<div class="span12">
	<div class="span12"></div>
    <div class="row-fluid">
	

		
		<?php

$sApplicationId = $this->config->config['facebook_api_key'];
$sApplicationSecret = $this->config->config['facebook_secret_key'];
$iLimit = 99;

?>
    
	
      <div id="photos"></div>
        <div id="fb-root"></div>

        <script>
        function sortMethod(a, b) {
            var x = a.name.toLowerCase();
            var y = b.name.toLowerCase();
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
        }
			window.fbAsyncInit = function() {
            FB.init({ appId: "<?php echo $this->config->config['facebook_api_key'] ?>",
                status: true,
                cookie: true,
                xfbml: true,
                oauth: true
            });
       
			
					
			
            function updateButton(response) {
                var button = document.getElementById('fb-auth');
				
				
                if (response.authResponse) { // in case if we are logged in
                    var userInfo = document.getElementById('user-info');
					
			
					FB.api('/me/albums?fields=id,name', function(response) {
					  for (var i=0; i<response.data.length; i++) {
						var album = response.data[i];
						if (album.name == 'Profile Pictures'){

						  FB.api('/'+album.id+'/photos', function(photos){
							if (photos && photos.data && photos.data.length){
							  for (var j=0; j<photos.data.length; j++){
								var photo = photos.data[j];
								// photo.picture contain the link to picture
								
								
								
								htmlcontent='<img src='+ photo.picture +'> width=100 height=100 />';  
								$("#photos").append(htmlcontent);  
							  }
							}
						  });

						  break;
						}
					  }
					});

                    button.onclick = function() {
                        FB.logout(function(response) {
                            window.location.reload();
                        });
                    };
                } else { // otherwise - dispay login button
                    button.onclick = function() {
                        FB.login(function(response) {
                            if (response.authResponse) {
                                window.location.reload();
                            }
                        }, {scope:'email'});
                    }
                }
            }

            // run once with current status and whenever the status changes
            FB.getLoginStatus(updateButton);
            FB.Event.subscribe('auth.statusChange', updateButton);
        };

        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
        </script>
		

    
	</div>
</div>
<?php		//}
		//}
?>
</div>
<script>
$('#navbar').scrollspy()
</script>