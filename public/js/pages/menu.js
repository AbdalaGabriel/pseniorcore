$( document ).ready(function() 
{
	console.log( "- Document ready" );
	initmenu();
});


function initmenu()
{
	console.log("- Function init menu");
	callmenu();

}

function callmenu()
{
	console.log("- Init function call menu");
	var token = $("#token").val();
	var menucontainer = $("#datos-menu");

	// Llenado de tabla en base a paginas en la base de datos.
	$.ajax(
	{
		url: baseurl+"admin/paginas",
		headers: {'X-CSRF-TOKEN': token},
		type: 'GET',
		dataType: 'json',
		data: {from:'menu'},

		success: function(data)
		{
			console.log("- se obtuvieron datos de urls");
			console.log(data);
			$(data).each(function(key, value)
			{
				menucontainer.append('<tr data-task-order="'+value.order_in_menu+'" data-menuoption-status="'+value.visible_in_menu+'"  data-menuoption-id="'+value.id+'" class="row-menu"><td>'+value.title+'</td><td>'+value.visible_in_menu+'</td></tr>');

			});

			console.log("- Menu created");
			detectEvents();

		}

		
	});
}


function detectEvents()
{
	console.log("- Init function detect events");
	var menucontainer = $("#datos-menu");

	menucontainer.sortable();

	// Evento se cambia el orden dentro de una misma columna
	menucontainer.on( "sortstop", function( event, ui ) 
	{	

		var draggedObject = ui.item;
		var thisoptionstatus = draggedObject.attr("data-menuoption-status");
		var pageId = draggedObject.attr("data-menuoption-id");
		
		//console.log("se ha terminado de ordenar")
		//Cambio de orden de las tarjetas que tiene la tarea.
		// y los voy acumulando en un array para enviar.
		optionsposition = new Array();
		menucontainer.find('.row-menu').each(function(i, el)
		{
			thisoption = $(this);
			thisoption.attr('data-task-order', i);
			//console.log(i);
			var thisId = $(this).attr('data-menuoption-id');
			var thisPos = $(this).attr('data-task-order');
			optionsposition[i]={position: thisPos, id: thisId};
			i++;
		});

		console.log(optionsposition);
		token = $("#token").val();
		// Ejecuto Ajax enviando nuevo orden a la bd
		$.ajax(
		{
			url: baseurl+"paginas/"+pageId+"/changeorder/",
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {neworder: optionsposition},

			success: function(){
				console.log("Se grabo el nuevo orden en la base de datos");
			}
		});

	});




}


