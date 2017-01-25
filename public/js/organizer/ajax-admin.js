
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	 idUser = $("#userId").val();
	var route = baseurl+"organizer/"+idUser;
    grillaProyectos = $(".projectsContainer");
	var basepath = ""

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		if(res.length != 0)
		{
			$(res).each(function(key, value)
			{
			    grillaProyectos.append('<tr><td><img width:"30" height="30" src="/uploads/projects/'+value.cover_image+'"></td><td>'+value.title+'<br/><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-project" data-id="'+value.id+'">Quick Edit</a></td> <td>'+value.urlfriendly+'</td><td class="post-categories" data-id="'+value.id+'">-</td><td><a href=baseurl+"admin/portfolio/en/'+value.id+'/edit" data-id="'+value.id+'">Versión en inglés</a></td><td><a href=baseurl+"admin/portfolio/'+value.id+'/edit" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#delete-this-project" data-id="'+value.id+'">Eliminar</button></td></tr>');
				celdaCategorias = $(".post-categories[data-id='"+value.id+"']");

			
			});
		} else{
			grillaProyectos.append("<p>Aún no tiene proyectos</p>")
		} 
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

function clean()
{
	$(".delete").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();
	var checksContainer = $(".checkboxes");
	
	checksContainer.empty();
    grillaProyectos.empty();
}


////////
// Close modal
function closeModal(storedcats)
{
	var checksContainer = $(".checkboxes");
	checksContainer.empty();
	console.log("- Close modal quick edit")
	console.log(storedcats);

	routeCatEdit = baseurl+"admin/blog/editcats";
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

	$(".create-new").click(function()
		{
			console.log( "- Inicio click listener: CREATE" );
			route = baseurl+"organizer/proyectos";
			token = $("#token").val();

			$("#confirm-create").click(function()
			{
				title = $("#title").val();
				urlf = $("#urlf").val();
				description = $("#content").val();
				console.log( "- Inicio confirmation listener: CREATE" );

				$.ajax(
				{
					url: route,
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {title: title, content: content, urlf: urlf, userid: idUser},

					success: function(){
						carga();
					}
				});
			});
		});

		
}