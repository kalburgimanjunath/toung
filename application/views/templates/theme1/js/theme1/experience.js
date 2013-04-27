	function createExperienceDisplayTemplate() {
		$.template( "expdisp", [
			"<div id='exp-disp-${posnum}' style='display:block' class='card formblock rounded' data='${posnum}'>",
			"<div class='disp'><table>",
			"    <tr><th>Company</th><td>${company}</td></tr>",
			"    <tr><th>Position</th><td>${position}</td></tr>",
			"    <tr><th>From</th><td>${startmonth}, ${startyear}</td></tr>",
			"    <tr><th>To</th><td>${endmonth}, ${endyear}</td></tr>",
			"    <tr><th>Description</th><td>${description}</td></tr>",
			"    <tr><th></th><td class='timestamp'>Updated ${updatedago}</td></tr>",
			"</table></div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='exp-modify-${posnum}' data='${posnum}' title='Make changes' href=''>Change</a>",
			"<a class='actionlink rounded' id='exp-delete-${posnum}' data='${posnum}' title='Remove this forever' href=''>Remove</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createExperienceEditTemplate() {
		$.template ( "expedit", [
			"<div id='exp-edit-${posnum}' style='display:none' class='card formblock rounded' data='${posnum}'>",
			"<form id='exp-edit-form-${posnum}' data='${posnum}' method='POST' action=''>",
			"<table>",
			"    <tr><th>Company</th><td><input name='expcompany' id='expcompany-${posnum}' type='text' value='${company}'></input></td></tr>",
			"    <tr><th>Position</th><td><input name='expposition' id='expposition-${posnum}' type='text' value='${position}'></input></td></tr>",
			"    <tr><th>From</th><td><select name='expstartmonth' id='expstartmonth-${posnum}'><option value='01'>01</option></select>",
			"     <select name='expstartyear' id='expstartyear-${posnum}'><option value='2010'>2010</option></select></td></tr>",
			"    <tr><th>To</th><td><select name='expendmonth' id='expendmonth-${posnum}'><option value='01'>01</option></select>",
			"     <select name='expendyear' id='expendyear-${posnum}'><option value='2010'>2010</option></select></td></tr>",
			"    <tr><th>Description</th><td><textarea name='expdescription' rows='3' cols='55' id='expdescription-${posnum}'>${description}</textarea></td></tr>",
			"    <tr><th></th><td><div class='edit-errors' style='display:none'></div></td></tr>",
			"</table>",
			"<div class='edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='exp-save-${posnum}' data='${posnum}' title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='exp-cancel-${posnum}' data='${posnum}' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createExpTemplates() {
		if (! $.template["expdisp"])
			createExperienceDisplayTemplate();
		if (! $.template["expedit"])
			createExperienceEditTemplate();
	}
	
	function loadAndShowExp(expdiv) {
	
		createExpTemplates();
		
		var postUrl = config.api.exp.get;
		
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
							$.jGrowl ("Error retrieving Experience :" . response.error.message);
						}						
					} else {
						populateExperienceInfo(expdiv, response.data /* explist */);
	                }
             },
		     error: function(response) {
					$.jGrowl("Error: " + response.message + " code : " + response.code);
		     }
		});
	}

	function updateExperienceInfo(exprecord) {
		var expdiv = $('#exp-disp-' + exprecord.posnum);
		// compute month and year fields
    	exprecord.startmonth = getMonthName($("#expstartmonth-" + exprecord.posnum).val());
    	exprecord.endmonth = getMonthName($("#expendmonth-" + exprecord.posnum).val());
    	exprecord.startyear = $("#expstartyear-" + exprecord.posnum).val() ;
    	exprecord.endyear = $("#expendyear-" + exprecord.posnum).val();
		
		var content = $.tmpl("expdisp", exprecord);
		content.hide();
		expdiv.replaceWith(content);
	}
	
	function validateExperienceInfo(posnum) {
    	var startmonth = $("#expstartmonth-" + posnum).val();
    	var endmonth = $("#expendmonth-" + posnum).val() ;
    	var startyear = $("#expstartyear-" + posnum).val() ;
    	var endyear = $("#expendyear-" + posnum).val();
    	
		var startdate=new Date();
		var enddate = new Date(startdate.getTime());
		startdate.setFullYear(startyear, startmonth, 1);
		enddate.setFullYear(endyear, endmonth, 1);

		var errorid = $("#exp-edit-" + posnum + " .edit-errors");
	
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

	function createExperienceInfo(expdiv, exprecord) {
	
			// get year and month combos
			if (exprecord.startdate != "") {
				exprecord.startyear = exprecord.startdate.substr(0,4);
				exprecord.startmonth = exprecord.startdate.substr(5,2);
			} else {
				exprecord.startmonth="01";
				exprecord.startyear = "2011";
			}
			if (exprecord.enddate != "") {
				exprecord.endyear = exprecord.enddate.substr(0,4);
				exprecord.endmonth = exprecord.enddate.substr(5,2);
			} else {
				exprecord.endmonth="01";
				exprecord.endyear = "2011";
			}	
			var startyear = parseInt(exprecord.startyear);
			var startyearid = '#expstartyear-' + exprecord.posnum;
			var startyearoptions = getYearOptions(startyear);
			
			var endyear = parseInt(exprecord.endyear);
			var endyearid = '#expendyear-' + exprecord.posnum;
			var endyearoptions = getYearOptions(endyear);
			
			var startmonth = parseInt(exprecord.startmonth);
			var startmonthid = '#expstartmonth-' + exprecord.posnum;
			var startmonthoptions = getMonthOptions(startmonth);
			
			var endmonth = parseInt(exprecord.endmonth);
			var endmonthid = '#expendmonth-' + exprecord.posnum;
			var endmonthoptions = getMonthOptions(endmonth);
			
			exprecord.startmonth = getMonthName(startmonth);
			exprecord.endmonth = getMonthName(endmonth);
		
	       var addbuttondiv = $("#addexperience");
           $.tmpl("expdisp", exprecord).insertBefore(addbuttondiv);
           $.tmpl("expedit", exprecord).insertBefore(addbuttondiv);
           var id = $(startyearid);
           id.html(startyearoptions);
           id = $(endyearid);
           id.html(endyearoptions);
           
           id = $(startmonthid);
           id.html(startmonthoptions);
           id = $(endmonthid);
           id.html(endmonthoptions);
           
           var cls = ".card .actions #exp-modify-" + exprecord.posnum;
           expdiv.delegate(cls, "click", function() {    
           		/// modify - show modify form, hide display data            
                var posnum = $(this).attr('data');
                toggleExp(posnum);
                return false;
            });
            
            cls = ".card .edit-actions #exp-cancel-" + exprecord.posnum;
            expdiv.delegate(cls, "click", function() {
           		/// cancel - hide modify form, show display data            
                var posnum = $(this).attr('data');
                if (posnum == "-1") {
                	deleteExpDivs(posnum);
                	$("#exp-norecords").show();
                } else {
	                toggleExp(posnum);
	            }
                return false;
            });
            
            var options = {  	
            	position: 'bottom',
            	questionText: "Are you sure you <br/>want to delete this?",
            	unique: true,
            	posnum: exprecord.posnum,
            	onProceed: function(trigger, clicked) {
            		$.jGrowl("Deleting record...");
            		deleteExp(this.posnum);
            		$(trigger).fastConfirm('close');
            		return false;
            	},
            	onCancel: function(trigger, clicked) {
            		$(trigger).fastConfirm('close');
            		return false;
            	}            	
            } ;

            cls = ".card .actions #exp-delete-" + exprecord.posnum;
            expdiv.delegate(cls, "click", function() {
            	$(this).fastConfirm(options);
            	return false;
            });
                                    
            cls = ".card .edit-actions #exp-save-" + exprecord.posnum;

			expdiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
            });
			expdiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
            }); 
            
			$("#exp-edit-form-" + exprecord.posnum).validate({   
					rules: {
						expcompany: { required: true, maxlength: 50, minlength: 2 },
						expposition: { required: true, maxlength: 50, minlength: 2 },
						expdescription: { required: true, maxlength: 500, minlength: 2 }
					},
					messages: {
						expcompany: { required: "Where did you work?" },
						expposition: { required: "What was your position/designation?" },
						expdescription: { required: "What did you do over there?" },
					},
					submitHandler : function(f) { 
						saveExperience($(f).attr('data')); 
					} 
			   });		
			   
			   $("#exp-norecords").hide();	   
	}

	function populateExperienceInfo(expdiv, explist) {

        expdiv.empty();
        expdiv.append("<h2 class='rounded'>Experience</h2>");
        expdiv.append("<div id='exp-norecords' class='norecords' style='display:none'>You do not have any information at the moment. Please click on the button below to add.</div>");
        expdiv.append("<div id='addexperience'><input type='submit' value='Add Experience' title='Add more experience' name='Add Experience' id='addnewexp' class='submitbutton'></div>");

		if (explist) {
	        for (i=0; i < explist.length; i++) {
				createExperienceInfo(expdiv, explist[i]);                       
        	}
        	if (explist.length > 0) {
        		$("#exp-norecords").hide();
        	}
        } else {
        	$("#exp-norecords").show();
        }           

		$('#addnewexp').click(function() {
			addNewExp();
		});	

        // hide all actions for all the exp cards
		$(".card .actions").hide();
				
	}

	function toggleExp(posnum) {
        var showdiv = "#exp-disp-" + posnum;
        var editdiv = "#exp-edit-" + posnum;
        
		var togglediv = showdiv + ", " + editdiv;
		$(togglediv).toggle();
	}

	function deleteExp(posnum) {
		
		var postUrl = config.api.exp.remove;
		var exprec = { 
			'experience' : {
		        'posnum' : posnum
		    }
		};

		$.ajax({
			type: "POST",
			url: postUrl,
			dataType: 'json',
			data:  { request : JSON.stringify(exprec) },
			success: function(response, status){
				if (response.error) {
					// error returned
					if (response.error.code == 401) {
					     showLogin();
					} else {
						$.jGrowl ("Error deleting Experience :" . response.error.message);
					}						
				} else {
					// delete was successful, remove the div from the page
					deleteExpDivs(posnum);
			    }
			},
			error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
			}
		});		
	}

	function deleteExpDivs(posnum) {
		var id = "#exp-edit-" + posnum;
		$(id).remove();
		id = "#exp-disp-" + posnum;
		$(id).remove();					                         
	}
	
	function addNewExp() {
		var exprecord = {
			userid: '',
			posnum: -1,
			startdate: '',
			enddate: '',
			company: '',
			position: '',
			description: ''
		};
		
		createExperienceInfo($("#experience"), exprecord);
		toggleExp(exprecord.posnum);				
	}
	
	
    function getExpFormData(posnum) {
    
    	var startmonth = $("#expstartmonth-" + posnum).val();
    	var endmonth = $("#expendmonth-" + posnum).val() ;
    	var startyear = $("#expstartyear-" + posnum).val() ;
    	var endyear = $("#expendyear-" + posnum).val();
    	var startdatestr = startyear + "-" + startmonth + "-01 00:00:00"
    	var enddatestr = endyear + "-" + endmonth + "-01 00:00:00"

	    var exprec = { 
	    	'experience' : {
		        'posnum' : posnum,
		        'startdate' : startdatestr,
		        'enddate' : enddatestr,
		        'company' : $("#expcompany-" + posnum).val(),
		        'position' : $("#expposition-" + posnum).val(),
		        'description' : $("#expdescription-" + posnum).val(),
		    }
	    };
	
	    return exprec;
    }	


	function saveExperience(posnum) {
	
			if (! validateExperienceInfo(posnum)) {
				return;
			}

			var exprec = getExpFormData(posnum);
						
			var postUrl;
			
			if (posnum== -1) {
				postUrl = config.api.exp.insert;
				exprec.newrec = true;
			} else {
				postUrl = config.api.exp.save;
				exprec.newrec = false;
			}

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(exprec)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							if (response.error.code == 401) {
							     showLogin();
							} else {
								$.jGrowl ("Error saving Experience :" . response.error.message);
							}						
						} else {
	                         if (response.data) {
	                         	var exprec = response.data;

	                         	if (exprec.newrec !== true) {
	                         		updateExperienceInfo(exprec);
		                         	toggleExp(exprec.posnum);
	                         	} else {
	                         		// remove the record for -1 temp and insert the newly created one
	                         		deleteExp(-1);
									createExperienceInfo($("#experience"), exprec);
	                         	}
	                         	
	                         	$.jGrowl("Saved '" + exprec.company + "'");
	                         }                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });         
	}
