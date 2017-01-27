
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();

	todos = $("#todo-column");
	inprogress = $("#inprogress-column");
	done = $("#done-column");

	// Declaracion de contenedores de elementos draggeables.

	todos.sortable({
		connectWith: "div"
	});
	inprogress.sortable({
		connectWith: "div";
		stop: function(event, ui) {
			$(this).find('.slideImage').each(function(i, el)
			{
				$(this).attr('data-position', i);
			});
			console.log("New position: " + ui.item.index());
			console.log(ui);
		}
	});
	done.sortable({
		connectWith: "div"
	});
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );

	//Definición de variables
	projectId = $("#projectId").val();
	var route = baseurl+"mis-proyectos/"+projectId+"/phases";
	grouptasks = $(".grouptasks");

	// Limpieza y desactivación de eventos.
	clean();
	console.log( "- Limpieza" );

	// Pedido de datos al modelo.
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		if(res.length != 0)
		{	
			console.log("traho"+res),
			$(res).each(function(key, value)
			{
				grouptasks.append('<a href="'+baseurl+"mis-proyectos/phase/"+value.id+'">'+value.title+'</a>');
				
			});
		} 
		else
		{
			grouptasks.append("<p>Comience creando un nuevo grupo de tareas</p>")
		} 
	})

	.done(function() 
	{
		console.log( "- Exito Ajax Carga" );
		defineListerner();
		updatecards()
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
	$("#confirm-create-task").off();
	$("#new-task").off();

	grouptasks.empty();
}

function updatecards()
{
	console.log( "- Iniciar la carga de tareas" );

	// Limpieza de listeners y contenedores de elementos.
	clean();
	console.log( "- Limpieza" );
	todos.empty();

	// Generación dinámica de ruta en base a la vista de grupo de tareas activa.
	phaseId = $("#phaseId").val();
	taskroute = baseurl+"mis-proyectos/"+projectId+"/phases/"+phaseId+"/tareas";

	// Append de elementos que me otorga el modelo.
	var consultatasks =  $.get(taskroute, function(res)
	{
		console.log(res);
		if(res.length != 0)
		{	
			console.log("-vCantidad de tareas obtenidas: "+res),
			$(res).each(function(key, value)
			{
				todos.append('<div class="task-container"><a href="#">'+value.title+'</a>'+value.description+'<p></p></div>');		
			});
		}
		else
		{
			todos.append("<p>Comience creando un nuevo grupo de tareas</p>");
		} 
	})

	defineListerner();
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
		taskroute = baseurl+"mis-proyectos/"+projectId+"/phases/"+phaseId+"/tareas";
		token = $("#token").val();

		$("#confirm-create-task").click(function()
		{
			tasktitle = $("#task-title").val();
			taskdescription = $("#task-content").val();
			console.log( "- Inicio confirmation listener: CREATE" );
			console.log(taskroute);
			console.log(tasktitle);
			console.log(taskdescription);
			console.log(token);
			console.log(projectId);
			console.log(phaseId)

			$.ajax(
			{
				url: taskroute,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {tasktitle: tasktitle, taskdescription: taskdescription,  projectId: projectId, phaseid: phaseId, order:'0', status:'1' },

				success: function(){
					updatecards();
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