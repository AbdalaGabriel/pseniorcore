//@to-do:actualizar rutas para produccion

$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	var route = baseurl+"admin/paginas";
	tablaDatos = $("#datos");

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		$(res).each(function(key, value)
		{
			tablaDatos.append('<tr><td>'+value.title+'<br/><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-modal" data-id="'+value.id+'">Quick Edit</a></td> <td>'+value.urlfriendly+'</td><td><a href="'+baseurl+'admin/paginas/'+value.id+'/edit" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#myModal" data-id="'+value.id+'">Eliminar</button></td></tr>');
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
	$("#createPage").off();
	$("#confirm-create").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();

	tablaDatos.empty();
}


// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );

		//////////////////////////////////////////////////////////////////////////////////////
		// Edición rápida

		$(".quickEdit").click(function()
		{
			console.log( "- Inicio click listener: QUICK EDIT" );
			idQuickEditButton = $(this).attr("data-id");
			routeEdit = baseurl+"admin/paginas/"+idQuickEditButton+"/edit";;
			token = $("#token").val();

			$.get(routeEdit, function(res)
			{
				$("#titleQuickEdit").val(res.title);
			});	


			$("#confirmation-quickEdit").click(function()
			{
				console.log( "- Inicio confirmation listener" );
				routeUpdate =  baseurl+"admin/paginas/"+idQuickEditButton;
				var newTitle = $("#titleQuickEdit").val();

				$.ajax(
				{
					url: routeUpdate,
					headers: {'X-CSRF-TOKEN': token},
					type: 'PUT',
					dataType: 'json',
					data: {title: newTitle},

					success: function(){
						carga();
					}
				});
			});
		});


		//////////////////////////////////////////////////////////////////////////////////////
		// Crear página nueva

		$("#createPage").click(function()
		{
			console.log( "- Inicio click listener: CREATE" );
			route = baseurl+"admin/paginas";
			token = $("#token").val();

			$("#confirm-create").click(function()
			{
				namepage = $("#namepage").val();
				console.log( "- Inicio confirmation listener: CREATE" );

				$.ajax(
				{
					url: route,
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {page: namepage},

					success: function(){
						carga();
					}
				});
			});
		});


		//////////////////////////////////////////////////////////////////////////////////////
		// Borrar esta página

		$(".delete").on("click", function()
		{
			console.log( "- Inicio click listener: DELETE" );
			idDeleteButton = $(this).attr("data-id");
			route = baseurl+"admin/paginas/"+idDeleteButton;
			token = $("#token").val();

			$("#confirmation").click(function()
			{
				console.log( "- Inicio confirmation listener" );
				console.log(idDeleteButton);

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

		// Metodo de edicion completa de pagina en form controller para generar logica de bloques.
	}