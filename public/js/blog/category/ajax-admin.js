var counter = 0;

$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	counter++;
	console.log( "- Carga "+counter );
	var route = "http://localhost:8000/admin/categorias";
	tablaDatos = $("#datos");

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		$(res).each(function(key, value)
		{
			tablaDatos.append('<tr><td>'+value.title+'<br/><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-post" data-id="'+value.id+'">Quick Edit</a></td><td><a href="http://localhost:8000/admin/blog/'+value.id+'/edit" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#delete-this-post" data-id="'+value.id+'">Eliminar</button></td></tr>');

		});
	})

	.done(function() 
	{
		console.log( "- Exito Ajax Carga" );
		defineListerner();
	})

	.fail(function()
	{ 
		console.log( "Error en carga Ajax" );
	})
};


// Borrado de Listeners
function clean()
{
	$(".delete").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();
	var checksContainer = $(".checkboxes");
	
	checksContainer.empty();
	tablaDatos.empty();
}


////////
// Close modal
function closeModal(storedcats)
{
	var checksContainer = $(".checkboxes");
	checksContainer.empty();
	console.log("- Close modal quick edit")
	console.log(storedcats);

	routeCatEdit = "http://localhost:8000/admin/blog/editcats";
	token = $("#token").val();

	$.ajax(
	{
		url: routeCatEdit,
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {catid: thiscatid, instruct:'restore', postid:thispostid},

		success: function()
		{
			console.log("se atacho placidamente");
		}
	});
	
	carga();
}


// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );

		//////////////////////////////////////////////////////////////////////////////////////
		// Edición rápida

		
			$("#createCategory").click(function()
			{
				console.log( "- Inicio click listener: CREATE" );
				route = "http://localhost:8000/admin/categorias";
				token = $("#token").val();

				$("#confirm-create").click(function()
				{
					namecat = $("#categoryname").val();;
					console.log( "- Inicio confirmation listener: CREATE: "+namecat );

					$.ajax(
					{
						url: route,
						headers: {'X-CSRF-TOKEN': token},
						type: 'POST',
						dataType: 'json',
						data: {cat: namecat},

						success: function(){
							carga();
						}
					});
				});
			});
	

	}