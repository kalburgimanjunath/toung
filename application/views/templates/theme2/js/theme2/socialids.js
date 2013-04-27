	function createSocialIdDisplayTemplate() {
		$.template( "sociddisp", [
			"<div id='soc-disp-${posnum}' style='display:block' class='card formblock rounded'>",
			"<div class='disp'><table>",
			"    <tr><th>Network</th><td>${socnetwork}</td></tr>",
			"    <tr><th>User Id</th><td>${socid}</td></tr>",
			"    <tr><th>Password</th><td>${password}</td></tr>",
			"</table></div>",
			"<div class='actions' style='display:inline-block'>",
			"<a class='actionlink rounded' id='soc-modify-${posnum}' data='${posnum}' title='Make changes' href=''>Change</a>",
			"<a class='actionlink rounded' id='soc-delete-${posnum}' data='${posnum}' title='Remove this forever' href=''>Remove</a>",
			"</div>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
	}

	function createSocialIdEditTemplate() {
	
		$.template ( "socidedit", [
			"<div id='soc-edit-${posnum}' style='display:none' class='card formblock rounded'>",
			"<form id='soc-edit-form-${posnum}' data='${posnum}' method='POST' action=''>",
			"<div class='edit'><table>",
			"    <tr><th>Network</th><td><select name='socnetwork' id='socnetwork-${posnum}' type='text' value='${socnetwork}'><option value='Facebook'>Facebook</option></select></td></tr>",
			"    <tr><th>User Id</th><td><input name='socid' id='socid-${posnum}' type='text' value='${socid}'></input></td></tr>",
			"    <tr><th>Password</th><td><input name='password' id='password-${posnum}' type='text' value='${password}'></input></td></tr>",
			"    <tr><th></th><td><div class='edit-errors' style='display:none'></div></td></tr>",
			"</table></div>",
			"<div class='edit-actions'>",
			"<input type='submit' value='Save' name='Save' class='submitbutton' id='soc-save-${posnum}' data='${posnum}' title='Save changes'/>",
			"<input type='reset' value='Cancel' name='Cancel' class='submitlink' id='soc-cancel-${posnum}' data='${posnum}' title='Cancel changes'/>",
			"</div>",
			"</form>",
			"<div class='cardspacer'></div>",
			"</div>"			
		].join(''));
	}


	function createSocialIdTemplates() {
		if (! $.template["sociddisp"])
			createSocialIdDisplayTemplate();
		if (! $.template["socidedit"])
			createSocialIdEditTemplate();
	}
	
	function loadAndShowSocialIds(socdiv) {
	
		createSocialIdTemplates();
		
		var postUrl = config.api.social.get;
		
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
							$.jGrowl ("Error retrieving SocialId :" . response.error.message);
						}						
					} else {
						populateSocialIdInfo(socdiv, response.data /* soclist */);
	                }
             },
		     error: function(response) {
					$.jGrowl("Error: " + response.message + " code : " + response.code);
		     }
		});
	}

	function updateSocialIdInfo(socrecord) {
	
		var socdiv = $('#soc-disp-' + socrecord.posnum);		
		var content = $.tmpl("sociddisp", socrecord);
		content.hide();
		socdiv.replaceWith(content);
	}
	
	function validateSocialIdInfo(posnum) {
    	var socnetwork = $("#socnetwork-" + posnum).val();
    	var socid = $("#socid-" + posnum).val() ;
		var password = $("#password-" + posnum).val() ;
 
		var errorid = $("#soc-edit-" + posnum + " .edit-errors");
	
		$(errorid).empty();
		$(errorid).hide();
		
		if (isEmpty(socnetwork)) {
			$(errorid).append("You must enter a valid social network name." );
		}	
		if (isEmpty(socid)) {
			$(errorid).append("You must enter a valid social network username." );
		}	
			
		if ($(errorid).html()) {
			$(errorid).show();
			return false;
		}
		
		return true;
	}

	function createSocialIdInfo(socdiv, socrecord) {
	
	       var addbuttondiv = $("#addsocial");
           $.tmpl("sociddisp", socrecord).insertBefore(addbuttondiv);
           $.tmpl("socidedit", socrecord).insertBefore(addbuttondiv);
           
   		   var socnetworkid = '#socnetwork-' + socrecord.posnum;
           var id = $(socnetworkid);

           var socnetworkoptions = getSocialNetworkOptions(socrecord.socnetwork?socrecord.socnetwork:"Facebook");
           id.html(socnetworkoptions);

           var cls = ".card .actions #soc-modify-" + socrecord.posnum;
           socdiv.delegate(cls, "click", function() {    
           		/// modify - show modify form, hide display data            
                var posnum = $(this).attr('data');
                toggleSocial(posnum);
                return false;
            });
            
            cls = ".card .edit-actions #soc-cancel-" + socrecord.posnum;
            socdiv.delegate(cls, "click", function() {
           		/// cancel - hide modify form, show display data            
                var posnum = $(this).attr('data');
                if (posnum == "-1") {
                	deleteSocDivs(posnum);
                	$("#soc-norecords").show();
                } else {
	                toggleSocial(posnum);
	            }
                return false;
            });
            
            var options = {  	
            	position: 'bottom',
            	questionText: "Are you sure you <br/>want to delete this?",
            	unique: true,
            	posnum: socrecord.posnum,
            	onProceed: function(trigger, clicked) {
            		$.jGrowl("Deleting record...");
            		deleteSocial(this.posnum);
            		$(trigger).fastConfirm('close');
            		return false;
            	},
            	onCancel: function(trigger, clicked) {
            		$(trigger).fastConfirm('close');
            		return false;
            	}            	
            } ;

            cls = ".card .actions #soc-delete-" + socrecord.posnum;
            socdiv.delegate(cls, "click", function() {
            	$(this).fastConfirm(options);
            	return false;
            });
                                    
            cls = ".card .edit-actions #soc-save-" + socrecord.posnum;

			socdiv.delegate(".card", "mouseenter", function() {					
            		$(this).find(".actions").fadeIn(500);
            });
			socdiv.delegate(".card", "mouseleave", function() {
            		$(this).find(".actions").fadeOut(100);
            }); 
            
			$("#soc-edit-form-" + socrecord.posnum).validate({   
					rules: {
						socid: { required: true, maxlength: 50, minlength: 2 },
/* 						password: { required: false, maxLength:50, minlength: 2 }, */
					},
					messages: {
						socnetwork: { required: "You must enter a social network name"},
						socid: { required: "You must enter your social network user name" },
						password: { required: "You must enter your social network password" },
					},
					submitHandler : function(f) { 
						saveSocialId($(f).attr('data')); 
					} 
			   });		
			   
			   $("#soc-norecords").hide();	   
	}

	function populateSocialIdInfo(socdiv, soclist) {

        socdiv.empty();
        socdiv.append("<h2 class='rounded'>Social Networks</h2>");
        socdiv.append("<div id='soc-norecords' class='norecords' style='display:none'>You do not have any information at the moment. Please click on the button below to add.</div>");
        socdiv.append("<div id='addsocial'><input type='submit' value='Add Social Network' title='Add more Social Networks' name='Add Social Network' id='addnewsocial' class='submitbutton'></div>");

		if (soclist) {
	        for (i=0; i < soclist.length; i++) {
				createSocialIdInfo(socdiv, soclist[i]);                       
        	}
        	if (soclist.length > 0) {
        		$("#soc-norecords").hide();
        	}
        } else {
        	$("#soc-norecords").show();
        }           

		$('#addnewsocial').click(function() {
			addnewsocial();
		});	

        // hide all actions for all the cards
		$(".card .actions").hide();
				
	}

	function toggleSocial(posnum) {
        var showdiv = "#soc-disp-" + posnum;
        var editdiv = "#soc-edit-" + posnum;
        
		var togglediv = showdiv + ", " + editdiv;
		$(togglediv).toggle();
	}

	function deleteSocial(posnum) {
		
		var postUrl = config.api.social.remove;
		var socrec = { 
			'socialid' : {
		        'posnum' : posnum
		    }
		};

		$.ajax({
			type: "POST",
			url: postUrl,
			dataType: 'json',
			data:  { request : JSON.stringify(socrec) },
			success: function(response, status){
				if (response.error) {
					// error returned
					if (response.error.code == 401) {
					     showLogin();
					} else {
						$.jGrowl ("Error deleting Social Network :" . response.error.message);
					}						
				} else {
					// delete was successful, remove the div from the page
					deleteSocDivs(posnum);
			    }
			},
			error: function(response) {
				$.jGrowl("Error: " + response.message + " code : " + response.code);
			}
		});		
	}

	function deleteSocDivs(posnum) {
		var id = "#soc-edit-" + posnum;
		$(id).remove();
		id = "#soc-disp-" + posnum;
		$(id).remove();					                         
	}
	
	function addnewsocial() {
		var socrecord = {
			userid: '',
			posnum: -1,
			socnetwork: '',
			socid: '',
			password: '',
		};
		
		createSocialIdInfo($("#socialids"), socrecord);
		toggleSocial(socrecord.posnum);				
	}
	
	
    function getSocialFormData(posnum) {
    
    	var socnetwork = $("#socnetwork-" + posnum).val();
    	var socid = $("#socid-" + posnum).val();
    	var password = $("#password-" + posnum).val();

	    var socrec = { 
	    	'socialid' : {
		        'posnum' : posnum,
		        'socnetwork' : socnetwork,
		        'socid' : socid,
		        'password' : password,
		    }
	    };
	
	    return socrec;
    }	


	function saveSocialId(posnum) {
	
			if (! validateSocialIdInfo(posnum)) {
				return;
			}

			var socrec = getSocialFormData(posnum);
						
			var postUrl;
			
			if (posnum== -1) {
				postUrl = config.api.social.insert;
				socrec.newrec = true;
			} else {
				postUrl = config.api.social.save;
				socrec.newrec = false;
			}

	       $.ajax({
                 type: "POST",
                 url: postUrl,
                 dataType: 'json',
                 data:  { request : JSON.stringify(socrec)  } ,
                 success: function(response, status){
						if (response.error) {
							// error returned
							if (response.error.code == 401) {
							     showLogin();
							} else {
								$.jGrowl ("Error saving Social Network :" . response.error.message);
							}						
						} else {
	                         if (response.data) {
	                         	var socrec = response.data;

	                         	if (socrec.newrec !== true) {
	                         		updateSocialIdInfo(socrec);
		                         	toggleSocial(socrec.posnum);
	                         	} else {
	                         		// remove the record for -1 temp and insert the newly created one
	                         		deleteSocial(-1);
									createSocialIdInfo($("#socialids"), socrec);
	                         	}
	                         	
	                         	$.jGrowl("Saved '" + socrec.socnetwork + "'");
	                         }                         
	                    }
                 },
                 error: function(response) {
 					$.jGrowl("Error: " + response.message + " code : " + response.code);
                 }
         });         
	}
