	/*
{"data":{"userid":"da","posnum":"1","username":"da","fullname":"da","firstname":null,"lastname":null,"password":"******","email":"da@da.com","phone":null,"mobile":null,"status":null,"started":null,"suspended":null,"usertype":null,"company":null,"streetaddress1":null,"streetaddress2":null,"city":null,"state":null,"postalcode":null,"country":null,"communityid":null,"aboutme":"Looks like you just got started. Click here to write something about  kjhskjdf sdf","created":"2011-04-24 20:41:48","updated":"2011-04-27 13:48:04"},"error":""}
	
*/

	function getContactDisplayTemplate() {
		var tmpl = $.template( "contactdisp", [
			"<div id='contact-disp' style='display:block' class='card formblock rounded'>",
			"<div class='contactdisp'><table>",
			"    <tr><th>Userid</th><td>${userid}</td></tr>",
			"    <tr><th>CredMine URL</th><td class='link'>${credmineUrl}</td></tr>",
			"    <tr><th>Email</th><td>${email}</td></tr>",
			"    <tr><th>Phone</th><td>${phone}</td></tr>",
			"    <tr><th>Mobile</th><td>${mobile}</td></tr>",
			"    <tr><th>Street Address</th><td>${streetaddress1}<br/>${streetaddress2}</td></tr>",
			"    <tr><th>City</th><td>${city}</td></tr>",
			"    <tr><th>State</th><td>${state}</td></tr>",
			"    <tr><th>Postal Code</th><td>${postalcode}</td></tr>",
			"    <tr><th>Country</th><td>${country}</td></tr>",
			"</table></div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='contact-modify' title='Make changes' href=''>Change</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
		return tmpl;			
	}

	function getContactEditTemplate() {
	
		var edutmpl = $.template ( "contactedit", [
			"<div id='contact-edit' style='display:none' class='card formblock rounded'>",
			"<form id='contact-edit-form' method='POST' action=''>",
			"<div class='contactdisp'><table>",
			"    <tr><th>Userid</th><td>${userid}</td></tr>",
			"    <tr><th>CredMine URL</th><td class='link'>${credmineUrl}</td></tr>",
			"    <tr><th>Email</th><td><input name='contactemail' id='contactemail' type='text' value='${email}'</input></td></tr>",
			"    <tr><th>Phone</th><td><input name='contactphone' id='contactphone' type='text' value='${phone}'</input></td></tr>",
			"    <tr><th>Mobile</th><td><input name='contactmobile' id='contactmobile' type='text' value='${mobile}'</input></td></tr>",
			"    <tr><th>Street Address</th><td><input name='contactaddress1' id='contactaddress1' type='text' value='${streetaddress1}'</input><br/>",
			"    <input name='contactaddress2' id='contactaddress2' type='text' value='${streetaddress2}'</input></td></tr>",
			"    <tr><th>City</th><td><input name='contactcity' id='contactcity' type='text' value='${city}'</input></td></tr>",
			"    <tr><th>State</th><td><input name='contactstate' id='contactstate' type='text' value='${state}'</input></td></tr>",
			"    <tr><th>Postal Code</th><td><input name='contactpostalcode' id='contactpostalcode' type='text' value='${postalcode}'</input></td></tr>",
			"    <tr><th>Country</th><td><input name='contactcountry' id='contactcountry' type='text' value='${country}'</input></td></tr>",
			"    <tr><th></th><td><div class='edit-errors' style='display:none'></div></td></tr>",
			"</table></div>",
			"<div class='contact-edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='contact-save'  title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='contact-cancel' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
		return edutmpl;	
	}


function loadAndShowContact(contactdiv) {

	    var postUrl = config.api.user.account.get; 

		$.ajax({
             type: "POST",
             url: postUrl,
             dataType: 'json',
             data:  { } ,
             success: function(response, status){
					if (response.error) {
						// error returned
						if (response.error.code == 401) {
						    showLogin();
						} else {
							$.jGrowl ("Error retrieving Contact information :" . response.error.message);
						}						
					} else {
                         //alert("Got account information : " + response.data);	
                         populateContactInfo($("#contact"), response.data);
                    }
             },
             error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
				return null;
             }
    });

}


function populateContactInfo(contactdiv, contactinfo) {
	contactdiv.empty();
    contactdiv.append("<h2 class='rounded'>Contact Info</h2>");
	createContactInfo(contactdiv, contactinfo);
    contactdiv.append("<h2 class='rounded'>Social Network</h2>");
}


function createContactInfo(contactdiv, contactinfo) {
	var content = getContactDisplayTemplate();	
	
	contactinfo.credmineUrl = config.url.credmineUrl + "/" + contactinfo.username;
		
	$.tmpl(content, contactinfo).appendTo(contactdiv);
	
	$.tmpl(getContactEditTemplate(), contactinfo).appendTo(contactdiv);
	
	// attach events to edit
	var cls = "#contact-modify";
	contactdiv.delegate(cls, "click", function() {    
	    toggleContact();
	    return false;
	});
	
	cls = "#contact-disp td";
	contactdiv.delegate(cls, "click", function() {    
	    toggleContact();
	    return false;
	});

		
	cls = "#contact-cancel";
	contactdiv.delegate(cls, "click", function() {
	    toggleContact();
	    return false;
	});
	
	cls = "#contact-save";
	contactdiv.delegate(cls, "click", function() {
		$("#contact-edit-form").trigger("submit");
	    return false;
	});
	
	$("#contact-edit-form").validate({
		onsubmit: true,
		rules: {
		},
		messages: {
		},
		submitHandler : function(form) { 
			saveContactInfo(form); 
		} 
	});
}

function toggleContact() {
    var showdiv = "#contact-disp";
    var editdiv = "#contact-edit";
    
	var togglediv = showdiv + ", " + editdiv;
	$(togglediv).toggle();
}

function getContactInfo(form) {
	var data = { 
		account : {
			phone : $(form).find("#contactphone").val(), 
			mobile : $(form).find("#contactmobile").val(), 
			streetaddress1 : $(form).find("#contactaddress1").val(), 
			streetaddress2 : $(form).find("#contactaddress2").val(), 
			city : $(form).find("#contactcity").val(), 
			state : $(form).find("#contactstate").val(), 
			postalcode : $(form).find("#contactpostalcode").val(), 
			country : $(form).find("#contactcountry").val()
		}
	};

	return data;
}

function saveContactInfo(form) {
	var data = getContactInfo(form);
			
    // post here
    var postUrl = config.api.user.accountsave; 

   
    $.ajax({
             type: "POST",
             url: postUrl,
             dataType: 'json',
             data:  { request : JSON.stringify(data)  } ,
             success: function(response, status){
					if (response.error) {
						// error returned
						if (response.error.code == 401) {
						    showLogin();
						} else {
							$.jGrowl ("Error saving Contact information :" . response.error.message);
						}						
					} else {
						$.jGrowl("Your contact information was updated.");	
						updateContactInfo();
						toggleContact();
                    }
             },
             error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
             }
    });

	return false;
}   

function updateContactInfo() {
}
