<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<script>
    var config = initApp("<?php echo base_url(); ?>")();
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>lib/jquery.tokeninput.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
	

	$("#user_next").click(function(event) {
		//alert ("Register");
	    var data = getFormData();

	    //validation
	    if (validateform(data)) {
	        // post here
			
	        var postUrl = "<?php echo base_url()?>aboutyou/credentials_save";
			
	       $.ajax({
	                 type: "POST",
	                 url: postUrl,
	                 dataType: 'json',
	                 data:  { request : JSON.stringify(data)  } ,
					 
	                 success: function(response, status){
						 

							if (response.error) {
								// error returned
								
								$("#signuperror").html(response.error.message);
							} else {		                        
		                         var signinurl = "<?php echo base_url();?>aboutyou/services";
		                     	 window.location.href = signinurl;
		                    }
	                 },
	                 error: function(response) {
						alert("Error: " + response.message + " code : " + response.code);
	                 }
	         });
	    } 

	    return false;
			
	});

    function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	    /*
		var account = { 
	    	'account' : {
		        'city' : $("#user_location").val(),
		        'headline' : $("#user_headline").val(),
		        'tags' : $("#user_tags").val(),
		        'bio' : $("#user_bio").val(),
		        'picture' : $("#user_picture").val()
		    }
	    };*/
		
	    //return account;
		return;
    }

	
	
</script>

</head>
<body>
<script>
	protectedPage();
</script>

<div id="container" >

	
				<div id="profile" class="defaulttheme rounded">
				<form method="post">	
					<div class="panes" id="edit">
					<div id ="" class="section box600">
						<h2 class="rounded">You Can </h2>
						<a href="<?php echo base_url();?>facebook/fblogin/importprofile">Import From Facebook </a>


					</div>
					
					
					<div id="education" class="section box600">
								<h2 class="rounded">Education</h2>
								<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>  	
					</div>
	                        			
	              	<div id="experience" class="section box600">
								<h2 class="rounded">Experience</h2>
								<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
					</div>
					
					<div id="skills" class="section box600">>
								<h2 class="rounded">Skills</h2>
								<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
					</div>
					
					<div class="form-actions">
						<label for="user_next"></label>
						<input type="submit" id="user_next" name="Save" value="Next"/>
					</div>
					
				</form>
				</div>
				<div class="spacer"></div>
			</div>
			


</div>


<script src="<?php echo base_url();?>js/education.js"></script>
<script src="<?php echo base_url();?>js/experience.js"></script>
<script src="<?php echo base_url();?>js/skills.js"></script>
<script src="<?php echo base_url();?>js/reference.js"></script>
<script src="<?php echo base_url();?>js/contact.js"></script>
<!--<script src="<?php echo base_url();?>js/bio.js"></script>-->
<script src="<?php echo base_url();?>js/socialids.js"></script>
<script src="<?php echo base_url();?>js/fbln.js"></script>
<script src="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.js"></script>

<script src="<?php echo base_url();?>lib/allrating/js/jquery.allRating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/allrating/css/allrating.css" />


<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />

</form>
</body>
</html>