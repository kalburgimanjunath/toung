/*
*=============================================================
*	fbDate is datetime picker jquery plugin
*	..........................................................
*	License : http://creativecommons.org/licenses/by/3.0/
*	Website : http://www.eantz.co.cc/
*	Author	: Destiya Dian Kusuma Wijayanto
*
*
*=============================================================
*
*/

jQuery.fn.fbDate = function(option) {
	var defaults = jQuery.extend({
		date : '#date',
		month : '#month',
		year : '#year'
	}, option);
	
	var d = defaults.date;
	var m = defaults.month;
	var y = defaults.year;
	
	d = $.find(d);
	m = $.find(m);
	y = $.find(y);
	
	$(m).bind('change', function() {
		var c = $.getFbDate($(this).val(), $(y).val());
		var date = parseInt($(d).val());
		
		$.setFbDate(c, d);
		
		if(date < c) {
			$(d).val(date);
		} else {
			$(d).val(0);
		};
	});
	
	$(y).change(function() {
		var c = $.getFbDate($(m).val(), $(this).val());
		var date = parseInt($(d).val());
		
		$.setFbDate(c, d);
		
		if(date < c) {
			$(d).val(date);
		} else {
			$(d).val(0);
		};			 
	});
	
	$.setFbDate = function(c, obj) {
		$(obj).html('');
		$(obj).html('<option value="0">Date : </option>');
		for(t=1;t<=c;t++) {
			$(obj).append('<option value="' + t + '">' + t + '</option>');
		};
	};
	
	$.getFbDate = function(month, year) {
		var c = 0;
		month = parseFloat(month);
		year = parseFloat(year);
		switch(month) {
			case 1:
				c = 31;
				break;
			case 2:
				if((year % 4) == 0) {
					if((year%100) != 0) {
						c = 29;
					} else {
						if((year%400) == 0) {
							c = 29;
						} else {
							c = 28;
						}
					}
				} else {
					c = 28;
				};
				break;
			case 3:
				c = 31;
				break;
			case 4:
				c = 30;
				break;
			case 5:
				c = 31;
				break;
			case 6:
				c = 30;
				break;
			case 7:
				c = 31;
				break;
			case 8:
				c = 31;
				break;
			case 9:
				c = 30;
				break;
			case 10:
				c = 31;
				break;
			case 11:
				c = 30;
				break;
			case 12:
				c = 31;
				break;
			default :
				c= 31;
		};
		
		return c;	
	};
	
	return false;
};