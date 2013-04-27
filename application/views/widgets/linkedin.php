<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Toung</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/profile.css">
</head>
<body>

<div class="span5">
<?php $account = $this->data['account'];?>	
<div>
	<div class="span2"><?php echo ucwords($account->firstname);?></div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li class="active" class="dropdown" id="menu1">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#menu1"><?php echo ucwords($account->firstname);?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">View Profile</a></li>
								<li><a href="#">Edit Profile</a></li>	
								<li><a href="#">Settings</a></li>	
								<li><a href="#">Log Out</a></li>									
							</ul>
					</li>
				</ul>
			</div>
		</div>				
	</div>
</div>	
	

<script type="text/javascript">

$("#searchuser").click(function(event) {
		//alert ("Register");
	    var data = getFormData();

	    //validation
	    if (validateform(data)) {
	        // post here
			
	        var postUrl = "<?php echo base_url()?>account/search_user";
			
	       $.ajax({
	                 type: "POST",
	                 url: postUrl,
	                 dataType: 'json',
	                 data:  { request : JSON.stringify(data)  } ,
					 
	                 success: function(response, status){
						 

							if (response.error) {
								// error returned
								
								//$("#signuperror").html(response.error.message);
							} else {		                        
		                        // var signinurl = "<?php echo base_url();?>aboutyou/credential";
								alert("searched:");
		                     	window.location.href = signinurl;
		                    }
	                 },
	                 error: function(response) {
						//alert("Error: " + response.message + " code : " + response.code);
	                 }
	         });
	    } 

	    return false;
			
	});
	
	function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	    var account = { 
	    	'account' : {
		        'username' : $("#username").val()
		    }
	    };
		
	    return account;
    }

    function validateform(data) {

	    var valid = true;
	
//	    if (isEmpty(data.account.password)) {
//	        $("#passworderror").html("Password is required");
//	        $("#password").addClass("inputerror");
//	        valid=false;
//	    } else {
//	        $("#passworderror").html("");
//	    }
//	
//	    if (! validateEmail(data.account.email)) {
//	        $("#emailerror").html("A valid email is required");
//	        $("#email").addClass("inputerror");
//	        valid=false;
//	    } else {
//	        $("#emailerror").html("");
//	    }
//	
	    return valid;   
    }
</script>