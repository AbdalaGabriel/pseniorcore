$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");

	

	 $("#mc-embedded-subscribe").click(function(){
	 	
		/*(function ($) {
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
	 	}*/

	 	email = $("#mce-EMAIL").val();
	 	nombre = $("#mce-FNAME").val();
	 	compania = $("#mce-compania").val();

	 	

	 	function checkForm(){
		  //alert("Boom!");
		  successResponse = $("#mce-success-response").html();

		  if(successResponse == ""){
	 		console.log("failure");
	 		console.log(successResponse );
		 	}
		 	else
		 	{
		 		console.log("Success");
		 		console.log(successResponse );
		 		sendInfoToDataBase();
		 	}
		 	console.log(email);
		 	console.log(nombre);
		 	console.log(compania);

		 	

		}
		

		setTimeout(checkForm, 2000);


		function sendInfoToDataBase()
		{
			console.log("- init function append usuarios");
			routeAddUser = baseurl+"admin/usuarios";;
			token = $("#token").val();

				$.ajax(
				{
					url: routeAddUser,
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {name: nombre, email: email, company: compania, from:'news'},

					success: function(){
						console.log("- Exito en la carga de usuarios");
					}
				});
		}

	 	

	 });

}