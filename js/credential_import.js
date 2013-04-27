function getBioDisplayTemplate () {

	var template = $.template( null, [
			"<div id='bio-disp' style='display:block' class='card formblock rounded'>",
			"<div id='bio-data' style='float:left'>",
			"{{html aboutme}}",
			"</div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='bio-modify' title='Make changes' href=''>Change</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
	].join(''));
	
	return template;
}

function getBioEditTemplate () {

	var template = $.template( null, [
			"<div id='bio-edit' style='display:none' class='card formblock rounded'>",
			"<form id='form_bio' method='POST' action=''>",
			"<div>Write something interesting about yourself.</div>",
			"	<textarea id='biodesc' name='aboutme' title='Eveyrone sees this, so make sure it is indeed interesting'", 
			"			class='element medium' maxlength=2000></textarea>",
			"	<div id='biodescvalid'></div>",
			"<div class='bio-edit-actions'>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='bio-cancel' title='Cancel changes'/>",
			"<input type='submit' class='submitbutton' id='biosubmit' name='Save' value='Save'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
	].join(''));
	
	return template;
}

function loadAndShowBio(biodiv) {

	    var postUrl = config.api.user.account.get; // config.api.aboutme.get; 

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
							$.jGrowl ("Error retrieving About me information :" . response.error.message);
						}						
					} else {
                         //alert("Got account information : " + response.data);	
                         populateAboutMe($("#bio"), {"aboutme": response.data.aboutme});
                         updateHeader(response.data);
                    }
             },
             error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
				return null;
             }
    });

}

function updateHeader(account) {
    $("#username").html(account.username);
    $("#headline").html(account.headline); 
}

function populateAboutMe(biodiv, aboutme) {
	biodiv.empty();
    biodiv.append("<h2 class='rounded'>About Me</h2>");

	createBioInfo(biodiv, aboutme);
	
}

function createBioInfo(biodiv, aboutme) {
	var content = getBioDisplayTemplate();	
		
	if (isEmpty(aboutme.aboutme)) {
		aboutme.aboutme = "Looks like you just got started. Click here to write something about ";
	}

	$.tmpl(content, aboutme).appendTo(biodiv);
	
	$.tmpl(getBioEditTemplate(), aboutme).appendTo(biodiv);
	
	// set the value of the text area
	$("#biodesc").val(aboutme.aboutme);
	
	// attach events to edit
	var cls = ".actions #bio-modify";
	biodiv.delegate(cls, "click", function() {    
	    toggleBio();
	    return false;
	});
	
	biodiv.delegate("#bio-disp", "click", function() {    
	    toggleBio();
	    return false;
	});
	
	cls = ".bio-edit-actions #bio-cancel";
	biodiv.delegate(cls, "click", function() {
	    toggleBio();
	    return false;
	});
	
	cls = ".bio-edit-actions #bio-save";
		biodiv.delegate(cls, "click", function() {
	    toggleBio();
	    return false;
	});
	
	$("#form_bio").validate({
		onsubmit: true,
		rules: {
			aboutme: {
				required: true,
				maxlength: 1000,
				minlength: 20
			}
		},
		messages: {
			aboutme: {
				minlength: "Hmmm...Can you make at least a sentence or two?",
				maxlength: "Whoa! Less is more! Reduce, reduce, reduce.",
				required: "Have you got nothing to say about yourself? C'mon!"
			}
		},
		submitHandler : function(form) { 
			saveAboutMe(form); 
		} 
	});
	
    $(".actions").hide();

	/*
biodiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
    });
	biodiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
    }); 
*/
	
	setupTextEditor();
}

function setupTextEditor() {
	var myHtmlSettings = {
	    nameSpace:       "html", // Useful to prevent multi-instances CSS conflict
	    previewInWindow: 'width=800, height=600, resizable=yes, scrollbars=yes',
	    onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},
	    onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
	    onTab:           {keepDefault:false, openWith:'     '},
	    markupSet:  [
	        {name:'Heading 1', key:'1', openWith:'<h1(!( class="[![Class]!]")!)>', closeWith:'</h1>', placeHolder:'Your title here...' },
	        {name:'Heading 2', key:'2', openWith:'<h2(!( class="[![Class]!]")!)>', closeWith:'</h2>', placeHolder:'Your title here...' },
	        {name:'Heading 3', key:'3', openWith:'<h3(!( class="[![Class]!]")!)>', closeWith:'</h3>', placeHolder:'Your title here...' },
	        {name:'Heading 4', key:'4', openWith:'<h4(!( class="[![Class]!]")!)>', closeWith:'</h4>', placeHolder:'Your title here...' },
	        {name:'Heading 5', key:'5', openWith:'<h5(!( class="[![Class]!]")!)>', closeWith:'</h5>', placeHolder:'Your title here...' },
	        {name:'Heading 6', key:'6', openWith:'<h6(!( class="[![Class]!]")!)>', closeWith:'</h6>', placeHolder:'Your title here...' },
	        {name:'Paragraph', openWith:'<p(!( class="[![Class]!]")!)>', closeWith:'</p>'  },
	        {separator:'---------------' },
	        {name:'Bold', key:'B', openWith:'<strong>', closeWith:'</strong>' },
	        {name:'Italic', key:'I', openWith:'<em>', closeWith:'</em>'  },
	        {name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
	        {separator:'---------------' },
	        {name:'Ul', openWith:'<ul>\n', closeWith:'</ul>\n' },
	        {name:'Ol', openWith:'<ol>\n', closeWith:'</ol>\n' },
	        {name:'Li', openWith:'<li>', closeWith:'</li>' },
	        {separator:'---------------' },
	        {name:'Picture', key:'P', replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },
	        {name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
	        {separator:'---------------' },
	        {name:'Clean', replaceWith:function(h) { return h.selection.replace(/<(.*?)>/g, "") } },
	        {name:'Preview', call:'preview', className:'preview' }
	    ]
	};
	$("#biodesc").markItUp(myHtmlSettings);
}

function toggleBio() {
    var showdiv = "#bio-disp";
    var editdiv = "#bio-edit";
    
	var togglediv = showdiv + ", " + editdiv;
	$(togglediv).toggle();
}

function getAboutMe(form) {
	var data = { 
		account : {
			aboutme : $(form).find("#biodesc").val() 
		}
	};

	return data;
}

function saveAboutMe(form) {
	var data = getAboutMe(form);
			
    // post here
    var postUrl = config.api.aboutme.update; 

   
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
							$.jGrowl(response.error.message);
						}
					} else {
						$.jGrowl("Your bio was updated.");	
						$("#bio-data").html($("#biodesc").val());                         
						toggleBio();
                    }
             },
             error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
             }
    });

	return false;
}   
   