	function createEducationDisplayTemplate() {
		$.template( "edudisp", [
			"<div id='edu-disp-${posnum}' style='display:block' class='card formblock rounded' data='${posnum}'>",
			"<ul class='educ'>",
			"    <li><h2>${institution}</h2></li>",				
			"    <li><h3>${startmonth}, ${startyear} - ${endmonth}, ${endyear}</h5></li>",
			"    <li><h4>${fieldofstudy}</h4></li>",
			"</ul>",			
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
	}

	function createEducationEditTemplate() {
	
		$.template ( "eduedit", [
			"<div id='edu-edit-${posnum}' style='display:none' class='card formblock rounded' data='${posnum}'>",
			"<form id='edu-edit-form-${posnum}' data='${posnum}' method='POST' action=''>",
			"<table>",
			"    <tr><th>Institution</th><td><input name='eduinstitution' id='eduinstitution-${posnum}' type='text' value='${institution}'></input></td></tr>",
			"    <tr><th>Credential</th><td><input name='educredential' id='educredential-${posnum}' type='text' value='${credential}'></input></td></tr>",
			"    <tr><th>Field of Study</th><td><input name='edufieldofstudy' id='edufieldofstudy-${posnum}' type='text' value='${fieldofstudy}'></input></td></tr>",
			"    <tr><th>From</th><td><select name='edustartmonth' id='edustartmonth-${posnum}'><option value='01'>01</option></select>",
			"     <select name='edustartyear' id='edustartyear-${posnum}'><option value='2010'>2010</option></select></td></tr>",
			"    <tr><th>To</th><td><select name='eduendmonth' id='eduendmonth-${posnum}'><option value='01'>01</option></select>",
			"     <select name='eduendyear' id='eduendyear-${posnum}'><option value='2010'>2010</option></select></td></tr>",
			"    <tr><th>Activities</th><td><textarea name='eduactivities' rows='3' cols='55' id='eduactivities-${posnum}'>${activities}</textarea></td></tr>",
			"    <tr><th></th><td><div class='edit-errors' style='display:none'></div></td></tr>",
			"</table>",
			"<div class='edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='edu-save-${posnum}' data='${posnum}' title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='edu-cancel-${posnum}' data='${posnum}' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));		
	}

	function createEduTemplates() {
		if (! $.template["edudisp"])
			createEducationDisplayTemplate();
		if (! $.template["eduedit"])
			createEducationEditTemplate();
			
	}
	
	function loadAndShowEdu(edudiv) {
	
		createEduTemplates();
		
		var postUrl = config.api.edu.get;
		
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
							$.jGrowl ("Error retrieving Education :" . response.error.message);
						}						
					} else {
						populateEducationInfo(edudiv, response.data /* edulist */);
	                }
             },
		     error: function(response) {
					$.jGrowl("Error: " + response.message + " code : " + response.code);
		     }
		});
	}
	
	function updateEducationInfo(edurecord) {
		var edudiv = $('#edu-disp-' + edurecord.posnum);
		// compute month and year fields
    	edurecord.startmonth = getMonthName($("#edustartmonth-" + edurecord.posnum).val());
    	edurecord.endmonth = getMonthName($("#eduendmonth-" + edurecord.posnum).val());
    	edurecord.startyear = $("#edustartyear-" + edurecord.posnum).val() ;
    	edurecord.endyear = $("#eduendyear-" + edurecord.posnum).val();
		
		var content = $.tmpl("edudisp", edurecord);

		content.hide();
		edudiv.replaceWith(content);
	}
	
	function validateEducationInfo(posnum) {
    	var startmonth = $("#edustartmonth-" + posnum).val();
    	var endmonth = $("#eduendmonth-" + posnum).val() ;
    	var startyear = $("#edustartyear-" + posnum).val() ;
    	var endyear = $("#eduendyear-" + posnum).val();
    	
		var startdate=new Date();
		var enddate = new Date(startdate.getTime());
		startdate.setFullYear(startyear, startmonth, 1);
		enddate.setFullYear(endyear, endmonth, 1);

		var errorid = $("#edu-edit-" + posnum + " .edit-errors");
	
		$(errorid).empty();
		$(errorid).hide();
		
		if (isEmpty(startyear)) {
			$(errorid).append("The Year you joined must be selected." );
		}	
		if (isEmpty(startmonth)) {
			$(errorid).append("The Month you joined must be selected." );
		}	
		if (isEmpty(endyear)) {
			$(errorid).append("The Year you graduated must be selected." );
		}	
		if (isEmpty(endmonth)) {
			$(errorid).append("The Month you graduated must be selected." );
		}	

		if (enddate < startdate) {
			$(errorid).append("End date cannot be after Start date" );
		}
		
		if ($(errorid).html()) {
			$(errorid).show();
			return false;
		}
		
		return true;
	}
	
	function createEducationInfo(edudiv, edurecord) {
	
			// get year and month combos
			if (edurecord.startdate != "") {
				edurecord.startyear = edurecord.startdate.substr(0,4);
				edurecord.startmonth = edurecord.startdate.substr(5,2);
			} else {
				edurecord.startmonth="01";
				edurecord.startyear = "2011";
			}
			if (edurecord.enddate != "") {
				edurecord.endyear = edurecord.enddate.substr(0,4);
				edurecord.endmonth = edurecord.enddate.substr(5,2);
			} else {
				edurecord.endmonth="01";
				edurecord.endyear = "2011";
			}	
			var startyear = parseInt(edurecord.startyear);
			var startyearid = '#edustartyear-' + edurecord.posnum;
			var startyearoptions = getYearOptions(startyear);
			
			var endyear = parseInt(edurecord.endyear);
			var endyearid = '#eduendyear-' + edurecord.posnum;
			var endyearoptions = getYearOptions(endyear);
			
			var startmonth = parseInt(edurecord.startmonth);
			var startmonthid = '#edustartmonth-' + edurecord.posnum;
			var startmonthoptions = getMonthOptions(startmonth);
			
			var endmonth = parseInt(edurecord.endmonth);
			var endmonthid = '#eduendmonth-' + edurecord.posnum;
			var endmonthoptions = getMonthOptions(endmonth);
			
			edurecord.startmonth = getMonthName(startmonth);
			edurecord.endmonth = getMonthName(endmonth);
		
	       var addbuttondiv = $("#addeducation");

           //$.tmpl("edudisp", edurecord).insertBefore(addbuttondiv);
           //$.tmpl("eduedit", edurecord).insertBefore(addbuttondiv);
	       
/*
	       $.tmpl(getEducationDisplayTemplate(), edurecord).insertBefore(addbuttondiv);
   	       $.tmpl(getEducationEditTemplate(), edurecord).insertBefore(addbuttondiv);
*/

           var id = $(startyearid);
           id.html(startyearoptions);
           id = $(endyearid);
           id.html(endyearoptions);
           
           id = $(startmonthid);
           id.html(startmonthoptions);
           id = $(endmonthid);
           id.html(endmonthoptions);
           
           var cls = ".card .actions #edu-modify-" + edurecord.posnum;
           edudiv.delegate(cls, "click", function() {    
           		/// modify - show modify form, hide display data            
                var posnum = $(this).attr('data');
                toggleEdu(posnum);
                return false;
            });
            
            cls = ".card .edit-actions #edu-cancel-" + edurecord.posnum;
            edudiv.delegate(cls, "click", function() {
           		/// cancel - hide modify form, show display data            
                var posnum = $(this).attr('data');
                if (posnum == "-1") {
                	deleteEduDivs(posnum);
                } else {
	                toggleEdu(posnum);
	            }
	           	$("#addnewedu").show();
                return false;
            });
            
            var options = {  	
            	position: 'bottom',
            	questionText: "Are you sure you <br/>want to delete this?",
            	unique: true,
            	posnum: edurecord.posnum,
            	onProceed: function(trigger, clicked) {
            		$.jGrowl("Deleting record...");
            		deleteEdu(this.posnum);
            		$(trigger).fastConfirm('close');
            		return false;
            	},
            	onCancel: function(trigger, clicked) {
            		$(trigger).fastConfirm('close');
            		return false;
            	}            	
            } ;

            cls = ".card .actions #edu-delete-" + edurecord.posnum;
            edudiv.delegate(cls, "click", function() {
            	$(this).fastConfirm(options);
	           	$("#addnewedu").show();
            	return false;
            });
                                    
			edudiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
            });
			edudiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
            }); 
            
			$("#edu-edit-form-" + edurecord.posnum).validate({   
					rules: {
						eduinstitution: { required: true, maxlength: 50, minlength: 2 },
						educredential: { required: true, maxlength: 50, minlength: 2 },
						edufieldofstudy: { required: true, maxlength: 50, minlength: 2 },
						eduactivities: { required: true, maxlength: 500, minlength: 2 }
					},
					messages: {
						eduinstitution: { required: "Where did you go to school?" },
						educredential: { required: "You graduated with something, right?" },
						edufieldofstudy: { required: "What did you specialize in?" },
						eduactivities: { required: "What? No activities?!" },
					},
					submitHandler : function(f) { 
						saveEducation($(f).attr('data')); 
					} 
			   });		
			   
			   $("#edu-norecords").hide();	   
	}
	
	function populateEducationInfo(edudiv, edulist) {

        edudiv.empty();
		edudiv.append("<div class='section'><div class='box600'><h1>Education</h1><div id='edu-norecords' class='norecords' style='display:none'>You do not have any information at the moment. Please click on the button below to add.</div><div id='addeducation'></div>");

		if ((edulist) && (edulist.length > 0)) {
    		$("#edu-norecords").hide();			
	        for (i=0; i < edulist.length; i++) {				
				createEducationInfo(edudiv, edulist[i]);                       
        	}
    	} else {
        	$("#edu-norecords").show();
    	}

		$('#addnewedu').click(function() {
			addNewEdu();
		});	

        // hide all actions for all the edu cards
		$(".card .actions").hide();
				
	}
	
	function toggleEdu(posnum) {
        var showdiv = "#edu-disp-" + posnum;
        var editdiv = "#edu-edit-" + posnum;
        
		var togglediv = showdiv + ", " + editdiv;
		$(togglediv).toggle();
	}

	function deleteEdu(posnum) {
		
		var postUrl = config.api.edu.remove;
		var edurec = { 
			'education' : {
		        'posnum' : posnum
		    }
		};

		$.ajax({
			type: "POST",
			url: postUrl,
			dataType: 'json',
			data:  { request : JSON.stringify(edurec) },
			success: function(response, status){
				if (response.error) {
					// error returned
					if (response.error.code == 401) {
					     showLogin();
					} else {
						$.jGrowl ("Error deleting Education :" . response.error.message);
					}						
				} else {
					// delete was successful, remove the div from the page
					deleteEduDivs(posnum);
			    }
			},
			error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
			}
		});		
	}

	function deleteEduDivs(posnum) {
		var id = "#edu-edit-" + posnum;
		$(id).remove();
		id = "#edu-disp-" + posnum;
		$(id).remove();					                         
	}
	
	function addNewEdu() {
		var edurecord = {
			userid: '',
			posnum: -1,
			startdate: '',
			enddate: '',
			fieldofstudy: '',
			institution: '',
			credential: '',
			activities: ''
		};
		
		createEducationInfo($("#education"), edurecord);
		toggleEdu(edurecord.posnum);				
	}
	
    function getEduFormData(posnum) {
    
    	var startmonth = $("#edustartmonth-" + posnum).val();
    	var endmonth = $("#eduendmonth-" + posnum).val() ;
    	var startyear = $("#edustartyear-" + posnum).val() ;
    	var endyear = $("#eduendyear-" + posnum).val();
    	var startdatestr = startyear + "-" + startmonth + "-01 00:00:00"
    	var enddatestr = endyear + "-" + endmonth + "-01 00:00:00"

    	//user_name, #user_screen_name, #user_password, #user_email
	    var edurec = { 
	    	'education' : {
		        'posnum' : posnum,
		        'startdate' : startdatestr,
		        'enddate' : enddatestr,
		        'institution' : $("#eduinstitution-" + posnum).val(),
		        'fieldofstudy' : $("#edufieldofstudy-" + posnum).val(),
		        'credential' : $("#educredential-" + posnum).val(),
		        'activities' : $("#eduactivities-" + posnum).val(),
		    }
	    };
	
	    return edurec;
    }	
	
	function saveEducation(posnum) {
	
			if (! validateEducationInfo(posnum)) {
				return;
			}

			var edurec = getEduFormData(posnum);
						
			var postUrl;
			
			if (posnum== -1) {
				postUrl = config.api.edu.insert;
				edurec.newrec = true;
			} else {
				postUrl = config.api.edu.save;
				edurec.newrec = false;
			}

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(edurec)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							if (response.error.code == 401) {
							     showLogin();
							} else {
								$.jGrowl ("Error saving Education :" . response.error.message);
							}						
						} else {
	                         if (response.data) {
	                         	var edurec = response.data;

	                         	if (edurec.newrec !== true) {
	                         		updateEducationInfo(edurec);
		                         	toggleEdu(edurec.posnum);
	                         	} else {
	                         		// remove the record for -1 temp and insert the newly created one
	                         		deleteEdu(-1);
									createEducationInfo($("#education"), edurec);
	                         	}
	                         	
	                         	$.jGrowl("Saved '" + edurec.institution + "'");
             		           	$("#addnewedu").show();
	                         }                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });         
	}
