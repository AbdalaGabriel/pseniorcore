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
				if(value.visible_in_menu == 1)
				{
					menucontainer.append('<tr data-task-order="'+value.order_in_menu+'" data-menuoption-status="'+value.visible_in_menu+'"  data-menuoption-id="'+value.id+'" class="row-menu"><td>'+value.title+'<div data-id-father="'+value.id+'" class="childspace"></div></td></tr>');

					if(value.subpages != "n")
					{
						console.log(value.id + "-tiene hijos");
						let children = value.subpages;
						$(children).each(function(key, child)
						{
							$(".childspace[data-id-father='"+value.id+"']").append('<tr data-task-order="'+child.order_in_menu+'" data-menuoption-status="'+child.visible_in_menu+'"  data-menuoption-id="'+child.id+'" class="row-menu"><td>'+child.title+'<div data-id-father="'+child.id+'" class="childspace"></div></td></tr>');
						});
						
					}
				}
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
	let token = $("#token").val();

	menucontainer.sortable({
		connectWith: "div",
		helper : 'clone',
		placeholder: "ui-state-highlight"
	});

	$( ".childspace" ).sortable({
		connectWith: "#datos-menu",
		helper : 'clone',

	});

	$( ".childspace" ).on( "sortout", function( event, ui ) {

		let oldContainer = ui.sender;
		if(oldContainer.hasClass("childspace")){
			let childs = oldContainer.children().length;
			let idFather = oldContainer.attr("data-id-father");

			// utilizo 3 como si fuera 0, porque en el drag esta metodo de jquery agrega otros elementos haciendo q no este vacio del todo.
			if(childs > 3 ){
				console.log("- stil children");
			}else
			{
				console.log("- quedo vacio");
				// Ejecuto Ajax enviando orden de poner null has_children en la bd
				$.ajax(
				{
					url: baseurl+"paginas/changeorder",
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {from:"emptyfather", father: idFather},

					success: function(){
						console.log("Se szvacio el padre en la base de datos");
					}
				});
			}
		}
	} );

	// Evento se cambia el orden dentro de una misma columna
	menucontainer.on( "sortstop", function( event, ui ) 
	{	

		let draggedObject = ui.item;
		let thisoptionstatus = draggedObject.attr("data-menuoption-status");
		let pageId = draggedObject.attr("data-menuoption-id");
		draggedObject.find(".childspace").css("display","block");
		//console.log("se ha terminado de ordenar")
		//Cambio de orden de las tarjetas que tiene la tarea.
		// y los voy acumulando en un array para enviar.
		optionsposition = new Array();
		menucontainer.find('.row-menu').each(function(i, el)
		{
			let thisoption = $(this);
			thisoption.attr('data-task-order', i);
			let thisId = thisoption.attr('data-menuoption-id');
			let thisPos = thisoption.attr('data-task-order');
			optionsposition[i]={position: thisPos, id: thisId};
			i++;
		});

		// Si el padre donde se solto tiene la clase childspace significa se solto como opcion secundaria.
		if(thisOptionFatherId = draggedObject.parent().hasClass("childspace"))
		{
			let thisOptionFatherId = draggedObject.parent().attr("data-id-father");
			draggedObject.find(".childspace").css("display","none");
            inneroptionsposition = new Array();
            
            draggedObject.parent().find('.row-menu').each(function(j, el)
			{
	            let thisinnerOption = $(this);
	            thisinnerOption.attr('data-task-order', j);
	            let thisinnerId = thisinnerOption.attr('data-menuoption-id');
				let thisinnerPos = thisinnerOption.attr('data-task-order');
				inneroptionsposition[j]={position: thisinnerPos, id: thisinnerId};
				j++;
			});


			console.log("- Dragged on iner container");
			console.log(thisOptionFatherId);
			console.log(inneroptionsposition);

			// Ejecuto Ajax enviando nuevo orden a la bd
			$.ajax(
			{
				url: baseurl+"paginas/changeorder",
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {innerneworder: inneroptionsposition, from:"innermenuoption", father: thisOptionFatherId},

				success: function(){
					console.log("Se grabo el nuevo orden inner en la base de datos");
				}
			});
		}
		else
		{
			//si se solto afuer, es una opcion primaria, por tanto ponemos el father en null
			let draggedObject = ui.item;
			let pageId = draggedObject.attr("data-menuoption-id");
			$.ajax(
				{
					url: baseurl+"paginas/changeorder",
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'json',
					data: {from:"mainOptionBack", id: pageId},

					success: function(){
						console.log("Se se puso null la propiedad father de esta opcion en la base de datos");
					}
				});

		}
		
		console.log(optionsposition);
		
		// Ejecuto Ajax enviando nuevo orden a la bd
		$.ajax(
		{
			url: baseurl+"paginas/changeorder",
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {neworder: optionsposition, from:"menuoption"},

			success: function(){
				console.log("Se grabo el nuevo orden en la base de datos");
			}
		});

	});

	


}


