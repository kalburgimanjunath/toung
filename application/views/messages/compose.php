<form class="form-horizontal">
	<fieldset>	
		<div class="inbox-item-header">
			<div class="control-group">
				<label class="control-label" for="to">To</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="to" name="to" >					
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="from">From</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="from">					
					</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="subject">Subject</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="subject">					
					</div>
			</div>
		</div>
			<div class="control-group">
				<label class="control-label" for="message">&nbsp;</label>
					<div class="controls">
						<textarea  class="input-xlarge" rows="10" cols="50" id="message" ></textarea>					
					</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit" id="sendmessage">Send</button>			
			</div>
		
    </fieldset>
</form>

<script language="javascript" type="text/javascript">
	
	$(document).ready(function() {	
		


		$("#to, #from, #subject, #message").focusin(
			function() {
			    $(this).css("border-color", "#000099");
		    }
		);

		$("#to, #from, #subject, #message").focusout(
			function() {
			    $(this).css("border-color", "#CCCCCC");
			}
		);
		
	$("#to").inputTip({
            goodText: "Ok!",           
            tipText: "Enter to address",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		
	$("#from").inputTip({
            goodText: "Ok!",
            tipText: "Enter from address",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });

		$("#subject").inputTip({
            goodText: "Ok!",           
            tipText: "Enter subject",
            validateText: function(inputValue, callback) {
                if (inputValue.length > 0) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
        
        $("#message").inputTip({
            goodText: "Ok!",           
            tipText: "Enter your message",
            validateText: function(inputValue, callback) {
                if (inputValue.length >= 8) callback(1);
                else callback(0);
            },
            validateInRealTime: false
        });
		
    });

	$("#sendmessage").click(function(event) {
		//alert ("Register");
	    var data = getFormData();
		event.preventDefault(); 
	    //validation
	    if (validateform(data)) {
	        // post here
			
	        var postUrl = "<?php echo base_url()?>messages/composesave";
			
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
		                         var signinurl = "<?php echo base_url();?>profile/editprofile";
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
	    	'sendmessage' : {
		        'to' : $("#to").val(),
		        'subject' : $("#subject").val(),
		        'message' : $("#message").val(),
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