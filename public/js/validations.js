
var statuswords = 1;

$( document ).ready(function() {
	initvalidations();
});


function initvalidations(){
	// funcion cambio de palabras home.
	console.log("- init validations ready");
	$("#sendContactForm").off();
	$("#sendContactForm").click(function(event)
	{
    
    	event.preventDefault();
    	console.log("- CLick submite");
    	if (grecaptcha.getResponse() == ""){
		    console.log("You can't proceed!");
		} else {
		    console.log("Thank you");
		    $(".contact-form").submit();
		}
	
	});

	$("#mc-embedded-subscribe").click(function(event)
	{
    
    	event.preventDefault();
    	console.log("- CLick submite");
    	if (grecaptcha.getResponse() == ""){
		    console.log("You can't proceed!");
		} else {
		    console.log("Thank you");
		    $("#mc-embedded-subscribe-form").submit();
		}
	
	});


	
}