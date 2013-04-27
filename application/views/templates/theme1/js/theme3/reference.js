	function createRefDisplayTemplate() {
		$.template( "refdisp", [
			"<div id='ref-disp-${posnum}' style='display:block' class='card formblock rounded' data='${posnum}'>",
			"<div class='disp'><table>",
			"    <tr><th>Name</th><td>${name}</td></tr>",
			"    <tr><th>Position</th><td>${position}</td></tr>",
			"    <tr><th>Company</th><td>${company}</td></tr>",
			"    <tr><th>Recommendation</th><td>${testimonial}</td></tr>",
			"    <tr><th></th><td class='timestamp'>Updated ${updatedago}</td></tr>",
			"</table></div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='ref-modify-${posnum}' data='${posnum}' title='Make changes' href=''>Change</a>",
			"<a class='actionlink rounded' id='ref-delete-${posnum}' data='${posnum}' title='Remove this forever' href=''>Remove</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createRefEditTemplate() {
		$.template ( "refedit", [
			"<div id='ref-edit-${posnum}' style='display:none' class='card formblock rounded' data='${posnum}'>",
			"<form id='ref-edit-form-${posnum}' data='${posnum}' method='POST' action=''>",
			"<table>",
			"    <tr><th>Name</th><td><input name='refname' id='refname-${posnum}' type='text' value='${name}'></input></td></tr>",
			"    <tr><th>Position</th><td><input name='refpos' id='refposition-${posnum}' type='text' value='${name}'></input></td></tr>",
			"    <tr><th>Company</th><td><input name='refcompany' id='refcompany-${posnum}' type='text' value='${name}'></input></td></tr>",
			"	 <tr><th>Recommendation</th><td><textarea id='reftestimonial-${posnum}' name='reftestimonial' title='Eveyrone sees this, so make sure it is indeed interesting'", 
			"			class='element medium' maxlength=2000></textarea></td></tr>",
			"</table>",
			"<div class='edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='ref-save-${posnum}' data='${posnum}' title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='ref-cancel-${posnum}' data='${posnum}' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
		
	}

	function createReferenceTemplates() {
		if (! $.template["refdisp"])
			createRefDisplayTemplate();
		if (! $.template["refedit"])
			createRefEditTemplate();
	}
	
	function loadAndShowReference(refdiv) {
	
		createReferenceTemplates();
		
		var postUrl = config.api.ref.get;
		
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
							$.jGrowl ("Error retrieving Reference :" . response.error.message);
						}						
					} else {
						populateReferenceInfo(refdiv, response.data /* skilist */);
	                }
             },
		     error: function(response) {
					$.jGrowl("Error: " + response.message + " code : " + response.code);
		     }
		});
	}

	function updateReferenceInfo(refrecord) {
	
		refrecord.selfratingname = getRatingName(refrecord.selfrating);
		var refdiv = $('#ref-disp-' + refrecord.posnum);		
		var content = $.tmpl("refdisp", refrecord);
		content.hide();
		refdiv.replaceWith(content);
	}
	
	function validateReferenceInfo(posnum) {
    	var refname = $("#refname-" + posnum).val();
    	var refcompany = $("#refcompany-" + posnum).val();
    	var refposition = $("#refposition-" + posnum).val();
    	var reftestimonial = $("#reftestimonial-" + posnum).val();
 
		var errorid = $("#ref-edit-" + posnum + " .edit-errors");
	
		$(errorid).empty();
		$(errorid).hide();
		
		if (isEmpty(refname)) {
			$(errorid).append("You must enter a name for your reference." );
		}	
		if (isEmpty(refcompany)) {
			$(errorid).append("You must enter a Company name for your reference." );
		}	
		if (isEmpty(refposition)) {
			$(errorid).append("You must enter a title/position for your reference." );
		}	
		if (isEmpty(reftestimonial)) {
			$(errorid).append("You must enter a recommendation." );
		}	
			
		if ($(errorid).html()) {
			$(errorid).show();
			return false;
		}
		
		return true;
	}

	function createReferenceInfo(refdiv, refrecord) {
	
			refrecord.selfratingname = getRatingName(refrecord.selfrating);

	       var addbuttondiv = $("#addreference");
           $.tmpl("refdisp", refrecord).insertBefore(addbuttondiv);
           $.tmpl("refedit", refrecord).insertBefore(addbuttondiv);
                      
           var cls = ".card .actions #ref-modify-" + refrecord.posnum;
           refdiv.delegate(cls, "click", function() {    
           		/// modify - show modify form, hide display data            
                var posnum = $(this).attr('data');
                toggleRef(posnum);
                return false;
            });
            
            cls = ".card .edit-actions #ref-cancel-" + refrecord.posnum;
            refdiv.delegate(cls, "click", function() {
           		/// cancel - hide modify form, show display data            
                var posnum = $(this).attr('data');
                if (posnum == "-1") {
                	deleteRefDivs(posnum);
                	$("#ref-norecords").show();
                } else {
	                toggleRef(posnum);
	            }
                return false;
            });
            
            var options = {  	
            	position: 'bottom',
            	questionText: "Are you sure you <br/>want to delete this?",
            	unique: true,
            	posnum: refrecord.posnum,
            	onProceed: function(trigger, clicked) {
            		$.jGrowl("Deleting record...");
            		deleteRef(this.posnum);
            		$(trigger).fastConfirm('close');
            		return false;
            	},
            	onCancel: function(trigger, clicked) {
            		$(trigger).fastConfirm('close');
            		return false;
            	}            	
            } ;

            cls = ".card .actions #ref-delete-" + refrecord.posnum;
            refdiv.delegate(cls, "click", function() {
            	$(this).fastConfirm(options);
            	return false;
            });
                                    
            cls = ".card .edit-actions #ref-save-" + refrecord.posnum;

			refdiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
            });
			refdiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
            }); 
            
			$("#ref-edit-form-" + refrecord.posnum).validate({   
					rules: {
						refname: { required: true, maxlength: 25, minlength: 2 },
						refposition: { required: true, maxlength: 25, minlength: 2 },
						refcompany: { required: true, maxlength: 50, minlength: 2 },
						reftestimonial: { required: true, maxlength: 2000, minlength: 2 },
					},
					messages: {
						refname: { 
							required: "You must enter a Reference name" 
						},
						refposition: { 
							required: "You must enter a title/position" 
						},
						refcompany: { 
							required: "You must enter Company name" 
						},
						reftestimonial: { 
							required: "You must provide a recommendation" 
						},
					},
					submitHandler : function(f) { 
						saveReference($(f).attr('data')); 
					} 
			   });		
			   
			   $("#ref-norecords").hide();	   
	}

	function populateReferenceInfo(refdiv, reflist) {

        refdiv.empty();
        refdiv.append("<h2 class='rounded'>References</h2>");
        refdiv.append("<div id='ref-norecords' class='norecords' style='display:none'>You do not have any information at the moment. Please click on the button below to add.</div>");
        refdiv.append("<div id='addreference'><input type='submit' value='Add Reference' title='Add more references' name='Add Reference' id='addNewRef' class='submitbutton'></div>");

		if (reflist) {
	        for (i=0; i < reflist.length; i++) {
				createReferenceInfo(refdiv, reflist[i]);                       
        	}
        	if (reflist.length > 0) {
        		$("#ref-norecords").hide();
        	}
        } else {
        	$("#ref-norecords").show();
        }           

		$('#addNewRef').click(function() {
			addNewRef();
		});	

        // hide all actions for all the reference cards
		$(".card .actions").hide();
				
	}

	function toggleRef(posnum) {
        var showdiv = "#ref-disp-" + posnum;
        var editdiv = "#ref-edit-" + posnum;
        
		var togglediv = showdiv + ", " + editdiv;
		$(togglediv).toggle();
	}

	function deleteRef(posnum) {
		
		var postUrl = config.api.ref.remove;
		var refrec = { 
			'reference' : {
		        'posnum' : posnum
		    }
		};

		$.ajax({
			type: "POST",
			url: postUrl,
			dataType: 'json',
			data:  { request : JSON.stringify(refrec) },
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
					deleteRefDivs(posnum);
			    }
			},
			error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
			}
		});		
	}

	function deleteRefDivs(posnum) {
		var id = "#ref-edit-" + posnum;
		$(id).remove();
		id = "#ref-disp-" + posnum;
		$(id).remove();					                         
	}
	
	function addNewRef() {
		var refrecord = {
			userid: '',
			posnum: -1,
			name: '',
			position: '',
			company: '',
			testimonial: ''
		};
		
		createReferenceInfo($("#reference"), refrecord);
		toggleRef(refrecord.posnum);				
	}
	
	
    function getRefFormData(posnum) {
    
    	var refname = $("#refname-" + posnum).val();
    	var refposition = $("#refposition-" + posnum).val();
    	var refcompany = $("#refcompany-" + posnum).val();
    	var reftestimonial = $("#reftestimonial-" + posnum).val();

	    var refrec = { 
	    	'reference' : {
		        'posnum' : posnum,
		        'name' : refname,
		        'position' : refposition,
		        'company' : refcompany,
		        'testimonial' : reftestimonial,
		    }
	    };
	
	    return refrec;
    }	


	function saveReference(posnum) {
	
			if (! validateReferenceInfo(posnum)) {
				return;
			}

			var refrec = getRefFormData(posnum);
						
			var postUrl;
			
			if (posnum== -1) {
				postUrl = config.api.ref.insert;
				refrec.newrec = true;
			} else {
				postUrl = config.api.ref.save;
				refrec.newrec = false;
			}

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(refrec)  } ,
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
	                         	var refrec = response.data;

	                         	if (refrec.newrec !== true) {
	                         		updateReferenceInfo(refrec);
		                         	toggleRef(refrec.posnum);
	                         	} else {
	                         		// remove the record for -1 temp and insert the newly created one
	                         		deleteRef(-1);
									createReferenceInfo($("#reference"), refrec);
	                         	}
	                         	
	                         	$.jGrowl("Saved '" + refrec.name + "'");
	                         }                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });         
	}

