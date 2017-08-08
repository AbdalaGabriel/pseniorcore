//@to-do:actualizar rutas para produccion
var newProjectId;

$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	var route = baseurl+"admin/paginas/home/slider";
	sliderContainer = $("#sliderContainer");

	clean();
	console.log( "- Limpieza" );

	let spanUrl = $(".baseUrl");
	spanUrl.text(baseurl);

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		

		if (res.length > 0) 
		{			
			console.log("Hay respuesta de la API");
			$(res).each(function(key, value)
			{		
				sliderContainer.append('<div data-id="'+value.id+'" data-position="'+value.order_slide+'" class="slideImage" ><a href="#" class="slideEidt-en" data-toggle="modal" data-target="#edit-slide-english" data-slide-id="'+value.id+'">EN</a><img style="max-width: 300px" src="/uploads/sliderhome/'+value.path+'" /><a href="#" class="slideEidt" data-toggle="modal" data-target="#edit-slide" data-slide-id="'+value.id+'">Edit</a><a href="#" class="slideDelete" data-toggle="modal" data-target="#delete-this-slide" data-slide-id="'+value.id+'">X</a></div>');
				
			});

		}
		else
		{
			console.log("NO Hay respuesta de la API");
			sliderContainer.append('<p>Aún no posee slides, haga click en "Agregar slides" para comenzar</p>');
		}

	})

	.done(function() 
	{
		console.log( "- Exito Ajax Carga" );
		sliderContainer.sortable({
			stop: function(event, ui) {
				$(this).find('.slideImage').each(function(i, el){
					$(this).attr('data-position', i);
				});
				console.log("New position: " + ui.item.index());
				console.log(ui);
			}
		});
		sliderContainer.disableSelection();
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

	sliderContainer.empty();
}


// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );

		// CREAR NUEVO SLIDE
		/////////////////////////////////////////////////////////////////////////////////////

		$("#confirm-create").click(function()
		{
			nameslide = $("#nameslide").val();
			subtitleslide = $("#subtitleslide").val();
			route = baseurl+"admin/paginas/home/slider";
			var buttonLink = $("#buttonLink").val();
			var buttonText = $("#buttonText").val();
			var imageTitle = $("#imagetitle").val();
			var imageDescription = $("#imagedescription").val();
			var hasLinkCheckbox = $("#haslink");
			var hasLink = 1;

			if(hasLinkCheckbox.is(":checked"))
			{
				console.log("- has link");
				hasLink = 1;
			}
			else
			{
				console.log("- hasn`t link");
				hasLink = 0;
			}

			console.log( "- Inicio confirmation listener: CREATE" );

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {nameslide: nameslide, subtitleslide: subtitleslide, hasLink: hasLink, buttonText: buttonText, buttonLink: buttonLink, imageTitle: imageTitle, imageDescription: imageDescription},

				success: function(data){
					console.log("- Creación mediante AJAX satisfactoria")
					console.log(data.id);
					newProjectId = data.id;
						// Subimos imagen luego de crear el proyecto
						dropzone.processQueue();
						check();
						
					}
				});
		});

		// EDITAR SLIDE
		/////////////////////////////////////////////////////////////////////////////////////

		$(".slideEidt").click(function()
		{
			console.log( "- Inicio click listener: QUICK EDIT" );
			idQuickEditButton = $(this).attr("data-slide-id");
			routeEdit = baseurl+"admin/paginas/home/slider/"+idQuickEditButton+"/edit";;
			token = $("#token").val();

			$.get(routeEdit, function(res)
			{
				console.log(res);
				$("#nameslideEdit").val(res.title);
				$("#subtitleslideEdit").val(res.subtitle);
				$("#buttonLinkEdit").val(res.buttonLink);
				$("#buttonTextEdit").val(res.buttonText);
				$("#imagetitleEdit").val(res.imagetitle);
				$("#imagedescriptionEdit").val(res.imagedescription);

			});	


			$("#confirmation-edit").click(function()
			{
				console.log( "- Inicio confirmation listener" );
				routeUpdate =  baseurl+"admin/paginas/home/slider/"+idQuickEditButton;
				var newTitle = $("#nameslideEdit").val();
				var newSubtitle = $("#subtitleslideEdit").val();
				var buttonLink = $("#buttonLinkEdit").val();
				var buttonText = $("#buttonTextEdit").val();
				var imageTitle = $("#imagetitleEdit").val();
				var imageDescription = $("#imagedescriptionEdit").val();
				var hasLinkCheckbox = $("#haslink");
				var hasLink = 1;

				if(hasLinkCheckbox.is(":checked")){
					console.log("- has link");
					hasLink = 1;
				}
				else
				{
					console.log("- hasn`t link");
					hasLink = 0;
				}


				$.ajax(
				{
					url: routeUpdate,
					headers: {'X-CSRF-TOKEN': token},
					type: 'PUT',
					dataType: 'json',
					data: {lang: "es", title: newTitle, subtitle: newSubtitle, hasLink: hasLink, buttonText: buttonText, buttonLink: buttonLink, imageTitle: imageTitle, imageDescription: imageDescription},

					success: function(){
						
						if(added){
							console.log("hay iamgen para actualizar");
							dropzone1.processQueue();
						}
						else{
							carga();
						}

						check();

						
					}
				});
			});
		});

		$(".slideEidt-en").click(function()
		{
			console.log( "- Inicio click listener: QUICK EDIT ENglish" );
			idQuickEditButton = $(this).attr("data-slide-id");
			routeEdit = baseurl+"admin/paginas/home/slider/"+idQuickEditButton+"/edit";;
			token = $("#token").val();

			$.get(routeEdit, function(res)
			{
				console.log(res);
				$("#nameslideEdit-en").val(res.en_title);
				$("#subtitleslideEdit-en").val(res.en_subtitle);
				$("#buttonLinkEdit-en").val(res.en_buttonLink);
				$("#buttonTextEdit-en").val(res.en_buttonText);
				$("#imagetitleEdit-en").val(res.en_imagetitle);
				$("#imagedescriptionEdit-en").val(res.en_imagedescription);

			});	


			$("#confirmation-edit-en").click(function()
			{
				console.log( "- Inicio confirmation listener" );
				routeUpdate =  baseurl+"admin/paginas/home/slider/"+idQuickEditButton;
				var newTitle = $("#nameslideEdit-en").val();
				var newSubtitle = $("#subtitleslideEdit-en").val();
				var buttonLink = $("#buttonLinkEdit-en").val();
				var buttonText = $("#buttonTextEdit-en").val();
				var imageTitle = $("#imagetitleEdit-en").val();
				var imageDescription = $("#imagedescriptionEdit-en").val();
				var hasLinkCheckbox = $("#haslink-en");
				var hasLink = 1;

				if(hasLinkCheckbox.is(":checked")){
					console.log("- has link");
					hasLink = 1;
				}
				else
				{
					console.log("- hasn`t link");
					hasLink = 0;
				}


				$.ajax(
				{
					url: routeUpdate,
					headers: {'X-CSRF-TOKEN': token},
					type: 'PUT',
					dataType: 'json',
					data: {lang: "en", title: newTitle, subtitle: newSubtitle, hasLink: hasLink, buttonText: buttonText, buttonLink: buttonLink, imageTitle: imageTitle, imageDescription: imageDescription},

					success: function(){
						
						if(added){
							console.log("hay iamgen para actualizar");
							dropzone1.processQueue();
						}
						else{
							carga();
						}

						
					}
				});
			});
		});

		$(".saveOrder").click(function()
		{
			 slidespositions = new Array();
			var i = 0;
			sliderContainer.find('.slideImage').each(function(){
				console.log(i);
				var thisId = $(this).attr('data-id');
				var thisPos = $(this).attr('data-position');
				slidespositions[i]={position: thisPos, id: thisId};
				
				i++;
			});

			console.log(slidespositions);
			token = $(".saveOrder").attr("data-token");
			$.ajax(
				{
					url: baseurl+"admin/paginas/home/slider/updateorder",
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {neworder: slidespositions},
					
					success: function(){
						console.log("oks");
						//carga();
						
					}
				});
				

		});

		//////////////////////////////////////////////////////////////////////////////////////
		// Borrar esta página

		$(".slideDelete").on("click", function()
		{
			console.log( "- Inicio click listener: DELETE" );
			idDeleteButton = $(this).attr("data-slide-id");
			route = baseurl+"admin/paginas/home/slider/"+idDeleteButton;
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
		
	}