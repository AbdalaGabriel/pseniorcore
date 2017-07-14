
$( document ).ready(function() 
{
	//console.log( "- Document ready" );
	carga();
	todos = $("#todo-column");
	inprogress = $("#inprogress-column");
	done = $("#done-column");
	token = $("#token").val();
	interaction();
	otherfunctions();


});

function interaction()
{
	//console.log("inicio de interacci{on");
	$(".inputOff").click(function()
	{
		element = $(this);
		//console.log("Click en input");
		element.addClass("inputOn");
		urltomodify = element.attr("data-url");
		actualValue = element.val();

	})
	.focusout(function() 
	{
		$(this).removeClass("inputOn");
		var newValue = element.val();
		if(actualValue == newValue)
		{
			//console.log("no hago nada, los valores son iguales");
		}
		else
		{
			var elementId = element.attr("data-id");
			var elementType = element.attr("data-type");
			var elementDOMType = element.attr("data-element-type");
			
			$.ajax(
			{
				url: baseurl+urltomodify,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {data: newValue, id:elementId, type: elementType},

				success: function(){
					//console.log("Se grabó el nuevo valor");
					if(elementDOMType == "card"){
						//console.log("se salio de editar una tarjeta");
						// Revisar para que busque a la columna q pertenece y no por todos lso tod{s}
						cardToUpdate = $('.task-container[data-task-id="'+elementId+'"]')
						//console.log(elementId);
						//console.log(newValue);
						cardToUpdate.find("a").text(newValue);
					}	
				}
			});
		}
	});
}

function otherfunctions()
{
	//console.log("init-others-function");
	var showphases = $(".show-phases");
	var closephases = $(".close-phases");
	var hiddenMenuPhases = $(".tasks-container");

	showphases.click(function(ev)
	{
		//console.log("init-click-function");
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		hiddenMenuPhases.addClass("showmenu");
		hiddenMenuPhases.removeClass("hidemenu");




		
	});

	closephases.click(function(ev)
	{
		//console.log("init-click-function");
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		hiddenMenuPhases.addClass("hidemenu");
		hiddenMenuPhases.removeClass("showmenu");

	});
}


