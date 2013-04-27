
<div class="info">

	<form id="myinfo_form" method="get" action=""> 
		<div class="formtitle">My Information</div>
		
		<label for="fullname">Full Name</label>
		<input id="fullname" size="25" maxlength="25" minlength="2" type="text" name="fullname" class="required" title="Full Name" placeholder="Full name"/>
			
		<label for="email">Email</label>
		<input id="email" size="50" maxlength="50" type="text" name="email" class="required email" title="Email" placeholder="Email"/>
		
		<label for="streetaddress1">Street Address</label>
		<input id="streetaddress1" size="80" maxlength="80" type="text" name="streetaddress1" title="Street Address" placeholder="Street Address"/>
		
		<label for="streetaddress2">Street Address (continued)</label>
		<input id="streetaddress2" size="80" maxlength="80" type="text" name="streetaddress2" title="Street Address" placeholder="Street Address"/>
		
		<label for="city">City</label>
		<input id="city" size="25" maxlength="25" type="text" name="city" title="City" placeholder="City"/>
		
		<label for="state">State</label>
		<input id="state" size="25" maxlength="25" type="text" name="state" title="State" placeholder="State"/>
		
		<label for="country">Country</label>
		<input id="country" size="25" maxlength="25" type="text" name="country" title="Country" placeholder="Country"/>
		
		<label for="postalcode">Postal Code</label>
		<input id="postalcode" size="25" maxlength="25" type="text" name="postalcode" title="Postal Code" placeholder="Postal Code"/>
		
		<label for="phone">Office</label>
		<input id="phone" size="25" maxlength="25" type="text" name="phone" title="Office Phone" placeholder="Office"/>
		
		<label for="mobile">Mobile</label>
		<input id="mobile" size="25" maxlength="25" type="text" name="mobile" title="Mobile Phone" placeholder="Mobile"/>
		
		<label for="infosubmit"></label>
		<input type="submit" id="infosubmit" name="Save" value="Submit"/>
		
	</form>

</div>


<script>
$(document).ready(function(){

	$("#myinfo_form").validate({
		rules : {
		},
		messages : {
			fullname : { 
				required: "Full name is required", 
				maxlength: "Full name cannot exceed 25 characters" 
			},
			email: { 
				email: "Enter a valid email address", 
				maxlength: "Email cannot exceed 50 characters", 
				required: "Email address is required" 
			},
		},
		submitHandler : function(form) { submitInfoFormData(form); } 
	});
	
	function submitInfoFormData(form) {
		var data = getInfoFormData(form);
		//alert ("Sending data to server");	
		
		// post here

        var postUrl = "<?php echo base_url()?>user/update";
               
        $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(data)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							alert(response.error.message);
						} else {
	                         alert("Saved your account information");	                         
	                    }
                 },
                 error: function(response) {
					alert("Error: " + response.message + " code : " + response.code);
                 }
        });

	
		return false;
	}  
	   
	function getInfoFormData(form) {
	
		var data = { 
			account: {
				fullname : $(form).find("input[name=fullname]").val(),
				email: $(form).find("input[name=email]").val(), 
				streetaddress1: $(form).find("input[name=streetaddress1]").val(),
				streetaddress2: $(form).find("input[name=streetaddress2]").val(), 
				city: $(form).find("input[name=city]").val(), 
				state: $(form).find("input[name=state]").val(), 
				country: $(form).find("input[name=country]").val(), 
				postalcode: $(form).find("input[name=postalcode]").val(), 
				phone: $(form).find("input[name=officephone]").val(), 
				mobile: $(form).find("input[name=mobilephone]").val(), 
			}
		};
	
		return data;
	}
	
});
</script>


<div>
	<form id="aboutme_form" method="get" action=""> 
		<div class="formtitle">About Me</div>
		<fieldset>
		<label for="aboutme">About Me</label>
		<textarea class="required" minlength=50 maxlength=2000 name="aboutme"></textarea>
				
		<label for="aboutmesubmit"></label>
		<input type="submit" id="aboutmesubmit" name="Save" value="Submit"/>
		</fieldset>
	</form>
</div>

<script>
$(document).ready(function(){
	
	
	loadMyInfo();
	
	$("#aboutme_form").validate({
			rules: {
			},
			messages: {
				aboutme: {
					minlength: "Please describe about yourself in at least 50 characters",
					maxlength: "Please describe about yourself in less than 2000 characters",
					required: "Please describe about yourself"
				}
			},
			submitHandler : function(form) { 
				submitAboutMeForm(form); 
			} 
	});
	
	
	function loadMyInfo() {
		
		    var postUrl = "<?php echo base_url()?>user/account/get";

			$.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							alert(response.error.message);
						} else {
	                         //alert("Got account information : " + response.data);	
	                         populateMyInfoForm(response.data);                         
	                    }
                 },
                 error: function(response) {
					alert("Error: " + response.message + " code : " + response.code);
                 }
        });

	}
	
	function populateMyInfoForm(account) {
		var form = $("#myinfo_form");
		
		$(form).find("input[name=fullname]").val(account.fullname);
		$(form).find("input[name=email]").val(account.email);
		$(form).find("input[name=streetaddress1]").val(account.streetaddress1);
		$(form).find("input[name=streetaddress2]").val(account.streetaddress2);
		$(form).find("input[name=city]").val(account.city);
		$(form).find("input[name=state]").val(account.state);
		$(form).find("input[name=country]").val(account.country);
		$(form).find("input[name=postalcode]").val(account.postalcode);
		$(form).find("input[name=phone]").val(account.phone);
		$(form).find("input[name=mobile]").val(account.mobile);		
	}
	
	
	function submitAboutMeForm(form) {
	
		var data = getAboutmeForm(form);
				
		//alert("Sending data to server");
		
        // post here
        var postUrl = "<?php echo base_url()?>user/aboutme/update";
       
        $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(data)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							alert(response.error.message);
						} else {
	                         alert("Saved about me information");	                         
	                    }
                 },
                 error: function(response) {
					alert("Error: " + response.message + " code : " + response.code);
                 }
        });

		return false;
	}   
	   
	   
	function getAboutmeForm(form) {
		var data = { 
			account : {
				aboutme : $(form).find("textarea[name=aboutme]").val() //$("#aboutme").val()
			}
		};
	
		return data;
	}

});
</script>

</div>
