$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");
	var submit = $("#sendForm");

	detectEvents();


	submit.click(function(e)
	{
		// Evitamos que haga submit via formulario, para manejarlo por JS.
		e.preventDefault();
		console.log("- Click submit");

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
		
		// Bloques principales
		var thisBlock =  $(this);
		var i = Iindex;
		var thisBlockId = thisBlock.attr("id");
		var rowsObject = new Object();

		// Segundo bucle for levanto informacion de rows y la guardo en un nuevo objeto.
		var innerRows = $("#"+thisBlockId+" .innerrow");
		
		if(innerRows.length > 0)
		{
			innerRows.each(function(Gindex) 
			{
				var thisInnerRow=  $(this);
				var g = Gindex;
				var thisInnerRowID = thisInnerRow.attr("id");

				// tercer bucle for levanto informacion de innerblocks y la guardo en un nuevo objeto.
				var innerblocks = $("#"+thisBlockId+" #"+thisInnerRowID+" .internblock");
				innerblocks.each(function(Jindex) 
				{
					var thisInnerBlock =  $(this);
					var j = Jindex;
					var thisInnerBlockID = thisInnerBlock.attr("id");
					var typeInnerBlock = thisInnerBlock.attr("data-type");


					// cuarto bucle for levanto informacion de elementos del innerblock y la guardo en un nuevo objeto.
					var thisInnerBlocksElements = $("#"+thisBlockId+" #"+thisInnerRowID+" #"+thisInnerBlockID+" .content > .innerelement");

					if(thisInnerBlocksElements.length > 0)
					{
						thisInnerBlocksElements.each(function(Kindex) 
						{
							var thisInnerBlockElement =  $(this);
							var k = Kindex;
							var thisInnerBlockElementId = thisInnerBlockElement.attr("id");
							var thisInnerBlockContent = $("#"+thisInnerBlockElementId+ " .innercontent");
							var hasLink = thisInnerBlockContent.attr("data-has-link");
							var linkvalue = thisInnerBlockContent.attr("data-linked-to");

							if(hasLink == "y")
							{
								innerBlocksElements[k] = 
								{ 
									id: thisInnerBlockElementId,
									html: thisInnerBlockContent.html(),
									link: linkvalue,
								};
							}
							else
							{
								innerBlocksElements[k] = 
								{ 
									id: thisInnerBlockElementId,
									html: thisInnerBlockContent.html(),
									link: "n",
								};
							};

							console.log("TIENE LINK: " + hasLink);

						});

						innerblocks[j] = 
						{ 
							id: thisInnerBlockID,
							innerblockselements: innerBlocksElements,
							type: typeInnerBlock,
						};

						innerBlocksElements = new Object();

					}
					else
					{
						innerblocks[j] = 
						{ 
							id: thisInnerBlockID,
							innerblockselements: 0,
							type: typeInnerBlock,
						};
					}

				});	

				rowsObject[g] = 
				{ 
					id: thisInnerRowID,
					innerblocks: innerblocks,
				};

			});
		
			// Finalmentec contruyo mi objeto.
			blocksObject[i] = 
			{ 
				id: thisBlockId,
				rows: rowsObject,
			};
		}
		else
		{
			blocksObject[i] = 
			{ 
				id: thisBlockId,
				rows: 0,
			};
		}
	
	});


	// Logs:
	console.log("Front: ");
	//console.log(blocksObject);

	console.log("Edition: ");
	//console.log(htmlForEditionMod);

	// Finalmente enviar informacion via ajax para confirmar edicion.-
	sendAllInformation(htmlForEditionMod, blocksObject);
}

function sendAllInformation(html, jsonObj)
{
	// Log inicio funcion-
	console.log("- Envio final de información");
	// Capturamos variables
		var categories = [];

		$(':checkbox:checked').each(function(i){
			categories[i] = $(this).val();
		});

		var token = $("#token").val();
		var title = $("#new-post-title").val();
		var meta_description = $("#new-meta-content").val();
		var coverImage = fileSelected;
		var routeNew = baseurl+'admin/portfolio';
		var urlfContent = $("#new-post-urlf").val();
		var imagedescription = $("#imagedescription").val();
		var imagetitle = $("#imagetitle").val();
		var blocksForFrontend =JSON.stringify(jsonObj);
		var htmlForEdition =  html;

		
		// Sending test

		console.log(title);

		console.log(categories);
		console.log(coverImage);
		console.log(meta_description);
		console.log(urlfContent);
		//

		console.log("- Se subio la foto de portada a destino temporal");
		//AJAX Mandamos el formulario manualmente via AJAX.
		$.ajax(
		{
			url: routeNew,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: 
			{
				title: title, 
				categories:categories ,
				urlf: urlfContent,
				metadescription: meta_description,
				imagedescription: imagedescription,
				imagetitle: imagetitle,
				editionMethod: 'full',
				htmlForEdition: htmlForEdition,
				blocks: blocksForFrontend,
			},

			success: function(projectId){
				console.log("- Proyecto creado exitosamente");
				console.log("- Iniciamos Carga de imagen en proyecto");
				dropzone.processQueue();
				console.log(projectId);
				check();
			}
		});
}


function detectEvents(){
	$("#new-post-title").focusout(function() {
		console.log("- Se ingresó un titulo para el posteo");
		var title = $("#new-post-title").val();
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
				check();
			}
		});
	})

}