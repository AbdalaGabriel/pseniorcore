$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	var route = "http://localhost/masashigue/public/admin/blog";
	tablaDatos = $("#datos");

	//clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		$(res).each(function(key, value)
		{
			tablaDatos.append('<tr><td>'+value.title+'<br/><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-modal" data-id="'+value.id+'">Quick Edit</a></td> <td>'+value.urlfirendly+'</td><td><a href="http://localhost/masashigue/public/admin/paginas/'+value.id+'/edit" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#myModal" data-id="'+value.id+'">Eliminar</button></td></tr>');
		});
	})

	.done(function() 
	{
		console.log( "- Exito Ajax Carga" );
		//defineListerner();
	})

	.fail(function()
	{ 
		console.log( "Error en carga Ajax" );
	})
};
