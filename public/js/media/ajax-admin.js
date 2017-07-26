var counter = 0;

$( document ).ready(function() 
{
	console.log( "- Document ready" );
	console.log("- Base url: " + baseurl);
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	counter++;
	console.log( "- Carga "+counter );
	var route = baseurl+"admin/media";
	grillaImagenes = $("#mediaGrid");

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		$(res).each(function(key, value)
		{
			// TODO: actualizar rutas en produccion, no puede quedar como file
			grillaImagenes.append('<div class="col-md-3"><a href="#" data-toggle="modal" data-target="#delete-this-image"  data-img-id="'+value.id+'" class="deleteImage">X</a><a href="#" class="editImage" data-toggle="modal" data-target="#edit-this-image" data-img-title="'+value.title+'" data-img-alt="'+value.description+'"  data-img-id="'+value.id+'"><img style="max-width: 100%;" src="/uploads/media/'+value.path+'"/></a></div>');

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
	grillaImagenes.empty();
	$(".delete").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();
	var checksContainer = $(".checkboxes");
	
	checksContainer.empty();
	//grillaImagenes.empty();
}

function defineListerner()
{
	$(".deleteImage").on("click", function()
	{
		console.log( "- Inicio click listener: DELETE" );
		idDeleteButton = $(this).attr("data-img-id");
		route = baseurl+"admin/media/"+idDeleteButton;
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

	$(".editImage").on("click", function()
	{
		console.log( "- Inicio click listener: EDIT" );
		idDeleteButton = $(this).attr("data-img-id");
		titleImageForAppend = $(this).attr("data-img-title");
		altImageForAppend = $(this).attr("data-img-alt");

		titleInput = $("#edittitle");
		altInput = $("#altdescr");

		titleInput.val(titleImageForAppend);
		altInput.val(altImageForAppend);

		routeEditImage = baseurl+"admin/media/"+idDeleteButton;
		token = $("#token").val();

		$("#confirmation-edit").click(function()
		{
			console.log( "- Inicio confirmation listener" );
			console.log(idDeleteButton);
			finaltitle = titleInput.val();
			finalAlt = altInput.val();

			$.ajax(
			{
				url: routeEditImage,
				headers: {'X-CSRF-TOKEN': token},
				type: 'PUT',
				dataType: 'json',
				data: 
				{
					title: finaltitle, 
					description: finalAlt,
				},

				success: function(data){
					console.log(data);
					carga();

				}
			});
		});
	});


	
}