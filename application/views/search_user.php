<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Toung</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/profile.css">
</head>
<body>

<div class="span5">
	
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#user">People</a></li>
		<li><a href="#job">Jobs</a></li>
    </ul>
     
    <div class="tab-content">
		<div class="tab-pane active" id="user">
			<form method="post" class="form-search" action="<?php echo base_url();?>account/search_user">
				<div class="span4">
					<input type="search" name="keyword" id="keyword" size="40" class='search_box' placeholder="Search for people,companies and titles"/>
					<input type="submit" value="Search" class="btn btn-primary"  id="searchuser"/>
				</div>
			</form>
		</div>
		
		<div class="tab-pane" id="job">
			<form method="post" class="form-search" action="<?php echo base_url();?>account/search_user">
				<div class="span4">
					<input type="search" name="keyword" id="keyword" size="40" class='search_box' placeholder="Search job by keyword,title or company"/>
					<input type="submit" value="Search" class="btn btn-primary"  id="searchuser"/>
				</div>
			</form>		
		</div>   
    </div>
     
    <script>
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    })
   
   
	
	
    </script>
</div>
<div class="span12">
	<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-modal.js" type="text/javascript"></script>
	<b>To Do</b> :<a data-toggle="modal" href="#myModal" >Update your professional photo</a>

	<div class="modal hide" id="myModal">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Change Your Professional Photo</h3>
    </div>
    <div class="modal-body">
    <p><input type="file" name="photo" /></p>
    </div>
    <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
    </div>
    </div>
</div>	
<?php //echo img($this->data['profile'][0]->avatar);?>
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