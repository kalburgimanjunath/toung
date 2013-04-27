$(document).ready(function() {
    $("#dash_open").click( function() {
    		if ($('#dash_content').is(":hidden")) {
            $("#dash_open").removeClass("dash_rounded_right",600);
            }else{
            $("#dash_open").addClass("dash_rounded_right",600);
            }
            $("#dash_content").toggle("slow");
           
            event.stopPropagation();
            
        });
});