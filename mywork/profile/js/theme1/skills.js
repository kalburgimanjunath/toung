	function createSkillDisplayTemplate() {
		$.template( "skidisp", [
			"<div id='ski-disp-${posnum}' style='display:block' class='card formblock rounded' data='${posnum}'>",
			"<div class='disp'><table>",
			"    <tr><th>Skill</th><td>${skillname}</td></tr>",
			"    <tr><th>Self Rating</th><td><span class='selfrating'>${selfratingname}</span><select disabled='disabled' name='skiselfratingv' id='skiselfratingv-${posnum}'><option value='1'>Novice</option></select></td></tr>",
			"    <tr><th></th><td class='timestamp'>Updated ${updatedago}</td></tr>",
			"</table></div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='ski-modify-${posnum}' data='${posnum}' title='Make changes' href=''>Change</a>",
			"<a class='actionlink rounded' id='ski-delete-${posnum}' data='${posnum}' title='Remove this forever' href=''>Remove</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createSkillEditTemplate() {
		$.template ( "skiedit", [
			"<div id='ski-edit-${posnum}' style='display:none' class='card formblock rounded' data='${posnum}'>",
			"<form id='ski-edit-form-${posnum}' data='${posnum}' method='POST' action=''>",
			"<table>",
			"    <tr><th>Skill</th><td><input name='skiname' id='skiname-${posnum}' type='text' value='${skillname}'></input></td></tr>",
			"    <tr><th>Rating</th><td><select name='skiselfrating' id='skiselfrating-${posnum}'><option value='1'>Novice</option></select></td></tr>",
			"</table>",
			"<div class='edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='ski-save-${posnum}' data='${posnum}' title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='ski-cancel-${posnum}' data='${posnum}' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createSkillTemplates() {
		if (! $.template["skidisp"])
			createSkillDisplayTemplate();
		if (! $.template["skiedit"])
			createSkillEditTemplate();
	}
	
	function loadAndShowSkills(skidiv) {
	
		createSkillTemplates();
		
		var postUrl = config.api.ski.get;
		
		$.ajax({
		     type: "POST",
		     url: postUrl,
		     dataType: 'json',
		     data:  { request : ""  } ,
		     success: function(response, status){
					if (response.error) {
						// error returned
						if (response.error.code == 401) {
						    showLogin();
						} else {
							$.jGrowl ("Error retrieving Skill :" . response.error.message);
						}						
					} else {
						populateSkillInfo(skidiv, response.data /* skilist */);
	                }
             },
		     error: function(response) {
					$.jGrowl("Error: " + response.message + " code : " + response.code);
		     }
		});
	}

	function updateSkillInfo(skirecord) {
	
		skirecord.selfratingname = getRatingName(skirecord.selfrating);
		var skidiv = $('#ski-disp-' + skirecord.posnum);		
		var content = $.tmpl("skidisp", skirecord);
		content.hide();
		skidiv.replaceWith(content);
		
		var selfratingidv = '#skiselfratingv-' + skirecord.posnum;
           var idv = $(selfratingidv);
           var selfratingoptions = getRatingOptions(skirecord.selfrating);
           idv.html(selfratingoptions);

           $(selfratingidv).allRating({
	       		theme: 'medal',
	       		showHover: false
    	 	});

	}
	
	function validateSkillInfo(posnum) {
    	var skillname = $("#skiname-" + posnum).val();
    	var selfrating = $("#skiselfrating-" + posnum).val() ;
 
		var errorid = $("#ski-edit-" + posnum + " .edit-errors");
	
		$(errorid).empty();
		$(errorid).hide();
		
		if (isEmpty(skillname)) {
			$(errorid).append("You must enter a valid skill." );
		}	
		if (isEmpty(selfrating)) {
			$(errorid).append("You must rate your skill." );
		}	
			
		if ($(errorid).html()) {
			$(errorid).show();
			return false;
		}
		
		return true;
	}

	function createSkillInfo(skidiv, skirecord) {
	
			skirecord.selfratingname = getRatingName(skirecord.selfrating);

	       var addbuttondiv = $("#addskill");
           $.tmpl("skidisp", skirecord).insertBefore(addbuttondiv);
           $.tmpl("skiedit", skirecord).insertBefore(addbuttondiv);
           
		   var selfratingid = '#skiselfrating-' + skirecord.posnum;
		   var selfratingidv = '#skiselfratingv-' + skirecord.posnum;
           var id = $(selfratingid);
           var idv = $(selfratingidv);
           var selfratingoptions = getRatingOptions(skirecord.selfrating);
           id.html(selfratingoptions);
           idv.html(selfratingoptions);

           $(selfratingidv).allRating({
	       		theme: 'medal',
	       		showHover: false
    	 	});
           
/*
           $(selfratingid).allRating({
	       		theme: 'medal'
    	 	});
*/


           var cls = ".card .actions #ski-modify-" + skirecord.posnum;
           skidiv.delegate(cls, "click", function() {    
           		/// modify - show modify form, hide display data            
                var posnum = $(this).attr('data');
                toggleSki(posnum);
                return false;
            });
            
            cls = ".card .edit-actions #ski-cancel-" + skirecord.posnum;
            skidiv.delegate(cls, "click", function() {
           		/// cancel - hide modify form, show display data            
                var posnum = $(this).attr('data');
                if (posnum == "-1") {
                	deleteSkiDivs(posnum);
                	$("#ski-norecords").show();
                } else {
	                toggleSki(posnum);
	            }
                return false;
            });
            
            var options = {  	
            	position: 'bottom',
            	questionText: "Are you sure you <br/>want to delete this?",
            	unique: true,
            	posnum: skirecord.posnum,
            	onProceed: function(trigger, clicked) {
            		$.jGrowl("Deleting record...");
            		deleteSki(this.posnum);
            		$(trigger).fastConfirm('close');
            		return false;
            	},
            	onCancel: function(trigger, clicked) {
            		$(trigger).fastConfirm('close');
            		return false;
            	}            	
            } ;

            cls = ".card .actions #ski-delete-" + skirecord.posnum;
            skidiv.delegate(cls, "click", function() {
            	$(this).fastConfirm(options);
            	return false;
            });
                                    
            cls = ".card .edit-actions #ski-save-" + skirecord.posnum;

			skidiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
            });
			skidiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
            }); 
            
			$("#ski-edit-form-" + skirecord.posnum).validate({   
					rules: {
						skiname: { required: true, maxlength: 50, minlength: 2 },
						skiselfrating: { required: true, number: true, range: [1,5] },
					},
					messages: {
						skiname: { 
							required: "You must enter a skill name" 
						},
						skiselfrating: { 
							required: "You must enter your skill level", 
							number: "Rate yourself between 1 (Beginner) to 5 (Expert)", 
						},
					},
					submitHandler : function(f) { 
						saveSkill($(f).attr('data')); 
					} 
			   });		
			   
			   $("#ski-norecords").hide();	   
	}

	function populateSkillInfo(skidiv, skilist) {

        skidiv.empty();
        skidiv.append("<h2 class='rounded'>Skill</h2>");
        skidiv.append("<div id='ski-norecords' class='norecords' style='display:none'>You do not have any information at the moment. Please click on the button below to add.</div>");
        skidiv.append("<div id='addskill'><input type='submit' value='Add Skill' title='Add more skills' name='Add Skill' id='addnewski' class='submitbutton'></div>");

		if (skilist) {
	        for (i=0; i < skilist.length; i++) {
				createSkillInfo(skidiv, skilist[i]);                       
        	}
        	if (skilist.length > 0) {
        		$("#ski-norecords").hide();
        	}
        } else {
        	$("#ski-norecords").show();
        }           

		$('#addnewski').click(function() {
			addnewski();
		});	

        // hide all actions for all the skill cards
		$(".card .actions").hide();
				
	}

	function toggleSki(posnum) {
        var showdiv = "#ski-disp-" + posnum;
        var editdiv = "#ski-edit-" + posnum;
        
		var togglediv = showdiv + ", " + editdiv;
		$(togglediv).toggle();
	}

	function deleteSki(posnum) {
		
		var postUrl = config.api.ski.remove;
		var skirec = { 
			'skill' : {
		        'posnum' : posnum
		    }
		};

		$.ajax({
			type: "POST",
			url: postUrl,
			dataType: 'json',
			data:  { request : JSON.stringify(skirec) },
			success: function(response, status){
				if (response.error) {
					// error returned
					if (response.error.code == 401) {
					     showLogin();
					} else {
						$.jGrowl ("Error deleting Skill :" . response.error.message);
					}						
				} else {
					// delete was successful, remove the div from the page
					deleteskidivs(posnum);
			    }
			},
			error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
			}
		});		
	}

	function deleteskidivs(posnum) {
		var id = "#ski-edit-" + posnum;
		$(id).remove();
		id = "#ski-disp-" + posnum;
		$(id).remove();					                         
	}
	
	function addnewski() {
		var skirecord = {
			userid: '',
			posnum: -1,
			skillname: ''
		};
		
		createSkillInfo($("#skills"), skirecord);
		toggleSki(skirecord.posnum);				
	}
	
	
    function getSkiFormData(posnum) {
    
    	var skillname = $("#skiname-" + posnum).val();
    	var selfrating = $("#skiselfrating-" + posnum).val() ;

	    var skirec = { 
	    	'skill' : {
		        'posnum' : posnum,
		        'skillname' : skillname,
		        'selfrating' : selfrating,
		    }
	    };
	
	    return skirec;
    }	


	function saveSkill(posnum) {
	
			if (! validateSkillInfo(posnum)) {
				return;
			}

			var skirec = getSkiFormData(posnum);
						
			var postUrl;
			
			if (posnum== -1) {
				postUrl = config.api.ski.insert;
				skirec.newrec = true;
			} else {
				postUrl = config.api.ski.save;
				skirec.newrec = false;
			}

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(skirec)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							if (response.error.code == 401) {
							     showLogin();
							} else {
								$.jGrowl ("Error saving Skill :" . response.error.message);
							}						
						} else {
	                         if (response.data) {
	                         	var skirec = response.data;

	                         	if (skirec.newrec !== true) {
	                         		updateSkillInfo(skirec);
		                         	toggleSki(skirec.posnum);
	                         	} else {
	                         		// remove the record for -1 temp and insert the newly created one
	                         		deleteSki(-1);
									createSkillInfo($("#skills"), skirec);
	                         	}
	                         	
	                         	$.jGrowl("Saved '" + skirec.skillname + "'");
	                         }                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });         
	}