/*  
function loadAndShowReference(referencediv) {
	        var postUrl = config.api.ref.get; 

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
							     var login_url = config.page.signin + "?return_url=" + config.page.profile_ref;
							     window.location.href = login_url;
							}
 							$.jGrowl ("Error retrieving References " . response.error); 
						} else {
	                         //$.jGrowl("Success: " + status);
	                         // goto account page
	                         if (response.data) {
    	                         var referencelist = response.data; 
    	                         populateReferenceInfo(referencediv, referencelist);
	                         } else {
	                           // display no education found
	                           referencediv.html("You have not entered your Reference details.");
	                           // display no references found
	                           referencediv.html("<p class='norecords'>You have not entered your References.</p>" +
	                           	'<input type="submit" value="Add Reference" name="Add Skill" id="addnewref" class="submitbutton">'
	                           	);
	                           	
	                           $('#addnewref').click(function() {
	                           		$.jGrowl("Add new reference");
	                           	});	

	                         }                         
	                         //console.log(reflist);	                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });
	}
	
	function populateReferenceInfo(referencediv, referencelist) {
		   var referencetmpl = $.template ( null, [
	       "<div id='reference-${recnum}' class='referencecard formblock'>",
	       "<ul>",
	       "    <li>Name: <span class='company'>${name}</span></li>",
	       "    <li>Position: <span class='position'>${position}</span></li>",
	       "    <li>Company: <span class='company'>${company}<span></li>",
	       "    <li>Testimonial: <span class='testimonial'>${testimonial}<span></li>",
	       "</ul>",
	       "<div class='actions'><a id='referenceedit-${recnum}' href=''>Edit</a></div>",
	       "</div>"
	   ].join(''));
       referencediv.empty();
       for (i=0; i < referencelist.length; i++) {
           referencelist[i].recnum=i;
           $.tmpl(referencetmpl, referencelist[i]).appendTo(referencediv);
           var cls = ".referencecard .actions #referenceedit-" + i;
           $(cls).click(function() {
                
                $.jGrowl (this.id);
                return false;
            });
        }
	}
*/
