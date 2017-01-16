$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");



	 $("#mc-embedded-subscribe").click(function(){

		(function ($) {
	    $.fn.inlineStyle = function (prop) {
	        return this.prop("style")[$.camelCase(prop)];
	    };
		}(jQuery));

	 	var estiloExito = $("#mce-success-response").inlineStyle("display");
	 	console.log(estiloExito);
	 	if(estiloExito == "none"){

		 console.log("failure");
	 	}else{
	 		console.log("exito");
	 	}


	 });

}