function mannageDragAndDrop()
{
	// Permito drag and drop en los contenedores.
	todos.sortable({
		connectWith: "div",
		helper : 'clone',
	});
	inprogress.sortable({
		connectWith: "div",
		helper : 'clone',
	});
	done.sortable({
		connectWith: "div",
		helper : 'clone'
	});

	// Evento se cambia el orden dentro de una misma columna
	$( ".task-column" ).on( "sortstop", function( event, ui ) 
	{
		thiscolumn = $(this);
		thiscolumnStatus = thiscolumn.attr("data-tasks-status");

		var draggedObject = ui.item;
		var taskID = draggedObject.attr("data-task-id");
		
		//console.log("se ha terminado de ordenar")
		//Cambio de orden de las tarjetas que tiene la tarea.
		// y los voy acumulando en un array para enviar.
		cardsPosition = new Array();
		thiscolumn.find('.task-container').each(function(i, el)
		{
			thisCard = $(this);
			thisCard.attr('data-task-order', i);
			//console.log(i);
			var thisId = $(this).attr('data-task-id');
			var thisPos = $(this).attr('data-task-order');
			cardsPosition[i]={position: thisPos, id: thisId};
			i++;
		});

		//console.log(cardsPosition);
		token = $("#token").val();
		// Ejecuto Ajax enviando nuevo orden a la bd
		$.ajax(
		{
			url: baseurl+"tasks/"+taskID+"/changeorder/",
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {neworder: cardsPosition},

			success: function(){
				//console.log("Se grabo el nuevo orden en la base de datos");
			}
		});

	});

	
	// Evento: se droppea una tarjeta en otra columina.
	$(".task-column").on( "sortreceive", function( event, ui ) 
	{
		//Leo parámetros de ésta columna.
		thiscolumn = $(this);
		thiscolumnStatus = thiscolumn.attr("data-tasks-status");
		
		// Cambio de status a la tarea
		var draggedObject = ui.item;
		draggedObject.attr("data-task-status",thiscolumnStatus);
		var draggedObjecNewtStatus = draggedObject.attr("data-task-status");
		//console.log(draggedObjecNewtStatus);

		// Ejecuto Ajax enviando el nuevo stado a la bd.
		var taskID = draggedObject.attr("data-task-id");
		var changeStatusRoute = baseurl+"tasks/"+taskID+"/changestatus/"+draggedObjecNewtStatus;
		
		var changeStatus =  $.get(changeStatusRoute, function(res)
		{
			//console.log("cambiado a In Progress");
		});

		//Cambio de orden de las tarjetas que tiene la tarea.
		// y los voy acumulando en un array para enviar.
		cardsPosition = new Array();
		thiscolumn.find('.task-container').each(function(i, el)
		{
			thisCard = $(this);
			thisCard.attr('data-task-order', i);
			//console.log(i);
			var thisId = $(this).attr('data-task-id');
			var thisPos = $(this).attr('data-task-order');
			cardsPosition[i]={position: thisPos, id: thisId};
			i++;
		});

		//console.log(cardsPosition);
		token = $("#token").val();
		// Ejecuto Ajax enviando nuevo orden a la bd
		$.ajax(
		{
			url: baseurl+"tasks/"+taskID+"/changeorder/",
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {neworder: cardsPosition},

			success: function(){
				//console.log("oks");
			}
		});

	});


}

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	//console.log( "- Carga" );

	//Definición de variables
	projectId = $("#projectId").val();
	phaseId = $("#phaseId").val();
	var route = baseurl+"mis-proyectos/"+projectId+"/phase/"+phaseId;
	grouptasks = $("#grouptasks");

	// Limpieza y desactivación de eventos.
	clean();
	//console.log( "- Limpieza" );

	// Pedido de datos al modelo.
	var consulta =  $.get(route, function(res)
	{
		//console.log(res);
		if(res.length > 0)
		{	
			//console.log("traho"+res),
			$(res).each(function(key, value)
			{
				//console.log("Agregada tarea "+value.title)
				grouptasks.append('<a  href="'+baseurl+"mis-proyectos/"+projectId+"/phase/"+value.id+'">'+value.title+'</a> - <a class="deletePhase" data-toggle="modal" data-target="#delete-this-phase" data-id="'+value.id+'" href="#">Borrar</a>');
			});
		} 
		else
		{
			grouptasks.append("<p>Comience creando un nuevo grupo de tareas</p>")
		} 
	})

	.done(function() 
	{
		//console.log( "- Exito Ajax Carga" );
		defineListerner();
		updatecards()
	})

	.fail(function()
	{ 
		//console.log( "Error en carga Ajax" );
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
	$(".deletePhase").off();
	$("#confirmate-delete-phase").off();

	grouptasks.empty();
}


function cleancolumns()
{
	$("#confirm-create-task").off();
	$("#new-task").off();
	todos.empty();
	inprogress.empty();
	done.empty();

}

function updatecards()
{
	console.log( "- Iniciar la carga de tareas" );

	// Limpieza de listeners y contenedores de elementos.
	cleancolumns();
	console.log( "- Limpieza" );



	// Por cada columna de tareas ejecuto un llamado ajax queme traiga ordenadas mis tarjetas
	$(".task-column").each(function(key, value)
	{
		phaseId = $("#phaseId").val();
		thisColumn = $(this);
		thisColumnStatus = thisColumn.attr("data-tasks-status");

		count = 0;
		//console.log("el status de esta columna es "+ thisColumnStatus);

		$.ajax(
		{
			url: baseurl+"phase/"+phaseId+"/tasks/"+thisColumnStatus,
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',
			
			success: function(data){
				//console.log("Orden!: ");
				//console.log(data);
				largoTarjetas = data.length;
				if(largoTarjetas > 0)
				{
					colstatus = data[0].status;
					columnForAppend = $('.task-column[data-tasks-status="'+colstatus+'"]')
					
					//console.log("data no es distinto de null y la columna es ");
					//console.log(columnForAppend);
					for(i=0;i<largoTarjetas;i++)
					{
						columnForAppend.append('<div  data-toggle="modal" data-target="#card-detail" class="task-container" data-task-order="'+data[i].task_order+'" data-task-status="'+data[i].status+'" data-task-id="'+data[i].id+'"><span data-status="4" data-id="'+data[i].id+'" class="hidecard">O</span><a href="#">'+data[i].title+'</a>'+data[i].description+'<p></p></div>');		
					}


				}	

				count = count+1;
				//console.log(count);
				if(count == 3){
					//console.log("terminaron las consultas, llamo func");
					eventsForCards();
				}

			}
		});

	});

	// consultar si hay tarjetas de tipo 4 para esta fase;
	projectId = $("#projectId").val();
	$.ajax(
	{
		url: baseurl+"phase/"+phaseId+"/tasks/4",
		headers: {'X-CSRF-TOKEN': token},
		type: 'GET',
		dataType: 'json',

		success: function(data){
				//console.log("Ocultas: ");
				largoOcultas = data.length;

				if(largoOcultas > 0){
					$("#hiddenCards").text("Ver tarjetas ocultas de esta fase");

					$("#hiddenCards").attr("href", baseurl+"/mis-proyectos/"+projectId+"/phase/"+phaseId+"/tareas-ocultas");
				}
			}
		});


	// Llamado a listeners
	defineListerner();
	// Declaracion de contenedores de elementos draggeables.
	mannageDragAndDrop();
	//console.log("termino ajax");

}

// Inicio de Listeners
function defineListerner()
{
	//console.log( "- Inicio listeners" );
	
	// Borrar grupos de tareas
	$(".deletePhase").click(function()
	{
		//console.log( "- Inicio click listener: DELETE" );
		idDeleteButton = $(this).attr("data-id");
		deleteroute = baseurl+"/mis-proyectos/deletethisphase";
		token = $("#token").val();
		
		$("#confirmate-delete-phase").click(function()
		{
			
			//console.log( "- Inicio confirmation listener" );
			//console.log(idDeleteButton);

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

	// CREAR NUEVOS GRUPOS DE TAREAS
	$(".new-group-task").click(function()
	{
		//console.log( "- Inicio click listener: CREATE" );
		route = baseurl+"mis-proyectos/"+projectId+"/phase";
		token = $("#token").val();

		$("#confirm-create-phase").click(function()
		{
			title = $("#title").val();
			description = $("#content").val();
			//console.log( "- Inicio confirmation listener: CREATE" );
			//console.log(route);
			//console.log(title);
			//console.log(description);
			//console.log(token);
			//console.log(projectId);

			$.ajax(
			{
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {title: title, content: description,  projectId: projectId},

				success: function(){
					carga();
					//console.log( "- Exito en carga Aja, se creo la nueva fase de proyecto" );
				},

				fail: function()
				{ 
					//console.log( "- Error en carga Ajax" );
				}
			});
		});
	});

	// CREAR NUEVAS tareas

	$("#new-task").click(function()
	{
		$("#new-task").off();
		console.log( "- Inicio click listener: CREATE NEW TASK" );
		phaseId = $("#phaseId").val();
		taskroute = baseurl+"mis-proyectos/"+projectId+"/phases/"+phaseId+"/tareas";
		token = $("#token").val();

		$("#confirm-create-task").off();
		$("#confirm-create-task").click(function()
		{
			tasktitle = $("#task-title").val();
			taskdescription = $("#task-content").val();
			//console.log( "- Inicio confirmation listener: CREATE" );
			//console.log(taskroute);
			//console.log(tasktitle);
			//console.log(taskdescription);
			//console.log(token);
			//console.log(projectId);
			//console.log(phaseId)

			$.ajax(
			{
				url: taskroute,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {tasktitle: tasktitle, taskdescription: taskdescription,  projectId: projectId, phaseid: phaseId, order:'0', status:'1' },

				success: function(res){
					//updatecards();
					console.log(res);
					todos.append('<div data-toggle="modal" data-target="#card-detail" class="task-container" data-task-order="0" data-task-status="1" data-task-id="'+res["id"]+'"><span data-status="4" data-id="'+res["id"]+'" class="hidecard">O</span><a href="#">'+tasktitle+'</a><p>'+taskdescription+'</p></div>')
					//console.log( "- Exito en carga AjaX, se creo la nueva fase de proyecto" );
				},

				fail: function()
				{ 
					//console.log( "- Error en carga Ajax" );
				}
			});
		});
	});


}

function eventsForCards(){
	//console.log("Inicializando eventos para tarjetas");
	$('.hidecard').on('click', function (ev) {
		ev.stopPropagation();
		//console.log("Se evito propagar");
		var newStatus = $(this).attr("data-status");
		var cardTaskID = $(this).attr("data-id");
		var changeStatusRoute = baseurl+"tasks/"+cardTaskID+"/changestatus/"+newStatus;
		
		var changeStatus =  $.get(changeStatusRoute, function(res)
		{
			//console.log("cambiado a Oculto");
		});
	});


	$(".task-container").click(function(){
		console.log("Click en tarjeta");
		var estaTarjeta = $(this);
		var idTarjeta = estaTarjeta.attr("data-task-id");

		let cardTitle = $("#card-title");
		let cardDescription = $("#card-description");
		let commentsContainer = $("#cardComments");

		cardTitle.empty();
		cardDescription.empty();
		commentsContainer.empty();

		console.log(idTarjeta);
		
		$.ajax(
		{
			url: baseurl+"task/givemeinfo",
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {id: idTarjeta},

			success: function(data){
				
				console.log("Mostrando info de tarjeta");
				console.log(data[0]);
				let thisObjectCard = data[0];
				cardTitle.val(thisObjectCard.title);
				cardTitle.attr("data-id", thisObjectCard.id);
				cardDescription.text(thisObjectCard.description);

				let dataLength = thisObjectCard.comments.length;

				for (i = 0; i < dataLength; i++)
				{
					let thisComment = thisObjectCard.comments[i];
					let comment = thisComment.comment;
					let userComment = thisComment.user_name;
				 	let userCommentId = thisComment.user_id;
				 	let commentId = thisComment.id;
				 	let commentDate = thisComment.updated_at;


				 	let htmlForAppend = '<div data-comment-id="'+commentId+'" class="commentContainer">';
				 	htmlForAppend += '<p class="comment">'+comment+'</p>';
					htmlForAppend += '<span class="author-comment">'+userComment+'</span> - <span class="commentDate">'+commentDate+'</span>';
				 	htmlForAppend += '</div>';

				 	commentsContainer.append(htmlForAppend);
				}

			}
		});

		 $("#sendComment").off();
    
		$("#sendComment").click(function()
		    {
		        console.log("Click en enviar comentario");
		        newComment = $("#newComment").val();
		        if(newComment != ""){
		            console.log("- Enviar comentario");
		            userID = $("#userID").val();
		            comentRoute = baseurl+"web/"+userID+"/task/"+idTarjeta+"/"+newComment;
		            console.log(comentRoute);
		            $.ajax(
					{
						url: comentRoute,
						headers: {'X-CSRF-TOKEN': token},
						type: 'POST',
						dataType: 'json',


						success: function(data){
							console.log("sucess");

							let thisComment = data;
							let comment = thisComment.comment;
							let userComment = thisComment.user_name;
						 	let userCommentId = thisComment.user_id;
						 	let commentId = thisComment.id;
						 	let commentDate = thisComment.updated_at;

						 	let htmlForAppend = '<div data-comment-id="'+commentId+'" class="commentContainer">';
						 	htmlForAppend += '<p class="comment">'+comment+'</p>';
						 	htmlForAppend += '<span class="author-comment">'+userComment+'</span> - <span class="commentDate">'+commentDate+'</span>';
						 	htmlForAppend += '</div>';

						 	commentsContainer.append(htmlForAppend);

						}

					});
		        }
		        else
		        {
		            //console.log("- Comentario vacio, no se envia nada");
		        }
		    });

	}); 
}