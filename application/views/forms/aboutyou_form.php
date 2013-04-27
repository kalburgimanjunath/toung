<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-type" content="text/html; charset=windows-1250">  
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/credmine.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/footer.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/home.css">
	<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/register.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/common.js"></script>
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
	
</head>
<body>
<?php	
	$strLocation='';
	
	$arrBaseLocation = unserialize(file_get_contents('http://www.geoplugin.net/extras/location.gp?ip='.base_url()));	
	$arrLocation = unserialize(file_get_contents('http://www.geoplugin.net/extras/postalcode.gp?ip='.base_url()));
	$currentLocation = array(
		'place'   => $arrLocation['geoplugin_place'],	
		'state'   => $arrBaseLocation['geoplugin_region'],
		'city'    => $arrBaseLocation['geoplugin_place'],
		'pincode' => $arrLocation['geoplugin_postCode'],
	);
	$strLocation = implode($currentLocation,',');		
?>
<script>
	var Config = initApp("<?php echo base_url(); ?>")();
</script>
<div class="container">
	<div class="row-fluid">
		<div class="span4">
		<!--Sidebar content-->
			<?php echo img('images/logos/small.png');?>			
			<?php echo img('images/extras/aboutyou-on.png');?>
			<?php echo img('images/extras/credential-off.png');?>
			<?php echo img('images/extras/finish-off.png');?>
		</div>
		<div class="span8">
			
		<!--Body content-->
			<strong>Ready to create some aweasome resume?</strong>
		
			<p>To get started lets start fill out some basic information about you</p>
			<br/><br/>
				<?php if(!empty($alert)){?>
					<div class="alert alert-success">
						<?php 
							if($alert === 1){
								$altmessage ="Basic Registration information stored successfully";
							}
							echo $altmessage;
						?>
					</div>
				<?php }?>
				<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
					<fieldset>
						<div class="hero-unit">
							<div class="control-group">
								<label class="control-label" for="location">Location</label>
									<div class="controls">
										<input type="text" class="input-xlarge" tabindex="1" size="20" id="user_location" name="user[location]" maxlength="50"  value="<?php echo $strLocation;?>">								
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_headline">Headline</label>
									<div class="controls">								
										<input id="user_headline" class="input-xlarge" type="text" tabindex="2" size="20" name="user[headline]" maxlength="50" placeHolder="Some thing catcy that describes you"/>
										<label class="error" id="headlineerror"></label>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_tags">Tags</label>
									<div class="controls">								
										<input id="user_tags" class="input-xlarge" type="text" tabindex="3" size="20" name="user[tags]" maxlength="50" placeHolder="Eg:Enterpreneour,Student,Designer,Marketer"/>
										<label class="error" id="tagserror"></label>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="user_bio">Short Bio</label>
									<div class="controls">
										
										<textarea id="user_bio" class="input-xlarge" type="text" tabindex="4" rows="4" cols="50" name="user[bio]"></textarea>
										<label class="error" id="bioerror"></label>
										<p class="help-block"></p>
									</div>
							</div>
							
							<div class="control-group">
								
								<label class="control-label" for="user_picture">Picture</label>						
															
								<div class="controls">
									<div class="span2">
										<?php   
											
												if(!empty($social)){
													echo img($social);
												}else{																							
													echo img('images/extras/cam.png');	
												}
										?>
									</div>
									<div class="span6">
										<span>Choose a file to upload</span>
										<input id="user_picture" class="input-xlarge" type="file" tabindex="5" size="" name="user[picture]" maxlength="20" />								
										<p class="help-block"></p>
										
									</div>
									
								</div>
								
							</div>							
						</div> 		
						<input class="btn btn-primary" type="submit" id="user_next" value="Next">	
					</fieldset>
					
				 <form>
			
		</div>
		
		
	</div>
</div>

<script src="<?php echo base_url();?>js/aboutyou_form.js"></script>

<script language="javascript" type="text/javascript">
	
	$(document).ready(function() {	
		


		$("#user_location, #user_headline, #user_tags, #user_bio, #user_picture ").focusin(
			function() {
			    $(this).css("border-color", "#000099");
		    }
		);

		$("#user_location, #user_headline, #user_tags, #user_bio, #user_picture ").focusout(
			function() {
			    $(this).css("border-color", "#CCCCCC");
			}
		);
		
	$("#user_location").inputTip({
            goodText: "Ok!",
            badText: "Can't leave this blank",
            tipText: "Enter your location name",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		
	$("#user_headline").inputTip({
            goodText: "Ok!",
            badText: "Use only letters, no spaces",
            tipText: "Enter your unique headline",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });

		$("#user_tags").inputTip({
            goodText: "Ok!",           
            tipText: "Enter tags",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
        
        $("#user_bio").inputTip({
            goodText: "Ok!",           
            tipText: "Enter your bio information",
            validateText: function(inputValue, callback) {
                if (inputValue.length >= 8) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		/*
        $("#user_picture").inputTip({
            goodText: "Ok!",
            badText: "Please select .jpg,gif,png image",
            tipText: "Enter select an image",
            validateText: function(inputValue, callback) {
                var emailRegexp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (emailRegexp.test(inputValue)) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });*/
		
    });

	$("#user_next").click(function(event) {
		//alert ("Register");
	    var data = getFormData();
		event.preventDefault(); 
	    //validation
	    if (validateform(data)) {
	        // post here
			
	        var postUrl = "<?php echo base_url()?>aboutyou/save";
			
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
		                         var signinurl = "<?php echo base_url();?>aboutyou/credential";
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
	//$("#user_location").val(geoplugin_city()+", "+geoplugin_countryName());
    function getFormData() {

    	//user_name, #user_screen_name, #user_password, #user_email
	    var account = { 
	    	'account' : {
		        'location' : $("#user_location").val(),
		        'headline' : $("#user_headline").val(),
		        'tags' : $("#user_tags").val(),
		        'bio' : $("#user_bio").val(),
		        'userfile' : $("#user_picture").val()
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

