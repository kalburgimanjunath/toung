<html lang="en" xmlns:fb="https://www.facebook.com/2008/fbml">
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-alert.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/docs.css" type="text/CSS"></script>
<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll" >
<style>
#result_friends{
	margin:10px;
}
#result_friends li{
	
	position:relative;
	width:30%;
	margin:30px;
}
.userItem{
	background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #BEC0C4;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 2px 2px 1px rgba(0, 0, 0, 0.2);
    margin: 0 20px;
    min-height: 120px;
    overflow: hidden;
    width: 285px;
}
.img120Mask{
	border: 0 none;
    border-radius: 3px 3px 3px 3px;
    display: block;
   
    height: 120px;
    margin: 0 15px 0 0;
    overflow: hidden;
    position: relative;
    text-align: center;
    width: 120px;
	display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.userItem img{
	width:120px;
	height:120px;
	position:relative;
}
.userListBd{
	height: 85px;
    overflow: hidden;
    padding: 5px 5px 0 0;
	float:right;

}
.webfont{
	font-size: 18px;
    margin: 0 0 5px;
}
.headline{
	color: #8C8F95;
    font-size: 12px;
    margin: 0 0 5px;
}
.img120MaskInner{
	width:120px;
}
.img120MaskInner a img{
	width: 150px;
	background-color: #cccccc;
	border: 1px solid #999999;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	padding: 15px 15px 15px 15px;
}
#profile-pic div img{
	WW
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	background-color:#ffbbbb;
}
</style>
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
	<div class="span12">Connections:<span id="countConnection"></span></div>
		<div class="span8">
		
		
		<?php

$sApplicationId = $this->config->config['facebook_api_key'];
$sApplicationSecret = $this->config->config['facebook_secret_key'];
$iLimit = 99;

?>
    
	
        <ul id="result_friends"></ul>
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
					var countFriends=0;
			
					
					
					
                    FB.api('/me/friends', function(response) {
                        //userInfo.innerHTML = '<li><div class="userItem"><div class="img120MaskOuter"><div class="img120MaskInner"><img src="https://graph.facebook.com/' + friend_data[i].id + '/picture?height=200&width=200"></div><div class="userListBd"><p class="webfont">' + response.id + '</p><p class="headline">' + response.name + '</p></div></div></div></li>';
						//userInfo.innerHTML = '<div class="span12" id="profile-pic"><div class="span6"><img src="https://graph.facebook.com/' + response.id + '/picture?height=150&width=150"></div><div class="span6"><p class="webfont">' + response.id + '</p><p class="headline">' + response.name + '</p></div></div>	';
                        //button.innerHTML = 'Logout';
                    });
					
                    FB.api('/me/friends?limit=<?= $iLimit ?>', function(response) {
                        var result_holder = document.getElementById('result_friends');
                        var friend_data = response.data.sort(sortMethod);

                        var results = '';
						var test = '';
                        for (var i = 0; i < friend_data.length; i++) {
							var work =  friend_data[i];
							
                            results += '<div class="span12" id="profile-pic"><div class="span6"><img src="https://graph.facebook.com/' + friend_data[i].id + '/picture?height=150&width=150"></div><div class="span6"><p class="webfont">' + friend_data[i].name + '</p><p id="headline"></p></div></div>';							
						}
                        result_holder.innerHTML = results;
                    });
					
					FB.api('/me/friends', function(response) {
						var friend_data = response.data.sort(sortMethod);
                        countFriends = response.data.length;
						htmlcontent=countFriends; 
						$("#countConnection").append(htmlcontent); 
						
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
		<!--
		<div class="span6">
			<div class="span12"><b><?php //echo $connection->fname.$connection->lname;?></b><br/>
			<i><?php //echo $connection->headline;?></i><br/>
			<b><a href="<?php //echo $connection->profile_url;?>" target="blank">View Profile</a></b></div>
		</div>
		<div class="span2">
			    <div class="btn-group">
				<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
				Message
				<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
				
					<li><a>Invite</a></li>
					<li><a>View Connections</a></li>
					<li><a>Share Profile</a></li>
					
				</ul>
				</div>
		</div>
		//-->
    
	</div>
</div>
<?php		//}
		//}
?>
</div>
<script>
$('#navbar').scrollspy()
</script>