/****** 

function loadAndShowSkills(skillsdiv) {
	        var postUrl = config.api.ski.get;

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : ""  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							if (response.error.code == 401) {
							     $.jGrowl("Unauthorized");
							     // redirect to login page
							     var login_url = config.page.signin + "?return_url=" + config.page.profile_ski;
							     window.location.href = login_url;
							}
 							$.jGrowl ("Error retrieving Skills " . response.error); 
						} else {
	                         //$.jGrowl("Success: " + status);
	                         // goto account page
	                         if (response.data) {
    	                         var skillslist = response.data; 
    	                         populateSkillsInfo(skillsdiv, skillslist);
	                         } else {
	                           // display no skills found
	                           skillsdiv.html("<p class='norecords'>You have not entered your Skills.</p>" +
	                           	'<input type="submit" value="Add Skill" name="Add Skill" id="addnewski" class="submitbutton">'
	                           	);
	                           	
	                           $('#addnewski').click(function() {
	                           		$.jGrowl("Add new skill");
	                           	});		                           
	                         }                         
	                         //console.log(skillslist);	                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });
	}
	
	function populateSkillsInfo(skillsdiv, skillslist) {
		   var skillstmpl = $.template ( null, [
	       "<div id='skills-${recnum}' class='skillscard formblock'>",
	       "<ul>",
	       "    <li>Skill Name <span class='company'>${skillname}</span></li>",
	       "    <li>Skill Level: <span class='position'>${expertlevel}</span></li>",
	       "</ul>",
	       "<div class='actions'><a id='skillsedit-${recnum}' href=''>Edit</a></div>",
	       "</div>"
	   ].join(''));
       skillsdiv.empty();
       for (i=0; i < skillslist.length; i++) {
           skillslist[i].recnum=i;
           $.tmpl(skillstmpl, skillslist[i]).appendTo(skillsdiv);
           var cls = ".skillscard .actions #skillsedit-" + i;
           $(cls).click(function() {
                
                $.jGrowl (this.id);
                return false;
            });
        }
	}
**********/
