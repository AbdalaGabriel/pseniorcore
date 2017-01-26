
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	projectId = $("#projectId").val();
	var route = baseurl+"mis-proyectos/"+projectId+"/phases";
	grouptasks = $(".grouptasks");

	clean();
	console.log( "- Limpieza" );

	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		if(res.length != 0)
			{	console.log("traho"+res),
		$(res).each(function(key, value)
		{
			grouptasks.append('<a href="'+baseurl+"mis-proyectos/phase/"+value.id+'">'+value.title+'</a>');
			
		});
	} else{
		grouptasks.append("<p>Comience creando un nuevo grupo de tareas</p>")
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
	$(".new-group-task").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirm-create-phase").off();
	$("#confirmation-quickEdit").off();

	grouptasks.empty();
}



// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );

	// CREAR NUEVOS GRUPOS DE TAREAS

	$(".new-group-task").click(function()
	{
		console.log( "- Inicio click listener: CREATE" );
		route = baseurl+"mis-proyectos/"+projectId+"/phases";
		token = $("#token").val();

		$("#confirm-create-phase").click(function()
		{
			title = $("#title").val();
			description = $("#content").val();
			console.log( "- Inicio confirmation listener: CREATE" );
			console.log(route);
			console.log(title);
			console.log(description);
			console.log(token);
			console.log(projectId);

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {title: title, content: description,  projectId: projectId},

				success: function(){
					carga();
					console.log( "- Exito en carga Aja, se creo la nueva fase de proyecto" );
				},

				fail: function()
				{ 
					console.log( "- Error en carga Ajax" );
				}
			});
		});
	});

	// CREAR NUEVAS tareas

	$("#new-task").click(function()
	{
		console.log( "- Inicio click listener: CREATE NEW TASK" );
		phaseId = $("#phaseId").val();
		route = baseurl+"mis-proyectos/"+projectId+"/phases/"+phaseId+"/tareas";
		token = $("#token").val();

		$("#confirm-create-task").click(function()
		{
			title = $("#title").val();
			description = $("#content").val();
			console.log( "- Inicio confirmation listener: CREATE" );
			console.log(route);
			console.log(title);
			console.log(description);
			console.log(token);
			console.log(projectId);

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {title: title, content: description,  projectId: projectId},

				success: function(){
					carga();
					console.log( "- Exito en carga Aja, se creo la nueva fase de proyecto" );
				},

				fail: function()
				{ 
					console.log( "- Error en carga Ajax" );
				}
			});
		});
	});


}