$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");
	var submit = $("#sendForm");
	$('.froala').froalaEditor();
	detectEvents();
	submitControl();
}

function detectEvents(){
	$("#this-page-title").focusout(function() {
		console.log("- Se ingresó un titulo para el posteo");
		var title = $("#this-page-title").val();
		var urlf = $("#new-post-urlf");
		var token = $("#token").val();
		var version = $("#new-post-urlf").attr("data-version");

		$.ajax(
		{
			url: baseurl+"admin/geturl",
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',
			data: {url: title},

			success: function(data)
			{
				console.log("- Se generó la url para le proyecto");
				console.log(data);
				urlf.val(data);
			}
		});
	})

}

function submitControl()
{	
	// Function init log();
	console.log("- Inicio append evento submit");

	var submitEditPageButton = $("#edit-page");
	submitEditPageButton.off();
	submitEditPageButton.click(function(e)
	{
		// Function init log-
		console.log("- Click on submit edit");

		// Prevenir que envie el form
		e.preventDefault();

		// Construir objeto Json.
		collectBlocksInformation();
		

	});
}


function collectBlocksInformation()
{
	// Function init log-
	console.log("- Inicio recollecion de datos para armar objeto json.");

	// Objetos para render en frontend.
	var blocksObject = new Object();
	var innerBlocksObject = new Object();
	var innerBlocksElements = new Object();


	// 1. Identificacion y recoleccion de datos de contenedor padre.
	var fatherBlock = $("#blocks-container");
	var htmlForEditionMod = fatherBlock.html();

	// 2. Creación de objeto para render en frontend.
	// Bloques:
	var blocks = $(".block");
	var blocksNumber = blocks.length;

	blocks.each(function(Iindex) {
		
		// Father
		var thisBlock =  $(this);
		var i = Iindex;
		var thisBlockId = thisBlock.attr("id");

		// Segundo bucle for levanto informacion de innerblocks y la guardo en un nuevo objeto.
		var innerblocks = $("#"+thisBlockId+" .internblock");
		innerblocks.each(function(Jindex) 
		{
			var thisInnerBlock =  $(this);
			var j = Jindex;
			var thisInnerBlockID = thisInnerBlock.attr("id");


			// tercer bucle for levanto informacion de elementos del innerblock y la guardo en un nuevo objeto.
			var thisInnerBlocksElements = $("#"+thisInnerBlockID+" .content > .innerelement");

			if(thisInnerBlocksElements.length > 0)
			{
				thisInnerBlocksElements.each(function(Kindex) 
				{
					var thisInnerBlockElement =  $(this);
					var k = Kindex;
					var thisInnerBlockElementId = thisInnerBlockElement.attr("id");
					var thisInnerBlockContent = $("#"+thisInnerBlockElementId+ " .innercontent");

					console.log("INner el id: "+thisInnerBlockElementId);
					innerBlocksElements[k] = 
					{ 
						id: thisInnerBlockElementId,
						html: thisInnerBlockContent.html(),
					};

				});

				innerblocks[j] = 
				{ 
					id: thisInnerBlockID,
					innerblockselements: innerBlocksElements,
				};

				innerBlocksElements = new Object();

			}
			else
			{
				innerblocks[j] = 
				{ 
					id: thisInnerBlockID,
					innerblockselements: 0,
				};
			}

		});

		// Finalmentec contruyo mi objeto.
		blocksObject[i] = 
		{ 
			id: thisBlockId,
			innerblocks: innerblocks,
		};
	});

	// Hijos bloques

	// Logs:
	console.log("Front: ");
	console.log(blocksObject);

	console.log("Edition: ");
	//console.log(htmlForEditionMod);
}



