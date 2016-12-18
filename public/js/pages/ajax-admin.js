

$( document ).ready(function() {
	console.log( "document ready" );
	carga();
	
});

//@to-do:actualizar rutas para produccion

function carga()
{
 	//ruta del controlador que tiene los datos en formato json
 	var route = "http://localhost/coresenior/public/admin/paginas";
	var tablaDatos = $("#datos");

	tablaDatos.empty();

	//otra forma de haceruna peticion ajax,
	$.get(route, function(res){

		$(res).each(function(key, value){
			//debo llamar al campo como se llama en la bd, en este caso Nombre!
			tablaDatos.append('<tr><td>'+value.titulo+'</td><td>'+value.urlFriendly+'</td><td><a href="#" class=""  data-toggle="modal" data-target="#myModal" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#myModal" data-id="'+value.id+'">Eliminar</button></td></tr>');
		});

		defineLoaders();
 	});

};




function defineLoaders(){

	//Listener boton delete

	$(".delete").click(function()
	{
		var idDeleteButton = $(this).attr("data-id");
	    var route = "http://localhost/coresenior/public/admin/paginas/"+idDeleteButton;
		var token = $("#token").val();

		//$("#myModal").modal('toggle');

		$("#confirmation").click(function(){

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				
						
				success: function(){
					carga();
					
				}
			});

		});

	});


	// Actualización de datos 

	$("#actualizar").click(function()
	{
		var value = $("#id").val();
		var dato = $("#genre").val();
		var route = "http://localhost/test/public/genecoresenior/public/admin/pagina"+value;
		var token = $("#token").val();

		$.ajax(
		{
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'PUT',
			dataType: 'json',
			data: {genre: dato},
					
			success: function(){
				carga();
				$("#myModal").modal('toggle');
				$("#msj-success").fadeIn();
			}
		});

	});
	
}

	



