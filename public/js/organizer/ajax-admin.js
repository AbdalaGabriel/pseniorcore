
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
	otherfunctions();

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		if(res.length != 0)
			{	console.log("traho"+res),
		$(res).each(function(key, value)
		{
			grillaProyectos.append('<a href="'+baseurl+"mis-proyectos/"+value.id+'" >'+value.title+'</a> - <a class="deleteProject" data-toggle="modal" data-target="#delete-this-project" data-id="'+value.id+'" href="#">Borrar</a></br>');

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

function otherfunctions()
{
	console.log("init-others-function");
	var showphases = $(".show-phases");
	var closephases = $(".close-phases");
	var hiddenMenuPhases = $(".tasks-container");

	showphases.click(function(ev)
	{
		console.log("init-click-function");
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		hiddenMenuPhases.addClass("showmenu");
		hiddenMenuPhases.removeClass("hidemenu");




		
	});

	closephases.click(function(ev)
	{
		console.log("init-click-function");
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		hiddenMenuPhases.addClass("hidemenu");
		hiddenMenuPhases.removeClass("showmenu");

	});
}

function clean()
{
	$(".delete").off();
	$(".create-new").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirm-create-clientproject").off();
	$("#confirmation-quickEdit").off();
	$(".deleteProject").off();
	$("#confirmate-delete").off();

	grillaProyectos.empty();
}



// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );
	$(".deleteProject").click(function()
	{
		console.log( "- Inicio click listener: DELETE" );
		idDeleteButton = $(this).attr("data-id");
		deleteroute = baseurl+"mis-proyectos/delete/";
		token = $("#token").val();
		
		$("#confirmate-delete").click(function()
		{
			
			console.log( "- Inicio confirmation listener" );
			console.log(idDeleteButton);

			$.ajax(
			{
				url: deleteroute,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data:{id:idDeleteButton},

				success: function(){
					carga();
				}
			});
		})
	});

	$(".create-new").click(function()
	{
		console.log( "- Inicio click listener: CREATE" );
		route = baseurl+"mis-proyectos/";
		token = $("#token").val();

		$("#confirm-create-clientproject").click(function()
		{
			title = $("#title").val();
			urlf = $("#urlf").val();
			description = $("#content").val();
			console.log( "- Inicio confirmation listener: CREATE" );
			console.log(route);
			console.log(title);
			console.log(urlf);
			console.log(description);
			console.log(token);
			console.log(idUser);

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {title: title, content: description, urlf: urlf, userid: idUser},

				success: function(){
					carga();
					console.log( "Exito en carga Ajax" );
				},

				fail: function()
				{ 
					console.log( "Error en carga Ajax" );
				}
			});
		});
	});
}